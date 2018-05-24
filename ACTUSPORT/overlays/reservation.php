        <?php
/*
 * module avec intégration d'un module de reservation externe
 * developpé pour une section
 * @author Christian Loubechine

 * attention : unifier le traitement de la mise à disposition du bouton "edit"
 *
 * Traitement des attributs devant apparaitre dans le filtre
 * 
 * Traitement des attributs pouvant servir de support à la recherche contextuelle
 *
 * Traitement des champs obligatoire en saisie
 *
 * traitement des champs devant être gérés par les référents
 * - pas visible lors de la création
 */

//
class Reservation extends Overlay {

    // data from specific table
    var $mydata = array();

    // fuse
    var $data_loaded = FALSE;



    /**
     * Récupération de données en table externe
     * utile seulement dans ce cas donc
     */
    function get_data() {
       global $context;

        // do it only once
        if($this->data_loaded) return TRUE;

        // memorize this call
        $this->data_loaded = TRUE;

        // sanity check
        if(!is_object($this->anchor))
            return FALSE;

        // intitialisation pour la génération de microdata
        //$context['itemscope'] = '<article itemscope itemtype="http://schema.org/Organization" >';
        //$context['itemscope_close'] = '</article>';

        $query = "SELECT * FROM ".SQL::table_name('grid')." AS grid "
            ." WHERE grid.anchor = '".SQL::escape($this->anchor->get_reference())."'";
        // fetch the first row
        if(!$this->mydata = SQL::query_first($query))
            return FALSE;

        $this->attributes = array_merge($this->attributes, $this->mydata);

        return TRUE;
    }

    /**
     * build the list of fields for one overlay
     * champs du premier tabs avec le titre et la description sinon mettre dans get_tabs
     *
     * @see overlays/overlay.php
     *
     * @param the hosting attributes
     * @param to be use with overlay edit_as_
     * @return a list of ($label, $input, $hint)
     */
    function get_fields($host,$field_pos=NULL) {
        global $context;

        $fields = array();

        ////// retrieve information from specifique table
        $this->get_data();


        // use the editor if possible
        $value = '';
        if(isset($this->mydata['grid2']) && $this->mydata['grid2'])
            $value = $this->mydata['grid2'];

        // sous Espece
        $local['label_en'] = 'widget 1';
        $local['label_fr'] = 'widget 1';
        $label = i18n::l($local, 'label');

        $input = '<textarea name="grid2" rows="5" cols="40" accesskey="i">'.$this->mydata['grid2'].'</textarea>';
        $hint = 'Code du widget';
        //$input = Surfer::get_editor('grid2', $value);
        //$hint = '';
        $fields[] = array($label, $input, $hint);

        // use the editor if possible
        $value = '';
        if(isset($this->mydata['active2']) && $this->mydata['active2'])
            $value = $this->mydata['active2'];

        // activation
        $local['label_en'] = 'activate';
        $local['label_fr'] = 'activation widget 1';
        $label = i18n::l($local, 'label');
        $hint = '';

        $input = '<select name="active2" size="3">';
        if (isset($this->mydata['active2'])) {
            switch ($this->mydata['active2']) {
                case 'actif':
                    $input .= '<option value="actif" selected="selected">actif</option>';
                    $input .= '<option value="non actif">non actif</option>';
                    $input .= '<option value="flottant">flottant</option>';
                    break;
                case 'non actif':
                    $input .= '<option value="actif" >actif</option>';
                    $input .= '<option value="non actif" selected="selected">non actif</option>';
                    $input .= '<option value="flottant">flottant</option>';
                    break;
                case 'flottant':
                default:
                    $input .= '<option value="actif" >actif</option>';
                    $input .= '<option value="non actif">non actif</option>';
                    $input .= '<option value="flottant" selected="selected">flottant</option>';
                    break;
            }
        }
            else {
                    $input .= '<option value="actif" selected="selected">actif</option>';
                    $input .= '<option value="non actif">non actif</option>';
                    $input .= '<option value="flottant">flottant</option>';
            }
        $input .= '</select>';
//        encode_field(isset($this->mydata['active2'])?$this->mydata['active2']:'actif').'" />';
        $fields[] = array($label, $input, $hint);

       // use the editor if possible
        $local['label_en'] = 'widget 2';
        $local['label_fr'] = 'widget 2';
        $label = i18n::l($local, 'label');
        $value = '';
        if(isset($this->mydata['grid3']) && $this->mydata['grid3'])
            $value = $this->mydata['grid3'];

        //$input = Surfer::get_editor('grid3', $value);
        $input = '<textarea name="grid3" rows="5" cols="40" accesskey="i">'.$this->mydata['grid3'].'</textarea>';

        $hint = '';
        $fields[] = array($label, $input, $hint);

        // activation
        $local['label_en'] = 'activate';
        $local['label_fr'] = 'activation widget 2';
        $label = i18n::l($local, 'label');

        $input = '<select name="active3" size="3">';
        if (isset($this->mydata['active3']) && $this->mydata['active3']=='actif') {
            $input .= '<option value="actif" selected="selected">actif</option>';
            $input .= '<option value="non actif">non actif</option>';
            }
        else {
            $input .= '<option value="actif" >actif</option>';
            $input .= '<option value="non actif" selected="selected">non actif</option>';
        }
        $input .= '</select>';
        $fields[] = array($label, $input, $hint);

        ////// fusionner les champs des classes parente
        // on peut aussi demander un onglet à part dans get_tabs
        // $fields = array_merge($fields, $this->get_geopos_fields($host, FALSE), $this->get_contact_fields());

        ////// exemple de champ pour télécharger 3 images
        // l'enregistrement doit être géré dans le edit_as
        // $label      = i18n::s('pictures');
        // $input      = '';
        // $ref = (isset($this->anchor))? $this->anchor->get_reference() : null;
        // $input .= Images::list_by_date_for_anchor($ref,0,3,'zicform nbinput_3');
        // $fields[]   = array($label,$input);

        // si overlay combiné avec edit_as et champ à mettre apres la description
        //switch ($field_pos) {
        //    case 'before_title':
        //    break;
        //    case 'before_desc':
        //    break;
        //    case 'after_desc':
        //    break;
        //    default:
        //        $fields = array_merge($fields, $this->get_geopos_fields($host, FALSE), $this->get_contact_fields());
        //    break;
        //}

        return $fields;
    }

    /**
     * text to be inserted aside
     *
     * @param array the hosting record, if any
     * @return some HTML to be inserted into the resulting page
    function &get_extra_text($host=NULL) {
        $text = '';
        if ($this->get_data() ) {
            $text.= Codes::beautify($this->mydata['grid2']);
        }
        return $text;
    }
     */

    function &get_live_introduction($host=NULL) {
        $text = '';

        if ($this->get_data() && $this->mydata['active3']=='actif' ) {
            $text.='<div id="widget-central">';
            $text.= Codes::beautify($this->mydata['grid3']);
            $text.='</div>';
        }
        if (surfer::is_associate() && isset($host['id'])) {
                    $text .=  '<div class="gest-admin">';
                    $text .=  '<li  class="item"><div class="admin">';
                    $edit = "section-edit/".$host['id'];
                    $text .=  '<a class="cover edit_object" href="'.$edit.'" title="modifier"></a>';
                    $edit = "images/edit.php?anchor=section%3A".$host['id'];
                    $text .=  '<a class="cover add_image" href="'.$edit.'" title="ajouter image"></a>';
                    $text .= '</div><small>Actions pour ' . $host['title'] . '</small></li>';
                    $text .= '</div>';
        }
        $text .= '<div id="introduction">'.$host['introduction'].'</div>';
        return $text;


    }
    /**
     * En url directe, on affiche en principe la meme chose que en surcouche
     * déclarer dans zic_st_common par exemple
     */
    public function &get_extra_text($host=NULL) {

        $text = '';
        if ($this->get_data() && $this->mydata['active2']=='actif' ) {
            $text.='<div id="widget-relatif">';
            $text.= Codes::beautify($this->mydata['grid2']);
            $text.='</div>';
            //$text.= Codes::beautify($host['description']);
        }
        if ($this->get_data() && $this->mydata['active2']=='flottant' ) {
            //$text.='<div id="widget-flottant">';
            $text.='<div id="widget">';
            $text.= Codes::beautify($this->mydata['grid2']);
            $text.='</div>';
		}
        return $text;
    }

 
    function &get_view_text($host=NULL) {
        global $context;
        $text = "";



/*        $images = Images::list_by_date_for_anchor($this->anchor, 0, 50, 'raw');
        $path   = Files::get_path($this->anchor,'images');
        
        if(count($images)) {
            include_once $context['path_to_root'].'included/jssor/jssor.php'; 
            Jssor::Load();
            
            // prepare gallery
            $slides = array();
            foreach($images as $image) {
                $slide = array();
                $slide['image_src'] = $path.'/'.$image['image_name'];
                if($desc = $image['description']) {
                    $slide['caption'] = $desc;
                }
                $slides[] = $slide;
            }
            
            $options = array(
                'fullwidth' => 'parent',
                'bullets'   => 1,
                'arrows'    => 1
                );
            
            $text .= Jssor::Make($slides, $options);
            
        }
        include_once $context['path_to_root'].'included/jssor/jssor.php'; 

*/
        //include_once $context['path_to_root'].'overlays/reservation/jssor.slider.mini.js'; 
        //Page::defer_script(strtolower('overlays/reservation/jssor.slider.mini.js'));


        //if (surfer::is_associate() && isset($host['id'])) {
            //$text .= '<h3>Essai slider non affiché au pulic</h3>';


       // $this->load_scripts_n_styles();

        return $text;


    }

        
    
    // do not add image in description
    public function should_embed_files() {
        return false;
    }
    
    

    
    
    /**
     * retrieve the content of one modified overlay
     * stocker impérativement les informations utilisées pour l'infobulle
     * les autres informations seront en table externe
     *
     * @see overlays/overlay.php
     *
     * @param the fields as filled by the end user
     * @return the updated fields
     */
    function parse_fields($fields) {

        /* zic_wad_common::parse_fields($fields);*/

        //$this->attributes['ad_phone'] = isset($fields['ad_phone'])? $fields['ad_phone'] :null;

        //$this->attributes[CAT_MATOS] = (isset($fields[CAT_MATOS]))?$fields[CAT_MATOS]:'';

        /*
            switch 1
            affectation des champs de la table avec insert ou update dans la table fille si elle existe
            voir concert_place


            switch 2
            affectation des variables pour mise à jour dans l'overlay
        */

    }


    /**
     * Do extra recording while user is created or deleted
     *
     * @param type $action
     * @param type $host
     * @param type $reference
     */
    function remember($action, $host, $reference) {
        global $context;
        $isok = true; // set to false on error, so stay in edition form

        //if(!isset($host['active2'])) $host['active2'] = NULL;

        // Stamp article
        switch($action) {
            case 'delete':

                 $query = "DELETE FROM " . SQL::table_name('grid') . " WHERE anchor = '".$reference."'";

                break;
            case 'insert':

                 $query = "INSERT INTO " . SQL::table_name('grid') . " SET "
                ."anchor='".SQL::escape($reference)."', \n"
                ."grid2='".SQL::escape($host['grid2'])."', \n"
                ."grid3='".SQL::escape($host['grid3'])."', \n"
                ."active2='".SQL::escape($host['active2'])."', \n"
                ."active3='".SQL::escape($host['active3'])."' \n";
            //break;
            // !!!! NO BREAK HERE !!!!

            case 'update':

                if(!isset($query)) {
                    $query = "UPDATE " . SQL::table_name('grid') . " SET "
                        ."grid2='".SQL::escape($host['grid2'])."' \n"
                        .",grid3='".SQL::escape($host['grid3'])."' \n"
                        .",active2='".SQL::escape($host['active2'])."' \n"
                        .",active3='".SQL::escape($host['active3'])."' \n"
                ." WHERE anchor = '".SQL::escape($reference)."'";
                }

                break;
            default:
                break;

        }

        // execute query for external table if any
         if (isset($query) && $query) {
            if (!SQL::query($query)) {
                $query = "INSERT INTO " . SQL::table_name('grid') . " SET "
                ."anchor='".SQL::escape($reference)."', \n"
                ."grid2='".SQL::escape($host['grid2'])."', \n"
                ."grid3='".SQL::escape($host['grid3'])."', \n"
                ."active2='".SQL::escape($host['active2'])."', \n"
                ."active3='".SQL::escape($host['active3'])."' \n";
                SQL::query($query);
            }
        }
        unset($query); 

        return $isok;
    }

   /**
     * create tables for structure : optionnel
     *
     * @see control/setup.php
     */
    public static function setup() {
        global $context;

        $fields = array();
        $fields['anchor']     = "VARCHAR(64) NOT NULL";                // up to 64 chars
        $fields['grid2']      = "MEDIUMTEXT";                // up to 64 chars
        $fields['grid3']      = "MEDIUMTEXT";                // up to 64 chars
        $fields['active2']    = "CHAR(10)";                // up to 64 chars
        $fields['active3']    = "CHAR(10)";                // up to 64 chars
        $indexes = array();
        $indexes['PRIMARY KEY']  = "(anchor)";

        return SQL::setup_table('grid', $fields, $indexes);
    }


}

// stop hackers
defined('YACS') or exit('Script must be included');

?>