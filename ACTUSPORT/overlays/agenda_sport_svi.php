<?php
/**
 * describe one annonce
 *
 * @see overlays/overlay.php
 *
 * @author Bernard Paques [email]bernard.paques@bigfoot.com[/email]
 * @reference
 * @license http://www.gnu.org/copyleft/lesser.txt GNU Lesser General Public License
 */
class Agenda_sport_svi extends Overlay {

	/**
	 * build the list of fields for one overlay
	 *
	 * @see overlays/overlay.php
	 *
	 * @param the hosting attributes
	 * @return a list of ($label, $input, $hint)
	 */
	function get_fields($host) {
		global $context;
		
		//categories
		include_once($context['path_to_root'].'categories/categories.php');
		include_once($context['path_to_root'].'shared/members.php');
		$label = i18n::s('Cat&eacute;gories').' *';
		$input = Agenda_sport_svi::get_listOption(array('une', 'keywords','hebdomadaire','mensuel'), isset($host['id'])?Members::list_anchors_for_member('article:'.$host['id']):null,'category:10');
		$hint = BR.i18n::s('Choisissez un sport');
		$fields[] = array($label, $input, $hint);

		//categories
		include_once($context['path_to_root'].'categories/categories.php');
		include_once($context['path_to_root'].'shared/members.php');
		$label = i18n::s('Cat&eacute;gories').' *';
		$input = Agenda_sport_svi::get_listOption(array('une', 'keywords','hebdomadaire','mensuel'), isset($host['id'])?Members::list_anchors_for_member('article:'.$host['id']):null,'category:111');
		$hint = BR.i18n::s('Choisissez une r&eacute;gion');
		$fields[] = array($label, $input, $hint);

		// dates animation
		$label = i18n::s('Date(s) de l\'animation').' *';
		$input = Skin::build_input('date_debut', isset($this->attributes['date_debut'])?$this->attributes['date_debut']:'', 'date');
		$input .= '<span style="margin-left: 20px;">Fin (facultatif): '.Skin::build_input('date_fin', isset($this->attributes['date_fin'])?$this->attributes['date_fin']:'', 'date').'</span>';
		$hint = i18n::s('Entrez une seule date ou une date de d&eacute;but et une date de fin');
		$hint = BR.i18n::s('Use format YYYY-MM-DD');
		$fields[] = array($label, $input, $hint);

 		// adresse
		// ville
		$label = i18n::s('Ville').' *';
 		include_once($context['path_to_root'].'/locations/locations.php');
 		$stat = Locations::stat_for_anchor('article:'.$host['id']);
  		if(!isset($host['id']) || !$stat || ($stat['count']==0)) { // en modif on utilise yacs normal
			$input = '<input id="ville" name="ville" value="'.encode_field(isset($this->attributes['ville'])?$this->attributes['ville']:'').'">';
			$input .= '<input type=hidden id="geo_position" name="geo_position" value="" />';
			$input .= '<input type=hidden id="geo_place_name" name="geo_place_name" value="" />';
			$hint = i18n::s('Indiquez également le d&eacute;partement : saint vallier, 26');
			$fields[] = array($label, $input, $hint);
	
			$context['page_footer'] .= '<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key='.$context['google_api_key'].'" type="text/javascript"></script>'."\n";
			$context['page_footer'] .= '<script type="text/javascript">'."\n"
				.'// check that main fields are not empty'."\n"
				.'function validMainForm() {'."\n"
			 .'var container=document.getElementById("main_form");//the form element'
				."\n"
			. 'if(!validateDocumentPost(container)) return false;'."\n";
			
			  //encodage emplacement
			  $context['page_footer'] .= 'if (container.ville.value != "") {'."\n";
			  $context['page_footer'] .= '  container.geo_place_name.value = container.ville.value,'."\n";
			$context['page_footer'] .= 'geocoder = null;'."\n";
			$context['page_footer'] .= '	if(!geocoder) {'."\n";
			$context['page_footer'] .= '		geocoder = new GClientGeocoder();'."\n";
			$context['page_footer'] .= '	}'."\n";
			$context['page_footer'] .= '	if(geocoder) {'."\n";
			$context['page_footer'] .= '		geocoder.getLatLng('."\n";
			$context['page_footer'] .= '			container.geo_place_name.value,'."\n";
			$context['page_footer'] .= '			function(point) {'."\n";
			$context['page_footer'] .= '				if (!point) {'."\n";
			$context['page_footer'] .= '					alert("Cette adresse n\'a pu être localisée");'."\n";
		  $context['page_footer'] .= '        	Yacs.stopWorking();'."\n";
			$context['page_footer'] .= '				} else {'."\n";
			$context['page_footer'] .= '					container.geo_position.value = point.y.toString() + ", " + point.x.toString();'."\n";
			$context['page_footer'] .= '					container.submit();'."\n";
			$context['page_footer'] .= '				}'."\n";
			$context['page_footer'] .= '			}'."\n";
			$context['page_footer'] .= '		)'."\n";
			$context['page_footer'] .= '	}'."\n";
			$context['page_footer'] .= '  return false;'."\n";
			$context['page_footer'] .= '}'."\n";
			$context['page_footer'] .= 'else { '."\n";
		  	$context['page_footer'] .= '  alert("Renseignez un emplacement pour cette annonce !");'."\n";
		  	$context['page_footer'] .= '	Yacs.stopWorking();'."\n";
			$context['page_footer'] .= '  return false;'."\n";
			$context['page_footer'] .= '}'."\n"  ;
			$context['page_footer'] .= '  return true;'."\n";
			$context['page_footer'] .= '}'."\n"  ;
	   
			$context['page_footer'] .= 'function trim(myString) '."\n"  ;
			$context['page_footer'] .= '{ '."\n"  ;
			$context['page_footer'] .= 'return myString.replace(/^\s+/g,\'\').replace(/\s+$/g,\'\') '."\n"  ;
			$context['page_footer'] .= '} '."\n"  ;
	 
				
			$context['page_footer'] .= 
			 'var mainForm=document.getElementById("main_form");//the form element'
			 ."\n"
			 .'mainForm.encoding="multipart/form-data";'
			 ."\n"
			 .'     validFunction = mainForm.onsubmit;'
			 ."\n"
			 .'     //alert(toto);'
			 ."\n"
			 .'if(typeof(document.removeEventListener)!="undefined")'
			 ."\n"
			 .'     mainForm.removeEventListener("submit", validFunction, false);'
			 ."\n"
			 .'else if(typeof(document.detachEvent)!=undefined)'
			 ."\n"
			 .'    mainForm.detachEvent("onsubmit", validFunction);'   
			 ."\n"
			 .'    mainForm.onsubmit = function() { return validMainForm();};'
				."\n"
				.'</script>'."\n";
		} else {
			  $hint = i18n::s('Pour modifier ou ajouter un emplacement, allez au bas de cette page.');
			  $items = Locations::list_by_date_for_anchor('article:'.$host['id'], 0, 100, 'compact');
	  		$input .= '<input type=hidden id="geo_position" name="geo_position" value="" />';
		    $input .= '<input type=hidden id="geo_place_name" name="geo_place_name" value="" />';
			$input = '<input type="hidden" id="ville" name="ville" value="'.encode_field($this->attributes['ville']).'">';
			  foreach($items as $item) {
				$input .= $item[1].BR;
			  }
				$fields[] = array($label, $input, $hint);
    	}

		// telephone
		$label = i18n::s('telephone').' *';
		$input = '<input id="telephone" name="telephone" value="'.encode_field(isset($this->attributes['telephone'])?$this->attributes['telephone']:'').'">';
		$hint = i18n::s('T&eacute;l&eacute;phone pour vous contacter');
		$fields[] = array($label, $input, $hint);

 		// lien
 		$label = i18n::s('Lien Web');
 		include_once($context['path_to_root'].'/links/links.php');
 		$stat = Links::stat_for_anchor('article:'.$host['id']);
		if(!isset($host['id']) || !$stat ||($stat['count']==0)) { // en modif on utilise yacs normal
				$input = '<input type="text" size=80 name="link_url" />';
				$hint = i18n::s('lien internet (facultatif)');
		} else {
		  $hint = i18n::s('Pour modifier ou ajouter un lien, retournez en mode visualisation.');
		  $items = Links::list_by_date_for_anchor('article:'.$host['id'], 0, 100, 'compact');
		  $input = '';
		  foreach($items as $item) {
			$input .= $item[1].BR;
		  }
		}
 		$fields[] = array($label, $input, $hint);

  	return $fields;
	}

	/**
	 * get an overlaid label
	 *
	 * Accepted action codes:
	 * - 'edit' the modification of an existing object
	 * - 'delete' the deleting form
	 * - 'new' the creation of a new object
	 * - 'view' a displayed object
	 *
	 * @see overlays/overlay.php
	 *
	 * @param string the target label
	 * @param string the on-going action
	 * @return the label to use
	 */
	function get_label($name, $action='view') {
		global $context;

		// the target label
		switch($name) {

		// edit command
		case 'edit_command':
			return i18n::s('Edit this event');
			break;

		// new command
		case 'new_command':
			return i18n::s('Add an event');
			break;

		// publish command
		case 'publish_command':
			return i18n::s('Add an event');
			break;

		// publish command
		case 'introduction':
			return i18n::s('');
			break;

		// publish command
		case 'Description':
			return i18n::s('');
			break;

		// page title
		case 'page_title':

			switch($action) {

			case 'edit':
				return i18n::s('Edit one day');

			case 'delete':
				return i18n::s('Delete one day');

			case 'new':
				return i18n::s('New day');

			case 'view':
			default:
				// use article title as the page title
				return NULL;

			}
			break;
		}

		// no match
		return NULL;
	}

	function &get_live_introduction($host=NULL) {
		$text = Codes::beautify_title($host['introduction']);
		return $text;
	}
	function &get_live_title($host=NULL) {
		$text = Codes::beautify_title($host['title'].' - '.$this->attributes['ville']);
		//$text .= '<p><strong> '.$this->attributes['ville']."</strong></p>\n";
		return $text;
	}

	/**
	 * display the content of one annonce
	 *
	 * Accepted variant codes:
	 * - 'view' - embedded into the main viewing page
	 *
	 * @see overlays/overlay.php
	 *
	 * @param string the variant code
	 * @param array the hosting record
	 * @return some HTML to be inserted into the resulting page
	 */
	function get_text($variant='view', $host=NULL) {
		global $context;

		// text to return
		$text = '';

		// add something to zooming views only
		switch($variant) {
		// extra side of the page
		case 'extra':
			$text =& $this->get_extra_text($host);
			return $text;

		// live introduction
		case 'introduction':
			$text =& $this->get_live_introduction($host);
			$list_category = Agenda_sport_svi::list_category_by_title_for_members('article:'.$host['id'],10, 0,1,'raw');
		  	$categtitle = '';	
			foreach($list_category as $id=>$categ) {
				if (strlen($categ['thumbnail_url'])> 0)
					$text .= '<img src="'.$categ['thumbnail_url'].'" alt="sport" />'."\n";
				else
					$text .= '<span>'.$categ['title'].'</span>'."\n";
			}
			$list_category = Agenda_sport_svi::list_category_by_title_for_members('article:'.$host['id'],111, 0,1,'raw');
		  	$categtitle = '';	
			foreach($list_category as $id=>$categ) {
				//if (strlen($categ['thumbnail_url'])> 0)
				//	$text .= '<img src="'.$categ['thumbnail_url'].'" alt="r&eacute;gion" />'."\n";
				//else
					$text .= '<span>'.$categ['title'].'</span>'."\n";
			}
			return $text;

		// live title
		case 'title':
			$text =& $this->get_live_title($host);
			return $text;

		// at the bottom of the page, after the description field
		case 'trailer':
			$text =& $this->get_trailer_text($host);
			// links to locations
			include_once($context['path_to_root'].'/locations/locations.php');
			$locations = Locations::list_by_date_for_anchor('article:'.$host['id'], 0, 100, 'raw');
			$title = '';
			foreach($locations as $id=>$item) {
				if ($title != '') 
			  		$title .= BR.$this->attributes['geo_place_name'];
				else 
			  		$title = $item['geo_place_name'];
				$geoloc = Locations::map_on_google($locations, 10);
				$text .= '<br clear="right" />';
				$text .= '<span class="geo_place">'.Skin::build_floating_box($title, $geoloc, "map_google").'</span>';
			}
			return $text;

		  case 'ddate':
		  	$text='';
			// the date(s))
			if ($this->attributes['date_fin'] == '') 
				$text .= ' '.Skin::build_date($this->attributes['date_debut'], 'jour')."\n";
			else {
			  $text .= ''.Skin::build_date($this->attributes['date_debut'], 'jour')."\n";
			  $text .= ''.Skin::build_date($this->attributes['date_fin'], 'jour')."\n";
			} 
			break;
		  case 'jour':
		  	$text='';
			// the date(s))
			if ($this->attributes['date_fin'] == '') 
				$text .= ' <p class="dateDebut"> '.Skin::build_date($this->attributes['date_debut'], 'jour')."</p>\n";
			else {
			  $text .= '<p class="dateDebut"> '.Skin::build_date($this->attributes['date_debut'], 'jour')."</p>\n";
			  $text .= '<p class="dateFin">'.Skin::build_date($this->attributes['date_fin'], 'jour')."</p>\n";
			} 
			// CHL recherche de la categorie sport
			$list_category = Agenda_sport_svi::list_category_by_title_for_members('article:'.$host['id'],10, 0,1,'raw');
		  	$categtitle = '';
			foreach($list_category as $id=>$categ) {
					$text .= '<span>'.$categ['title'].'</span>'."\n";
			}
			// CHL recherche de la region
			$list_category = Agenda_sport_svi::list_category_by_title_for_members('article:'.$host['id'],111, 0,1,'raw');
		  	$categtitle = '';
			foreach($list_category as $id=>$categ) {
					$text .= '<span>'.$categ['title'].'</span>'."\n";
			}

			break;

		  case 'block_date':
		  	$text='';
			// the date(s))
			if ($this->attributes['date_fin'] == '') 
				$text .= ' <p class="dateDebut"> '.Skin::build_date($this->attributes['date_debut'], 'jour')."</p>\n";
			else {
			  $text .= '<p class="dateDebut"> '.Skin::build_date($this->attributes['date_debut'], 'jour')."</p>\n";
			  $text .= '<p class="dateFin">'.Skin::build_date($this->attributes['date_fin'], 'jour')."</p>\n";
			} 

			break;
		  case 'category':
		  	$text='';
			// CHL recherche de la categorie sport
			$list_category = Agenda_sport_svi::list_category_by_title_for_members('article:'.$host['id'],10, 0,1,'raw');
		  	$categtitle = '';
			foreach($list_category as $id=>$categ) {
					$text .= '<span>'.$categ['title'].'</span>'."\n";
			}
			// CHL recherche de la categorie sport
			$list_category = Agenda_sport_svi::list_category_by_title_for_members('article:'.$host['id'],111, 0,1,'raw');
		  	$categtitle = '';
			foreach($list_category as $id=>$categ) {
					$text .= '<span>'.$categ['title'].'</span>'."\n";
			}

			break;
		  case 'view' :
			  if (strlen($this->attributes['telephone'])>0) 
				  $text .= '<p><b> Contact au :  '.$this->attributes['telephone']."</b></p>\n";
			// the date(s))
			if ($this->attributes['date_fin'] == '') 
				$text .= '<p class="dateDebut">'.Skin::build_date($this->attributes['date_debut'], 'jour')."</p>\n";
			else {
			  $text .= '<p class="dateDebut">'.Skin::build_date($this->attributes['date_debut'], 'jour')."</p>\n";
			  $text .= '<p class="dateFin">'.Skin::build_date($this->attributes['date_fin'], 'jour')."</p>\n";
			} 
			
			$text = Codes::beautify($text.$host['description']);
			break;
		default:
			return $text;
		}
		return $text;
	}

	/**
	 * retrieve the content of one modified overlay
	 *
	 * @see overlays/overlay.php
	 *
	 * @param the fields as filled by the end user
	 * @return the updated fields
	 */
	function parse_fields($fields) {
/*echo "<script language='javascript'>alert('".$_FILES['vignette_file']['tmp_name']."');</script>";*/
		
		$this->attributes['ville'] = $fields['ville'];
		$this->attributes['geo_position'] = $fields['geo_position'];
		$this->attributes['telephone'] = $fields['telephone'];
		
		$this->attributes['link_url'] = $fields['link_url'];
			
		$this->attributes['date_debut'] = $fields['date_debut'];
		$this->attributes['date_fin'] = $fields['date_fin'];
		
		return $this->attributes;
	}

	/**
	 * remember an action once it's done
	 *
	 * Following actions are recognized:
	 * - 'insert' - insert a new record in the side table
	 * - 'update' - update an existing record
	 * - 'delete' - suppress a record in the database
	 *
	 * To enforce database consistency, and in case of 'update' the function
	 * deletes the record and create it again.
	 *
	 * @param string the action 'insert', 'update' or 'delete'
	 * @param array the hosting record
	 * @return FALSE on error, TRUE otherwise
	 */
	function remember($variant, $host) {
		global $context, $_REQUEST;

		// id cannot be empty
		if(!$host['id'] || !is_numeric($host['id']))
			return;
			
		// we use the existing back-end for dates
		include_once $context['path_to_root'].'dates/dates.php';
		//categories
		Members::unlink_for_reference('article:'.$host['id']);
		foreach($_REQUEST as $key => $value) {
		  if (substr($key, 0, 9) == 'category:') {
			if (strlen($value)>0) Members::assign($value, 'article:'.$host['id']);
		  }
		}
		
		// mémorisation date evenenement dans le rang pour tri par date
		if (!empty($_REQUEST['date_debut'])) {
		  $host['rank'] = str_replace('-', '', $_REQUEST['date_debut']);
		  include_once($context['path_to_root'].'/articles/articles.php');
		  Articles::put($host);
		}
	
  	  	$_REQUEST = $host;
			// locations
		if (isset($_REQUEST['geo_position']) && ($_REQUEST['geo_position'] != '')) {
		  $_REQUEST['anchor'] = 'article:'.$host['id'];
			$_REQUEST['geo_place_name'] = $_REQUEST['ville'];
			$_REQUEST['id'] = null;
			//include_once($context['path_to_root'].'/locations/edit.php');
			include_once($context['path_to_root'].'/locations/locations.php');
			$_REQUEST['id'] = null;
			$_REQUEST['description'] = null;
			Locations::post($_REQUEST);
			
			// suppress reference to location in main description field
			$host = Articles::get($host['id'], true); //retrieve correct $host
			if ($pos = strpos($host['description'], '[location=')) {
				$fin = strpos($host['description'], ']', $pos);
				$host['description'] = substr($host['description'], 0, $pos).substr($host['description'], $fin+1);
				Articles::put($host);
			 }
		}
			
		// images
		if (isset($_FILES['upload']) && $_FILES['upload']['tmp_name'] != '') {
			$_REQUEST['silent'] = 'Y';
			$_REQUEST['image_name'] = $_FILES['upload']['name'];
			$_REQUEST['image_size'] = $_FILES['upload']['size'];
			$_REQUEST['anchor'] = 'article:'.$host['id'];
			$_REQUEST['action'] = 'set_as_thumbnail';
			$_REQUEST['id'] = null;
			//include_once($context['path_to_root'].'/images/edit.php');
			include_once($context['path_to_root'].'/images/images.php');
			Images::post($_REQUEST);
		}
			
		// links
		if (isset($_REQUEST['link_url']) && ($_REQUEST['link_url'] != '')) {
			  $_REQUEST['anchor'] = 'article:'.$host['id'];
			  $_REQUEST['id'] = null;
			  $_REQUEST['description'] = null;
			  //include_once($context['path_to_root'].'/links/edit.php');
			  include_once($context['path_to_root'].'/links/links.php');
			  Links::post($_REQUEST);
			  
		}
		// build the update query
		$auto_increment = SQL::escape($host['id']) + 1;
		switch($variant) {
			// delete a record
			case 'delete':
				// delete dates for this anchor
				Dates::delete_for_anchor('article:'.$host['id']);
				break;
				// in sert a new record in the database
			case 'insert':
			// bind one date to this record
				if(isset($this->attributes['date_debut']) && $this->attributes['date_debut']) {
	
					$fields = array();
					$fields['anchor'] = 'article:'.$host['id'];
					$fields['date_stamp'] = $this->attributes['date_debut'];
	
					// update the database
					if(!$fields['id'] = Dates::post($fields)) {
						Logger::error(i18n::s('Impossible to add an item.'));
						return FALSE;
					}
	
				}
				//$query = " ALTER TABLE `agenda`  AUTO_INCREMENT =".$auto_increment;
				//SQL::query($query);
				//$query = " ALTER TABLE `asi_articles`  AUTO_INCREMENT =".$auto_increment;
				//SQL::query($query);
			}
	Articles::put($host);
    $_REQUEST = $host;


	return TRUE;
  }
	/**
	 * get categories as checkboxes
	 *
	 * Only categories matching following criteria are returned:
	 * - category is visible (active='Y')
	 * - category is restricted (active='R'), but surfer is a logged member
	 * - category is hidden (active='N'), but surfer is an associate
	 * - an expiry date has not been defined, or is not yet passed
	 *
	 * @param array a list of categories ($reference => $attributes) currently assigned to the item, or a category reference (i.e., 'category:234')
	 * @param string the anchor currently selected, if any
	 * @return the HTML to insert in the page
	 */
	function get_checkboxes($to_avoid=NULL, $to_select=NULL, $category_parent=NULL) { // CHL
		global $context;

		// returned text
		$text = '';

		// display active and restricted items
		$where = "categories.active='Y'";
		if(Surfer::is_member())
			$where .= " OR categories.active='R'";
		if(Surfer::is_associate())
			$where .= " OR categories.active='N'";
		$where = '('.$where.')';

		// only consider live categories
		$now = gmstrftime('%Y-%m-%d %H:%M:%S');
		$where .= ' AND ((categories.expiry_date is NULL)'
			."	OR (categories.expiry_date <= '".NULL_DATE."') OR (categories.expiry_date > '".$now."'))";

		// avoid weekly and monthly publications
		$where .= " AND (categories.nick_name NOT LIKE 'week%') AND (categories.nick_name NOT LIKE '".i18n::c('weekly')."')"
			." AND (categories.nick_name NOT LIKE 'month%') AND (categories.nick_name NOT LIKE '".i18n::c('monthly')."')";

		// make an array of assigned categories
		if(is_string($to_avoid) && $to_avoid) {
			$to_avoid_as_string = $to_avoid;
			$to_avoid = array();
			$to_avoid[$to_avoid_as_string] = 'only one';
		} elseif(!is_array($to_avoid))
			$to_avoid = array();

		// CHL restriction sur une categorie parente
		if(strlen($category_parent)>0) 
			$where .= " AND categories.anchor ='".$category_parent."'";
		else 
			$where .= " AND categories.anchor =''";

		// skip categories already assigned
		foreach($to_avoid as $reference)
			$where .= " AND (categories.nick_name <> '".$reference."')";

		// limit the query to top level
		$query = "SELECT categories.id, categories.nick_name, categories.path, categories.title"
			." FROM ".SQL::table_name('categories')." AS categories"
			." WHERE (".$where.") " // CHL on enleve AND categories.anchor =''
			." ORDER BY categories.path, categories.rank, categories.title LIMIT 0, 500";
		if(!$result =& SQL::query($query))
			return $text;

		// parse request results
		$chlColonne = 0;  // CHL
		while($result && list($option_id, $option_nick_name, $option_path, $option_label) = SQL::fetch_row($result)) {

			// maybe we are in the selected line
			$checked = '';
			if(is_string($to_select) && ($to_select == 'category:'.$option_id))
				$checked = ' checked';
			elseif(is_array($to_select) && !(array_search('category:'.$option_id, $to_select) === false))
				$checked = ' checked';

			if($option_path) {
				// on ne prend que le titre et pas tout le cheminement
				// CHL				$path = explode('|', $option_path);
				// CHL $label = join(CATEGORY_PATH_SEPARATOR, $path);
				$label = $option_label; // CHL 
			} else
				$label = $option_label;
			if ($chlColonne==3) { // CHL  Test nombre de colonne
				$text .= '<br />';
				$chlColonne=0;
				}
			$chlColonne++;
			$text .= '<input type=checkbox name="category:'.$option_id.'"'.$checked.'>'.$label."\n";
		}

		// job done
		return $text;
	}
	/**
	 * get categories as checkboxes
	 *
	 * Only categories matching following criteria are returned:
	 * - category is visible (active='Y')
	 * - category is restricted (active='R'), but surfer is a logged member
	 * - category is hidden (active='N'), but surfer is an associate
	 * - an expiry date has not been defined, or is not yet passed
	 *
	 * @param array a list of categories ($reference => $attributes) currently assigned to the item, or a category reference (i.e., 'category:234')
	 * @param string the anchor currently selected, if any
	 * @return the HTML to insert in the page
	 */
	function get_listOption($to_avoid=NULL, $to_select=NULL, $category_parent=NULL) { // CHL
		global $context;

		// returned text
		$text = '';

		// display active and restricted items
		$where = "categories.active='Y'";
		if(Surfer::is_member())
			$where .= " OR categories.active='R'";
		if(Surfer::is_associate())
			$where .= " OR categories.active='N'";
		$where = '('.$where.')';

		// only consider live categories
		$now = gmstrftime('%Y-%m-%d %H:%M:%S');
		$where .= ' AND ((categories.expiry_date is NULL)'
			."	OR (categories.expiry_date <= '".NULL_DATE."') OR (categories.expiry_date > '".$now."'))";

		// avoid weekly and monthly publications
		$where .= " AND (categories.nick_name NOT LIKE 'week%') AND (categories.nick_name NOT LIKE '".i18n::c('weekly')."')"
			." AND (categories.nick_name NOT LIKE 'month%') AND (categories.nick_name NOT LIKE '".i18n::c('monthly')."')";

		// make an array of assigned categories
		if(is_string($to_avoid) && $to_avoid) {
			$to_avoid_as_string = $to_avoid;
			$to_avoid = array();
			$to_avoid[$to_avoid_as_string] = 'only one';
		} elseif(!is_array($to_avoid))
			$to_avoid = array();

		// CHL restriction sur une categorie parente
		if(strlen($category_parent)>0) 
			$where .= " AND categories.anchor ='".$category_parent."'";
		else 
			$where .= " AND categories.anchor =''";

		// skip categories already assigned
		foreach($to_avoid as $reference)
			$where .= " AND (categories.nick_name <> '".$reference."')";

		// limit the query to top level
		$query = "SELECT categories.id, categories.nick_name, categories.path, categories.title"
			." FROM ".SQL::table_name('categories')." AS categories"
			." WHERE (".$where.") " // CHL on enleve AND categories.anchor =''
			." ORDER BY categories.path, categories.rank, categories.title LIMIT 0, 500";
		if(!$result =& SQL::query($query))
			return $text;

		// parse request results
		$text = '<select name="category:'.$category_parent.'">';
		$chlColonne = 0;  // CHL
		while($result && list($option_id, $option_nick_name, $option_path, $option_label) = SQL::fetch_row($result)) {

			// maybe we are in the selected line
			$checked = '';
			if(is_string($to_select) && ($to_select == 'category:'.$option_id))
				$checked = ' selected="selected"';
			elseif(is_array($to_select) && !(array_search('category:'.$option_id, $to_select) === false))
				$checked = ' selected="selected"';

			if($option_path) {
				// on ne prend que le titre et pas tout le cheminement
				// CHL				$path = explode('|', $option_path);
				// CHL $label = join(CATEGORY_PATH_SEPARATOR, $path);
				$label = $option_label; // CHL 
			} else
				$label = $option_label;
			if ($chlColonne==3) { // CHL  Test nombre de colonne
				$text .= '<br />';
				$chlColonne=0;
				}
			$chlColonne++;
			$text .= '<option value="category:'.$option_id.'"'.$checked.'>'.$label.'</option>'."\n";
		}

		// job done
		$text .= '</select>';
		return $text;
	}
//
// A ajouter après migration yacs
//
	/**
	 * list alphabetically the categories related to a given anchor
	 *
	 * Actually list category by title. 
	 *
	 * Only category matching following criteria are returned:
	 *
	 * @param the target anchor
	 * @param int the offset from the start of the list; usually, 0 or 1
	 * @param int the number of items to display
	 * @param string the list variant, if any
	 * @return NULL on error, else an ordered array with $url => ($prefix, $label, $suffix, $icon)
	 *
	 * @see categories/print.php
	 * @see categories/view.php
	 */
	function &list_category_by_title_for_members($anchor, $category, $offset=0, $count=10, $variant=NULL) {
		global $context;

		// locate where we are
		if(!$variant)
			$variant = $anchor;

		// limit the scope of the request
		//$where = "(categories.thumbnail_url <> '')";
		$where = " categories.anchor='category:10'";

		// the list of articles
		$query = "SELECT categories.*"
			." FROM (".SQL::table_name('members')." AS members"
			.", ".SQL::table_name('categories')." AS categories)"
			." WHERE (members.member LIKE '".SQL::escape($anchor)."')"
			."	AND (CONCAT('category:',".$category.") = members.anchor)"
			."	AND ".$where
			." ORDER BY categories.rank, categories.title LIMIT ".$offset.','.$count;
		// use existing listing facility
		$output =& Articles::list_selected(SQL::query($query), $variant);
		return $output;
	}

}

?>