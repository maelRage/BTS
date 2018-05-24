namespace HKSoundPlayer
{
    partial class Form1
    {
        /// <summary>
        /// Variable nécessaire au concepteur.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Nettoyage des ressources utilisées.
        /// </summary>
        /// <param name="disposing">true si les ressources managées doivent être supprimées ; sinon, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Code généré par le Concepteur Windows Form

        /// <summary>
        /// Méthode requise pour la prise en charge du concepteur - ne modifiez pas
        /// le contenu de cette méthode avec l'éditeur de code.
        /// </summary>
        private void InitializeComponent()
        {
            this.components = new System.ComponentModel.Container();
            System.ComponentModel.ComponentResourceManager resources = new System.ComponentModel.ComponentResourceManager(typeof(Form1));
            this.deviceComboBox = new System.Windows.Forms.ComboBox();
            this.playButton = new System.Windows.Forms.Button();
            this.soundListBox = new System.Windows.Forms.ListBox();
            this.audioDeviceGroupBox = new System.Windows.Forms.GroupBox();
            this.soundListGroupBox = new System.Windows.Forms.GroupBox();
            this.loadFromFileButton = new System.Windows.Forms.Button();
            this.saveToFileButton = new System.Windows.Forms.Button();
            this.deleteSoundButton = new System.Windows.Forms.Button();
            this.assSoundButton = new System.Windows.Forms.Button();
            this.SoundDataGroupBox = new System.Windows.Forms.GroupBox();
            this.deleteHKButton = new System.Windows.Forms.Button();
            this.activeCheckBox = new System.Windows.Forms.CheckBox();
            this.actifLabel = new System.Windows.Forms.Label();
            this.stopButton = new System.Windows.Forms.Button();
            this.setHotkeyBox = new System.Windows.Forms.TextBox();
            this.hotKeyLabel = new System.Windows.Forms.Label();
            this.label2 = new System.Windows.Forms.Label();
            this.volumeBar = new System.Windows.Forms.TrackBar();
            this.volumeLabel = new System.Windows.Forms.Label();
            this.setPathLabel = new System.Windows.Forms.Label();
            this.label1 = new System.Windows.Forms.Label();
            this.setFilenameLabel = new System.Windows.Forms.Label();
            this.setNameBox = new System.Windows.Forms.TextBox();
            this.nameLabel = new System.Windows.Forms.Label();
            this.selectFileButton = new System.Windows.Forms.Button();
            this.logTextBox = new System.Windows.Forms.TextBox();
            this.openFileDialog1 = new System.Windows.Forms.OpenFileDialog();
            this.checkSoundState = new System.Windows.Forms.Timer(this.components);
            this.statusStrip1 = new System.Windows.Forms.StatusStrip();
            this.toolStripStatusLabel1 = new System.Windows.Forms.ToolStripStatusLabel();
            this.toolStripStatusLabel2 = new System.Windows.Forms.ToolStripStatusLabel();
            this.toolStripStatusLabel3 = new System.Windows.Forms.ToolStripStatusLabel();
            this.audioDeviceGroupBox.SuspendLayout();
            this.soundListGroupBox.SuspendLayout();
            this.SoundDataGroupBox.SuspendLayout();
            ((System.ComponentModel.ISupportInitialize)(this.volumeBar)).BeginInit();
            this.statusStrip1.SuspendLayout();
            this.SuspendLayout();
            // 
            // deviceComboBox
            // 
            this.deviceComboBox.FormattingEnabled = true;
            this.deviceComboBox.ItemHeight = 13;
            this.deviceComboBox.Location = new System.Drawing.Point(6, 19);
            this.deviceComboBox.Name = "deviceComboBox";
            this.deviceComboBox.Size = new System.Drawing.Size(329, 21);
            this.deviceComboBox.TabIndex = 2;
            this.deviceComboBox.SelectedIndexChanged += new System.EventHandler(this.deviceComboBox1_SelectedIndexChanged);
            // 
            // playButton
            // 
            this.playButton.Font = new System.Drawing.Font("Microsoft Sans Serif", 8.25F);
            this.playButton.Location = new System.Drawing.Point(185, 48);
            this.playButton.Margin = new System.Windows.Forms.Padding(0);
            this.playButton.Name = "playButton";
            this.playButton.Size = new System.Drawing.Size(40, 22);
            this.playButton.TabIndex = 4;
            this.playButton.Text = "Play";
            this.playButton.UseVisualStyleBackColor = true;
            this.playButton.Click += new System.EventHandler(this.testSoundButton_Click);
            // 
            // soundListBox
            // 
            this.soundListBox.FormattingEnabled = true;
            this.soundListBox.Location = new System.Drawing.Point(6, 19);
            this.soundListBox.Name = "soundListBox";
            this.soundListBox.Size = new System.Drawing.Size(217, 368);
            this.soundListBox.TabIndex = 5;
            this.soundListBox.SelectedIndexChanged += new System.EventHandler(this.soundListBox_SelectedIndexChanged);
            // 
            // audioDeviceGroupBox
            // 
            this.audioDeviceGroupBox.Controls.Add(this.deviceComboBox);
            this.audioDeviceGroupBox.Location = new System.Drawing.Point(12, 12);
            this.audioDeviceGroupBox.Name = "audioDeviceGroupBox";
            this.audioDeviceGroupBox.Size = new System.Drawing.Size(345, 53);
            this.audioDeviceGroupBox.TabIndex = 6;
            this.audioDeviceGroupBox.TabStop = false;
            this.audioDeviceGroupBox.Text = "Périphérique Audio";
            // 
            // soundListGroupBox
            // 
            this.soundListGroupBox.Controls.Add(this.loadFromFileButton);
            this.soundListGroupBox.Controls.Add(this.saveToFileButton);
            this.soundListGroupBox.Controls.Add(this.deleteSoundButton);
            this.soundListGroupBox.Controls.Add(this.assSoundButton);
            this.soundListGroupBox.Controls.Add(this.soundListBox);
            this.soundListGroupBox.Location = new System.Drawing.Point(12, 71);
            this.soundListGroupBox.Name = "soundListGroupBox";
            this.soundListGroupBox.Size = new System.Drawing.Size(229, 424);
            this.soundListGroupBox.TabIndex = 7;
            this.soundListGroupBox.TabStop = false;
            this.soundListGroupBox.Text = "Liste";
            // 
            // loadFromFileButton
            // 
            this.loadFromFileButton.Location = new System.Drawing.Point(182, 393);
            this.loadFromFileButton.Name = "loadFromFileButton";
            this.loadFromFileButton.Size = new System.Drawing.Size(41, 23);
            this.loadFromFileButton.TabIndex = 9;
            this.loadFromFileButton.Text = "Load";
            this.loadFromFileButton.UseVisualStyleBackColor = true;
            this.loadFromFileButton.Click += new System.EventHandler(this.loadFromFileButton_Click);
            // 
            // saveToFileButton
            // 
            this.saveToFileButton.Location = new System.Drawing.Point(135, 393);
            this.saveToFileButton.Name = "saveToFileButton";
            this.saveToFileButton.Size = new System.Drawing.Size(41, 23);
            this.saveToFileButton.TabIndex = 8;
            this.saveToFileButton.Text = "Save";
            this.saveToFileButton.UseVisualStyleBackColor = true;
            this.saveToFileButton.Click += new System.EventHandler(this.saveToFileButton_Click);
            // 
            // deleteSoundButton
            // 
            this.deleteSoundButton.Location = new System.Drawing.Point(36, 393);
            this.deleteSoundButton.Name = "deleteSoundButton";
            this.deleteSoundButton.Size = new System.Drawing.Size(24, 23);
            this.deleteSoundButton.TabIndex = 8;
            this.deleteSoundButton.Text = "-";
            this.deleteSoundButton.UseVisualStyleBackColor = true;
            this.deleteSoundButton.Click += new System.EventHandler(this.deleteSoundButton_Click);
            // 
            // assSoundButton
            // 
            this.assSoundButton.Location = new System.Drawing.Point(6, 393);
            this.assSoundButton.Name = "assSoundButton";
            this.assSoundButton.Size = new System.Drawing.Size(24, 23);
            this.assSoundButton.TabIndex = 8;
            this.assSoundButton.Text = "+";
            this.assSoundButton.UseVisualStyleBackColor = true;
            this.assSoundButton.Click += new System.EventHandler(this.addSoundButton_Click);
            // 
            // SoundDataGroupBox
            // 
            this.SoundDataGroupBox.Controls.Add(this.deleteHKButton);
            this.SoundDataGroupBox.Controls.Add(this.activeCheckBox);
            this.SoundDataGroupBox.Controls.Add(this.actifLabel);
            this.SoundDataGroupBox.Controls.Add(this.stopButton);
            this.SoundDataGroupBox.Controls.Add(this.setHotkeyBox);
            this.SoundDataGroupBox.Controls.Add(this.hotKeyLabel);
            this.SoundDataGroupBox.Controls.Add(this.label2);
            this.SoundDataGroupBox.Controls.Add(this.volumeBar);
            this.SoundDataGroupBox.Controls.Add(this.playButton);
            this.SoundDataGroupBox.Controls.Add(this.volumeLabel);
            this.SoundDataGroupBox.Controls.Add(this.setPathLabel);
            this.SoundDataGroupBox.Controls.Add(this.label1);
            this.SoundDataGroupBox.Controls.Add(this.setFilenameLabel);
            this.SoundDataGroupBox.Controls.Add(this.setNameBox);
            this.SoundDataGroupBox.Controls.Add(this.nameLabel);
            this.SoundDataGroupBox.Controls.Add(this.selectFileButton);
            this.SoundDataGroupBox.Location = new System.Drawing.Point(247, 71);
            this.SoundDataGroupBox.Name = "SoundDataGroupBox";
            this.SoundDataGroupBox.Size = new System.Drawing.Size(282, 225);
            this.SoundDataGroupBox.TabIndex = 8;
            this.SoundDataGroupBox.TabStop = false;
            this.SoundDataGroupBox.Text = "Données";
            // 
            // deleteHKButton
            // 
            this.deleteHKButton.Location = new System.Drawing.Point(244, 166);
            this.deleteHKButton.Name = "deleteHKButton";
            this.deleteHKButton.Size = new System.Drawing.Size(24, 23);
            this.deleteHKButton.TabIndex = 8;
            this.deleteHKButton.Text = "-";
            this.deleteHKButton.UseVisualStyleBackColor = true;
            this.deleteHKButton.Click += new System.EventHandler(this.deleteHKButton_Click_1);
            // 
            // activeCheckBox
            // 
            this.activeCheckBox.AutoSize = true;
            this.activeCheckBox.Location = new System.Drawing.Point(68, 198);
            this.activeCheckBox.Name = "activeCheckBox";
            this.activeCheckBox.RightToLeft = System.Windows.Forms.RightToLeft.No;
            this.activeCheckBox.Size = new System.Drawing.Size(15, 14);
            this.activeCheckBox.TabIndex = 25;
            this.activeCheckBox.UseVisualStyleBackColor = true;
            this.activeCheckBox.CheckedChanged += new System.EventHandler(this.activeCheckBox_CheckedChanged);
            // 
            // actifLabel
            // 
            this.actifLabel.AutoSize = true;
            this.actifLabel.Location = new System.Drawing.Point(13, 198);
            this.actifLabel.Name = "actifLabel";
            this.actifLabel.Size = new System.Drawing.Size(34, 13);
            this.actifLabel.TabIndex = 24;
            this.actifLabel.Text = "Actif :";
            // 
            // stopButton
            // 
            this.stopButton.Location = new System.Drawing.Point(228, 48);
            this.stopButton.Name = "stopButton";
            this.stopButton.Size = new System.Drawing.Size(40, 22);
            this.stopButton.TabIndex = 9;
            this.stopButton.Text = "Stop";
            this.stopButton.UseVisualStyleBackColor = true;
            this.stopButton.Click += new System.EventHandler(this.stopButton_Click);
            // 
            // setHotkeyBox
            // 
            this.setHotkeyBox.BackColor = System.Drawing.SystemColors.Control;
            this.setHotkeyBox.Location = new System.Drawing.Point(68, 168);
            this.setHotkeyBox.Name = "setHotkeyBox";
            this.setHotkeyBox.ReadOnly = true;
            this.setHotkeyBox.Size = new System.Drawing.Size(170, 20);
            this.setHotkeyBox.TabIndex = 10;
            this.setHotkeyBox.Enter += new System.EventHandler(this.setHotkeyBox_Enter);
            this.setHotkeyBox.KeyDown += new System.Windows.Forms.KeyEventHandler(this.textBox1_KeyDown);
            this.setHotkeyBox.KeyUp += new System.Windows.Forms.KeyEventHandler(this.setHotkeyBox_KeyUp);
            this.setHotkeyBox.Leave += new System.EventHandler(this.setHotkeyBox_Leave);
            // 
            // hotKeyLabel
            // 
            this.hotKeyLabel.AutoSize = true;
            this.hotKeyLabel.Location = new System.Drawing.Point(13, 171);
            this.hotKeyLabel.Name = "hotKeyLabel";
            this.hotKeyLabel.Size = new System.Drawing.Size(48, 13);
            this.hotKeyLabel.TabIndex = 22;
            this.hotKeyLabel.Text = "HotKey :";
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Location = new System.Drawing.Point(10, 82);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(44, 13);
            this.label2.TabIndex = 21;
            this.label2.Text = "Fichier :";
            // 
            // volumeBar
            // 
            this.volumeBar.AutoSize = false;
            this.volumeBar.Cursor = System.Windows.Forms.Cursors.Default;
            this.volumeBar.LargeChange = 10;
            this.volumeBar.Location = new System.Drawing.Point(68, 136);
            this.volumeBar.Maximum = 100;
            this.volumeBar.Name = "volumeBar";
            this.volumeBar.Size = new System.Drawing.Size(200, 20);
            this.volumeBar.TabIndex = 19;
            this.volumeBar.TickFrequency = 10;
            this.volumeBar.TickStyle = System.Windows.Forms.TickStyle.None;
            this.volumeBar.Scroll += new System.EventHandler(this.volumeBar_Scroll);
            // 
            // volumeLabel
            // 
            this.volumeLabel.AutoSize = true;
            this.volumeLabel.Location = new System.Drawing.Point(10, 136);
            this.volumeLabel.Name = "volumeLabel";
            this.volumeLabel.Size = new System.Drawing.Size(48, 13);
            this.volumeLabel.TabIndex = 18;
            this.volumeLabel.Text = "Volume :";
            // 
            // setPathLabel
            // 
            this.setPathLabel.AutoSize = true;
            this.setPathLabel.Location = new System.Drawing.Point(65, 107);
            this.setPathLabel.Name = "setPathLabel";
            this.setPathLabel.Size = new System.Drawing.Size(35, 13);
            this.setPathLabel.TabIndex = 16;
            this.setPathLabel.Text = "label2";
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Location = new System.Drawing.Point(10, 107);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(48, 13);
            this.label1.TabIndex = 15;
            this.label1.Text = "Chemin :";
            // 
            // setFilenameLabel
            // 
            this.setFilenameLabel.AutoSize = true;
            this.setFilenameLabel.Location = new System.Drawing.Point(65, 82);
            this.setFilenameLabel.Name = "setFilenameLabel";
            this.setFilenameLabel.Size = new System.Drawing.Size(35, 13);
            this.setFilenameLabel.TabIndex = 14;
            this.setFilenameLabel.Text = "label1";
            // 
            // setNameBox
            // 
            this.setNameBox.Location = new System.Drawing.Point(68, 23);
            this.setNameBox.Name = "setNameBox";
            this.setNameBox.Size = new System.Drawing.Size(200, 20);
            this.setNameBox.TabIndex = 12;
            this.setNameBox.TextChanged += new System.EventHandler(this.setNameBox_TextChanged);
            // 
            // nameLabel
            // 
            this.nameLabel.AutoSize = true;
            this.nameLabel.Location = new System.Drawing.Point(10, 23);
            this.nameLabel.Name = "nameLabel";
            this.nameLabel.Size = new System.Drawing.Size(35, 13);
            this.nameLabel.TabIndex = 11;
            this.nameLabel.Text = "Nom :";
            // 
            // selectFileButton
            // 
            this.selectFileButton.Font = new System.Drawing.Font("Microsoft Sans Serif", 8.25F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.selectFileButton.Location = new System.Drawing.Point(68, 48);
            this.selectFileButton.Name = "selectFileButton";
            this.selectFileButton.Size = new System.Drawing.Size(93, 22);
            this.selectFileButton.TabIndex = 9;
            this.selectFileButton.Text = "Select a File";
            this.selectFileButton.UseVisualStyleBackColor = true;
            this.selectFileButton.Click += new System.EventHandler(this.selectFileButton_Click);
            // 
            // logTextBox
            // 
            this.logTextBox.Location = new System.Drawing.Point(247, 302);
            this.logTextBox.Multiline = true;
            this.logTextBox.Name = "logTextBox";
            this.logTextBox.ReadOnly = true;
            this.logTextBox.Size = new System.Drawing.Size(282, 193);
            this.logTextBox.TabIndex = 26;
            // 
            // openFileDialog1
            // 
            this.openFileDialog1.FileName = "openFileDialog1";
            this.openFileDialog1.FileOk += new System.ComponentModel.CancelEventHandler(this.openFileDialog1_FileOk);
            // 
            // checkSoundState
            // 
            this.checkSoundState.Tick += new System.EventHandler(this.checkSoundState_Tick);
            // 
            // statusStrip1
            // 
            this.statusStrip1.Items.AddRange(new System.Windows.Forms.ToolStripItem[] {
            this.toolStripStatusLabel1,
            this.toolStripStatusLabel2,
            this.toolStripStatusLabel3});
            this.statusStrip1.Location = new System.Drawing.Point(0, 500);
            this.statusStrip1.Name = "statusStrip1";
            this.statusStrip1.Size = new System.Drawing.Size(536, 22);
            this.statusStrip1.TabIndex = 9;
            // 
            // toolStripStatusLabel1
            // 
            this.toolStripStatusLabel1.Name = "toolStripStatusLabel1";
            this.toolStripStatusLabel1.Size = new System.Drawing.Size(0, 17);
            // 
            // toolStripStatusLabel2
            // 
            this.toolStripStatusLabel2.Name = "toolStripStatusLabel2";
            this.toolStripStatusLabel2.Size = new System.Drawing.Size(0, 17);
            // 
            // toolStripStatusLabel3
            // 
            this.toolStripStatusLabel3.DisplayStyle = System.Windows.Forms.ToolStripItemDisplayStyle.Text;
            this.toolStripStatusLabel3.Name = "toolStripStatusLabel3";
            this.toolStripStatusLabel3.RightToLeft = System.Windows.Forms.RightToLeft.No;
            this.toolStripStatusLabel3.Size = new System.Drawing.Size(0, 17);
            // 
            // Form1
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(536, 522);
            this.Controls.Add(this.logTextBox);
            this.Controls.Add(this.statusStrip1);
            this.Controls.Add(this.SoundDataGroupBox);
            this.Controls.Add(this.soundListGroupBox);
            this.Controls.Add(this.audioDeviceGroupBox);
            this.Icon = ((System.Drawing.Icon)(resources.GetObject("$this.Icon")));
            this.Name = "Form1";
            this.Text = "HK Sound Player";
            this.FormClosing += new System.Windows.Forms.FormClosingEventHandler(this.Form1_FormClosing);
            this.Load += new System.EventHandler(this.Form1_Load);
            this.audioDeviceGroupBox.ResumeLayout(false);
            this.soundListGroupBox.ResumeLayout(false);
            this.SoundDataGroupBox.ResumeLayout(false);
            this.SoundDataGroupBox.PerformLayout();
            ((System.ComponentModel.ISupportInitialize)(this.volumeBar)).EndInit();
            this.statusStrip1.ResumeLayout(false);
            this.statusStrip1.PerformLayout();
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion
        private System.Windows.Forms.ComboBox deviceComboBox;
        private System.Windows.Forms.Button playButton;
        private System.Windows.Forms.ListBox soundListBox;
        private System.Windows.Forms.GroupBox audioDeviceGroupBox;
        private System.Windows.Forms.GroupBox soundListGroupBox;
        private System.Windows.Forms.Button deleteSoundButton;
        private System.Windows.Forms.Button assSoundButton;
        private System.Windows.Forms.GroupBox SoundDataGroupBox;
        private System.Windows.Forms.OpenFileDialog openFileDialog1;
        private System.Windows.Forms.Button selectFileButton;
        private System.Windows.Forms.TextBox setNameBox;
        private System.Windows.Forms.Label nameLabel;
        private System.Windows.Forms.Label setFilenameLabel;
        private System.Windows.Forms.Label setPathLabel;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Button stopButton;
        private System.Windows.Forms.TrackBar volumeBar;
        private System.Windows.Forms.Label volumeLabel;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.TextBox setHotkeyBox;
        private System.Windows.Forms.Label hotKeyLabel;
        private System.Windows.Forms.CheckBox activeCheckBox;
        private System.Windows.Forms.Label actifLabel;
        private System.Windows.Forms.Button deleteHKButton;
        private System.Windows.Forms.Button saveToFileButton;
        private System.Windows.Forms.Timer checkSoundState;
        private System.Windows.Forms.Button loadFromFileButton;
        private System.Windows.Forms.StatusStrip statusStrip1;
        private System.Windows.Forms.ToolStripStatusLabel toolStripStatusLabel1;
        private System.Windows.Forms.ToolStripStatusLabel toolStripStatusLabel2;
        private System.Windows.Forms.TextBox logTextBox;
        private System.Windows.Forms.ToolStripStatusLabel toolStripStatusLabel3;
    }
}

