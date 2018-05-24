using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Drawing;
using System.Windows.Forms;

using System.IO;
using NAudio.Wave;
using LowKey;
using NAudio.CoreAudioApi;
using NAudio.Vorbis;
using NAudio.Wave.SampleProviders;
//using System.Globalization;

namespace HKSoundPlayer
{
    public partial class Form1 : Form
    {
        // Constructor
        public Form1()
        {
            InitializeComponent();
        }

        // Form Loading
        private void Form1_Load(object sender, EventArgs e)
        {
            DisableDataForm();

            // MMDevice Enumerator
            MMDeviceEnumerator enumerator = new MMDeviceEnumerator();

            // WaveOut Device (32 char limit)
            for (int i = 0; i < WaveOut.DeviceCount; i++)
            {
                // WaveOutCapabilities (32 char limit)
                WaveOutCapabilities woc = WaveOut.GetCapabilities(i);
                String deviceName = "";

                // Using MMDevice
                foreach (MMDevice device in enumerator.EnumerateAudioEndPoints(DataFlow.Render, DeviceState.All))
                {
                    if (device.FriendlyName.StartsWith(woc.ProductName))
                    {
                        deviceName = device.FriendlyName;
                        break;
                    }
                }

                // No MMDevice Found so we use WaveOut one
                if(deviceName != "")
                    deviceComboBox.Items.Add(deviceName);
                else
                    deviceComboBox.Items.Add(woc.ProductName);
            }

            // Dispose
            enumerator.Dispose();

            // Select Default One
            deviceComboBox.SelectedIndex = 0;

            // Start Hooking
            hooker.HotkeyDown += Hooker_HotkeyDown;
            startHooking();
        }
        // Form Closing
        private void Form1_FormClosing(object sender, FormClosingEventArgs e)
        {
            if(waveOut != null)
                waveOut.Dispose();
            stopHooking();
        }

        // Structure
        public struct HKSound
        {
            public String name;
            public String completeFilename;
            public String filename;
            public String path;
            public String extension;
            public float volume;
            public String hotkey;
            public bool active;
        }

        // Global Variables
        List<HKSound> soundFiles = new List<HKSound>();
        KeyboardHook hooker = KeyboardHook.Hooker;
        bool disableUIEvent = false;
        int selectedSound = -1;
        int selectedDevice = 0;
        HKSound currentSound;
        WaveOut waveOut;
        AudioFileReader audioFile;
        VorbisWaveReader currentOGG;

        // KEYBOARD HOOKING

        // Start Keyboard Hooking
        public void startHooking()
        {         
            try
            {
                if (!hooker.IsHooked)
                    hooker.Hook();
                debugLog("[Action] Hook Enabled // State : " + hooker.IsHooked.ToString());
            }
            catch (KeyboardHookException exc)
            {
                debugLog("[Exception] " + exc.Message);
            }
        }
        // Stop Keyboard Hooking
        public void stopHooking()
        {
            try
            {                
                if (hooker.IsHooked)
                    hooker.Unhook();
                debugLog("[Action] Hook Disabled / State : " + hooker.IsHooked.ToString());
            }
            catch (KeyboardHookException exc)
            {
                debugLog("[Exception]" + exc.Message);
            }
        }
        // Clear All Hook
        public void clearHooking()
        {
            if(hooker != null)
                hooker.Clear();
            debugLog("[Action] Hooks cleared");
        }

        // Hook Event
        private void Hooker_HotkeyDown(object sender, KeyboardHookEventArgs e)
        {
            debugLog("[Event] Event " + e.Name + " launched");

            // STOP and VOLUME Hotkeys
            if (e.Name == "HK_STOP")
            {
                stopSound();
                return;
            }
            else if(e.Name == "HK_VOLUP")
            {
                changeVolume(true);
                return;
            }
            else if (e.Name == "HK_VOLDOWN")
            {
                changeVolume(false);
                return;
            }

            // Is Hook actually a song Name
            foreach (HKSound sound in soundFiles)
                if(sound.name == e.Name)
                    playSoundAtPos(soundFiles.IndexOf(sound));
        }

        // Add Hook for selected Sound
        public void addHook(int soundPos)
        {
            // Should not happened
            if (soundPos == -1 || soundFiles[soundPos].hotkey == "" || !soundFiles[soundPos].active)
                return;

            // Set Hot Key for Hook
            String[] subHotKey = soundFiles[soundPos].hotkey.Split(','); ;
            Keys mainKey = (Keys)Enum.Parse(typeof(Keys), subHotKey[0]);
            Keys modKeys = Keys.None;
            if (subHotKey.Length > 1)
                for (int i = 1; i < subHotKey.Length; i++)
                    modKeys |= (Keys)Enum.Parse(typeof(Keys), subHotKey[i]);

            // DEBUG
            debugLog("[Hotkey] Sound " + soundFiles[soundPos].name + " hooked");
            debugLog("[Hotkey] Main Key : " + mainKey.ToString());
            debugLog("[Hotkey] Mods Key : " + modKeys.ToString());

            // Check if HotKey Combination is already set
            for(int i=0; i<soundFiles.Count; i++)
            {
                // Actual Sound
                if (soundPos == i)
                    continue;

                // Hotkey already in use
                if(soundFiles[soundPos].hotkey == soundFiles[i].hotkey)
                {
                    debugLog("[Warning] Current Hotkey already used by : " + soundFiles[i].name);
                    clearHotKeyfor(soundPos);
                    return;
                }
            }            

            // We first remove then add INSTEAD of Adding then remove/add
            // true important il permet de laisser passer le hook aux autres application 
            try
            {
                hooker.Add(soundFiles[soundPos].name, mainKey, modKeys, true);
            }
            catch (KeyboardHookException exc)
            {
                debugLog("[Exception] " + exc.ToString());
            }
        }
        // Remove Hook for selected Sound
        public void removeHook(int soundPos)
        {
            if (soundPos == -1)
                return;

            try
            {
                hooker.Remove(soundFiles[soundPos].name);
                debugLog("[Hook] Removed : " + soundFiles[soundPos].name);
            }
            catch (KeyboardHookException exc)
            {
                debugLog("[Exception] " + exc.Message);
            }
        }

        // Clear Hotkey for a Sound
        public void clearHotKeyfor(int soundPos)
        {
            // Should not happened
            if (soundPos == -1)
                return;

            // Save Name
            var hk = new HKSound();
            hk = soundFiles[soundPos];
            hk.hotkey = "";
            hk.active = false;
            soundFiles[soundPos] = hk;

            // Remove Hook
            removeHook(soundPos);

            // If not actually displayed dont touch UI
            if (soundPos != selectedSound)
                return;

            // UI
            disableUIEvent = true;
            activeCheckBox.Enabled = false;
            activeCheckBox.Checked = false;
            setHotkeyBox.Text = "";
            soundListBox.Items[soundPos] = hk.name;
            disableUIEvent = false;

        }



        // SOUND

        // Play Sound
        public void playSound(HKSound sound)
        {
            if (waveOut != null)
            {
                debugLog("[Sound] Disposed");
                waveOut.Dispose();
            }
            waveOut = new WaveOut();
            waveOut.DeviceNumber = selectedDevice;
            checkSoundState.Stop();
            debugLog("[Action] Sound " + sound.filename);

            // VorbisWaveReader is not in AudioFileReader but is a ISampleProvider
            if (sound.extension == ".ogg")
            {
                if (currentOGG != null)
                    currentOGG.Dispose();
                currentOGG = new VorbisWaveReader(sound.completeFilename);
     
                waveOut.Init(currentOGG);                
                waveOut.Play();
                waveOut.Volume = sound.volume;                
                checkSoundState.Start();
                currentSound = sound;
                debugLog("[Sound] Volume : " + sound.volume);
                debugLog("[Sound] OGG Start");
            }
            else if(".mp3.mp4.wav".Contains(sound.extension))
            {
                if (audioFile != null)
                    audioFile.Dispose();
                audioFile = new AudioFileReader(sound.completeFilename);
                waveOut.Init(audioFile);
                waveOut.Play();                
                waveOut.Volume = sound.volume;
                checkSoundState.Start();
                currentSound = sound;
                debugLog("[Sound] Volume : " + sound.volume);
                debugLog("[Sound] MP3/MP4/WAV Start");
            }
            else
            {
                debugLog("[Sound] Not MP3, MP4 nor WAV");
            }

        }
        // Play Sound at Position
        public void playSoundAtPos(int position)
        {
            // Should not happened
            if (position == -1)
                return;

            // File does not exist
            if (!System.IO.File.Exists(soundFiles[position].completeFilename))
            {
                debugLog("[Warning] File does not exists : " + soundFiles[position].filename);
                return;
            }

            playSound(soundFiles[position]);
        }
        // Stop Sound
        public void stopSound()
        {
            if (waveOut == null)
                return;

            // Stop if Playing
            if (waveOut.PlaybackState == PlaybackState.Playing)
            {
                debugLog("[Action] Stopped");
                waveOut.Stop();
            }
            else
            {
                debugLog("[Warning] Already Stopped");
            }
        }
        // Change volume
        public void changeVolume(bool up)
        {            
            if (waveOut == null)
                return;

            // Not actually Playing so dont need to change volume
            if (waveOut.PlaybackState != PlaybackState.Playing)
                return;

            float newVol = waveOut.Volume;
            if (up)
            {
                newVol = newVol + (float)0.050;
                if (newVol > 1)
                    newVol = 1;
            }
            else
            {
                newVol = newVol - (float)0.050;
                if (newVol < 0)
                    newVol = 0;
            }
            int v = (int)(newVol * 100);
            waveOut.Volume = (float) v / (float)100;
            debugLog("[Volume] New volume : " + waveOut.Volume.ToString());
        }



        // SETTINS SAVING & LOADING

        // Save Settings
        public void saveSettings()
        {
            MemoryStream stream = new MemoryStream();
            System.Runtime.Serialization.Json.DataContractJsonSerializer serializer = new System.Runtime.Serialization.Json.DataContractJsonSerializer(typeof(List<HKSound>));
            serializer.WriteObject(stream, soundFiles);
            byte[] json = stream.ToArray();
            System.IO.File.WriteAllBytes("settings.ini", json);
        }
        // Load Settings
        public void loadSettings()
        {
            if(!System.IO.File.Exists("settings.ini"))
            {
                debugLog("[Warning] Settings.ini missing, save in first place");
                return;
            }
            System.Runtime.Serialization.Json.DataContractJsonSerializer serializer = new System.Runtime.Serialization.Json.DataContractJsonSerializer(typeof(List<HKSound>));
            MemoryStream ms = new MemoryStream(System.IO.File.ReadAllBytes("settings.ini"));
            soundFiles = serializer.ReadObject(ms) as List<HKSound>;

            // Clean Hook
            clearHooking();

            // Clear List for Recreation
            soundListBox.Items.Clear();
            for (int i = 0; i < soundFiles.Count; i++)
            {
                if(soundFiles[i].hotkey == "")
                    soundListBox.Items.Add(soundFiles[i].name);
                else
                    soundListBox.Items.Add(hotkeyFriendlyName(soundFiles[i].hotkey) + " : " + soundFiles[i].name);

                if (soundFiles[i].active)
                    addHook(i);
            }
        }



        // UTILS

        // Display Hotkey as Friendly (and shorter ;-)
        public String hotkeyFriendlyName(String hotkey)
        {
            if (hotkey == "")
                return "";

            // Remove Space
            hotkey = hotkey.Replace(" ", "");

            string[] hks = hotkey.Split(',');
            String keys = "";

            // Modifiers
            if (hotkey.Contains("Control"))
                keys += "Ctrl+";
            if (hotkey.Contains("Alt"))
                keys += "Alt+";
            if (hotkey.Contains("Shift"))
                keys += "Shift+";

            // Main Key
            keys += hks[0];

            // Replace
            keys = keys.Replace("NumPad", "");            

            return keys;
        }



        // LOGGING

        // Log TO UI
        public void debugLog(String logText)
        {
            logTextBox.AppendText(logText + "\r\n");
        }



        // TIMER

        // Timer Event
        private void checkSoundState_Tick(object sender, EventArgs e)
        {
            if (waveOut.PlaybackState == PlaybackState.Stopped)
            {
                waveOut.Dispose();
                checkSoundState.Enabled = false;                
                if (audioFile != null)
                    audioFile.Dispose();
                if (currentOGG != null)
                    currentOGG.Dispose();

                // CurrentSound
                currentSound = new HKSound();

                // UI
                toolStripStatusLabel2.Text = "Stopped";
                debugLog("[Sound] Disposed from timer");
            }
            else
            {
                // UI
                toolStripStatusLabel2.Text = "Playing : " + currentSound.name;
            }
        }



        // UI

        // UI LISTBOX : Device in ListBox Changed
        private void deviceComboBox1_SelectedIndexChanged(object sender, EventArgs e)
        {
            // Set Device
            selectedDevice = deviceComboBox.SelectedIndex;
        }

        // UI LISTBOX : Sound in ListBox Changed
        private void soundListBox_SelectedIndexChanged(object sender, EventArgs e)
        {
            // Event disabled
            if (disableUIEvent)
                return;

            // Set Current Sound
            selectedSound = soundListBox.SelectedIndex;

            if (selectedSound == -1)
                DisableDataForm();
            else
                setDataForm();
        }

        // UI BUTTON :  Add Sound to ListBox
        private void addSoundButton_Click(object sender, EventArgs e)
        {
            var hk = new HKSound();
            hk.name = "New Sound";
            hk.completeFilename = "";
            hk.volume = 1;
            hk.hotkey = "";
            hk.active = false;
            soundFiles.Add(hk);

            // UI
            soundListBox.Items.Add("New Sound");
            soundListBox.SelectedIndex = soundListBox.Items.Count - 1;
        }

        // UI BUTTON : Delete Sound from ListBox
        private void deleteSoundButton_Click(object sender, EventArgs e)
        {
            if (selectedSound == -1)
                return;

            removeHook(selectedSound);
            soundFiles.RemoveAt(selectedSound);
            soundListBox.Items.RemoveAt(selectedSound);

            if (soundListBox.Items.Count > 0)
                soundListBox.SelectedIndex = 0;
            else
            {
                selectedSound = -1;
                DisableDataForm();
            }
        }

        // UI TEXTBOX : Save Name
        private void setNameBox_TextChanged(object sender, EventArgs e)
        {
            // Should not happened
            if (selectedSound == -1)
                return;

            // Set by Code - Don't launch event
            if (disableUIEvent)
                return;

            // Save Name
            var hk = new HKSound();
            hk = soundFiles[selectedSound];
            String oldName = hk.name;
            hk.name = setNameBox.Text;
            soundFiles[selectedSound] = hk;

            // Avoid Event START
            disableUIEvent = true;

            if(soundFiles[selectedSound].hotkey != "")
                soundListBox.Items[selectedSound] = hotkeyFriendlyName(soundFiles[selectedSound].hotkey) + " : " + setNameBox.Text;
            else
                soundListBox.Items[selectedSound] = setNameBox.Text;

            // Avoid Event END
            disableUIEvent = false;

            // Remove OldName Hook
            if (activeCheckBox.Checked)
            {
                setActiveCheckbox(false);

                try
                {
                    if (oldName == "")
                        oldName = "New Sound";
                    hooker.Remove(oldName);
                    debugLog("[Action] Hook for " + oldName + " removed");
                }
                catch (KeyboardHookException exc)
                {
                    debugLog("[Exception] " + exc.Message);
                }
            }
        }

        // UI FILE DIALOG : Open File Dialog
        private void selectFileButton_Click(object sender, EventArgs e)
        {
            openFileDialog1.ShowDialog();
        }
        // UI FILE DIALOG : Selected File in File Dialog
        private void openFileDialog1_FileOk(object sender, CancelEventArgs e)
        {
            // Save File Data
            var hk = new HKSound();
            hk = soundFiles[selectedSound];
            hk.completeFilename = openFileDialog1.FileName;
            hk.filename = openFileDialog1.SafeFileName;
            hk.path = Path.GetDirectoryName(hk.completeFilename);
            hk.extension = Path.GetExtension(hk.completeFilename);
            soundFiles[selectedSound] = hk;

            // UI
            setFilenameLabel.Text = hk.filename;
            setPathLabel.Text = hk.path;
        }

        // UI BUTTON : Test Sound from ListBox
        private void testSoundButton_Click(object sender, EventArgs e)
        {
            playSoundAtPos(selectedSound);
        }
        // UI BUTTON : Stop Sound
        private void stopButton_Click(object sender, EventArgs e)
        {
            stopSound();
        }

        // UI SCROLBAR : Save Volume
        private void volumeBar_Scroll(object sender, EventArgs e)
        {
            // Should not happened
            if (selectedSound == -1)
                return;

            // Save Volume
            var hk = new HKSound();
            hk = soundFiles[selectedSound];
            hk.volume = (float)volumeBar.Value / 100;
            soundFiles[selectedSound] = hk;

            // Set Actual volume if Selected Sound is CurrentSound
            if (waveOut != null)
                if (hk.name == currentSound.name)
                    if (waveOut.PlaybackState == PlaybackState.Playing)
                    {
                        waveOut.Volume = (float)volumeBar.Value / 100;
                        debugLog("[Volume] Volume set via scrollbar to : " + waveOut.Volume.ToString());
                    }
        }

        // UI KEYDOWN : Save HotKey
        private void textBox1_KeyDown(object sender, KeyEventArgs e)
        {
            // Should not happened
            if (selectedSound == -1)
                return;

            // Save Name
            var hk = new HKSound();
            hk = soundFiles[selectedSound];
            hk.active = true;
            hk.hotkey = e.KeyData.ToString();
            soundFiles[selectedSound] = hk;
        }
        // UI BUTTON : Remove HotKey
        private void deleteHKButton_Click_1(object sender, EventArgs e)
        {
            if(soundFiles[selectedSound].hotkey != "")
                clearHotKeyfor(selectedSound);
        }

        // UI CHECKBOX : Save Active
        private void activeCheckBox_CheckedChanged(object sender, EventArgs e)
        {
            // Set by Code - Don't launch event
            if (disableUIEvent)
                return;

            // Should not happened
            if (selectedSound == -1)
                return;

            // Save Name
            var hk = new HKSound();
            hk = soundFiles[selectedSound];
            hk.active = activeCheckBox.Checked;
            soundFiles[selectedSound] = hk;

            // Activate Hook
            if (hk.active)
                addHook(selectedSound);
            else
                removeHook(selectedSound);
        }

        // UI Checkbox : Set Active Checkbox without starting an Event
        private void setActiveCheckbox(bool check)
        {
            disableUIEvent = true;
            activeCheckBox.Checked = check;
            disableUIEvent = false;
        }

        // UI : Remove Focus from HotKey Box
        private void setHotkeyBox_KeyUp(object sender, KeyEventArgs e)
        {
            // Should not happened
            if (selectedSound == -1)
                return;

            // UI
            disableUIEvent = true;
            activeCheckBox.Enabled = true;
            activeCheckBox.Checked = true;
            setHotkeyBox.Text = soundFiles[selectedSound].hotkey;
            soundListBox.Items[selectedSound] = hotkeyFriendlyName(soundFiles[selectedSound].hotkey) + " : " + soundFiles[selectedSound].name;
            disableUIEvent = false;

            // Set Focus
            setHotkeyBox.BackColor = Color.Empty;
            soundListBox.Focus();

            // Re-allow Hooking
            startHooking();

            // Add Hook
            addHook(selectedSound);
        }

        // UI : Set Color for HotKey Box
        private void setHotkeyBox_Enter(object sender, EventArgs e)
        {
            stopHooking();
            if (setHotkeyBox.Text != "")
                clearHotKeyfor(selectedSound);
            setHotkeyBox.BackColor = Color.LightSkyBlue;
        }

        // UI : If the user leave the textbox without setting hotkey
        private void setHotkeyBox_Leave(object sender, EventArgs e)
        {
            if (setHotkeyBox.Text == "")
            {
                setHotkeyBox.BackColor = Color.Empty;
                startHooking();
            }
        }

        // UI BUTTON : Save to File
        private void saveToFileButton_Click(object sender, EventArgs e)
        {
            saveSettings();
        }
        // UI BUTTON : Load From File
        private void loadFromFileButton_Click(object sender, EventArgs e)
        {            
            loadSettings();
            DisableDataForm();
        }

        // UI : Disabled Data Form
        public void DisableDataForm()
        {
            disableUIEvent = true;

            // Song Name
            setNameBox.Text = "";
            setNameBox.Enabled = false;

            // Label Filename
            setFilenameLabel.Text = "";
            setPathLabel.Text = "";

            // Volume Bar
            volumeBar.Value = 0;
            volumeBar.Enabled = false;

            // Hotkey Box
            setHotkeyBox.Text = "";
            setHotkeyBox.Enabled = false;

            // Select File Button
            selectFileButton.Enabled = false;

            // Active Checkbox
            activeCheckBox.Enabled = false;
            activeCheckBox.Checked = false;

            disableUIEvent = false;
        }
        // UI : Set Data Form
        public void setDataForm()
        {
            disableUIEvent = true;

            // Song Name
            setNameBox.Enabled = true;
            setNameBox.Text = soundFiles[selectedSound].name;

            // Label Filename
            setFilenameLabel.Text = soundFiles[selectedSound].filename;
            setPathLabel.Text = soundFiles[selectedSound].path;

            // Volume Bar
            volumeBar.Enabled = true;
            volumeBar.Value = (int)(soundFiles[selectedSound].volume * 100);

            // Hotkey Box
            setHotkeyBox.Enabled = true;
            setHotkeyBox.Text = soundFiles[selectedSound].hotkey;

            // Select File Button
            selectFileButton.Enabled = true;

            // Active Checkbox
            if (soundFiles[selectedSound].hotkey == "")
            {
                activeCheckBox.Enabled = false;
                activeCheckBox.Checked = false;
            }
            else
            {
                activeCheckBox.Enabled = true;
                activeCheckBox.Checked = soundFiles[selectedSound].active;
            }

            disableUIEvent = false;
        }
    }  
}
