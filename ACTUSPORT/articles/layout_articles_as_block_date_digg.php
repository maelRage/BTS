<?php
/**
 * layout articles as rows in a table
 *
 * The title of each article is also a link to the article itself.
 * A title attribute of the link displays the reference to use to link to the page.
 *
 * @see sections/view.php
 *
 * @author Bernard Paques
 * @author GnapZ
 * @author Thierry Pinelli (ThierryP)
 * @reference
 * @license http://www.gnu.org/copyleft/lesser.txt GNU Lesser General Public License
 */
Class Layout_articles_as_block_date_digg extends Layout_interface {

	/**
	 * the preferred order for items
	 *
	 * @return string to be used in requests to the database
	 *
	 * @see skins/layout.php
	 */
	function items_order() {
		return 'rank';
	}
	/**
	 * the preferred number of items for this layout
	 *
	 * @return 20
	 *
	 * @see skins/layout.php
	 */
	function items_per_page() {
		return 30;
	}

	/**
	 * list articles as rows in a table
	 *
	 * @param resource the SQL result
	 * @return string the rendered text
	**/
	function &layout(&$result) {
		global $context;

		// we return some text
		$text = $ddate = '';

		// empty list
		if(!SQL::count($result))
			return $text;

		// flag articles updated recently
		$now = gmstrftime('%Y-%m-%d %H:%M:%S');
		if($context['site_revisit_after'] < 1)
			$context['site_revisit_after'] = 2;
		$dead_line = gmstrftime('%Y-%m-%d %H:%M:%S', mktime(0,0,0,date("m"),date("d")-$context['site_revisit_after'],date("Y")));

		// build a list of articles
		$rows = array();
		include_once $context['path_to_root'].'categories/categories.php';
		include_once $context['path_to_root'].'comments/comments.php';
		include_once $context['path_to_root'].'files/files.php';
		include_once $context['path_to_root'].'links/links.php';
		include_once $context['path_to_root'].'overlays/overlay.php';
		$cpt=0; // CHL compteur pour afficher 30 articles maximum
		while($item =& SQL::fetch($result) && $cpt<30) {

			$cpt++;
			// get the related overlay
			$overlay = Overlay::load($item);

			// insert overlay data, if any
			if(is_object($overlay))
				$ddate = $overlay->get_text('block_date_digg', $item);
			// get the anchor
			$anchor =& Anchors::get($item['anchor']);

			// the url to view this item
			$url =& Articles::get_permalink($item);

			// reset the rendering engine between items
			Codes::initialize($url);

			// reset everything
			$title = $abstract = $author = '';

			// CHL suppression indication maj ou new
			// CHL 1ère colonne = date
			$title = ''.$ddate."\n";

			// indicate the id in the hovering popup
			$hover = i18n::s('View the page');
			if(Surfer::is_member())
				$hover .= ' [article='.$item['id'].']';

			// use the title to label the link
			if(is_object($overlay) && is_callable(array($overlay, 'get_live_title')))
				$label = $overlay->get_live_title($item);
			else
				$label = ucfirst(Codes::beautify_title(strip_tags($item['title'], '<br><div><img><p><span>')));

			// use the title as a link to the page
			$abstract .='<h2>'.Skin::build_link($url, $label, 'basic', $hover).'</h2>';
			// insert overlay data, if any
			if(is_object($overlay))
				$abstract .= '<small>'.$overlay->get_text('category', $item) . ' : </small>';

			// CHL recherche de la categorie sport
			// the icon
			//if($item['thumbnail_url'])
			//	$abstract .= '<a href="'.$context['url_to_root'].$url.'"><img src="'.$item['thumbnail_url'].'" class="right_image" alt="" /></a>';
			include_once($context['path_to_root'].'/images/images.php');
			foreach($images = Layout_articles_as_block_date_digg::list_by_date_for_anchor_asc('article:'.$item['id'], 0, 1, 'raw') as $image) {
				  //$src = Images::get_icon_href($image); 
				  $src = Images::get_thumbnail_href($image); 
				  //$text .= '<span class="event_image">'.Skin::build_image('right', $src, $title, $url ).'</span>';
				  $abstract .= '<a href="'.$context['url_to_root'].$url.'"><img src="'.$src.'" class="right_image" alt="'.$image['title'].'" /></a>';
				  break;
			}

			// rating
			if($item['rating_count'])
				$rating_label = sprintf(i18n::ns('%s vote', '%s votes', $item['rating_count']), '<span class="big">'.$item['rating_count'].'</span>'.BR);
			else
				$rating_label = i18n::s('No vote');
			// present results
			$digg = '<div class="digg"><div class="votes">'.$rating_label.'</div>';

			// a rating has already been registered
			if(isset($_COOKIE['rating_'.$item['id']]))
				Cache::poison();

			// where the surfer can rate this item
			else
				$digg .= '<div class="rate">'.Skin::build_link(Articles::get_url($item['id'], 'rate'), i18n::s('Rate it'), 'basic').'</div>';

			// close digg-like area
			$digg .= '</div>';
			

			// manage layout
			$abstract .= '<div class="digg_content">'.$digg.$content.'</div>';
			// the introductory text
			if($item['introduction'])
				$abstract .= Codes::beautify_introduction($item['introduction']);

			// make some abstract out of main text
			if(!$item['introduction'] && ($context['skins_with_details'] == 'Y'))
				$abstract .= Skin::cap(Codes::beautify($item['description'], $item['options']), 50);

			// this is another row of the output -- title, abstract, (author,) details
			// CHL if(isset($context['with_author_information']) && ($context['with_author_information'] == 'Y'))
			//	$cells = array($title, $abstract, $author);
			//else
				$cells = array($title, $abstract);

			// append this row
			$rows[] = $cells;

		}

		// end of processing
		SQL::free($result);

		// headers
		// CHL if(isset($context['with_author_information']) && ($context['with_author_information'] == 'Y'))
		//	$headers = array(i18n::s('Date'), i18n::s('Topic'), i18n::s('Poster'));
		//else
			//$headers = array(i18n::s('Date'), i18n::s('Topic'));

		// return a sortable table
		$text .= Skin::table($headers, $rows, 'grid');
		return $text;
	}
	/**
	 * list newest images for one anchor
	 *
	 * Example:
	 * [php]
	 * include_once 'images/images.php';
	 * $items = Images::list_by_date_for_anchor('section:12', 0, 10);
	 * $context['text'] .= Skin::build_list($items, 'compact');
	 * [/code]
	 *
	 * @param string the anchor (e.g., 'article:123')
	 * @param int the offset from the start of the list; usually, 0 or 1
	 * @param int the number of items to display
	 * @param string the list variant, if any
	 * @return NULL on error, else an ordered array with $url => ($prefix, $label, $suffix, $icon)
	 * @see images/images.php#list_selected for $variant description
	 */
	function &list_by_date_for_anchor_asc($anchor, $offset=0, $count=20, $variant=NULL) {
		global $context;

		// use the anchor itself as the default variant
		if(!$variant)
			$variant = $anchor;

		// the request
		$query = "SELECT * FROM ".SQL::table_name('images')." AS images "
			." WHERE (images.anchor = '".SQL::escape($anchor)."') "
			." ORDER BY images.edit_date, images.title LIMIT ".$offset.','.$count;
		// the list of images
		$output =& Images::list_selected(SQL::query($query), $variant);
		return $output;
	}

}

?>