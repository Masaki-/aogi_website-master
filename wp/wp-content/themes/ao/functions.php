<?php



// 固定ページにカテゴリーを設定
function add_categorie_to_pages(){
register_taxonomy_for_object_type('category', 'page');
}
add_action('init','add_categorie_to_pages');
// カテゴリーアーカイブに固定ページを含める
function add_page_to_category_archive( $query ) {
if ( $query->is_category== true && $query->is_main_query() ) {
$query->set('post_type', array( 'post', 'page' ));
}
}
add_action( 'pre_get_posts', 'add_page_to_category_archive' );


//---------------------------------------------------------------------------
//	賢威の基本設定
//---------------------------------------------------------------------------


remove_filter( 'pre_term_description', 'wp_filter_kses' );

load_textdomain('keni', get_template_directory().'/keni.mo');

if (!defined('KENI_SET')) {
	global $wpdb;
	define("KENI_SET",$wpdb->prefix."keni_setting62");
}


function keni_setting() {
	include(TEMPLATEPATH . '/keni_setting.php');
}

function keni_setup() {
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );
}
add_action( 'after_setup_theme', 'keni_setup' );


register_nav_menu( 'primary', __( 'メニュー', 'keni' ) );

if (is_user_logged_in() and (mb_ereg(get_bloginfo('wpurl')."/wp-admin/", "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']) || mb_ereg(get_bloginfo('wpurl')."/wp-admin/", "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']))) {
	mb_ereg("(wp-admin/.+.php)*$", $_SERVER['REQUEST_URI'], $files);

	if (isset($files[1]) and file_exists(ABSPATH.$files[1])) {
		add_action( 'admin_menu', 'keni_admin_menu' );
		add_action('template_redirect', 'keni_setting');

		add_action('admin_print_scripts', 'my_admin_scripts');
		add_action('admin_print_styles', 'my_admin_styles');
	}
}



//---------------------------------------------------------------------------
// 賢威用各種モジュールの読み込み
//---------------------------------------------------------------------------
require_once("keni62_db.php");

// ディレクトリ内のファイルを読み込む
$mod_dir = opendir(get_template_directory()."/module/");
while($file_name = readdir($mod_dir)) {
//	if (ereg("\.php$", $file_name)) {
	if (preg_match('/\.php$/', $file_name)) {
		if (isset($_GET['taxonomy']) and ($_GET['taxonomy'] == "post_tag")) {
			if ($file_name != "add_extra_fields_category.php") {
				require_once(get_template_directory()."/module/".$file_name);
			}
		} else {
			require_once(get_template_directory()."/module/".$file_name);
		}
	}
}


//---------------------------------------------------------------------------
// 賢威用各種モジュールの読み込み
//---------------------------------------------------------------------------
function register_jquery() {
	wp_register_script('my-utility', get_bloginfo('template_directory') .'/js/utility.js','','',true);
	wp_enqueue_script('my-utility');

	wp_register_script('my-social', get_bloginfo('template_directory') .'/js/socialButton.js','','',true);
	wp_enqueue_script('my-social');

	/*-------------------------------------------------------------------------------------------------
		独自のJSを読み込ます場合は、賢威テンプレートの /js 内にファイルを入れた後、下記に追記して下さい。
		※ コメントアウト（ // ）を外して下さい。
	-------------------------------------------------------------------------------------------------*/
//	wp_register_script('【JS名】', get_bloginfo('template_directory') .'/js/【JSファイル名】','','',true);
//	wp_enqueue_script('【JS名】');
}

add_action('wp_enqueue_scripts', 'register_jquery');


function keni_widgets_init() {
	register_sidebar( array(
		'name' => __( 'サイドバー' ),
		'id' => 'sidebar',
		'before_widget' => '<div id="%1$s" class="contents widget-conts %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'サブコンテンツ' ),
		'id' => 'sub-contents',
		'before_widget' => '<div id="%1$s" class="contents widget-conts %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'keni_widgets_init' );

add_theme_support('menus');
add_theme_support( 'post-thumbnails' );



//---------------------------------------------------------------------------
//	メニューのリストを取得
//---------------------------------------------------------------------------
function get_menu_list() {
	global $wpdb;
	$menu_list['-1'] = "メニューの表示をしない";
	$menu_list['0'] = "標準のメニュー表示を利用する";
	$res = $wpdb->get_results("SELECT t.term_id, t.name FROM ".$wpdb->prefix."term_taxonomy AS tt LEFT JOIN ".$wpdb->prefix."terms AS t USING(term_id) WHERE tt.taxonomy='nav_menu'");
	foreach ($res as $line) {
		$menu_list[$line->term_id] = $line->name;
	}
	return $menu_list;
}

//---------------------------------------------------------------------------
//	「親ページ」＋「子ページ」のタイトルにする
//---------------------------------------------------------------------------

function is_subpage() {
    global $post;
	if ( is_page() && $post->post_parent ){
		$parentID = $post->post_parent;
		return $parentID;
	} else {
		return false;
	};
};
//---------------------------------------------------------------------------
//	カスタムサムネイル
//---------------------------------------------------------------------------

add_image_size('thumb250', 250, 200, true);


//---------------------------------------------------------------------------
//	メニューのカスタマイズ
//---------------------------------------------------------------------------
function get_globalmenu_keni($position = "globalmenu") {

	if (the_keni($position) and (the_keni($position) < 0)) {
		return false;
	}

	$menu_list = get_menu_list();

	if ($position == "globalmenu") {

		$menu_data = array(
			'theme_location'  => '',
			'menu'            => $menu_list[the_keni($position)],
			'container'       => '',
			'container_class' => '',
			'container_id'    => '',
			'menu_class'      => '',
			'menu_id'         => '',
			'echo'            => false,
			'fallback_cb'     => 'wp_page_menu',
			'before'          => '',
			'after'           => '',
			'link_before'     => '',
			'link_after'      => '',
			'items_wrap'      => '%3$s',
			'depth'           => 0,
			'walker'          => ''
		);

		if ($menu_list[the_keni($position)] == "標準のメニュー表示を利用する") {
			$menu_data['theme_location'] = 'menu-header';
			$menu_data['container_class'] = 'menu-header';
		}

		$menu = wp_nav_menu($menu_data);

		$menu = str_replace("\n","", $menu);
		$menu_array = explode("</li>", 	$menu);


		if (is_array($menu_array)) {
			foreach ($menu_array as $no => $val) {
				$val = trim($val);
				$val = str_replace('<div class=""><ul>','',$val);
				$val = str_replace('</li></ul></div>','',$val);

				if ($val != "") {
					if ($no == 0) {
						$menu_array[$no] = preg_replace("/<li(.+?)class=\"(.+)\">/","<li$1class=\"first $2\">", $val)."</li>";
					} else {
						$menu_array[$no] = $val ."</li>";
					}
				} else {
					unset($menu_array[$no]);
				}
			}
			$menu = implode("\n", $menu_array)."\n";
			$menu = trim(str_replace('</ul></div></li>','',$menu))."\n";
		}

	} else {	// ヘッダメニュー以外
		if ($menu_list[the_keni($position)] == "標準のメニュー表示を利用する") {
			$menu_data['theme_location'] = 'menu-header';
			$menu_data['container_class'] = 'menu-header';
		} else {
			$menu_data['menu'] = $menu_list[the_keni($position)];
		}

		$menu = wp_nav_menu($menu_data);
	}

	return $menu;
}



//---------------------------------------------------------------------------
//	アーカイブのタイトルの表示する関数
//---------------------------------------------------------------------------

function archive_title_keni() {
	echo get_archive_title_keni();
}


function get_archive_title_keni($page="y") {
	$arc_title = "";
	if (is_archive()) {
		if(is_category()){
			global $cat;
			$title_araay = get_post_meta($cat, "title");
			if (isset($title_araay[0]) and ($title_araay[0] != "")) {
				$arc_title = $title_araay[0];
			} else {
				$arc_title = sprintf( __('Archive List for %s','keni'), single_cat_title("",false));
			}
		} else if(is_day()){
			$arc_title = sprintf( __('Archive List for %s','keni'), get_the_time(__('F j, Y','keni')));
		} else if(is_month()){
			$arc_title = sprintf( __('Archive List for %s','keni'), get_the_time(__('F Y','keni')));
		} else if(is_year()){
			$arc_title = sprintf( __('Archive List for %s','keni'), get_the_time(__('Y','keni')));
		} else if(is_author()) {
			$arc_title = get_the_author().sprintf( __('Archive List for authors','keni'));
		} elseif(is_tag()) {
			$tag_id = get_query_var('tag_id');
			$title_araay = get_post_meta($tag_id, "title");
			if (isset($title_araay[0]) and ($title_araay[0] != "")) {
				$arc_title = $title_araay[0];
			} else {
				$arc_title = sprintf( __('Tag List for %s','keni'), single_tag_title("",false));
			}
		} else if(isset($_GET['paged']) && !empty($_GET['paged'])) {
			$title = sprintf( __('Archive List for blog','keni'));
		} else {
			$categoryList = get_post_type_object(get_post_type());
			if (preg_match('/'.get_post_type().'\/$/', $_SERVER['REQUEST_URI'])) {	// カテゴリの上位の場合
				$arc_title = $categoryList->labels->name;
			} else {
				foreach ($categoryList->taxonomies as $taxonomie) {
					$term = get_the_terms(get_the_ID(), $taxonomie);
					if (!isset($term->errors)) {
						foreach ((array)$term as $val) {
							$arc_title = $val->name;
							break;
						}
					}
				}
			}
		}
	} else if(is_search()){
		$arc_title = sprintf( __('Search Result for %s','keni'), get_search_query());
	}

	if ((get_query_var('paged') > 1)  and ($page=="y")) {
		return $arc_title.show_page_number();
	} else {
		return $arc_title;
	}
}


/**
 * ページのルート名を取得
 *
 *
 */

function get_root_page_name($l_post = null) {
  global $post;
  if (is_null($l_post)) {
    $l_post = $post;
  }
  if ($l_post->post_parent) {
    $parent_post = get_post($l_post->post_parent);
    return get_root_page_name($parent_post);
  }
  return $l_post->post_name;
}

/**
 * ページのがあるページの子ページもしくはそのページかを判定する関数
 *
 *
 */

function is_tree( $pid ) {      // $pid = この ID を持つ固定ページの子ページを表示中であるか
    global $post;               // 現在の固定ページの詳細を読み込む
    if ( is_page( $pid ) )
        return true;            // その固定ページを表示中
    $anc = get_post_ancestors( $post->ID );
    foreach ( $anc as $ancestor ) {
        if( is_page() && $ancestor == $pid ) {
            return true;        // 子ページを表示中
        }
    }
    return false;  // その固定ページもでなく、子ページでもない
}


//---------------------------------------------------------------------------
//	個別ページにタグを設定出来るようにする
//---------------------------------------------------------------------------
function add_tag_to_page() {
 register_taxonomy_for_object_type('post_tag', 'page');
}
add_action('init', 'add_tag_to_page');

function add_page_to_tag_archive( $obj ) {
	if ( is_tag() and $obj->is_main_query()) {
		$obj->query_vars['post_type'] = array( 'post', 'page' );
	}
}
add_action( 'pre_get_posts', 'add_page_to_tag_archive' );

//---------------------------------------------------------------------------
//	最新情報リスト
//---------------------------------------------------------------------------
function newposts_keni( $num_of_posts = 5, $hatenabm = 0, $excerpt = 0, $show_date = "month", $catid = 0, $type = 1) {

	$r = new WP_Query(array('showposts' => $num_of_posts, 'nopaging' => 0, 'post_status' => 'publish', 'cat' => $catid, 'ignore_sticky_posts' => 1));
	$lastpostcnt = 0;
	while ($r->have_posts()) : $r->the_post();
		$lastpostcnt++;
		echo "<dt>";

		if ( "year" == $show_date ) {
			the_time(get_option( 'date_format'));
//			the_time(__('F j, Y','keni'));
		} else if ( "month" == $show_date ) {
			the_time(get_option( 'date_format'));
//			the_time(__('F j','keni'));
		} else if ( "diff" == $show_date ) {
			$difftime = strtotime("now") - strtotime(get_the_time("Y-m-d"));
			$diffday = (int) ($difftime / 86400);
			if ( $diffday >= 2 ) {
				printf(__('%s days ago','keni'), $diffday);
			} else if ( $diffday >= 1 ) {
				printf(__('%s day ago','keni'), $diffday);
			} else {
				echo(__('Less than a day ago','keni'));
			}
		}
		echo "</dt>\n";

		$catdata = get_the_category();

		if ($type == 1) {
			$term_data = get_option('term_'.$catdata[0]->cat_ID);
			$term_bgcolor = ( empty( $term_data['bgcolor'] ) ) ? '#666' : $term_data['bgcolor'];
			$term_txcolor = ( empty( $term_data['textcolor'] ) ) ? '#fff' : $term_data['textcolor'];

			echo "<dd class=\"cat category".sprintf("%02d",$catdata[0]->cat_ID)."\" style=\"background-color: ".esc_attr($term_bgcolor)."; color: ".esc_attr($term_txcolor)."\">".esc_attr($catdata[0]->cat_name)."</dd>\n";
			echo "<dd><a href=\"".get_permalink()."\" title=\"". (get_the_title() ? esc_attr(get_the_title()) : get_the_ID())."\">";
			if ( get_the_title() ) the_title(); else the_ID();
			echo "</a>";
			if ( $hatenabm ) echo get_hatena_bookmark(get_permalink());
			if ( $excerpt ) {
				echo "<div>";
				the_excerpt_rss();
				echo "</div>";
			}
			echo "\n</dd>\n";

		} else if ($type == 2) {

			if (isset($catdata) and count($catdata) > 0) { ?>
				<dd class="cat">
				<ul>
				<?php foreach ($catdata as $cat) {
					$term_data = get_option('term_'.$cat->cat_ID);
					$term_bgcolor = ( empty( $term_data['bgcolor'] ) ) ? '#666' : $term_data['bgcolor'];
					$term_txcolor = ( empty( $term_data['textcolor'] ) ) ? '#fff' : $term_data['textcolor'];
					echo "<li class=\"cat category".sprintf("%02d",$cat->cat_ID)."\" style=\"background-color: ".esc_attr($term_bgcolor)."; color: ".esc_attr($term_txcolor)."\">".esc_attr($cat->cat_name)."</li>\n";
				} ?>
				</ul>
				</dd>
<?php }
			echo "<dd><a href=\"".get_permalink()."\" title=\"". (get_the_title() ? esc_attr(get_the_title()) : get_the_ID())."\">";
			if ( get_the_title() ) the_title(); else the_ID();
			echo "</a><br />";
			if ( $hatenabm ) echo get_hatena_bookmark(get_permalink());
			if ( $excerpt ) {
				the_excerpt_rss();
			}
			echo "</dd>\n";
		}

	endwhile;
	wp_reset_query();  // Restore global post data stomped by the_post().
}


//---------------------------------------------------------------------------
//	固定ページで「抜粋」を入力可に
//---------------------------------------------------------------------------
add_post_type_support('page', 'excerpt');


//---------------------------------------------------------------------------
//	「もっと見る」リンクの文字省略時のデザイン変更
//---------------------------------------------------------------------------
function new_excerpt_more($more) {
	return '・・・';
}
add_filter('excerpt_more', 'new_excerpt_more');

//---------------------------------------------------------------------------
//	リンクリスト表示用ショートコード設定
//---------------------------------------------------------------------------

function link_list() {
	return "<dl class='dl-style02'>".wp_list_bookmarks('between=<dd>&title_li=&categorize=0&orderby=id&show_description=1&before=<dt>&after=</dd></dt>&echo=0')."</dl>";
}

add_shortcode('link_list','link_list');

//---------------------------------------------------------------------------
//	リンクマネージャーを有効にする
//---------------------------------------------------------------------------
add_filter( 'pre_option_link_manager_enabled', '__return_true' );



//---------------------------------------------------------------------------
//	投稿での改行
//---------------------------------------------------------------------------
/**
 * [br] または [br num="x"] x は数字を入れる
*/

function sc_brs_func( $atts, $content = null ) {
	extract( shortcode_atts( array(
					'num' => '5',
					), $atts ));
	$out = "";
	for ($i=0;$i<$num;$i++) {
		$out .= "<br />";
	}
	return $out;
}

add_shortcode( 'br', 'sc_brs_func' );

//---------------------------------------------------------------------------
//	Include PHP埋め込みショートコード
//---------------------------------------------------------------------------
/**
 * [br] または [br num="x"] x は数字を入れる
*/


//ここから
function Include_my_php($params = array()) {
    extract(shortcode_atts(array(
        'file' => 'default'
    ), $params));
    ob_start();
    include(get_theme_root() . '/' . get_template() . "/$file.php");
    return ob_get_clean();
}

add_shortcode('myphp', 'Include_my_php');
//ここまで

//---------------------------------------------------------------------------
//	管理画面上での<h1>エリアの指定
//---------------------------------------------------------------------------
add_action('admin_menu', 'add_h1_box');
add_action('save_post', 'save_h1_string');

function add_h1_box() {
	add_meta_box('h1', '&lt;h1&gt;の文字', 'h1_setting', 'post', 'normal', 'high');
	add_meta_box('h1', '&lt;h1&gt;の文字', 'h1_setting', 'page', 'normal', 'high');
}

function h1_setting() {
	if (isset($_GET['post'])) {
		$page_h1_array = get_post_meta( $_GET['post'], 'page_h1');
		if (isset($page_h1_array[0])) {
			$page_h1 = $page_h1_array[0];
		} else {
			$page_h1 = "";
		}
	} else {
		$page_h1 = "";
	}

	$res = "<input class=\"keni_h1_textbox\" type=\"text\" name=\"page_h1\" value=\"".htmlspecialchars($page_h1)."\" size=\"64\" maxlength=\"64\" />";
	echo $res;
}

function save_h1_string($post_id) {
	if (isset($_POST['page_h1'])) {
		$change_h1 = $_POST['page_h1'];
		if (get_post_meta( $post_id, 'page_h1') == "") {
			add_post_meta( $post_id, 'page_h1', $change_h1, true);
		} else {
			update_post_meta( $post_id, 'page_h1', $change_h1);
		}
	}
}


//---------------------------------------------------------------------------
//	<h1>の表示する関数
//---------------------------------------------------------------------------

function h1_keni() {
	echo esc_html(get_h1_keni());
}


function get_h1_keni($post_id = 0) {

	$h1 = "";
	$no_view = "y";

	if ($post_id > 0) {
		$post_h1_array = get_post_meta($post_id,'page_h1');
		if (isset($post_h1_array[0]) and ($post_h1_array[0] != "")) {
			$h1 = $post_h1_array[0];
		} else {
			$h1 = get_the_title($post_id);
		}

	} else if(is_home() or is_front_page()) {

		if ((get_option('page_for_posts') > 0) and (get_the_ID() != get_option('page_on_front'))) {
			$h1 = get_the_title(get_option('page_for_posts'));
		} else {
			if (the_keni('top_h1') != "") {
				$h1 = the_keni('top_h1');
			} else {
				$h1 = title_keni();
				$no_view = "n";
			}
		}

		if (get_query_var('paged') > 1 && $no_view =="y") {
			$h1 .= show_page_number();
		}

	} else if (is_day() or is_month() or is_year()) {
		$h1 = archive_title_keni();

	} else if (is_category() or is_tag()) {

		$h1 = get_archive_title_keni();

	} else if (is_singular()) {

		$post_h1_array = get_post_meta(get_the_ID(),'page_h1');
		if (isset($post_h1_array[0]) and ($post_h1_array[0] != "")) {
			$h1 = $post_h1_array[0];
		} else {
			$h1 = get_the_title();
		}

	} else if (is_404()) {
		$h1 = "お探しの記事は見つかりませんでした。";

	} else {
		$h1 = archive_title_keni();
	}

	return $h1;
}


//---------------------------------------------------------------------------
//	管理画面上でのcanonicalエリアの指定
//---------------------------------------------------------------------------

add_action('admin_menu', 'add_canonical_box');
add_action('save_post', 'save_canonical_string');

function add_canonical_box() {
	add_meta_box('canonical', 'canonical URL', 'canonical_setting', 'post', 'normal', 'high');
	add_meta_box('canonical', 'canonical URL', 'canonical_setting', 'page', 'normal', 'high');
}

function canonical_setting() {
	if (isset($_GET['post'])) {
		$page_canonical_array = get_post_meta( $_GET['post'], 'page_canonical');
		if (isset($page_canonical_array[0])) {
			$page_canonical = $page_canonical_array[0];
		} else {
			$page_canonical = "";
		}
	} else {
		$page_canonical = "";
	}

	$res = "<input type=\"text\" class=\"keni_canonical_textbox\" name=\"page_canonical\" id=\"page_canonical\" value=\"".htmlspecialchars($page_canonical)."\" size=\"64\" />";
	echo $res;
}

function save_canonical_string($post_id) {
	if (isset($_POST['page_canonical'])) {
		$change_canonical = $_POST['page_canonical'];
		if (get_post_meta( $post_id, 'page_canonical') == "") {
			add_post_meta( $post_id, 'page_canonical', $change_canonical, true);
		} else {
			update_post_meta( $post_id, 'page_canonical', $change_canonical);
		}
	}
}



//---------------------------------------------------------------------------
//	canonicalを表示する関数
//---------------------------------------------------------------------------

function canonical_keni() {
	echo get_canonical_keni();
}


function get_canonical_keni() {
	$canonical = "";
	if(!is_home() && !is_front_page()) {
		if (!preg_match('/noindex/', getIndexFollow(), $res)) {
			$post_canonical_array = get_post_meta(get_the_ID(),'page_canonical');
			if (isset($post_canonical_array[0]) and ($post_canonical_array[0] != "")) {
				$canonical = '<link rel="canonical" href="'.$post_canonical_array[0]. '" />'."\n";
				remove_action('wp_head', 'rel_canonical');
			}
		}
	}
	return $canonical;
}



//---------------------------------------------------------------------------
//	管理画面上での関連記事エリアの指定
//---------------------------------------------------------------------------

add_action('admin_menu', 'add_relation_box');
add_action('save_post', 'save_relation_string');

function add_relation_box() {
	add_meta_box('relation', '関連記事設定', 'relation_setting', 'post', 'normal', 'high');
	add_meta_box('relation', '関連記事設定', 'relation_setting', 'page', 'normal', 'high');
}

function relation_setting() {

	for ($i = 0; $i < 5; $i++) {
		$relation[$i]['title'] = "";
		$relation[$i]['url'] = "";
		$relation[$i]['blank'] = "";
	}

	if (isset($_GET['post'])) {
		$relation_array = get_post_meta( $_GET['post'], 'relation');
		if (isset($relation_array[0])) {
			// 改行で区切る
			$relation_lies = explode("\n", $relation_array[0]);
			foreach ($relation_lies as $no => $relation_line) {
				// タブで区切る
				$line_array = explode("\t", $relation_line);
				if (trim($line_array[0]) != "") {
					$relation[$no]['title'] = $line_array[0];
					$relation[$no]['url'] = $line_array[1];
					$relation[$no]['blank'] = $line_array[2];
				}
			}
		}
	}

	$res = "<p>左から「記事タイトル」「記事URL」を入力して下さい。<br />リンクを新ウィンドウで開きたい場合は、右のチェックボックスにチェックを入れて下さい。</p>\n";
	$res .= "<ol class=\"keni_relation_lists\">\n";

	foreach ($relation as $no => $val) {
		$res .= "<li>\n";
		$res .= "<span class=\"keni_relation_title\"><input type=\"text\" name=\"relation[".$no."][title]\" value=\"".htmlspecialchars($val['title'])."\" placeholder=\"記事タイトル\" size=\"32\" /></span>\n";
		$res .= "<span class=\"keni_relation_url\"><input type=\"text\" name=\"relation[".$no."][url]\" value=\"".htmlspecialchars($val['url'])."\" placeholder=\"記事URL\" size=\"55\" /></span>\n";
		if ($val['blank'] == "y") {
			$res .= "<span class=\"keni_relation_blank\"><input type=\"checkbox\" name=\"relation[".$no."][blank]\" value=\"y\" checked=\"checked\" /></span>\n";
		} else {
			$res .= "<span class=\"keni_relation_blank\"><input type=\"checkbox\" name=\"relation[".$no."][blank]\" value=\"y\" /></span>\n";
		}
		$res .= "</li>\n";
	}
	$res .= "</ol>\n";

	echo $res;
}

function save_relation_string($post_id) {
	if (isset($_POST['relation'])) {
		$relation = "";
		foreach ($_POST['relation'] as $no => $val) {
			if (($val['title'] != "") and ($val['url'] != "")) {
				$relation .= $val['title']."\t".$val['url']."\t".$val['blank']."\n";
			}
		}
		if (get_post_meta( $post_id, 'relation') == "") {
			add_post_meta( $post_id, 'relation', $relation, true);
		} else {
			update_post_meta( $post_id, 'relation', $relation);
		}
	}
}



//---------------------------------------------------------------------------
//	関連記事を表示する関数
//---------------------------------------------------------------------------

function relation_keni() {
	echo get_relation_keni();
}


function get_relation_keni() {
	$relation = "";
	if(!is_home() && !is_front_page()) {
		$relation_array = get_post_meta(get_the_ID(),'relation');
		if (isset($relation_array[0]) and ($relation_array[0] != "")) {

			// 改行で区切る
			$relation_lies = explode("\n", $relation_array[0]);
			foreach ($relation_lies as $no => $relation_line) {
				// タブで区切る
				$line_array = explode("\t", $relation_line);
				if (trim($line_array[0]) != "") {
					if ($line_array[2] == "y") {
						$relation .= "<li><a href=\"".$line_array[1]."\" title=\"".$line_array[0]."\" target=\"_blank\">".$line_array[0]."</a></li>\n";
					} else {
						$relation .= "<li><a href=\"".$line_array[1]."\" title=\"".$line_array[0]."\">".$line_array[0]."</a></li>\n";
					}
				}
			}
		}
	}
	if ($relation != "") {
		return "<div class=\"contents keni-relatedposts\">\n<h3 id=\"keni-relatedposts\">".sprintf( __('Related Posts','keni'))."</h3>\n<ul class=\"keni-relatedposts-list\">\n".$relation."</ul>\n</div>\n";
	} else {
		return "";
	}
}



//---------------------------------------------------------------------------
//	管理画面上でのレイアウトの指定
//---------------------------------------------------------------------------
$layout = array("def" => "共通設定を適用する",
								"col1" => "1カラム",
								"col2" => "2カラム",
								"col2r" => "2カラムリバース",
								"col3" => "3カラム",
								"col3r" => "3カラムリバース"
								);

add_action('admin_menu', 'add_layout_custom_box');
add_action('save_post', 'save_custom_field_postdata');

function add_layout_custom_box() {
	add_meta_box('page_layout', 'レイアウト', 'layout_setting', 'post', 'side', 'low');
	add_meta_box('page_layout', 'レイアウト', 'layout_setting', 'page', 'side', 'low');
}

function layout_setting() {
	global $layout;

	if (isset($_GET['post'])) {
		$post_layout_array = get_post_meta( $_GET['post'], 'page_layout');
		if (isset($post_layout_array[0])) {
			$post_layout = $post_layout_array[0];
		} else {
			$post_layout = "def";
		}
	} else {
		$post_layout = "def";
	}
	$last_type = end($layout);
	$res = "<select name=\"page_layout\">\n";

	foreach ($layout as $type => $view) {
		if ($type == $post_layout) {
			$res .= "<option value=\"".$type."\" selected=\"selected\" >".$view."</option>\n";
		} else {
			$res .= "<option value=\"".$type."\" >".$view."</option>\n";
		}
	}
	$res .= "</select>\n";
	echo $res;
}

function save_custom_field_postdata($post_id) {
	if (isset($_POST['page_layout'])) {
		$change_layout = $_POST['page_layout'];
		if (get_post_meta( $post_id, 'page_layout') == "") {
			add_post_meta( $post_id, 'page_layout', $change_layout, true);
		} else {
			update_post_meta( $post_id, 'page_layout', $change_layout);
		}
	}
}



//---------------------------------------------------------------------------
//	管理画面上でのエリアの表示指定
//---------------------------------------------------------------------------
$view_area = array("sub" => "サブコンテンツ　",
									"side" => "サイドバー　　　"
									);

$view_status = array("def" => "共通設定を適用する",
										 "y" => "表示する",
										 "n" => "表示しない"
										 );

add_action('admin_menu', 'add_contents_area');
add_action('save_post', 'save_contents_postdata');

function add_contents_area() {
	add_meta_box('contents_area', 'コンテンツエリア', 'view_contents_setting', 'post', 'side', 'low');
	add_meta_box('contents_area', 'コンテンツエリア', 'view_contents_setting', 'page', 'side', 'low');
}

function view_contents_setting() {
	global $view_area;
	global $view_status;

	$view_sub = the_keni('view_sub');
	$view_side = the_keni('view_side');

	$res = "<table>\n<tbody>";

	foreach ($view_area as $type => $view) {
		$res .= "<tr>\n<th>".$view."</th>\n<td>\n";

		$sel_status = get_post_meta( $_GET['post'], $type);

		if (isset($sel_status[0])) {
			$selected = $sel_status[0];
		} else {
			$selected = key($view_status);
		}

		$res .= "<select name=\"".$type."\">\n";

		foreach ($view_status as $status_type => $status_view) {
			if ($status_type == $selected) {
				$res .= "<option value=\"".$status_type."\" selected=\"selected\" >".$status_view."</option>\n";
			} else {
				$res .= "<option value=\"".$status_type."\" >".$status_view."</option>\n";
			}
		}
		$res .= "</select>\n</td>\n</tr>\n";
	}

	$res .= "</tbody>\n</table>";

	echo $res;
}

function save_contents_postdata($post_id) {
	global $view_area;
	foreach ($view_area as $type => $view) {
		if (isset($_POST[$type])) {
			$change_view = $_POST[$type];
			if (get_post_meta( $post_id, $type) == "") {
				add_post_meta( $post_id, $type, $change_view, true);
			} else {
				update_post_meta( $post_id, $type, $change_view);
			}
		}
	}
}



//---------------------------------------------------------------------------
//	管理画面上でのindex/followの指定
//---------------------------------------------------------------------------
$index_area = array("index" => array("index" => "index",
																		 "noindex" => "noindex"),
										"follow" => array("follow" => "follow",
																			"nofollow" => "nofollow")
									);

$index_pulldown = array("index" => "index",
												"noindex" => "noindex",
												"noindex_p2" => "2ページ目以降はnoindex"
												);

// index_menu
$index_menu['def'] = "共通設定を適用する";
foreach ($index_area['index'] as $val) {
	$index_menu[$val] = $val;
}

$index_list_menu['def'] = "共通設定を適用する";
foreach ($index_pulldown as $no => $val) {
	$index_list_menu[$no] = $val;
}

// follow_menu
$follow_menu['def'] = "共通設定を適用する";
foreach ($index_area['follow'] as $val) {
	$follow_menu[$val] = $val;
}


add_action('admin_menu', 'add_index_area');
add_action('save_post', 'save_index_postdata');

function add_index_area() {
	add_meta_box('index_area', 'インデックス/フォロー', 'index_setting', 'post', 'side', 'low');
	add_meta_box('index_area', 'インデックス/フォロー', 'index_setting', 'page', 'side', 'low');
}

function index_setting() {
	global $index_area;

	$res = "<table>\n<tbody>";

	foreach ($index_area as $view => $setting) {

		$res .= "<tr>\n<th>".$view."</th>\n<td>\n";

		$sel_status = get_post_meta( $_GET['post'], $view);

		if (isset($sel_status[0])) {
			$selected = $sel_status[0];
		} else {
			$selected = key($setting);
		}

		$res .= "<select name=\"".$view."\" id=\"index_val\">\n";

		foreach ($setting as $type => $val) {

			if ($type == $selected) {
				$res .= "<option value=\"".$type."\" selected=\"selected\" >".$val."</option>\n";
			} else {
				$res .= "<option value=\"".$type."\" >".$val."</option>\n";
			}
		}
		$res .= "</select>\n</td>\n</tr>\n";
	}

	$res .= "</tbody>\n</table>\n";


	// noindexの場合に、canonicalをdisableにする
	$res .= "<script type=\"text/javascript\">\n";
	$res .= "jQuery(function(){\n";
	$res .= "change_index();\n";
	$res .= "jQuery('#index_val').change(function() {\n";
	$res .= "change_index();\n";
	$res .= "})\n";
	$res .= "})\n";

	$res .= "function change_index() {\n";
	$res .= "var index = jQuery('#index_val').val();\n";
	$res .= "if (index == \"noindex\") {;\n";
	$res .= "jQuery('#page_canonical').attr('disabled', 'disabled');\n";
	$res .= "jQuery('#page_canonical').css('background-color', '#e6e6e6');\n";
	$res .= "} else {\n";
	$res .= "jQuery('#page_canonical').removeAttr('disabled');\n";
	$res .= "jQuery('#page_canonical').css('background-color', '#fff');\n";
	$res .= "}\n";
	$res .= "}\n";
	$res .= "</script>\n";

	echo $res;
}

function save_index_postdata($post_id) {

	global $index_area;

	foreach ($index_area as $type => $val) {

		if (isset($_POST[$type])) {
			$change_index = $_POST[$type];
			if (get_post_meta( $post_id, $type) == "") {
				add_post_meta( $post_id, $type, $change_index, true);
			} else {
				update_post_meta( $post_id, $type, $change_index);
			}
		}
	}
}



//---------------------------------------------------------------------
// ポストIDに設定したレイアウトを取得
//---------------------------------------------------------------------
function getPageLayout($post_id) {

	$post_layout = $top_layout = "";

	if(is_front_page()) {
		$top_layout = the_keni('top_layout');
		if ($top_layout == "") {
			$top_layout = "col2";
		} else if ($top_layout == "def") {
			$top_layout = the_keni('layout');
		}
		return $top_layout;

	} else if(is_home() and get_option('page_for_posts') > 1) {
		$post_layout_array = get_post_meta(get_option('page_for_posts'),'page_layout');
		if (isset($post_layout_array[0])) {
			$post_layout = $post_layout_array[0];
			if ($post_layout == "def") {
				$post_layout = the_keni('layout');
			}
		} else {
			$post_layout = the_keni('layout');
		}
	} elseif (is_category()) {

		$layout_araay = get_post_meta( get_query_var('cat'), "layout");
		if (isset($layout_araay[0]) and ($layout_araay[0] != "def")) {
			$post_layout = $layout_araay[0];
		} else {
			$post_layout = the_keni('list_category');
		}
	} elseif (is_search()) {
		$post_layout = the_keni('list_search');
	} elseif (is_author()) {
		$post_layout = the_keni('list_author');
	} elseif (is_tag()) {
		$layout_araay = get_post_meta( get_query_var('tag_id'), "layout");
		if (isset($layout_araay[0]) and ($layout_araay[0] != "def")) {
			$post_layout = $layout_araay[0];
		} else {
			$post_layout = the_keni('list_tag');
		}
	} elseif (is_archive()) {
		$post_layout = the_keni('list_archive');
	} else {
		$post_layout_array = get_post_meta($post_id,'page_layout');
		if (isset($post_layout_array[0])) {
			$post_layout = $post_layout_array[0];
			if ($post_layout == "def") {
				$post_layout = the_keni('layout');
			}
		} else {
			$post_layout = the_keni('layout');
		}
	}

	if ($post_layout == "") {
		$post_layout = "col2";
	} else if ($post_layout == "def") {
		$post_layout = the_keni('layout');
	}
	return $post_layout;
}


//---------------------------------------------------------------------------
// ポストIDに設定したレイアウトを表示する
//---------------------------------------------------------------------------
function pageLayoutView($post_id) {
	global $layout;
	$post_layout = getPageLayout($post_id);
	echo $layout[$post_layout];
}



//---------------------------------------------------------------------------
// 404に設定したレイアウトを表示する
//---------------------------------------------------------------------------
function notFoundLayoutView() {
	global $layout;
	$post_layout = the_keni('list_404');
	if ($post_layout == "def") {
		$post_layout = the_keni('layout');
	}
	return $post_layout;
}




//---------------------------------------------------------------------------
// 対象ページに設定されているレイアウトを返却
//---------------------------------------------------------------------------
function keni_layout($post_id) {

	if(is_home() or is_front_page()) {
		$res = get_body_class(the_keni('top_layout'));
	} else if (isset($post_id)) {
		$res = get_body_class(getPageLayout($post_id));
	} else {
		$res = 	get_body_class(the_keni('layout'));
	}

	return $res;
}


//---------------------------------------------------------------------------
//	データベースに登録されている内容を取得
//---------------------------------------------------------------------------
function getKeniSetting() {
	global $wpdb;

	$table_alive = $wpdb->get_results("SHOW TABLES LIKE '".KENI_SET."'");
	if (isset($table_alive) and count($table_alive) > 0) {
		$sql = "SELECT * FROM ".KENI_SET." ORDER BY ks_sort";
		$res = $wpdb->get_results($sql , ARRAY_A);
		foreach ($res as $val) {
			$ks_id = $val['ks_id'];
			unset($val['ks_id']);
			$list[$ks_id] = $val;
		}
		return $list;
	}
	return array();
}


//---------------------------------------------------------------------------
//	データベースに登録されている個別の項目情報を取得
//---------------------------------------------------------------------------
function the_keni($val="") {
	$res = "";
	if ($val != "") {
		global $wpdb;
		$table_alive = $wpdb->get_results("SHOW TABLES LIKE '".KENI_SET."'");
		if (isset($table_alive) and count($table_alive) > 0) {
			$res = $wpdb->get_var($wpdb->prepare("SELECT ks_val FROM ".KENI_SET." WHERE ks_sys_cont=%s AND ks_active='y'", $val));
		}
	}
	return $res;
}



//---------------------------------------------------------------------------
//	管理画面でのファイルのアップロード機能
//---------------------------------------------------------------------------
function my_admin_scripts() {
	if (isset($_GET['page']) and ($_GET['page'] == "keni_admin_menu")) {
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_register_script('my-upload', get_bloginfo('template_directory') .'/js/upload.js');
		wp_enqueue_script('my-upload');
	}
}
function my_admin_styles() {
	wp_enqueue_style('thickbox');
}

function replaceImagePath($arg) {
	$content = str_replace('"images/', '"' . get_bloginfo('template_directory') . '/images/', $arg);
	return $content;
}
add_action('the_content', 'replaceImagePath');

//---------------------------------------------------------------------------
//	投稿一覧に、項目を追加する
//---------------------------------------------------------------------------
function manage_posts_columns($columns) {
	$columns['column'] = "カラム数";
	$columns['h1'] = "h1";
	$columns['thumbnail'] = "アイキャッチ";
	return $columns;
}
function add_column($column_name, $post_id) {
	if ( $column_name == 'column' ) {
		pageLayoutView($post_id);
	} else if ( $column_name == 'h1' ) {
		echo get_h1_keni($post_id);
	} else if ( $column_name == 'thumbnail' ) {
		$thumbnail_id = get_post_thumbnail_id($post_id);
		$image = wp_get_attachment_image_src($thumbnail_id, "thumbnail");
		if (isset($image[0])) {
			echo '<img src="'.$image[0].'" />';
		} else {
			echo "&#8212;";
		}
	}
}
add_filter( 'manage_posts_columns', 'manage_posts_columns' );
add_action( 'manage_posts_custom_column', 'add_column', 10, 2 );

add_filter( 'manage_pages_columns', 'manage_posts_columns' );
add_action( 'manage_pages_custom_column', 'add_column', 10, 2 );


//---------------------------------------------------------------------------
//	投稿画面からフォーマットの項目を非表示にする
//---------------------------------------------------------------------------
function remove_post_metaboxes() {
	remove_meta_box('formatdiv', 'post', 'normal');
}
add_action('admin_menu', 'remove_post_metaboxes');


//---------------------------------------------------------------------------
//	ページャーを表示する
//---------------------------------------------------------------------------
function pager_keni() {

	$pager = "";

	global $wp_query;
	$max_page = $wp_query->max_num_pages;
	$now_page = get_query_var('paged');
	if ($now_page == 0) {
		$now_page =1;
	}
	if ($max_page > $now_page) {
		$pager .= "<li class=\"nav-prev\">". get_next_posts_link('以前の記事へ') ."</li>\n";
	}

	if (is_paged()) {
		$pager .= "<li class=\"nav-next\">". get_previous_posts_link('新しい記事へ')."</li>\n";
	}

	if ($pager != "") {
		echo "<div class=\"cont-menu-wp\">\n<ul>\n".$pager."</ul>\n</div>\n";
	}
}

//---------------------------------------------------------------------------
//	/category/を非表示にする
//---------------------------------------------------------------------------

add_filter('user_trailingslashit', 'remcat_function');
function remcat_function($link) {
    return str_replace("/category/", "/", $link);
}

add_action('init', 'remcat_flush_rules');
function remcat_flush_rules() {
    global $wp_rewrite;
    $wp_rewrite->flush_rules();
}

add_filter('generate_rewrite_rules', 'remcat_rewrite');
function remcat_rewrite($wp_rewrite) {
    $new_rules = array('(.+)/page/(.+)/?' => 'index.php?category_name='.$wp_rewrite->preg_index(1).'&paged='.$wp_rewrite->preg_index(2));
    $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
}


//---------------------------------------------------------------------------
//	カテゴリ名を取得
//---------------------------------------------------------------------------
function get_category_keni($param = "', '") {

	$category = get_the_category();

	if (is_array($category) and count($category) > 0) {
		echo '[<span class="post-cat">';
		echo the_category($param);
		echo '</span>]';
	} else {
		$categoryList = get_post_type_object(get_post_type());

		if (is_object($categoryList)) {
			foreach ($categoryList->taxonomies as $taxonomie) {
				$term = get_the_terms(get_the_ID(), $taxonomie);
				if (is_object($term) and !isset($term->errors)) {
					foreach ($term as $val) {
						$list[] = "<a href=\"".get_bloginfo('url').'/'.$val->taxonomy."/".$val->slug."/\">".$val->name."</a>";
					}
				}
			}
			if (isset($list) and count($list) > 0) {
				echo '[<span class="post-cat">'.implode($param, $list).'</span>]';
			}
		}
	}
}



//---------------------------------------------------------------------------
//	カテゴリ/タグにテキストエリアを設置
//---------------------------------------------------------------------------

function getIndexFollow() {

	$index = "index";
	$follow = "follow";

	if (is_home() and get_query_var('paged') > 1) {
		$index = the_keni("snd_page_index");

	} else if (is_singular()) {

		$page_index = get_post_meta(get_the_ID(), 'index');
		if (isset($page_index[0])) {
			$index = $page_index[0];
		}
		$page_follow = get_post_meta(get_the_ID(), 'follow');
		if (isset($page_follow[0])) {
			$follow = $page_follow[0];
		}

	} else if (is_category()) {

		$index_araay = get_post_meta( get_query_var('cat'), "meta_index");
		if (!isset($index_araay[0]) or ($index_araay[0] == "def")) {
			$index_araay[0] = the_keni("list_category_index");
		}

		if ($index_araay[0] == "noindex_p2" and get_query_var('paged') > 1) {
			$index = "noindex";
		} else if ($index_araay[0] == "noindex_p2") {
			$index = "index";
		} else {
			$index = $index_araay[0];
		}

		$follow_araay = get_post_meta( get_query_var('cat'), "meta_follow");
		if (!isset($follow_araay[0]) or ($follow_araay[0] == "def")) {
			$follow = the_keni("list_category_follow");
		} else {
			$follow = $follow_araay[0];
		}

	} else if (is_tag()) {

		$index_array = get_post_meta( get_query_var('tag_id'), "meta_index");
		if (!isset($index_array[0]) or ($index_array[0] == "def")) {
			$index_array[0] = the_keni("list_tag_index");
		}

		if ($index_array[0] == "noindex_p2" and get_query_var('paged') > 1) {
			$index = "noindex";
		} else if ($index_array[0] == "noindex_p2") {
			$index = "index";
		} else {
			$index = $index_array[0];
		}

		$follow_araay = get_post_meta( get_query_var('tag_id'), "meta_follow");
		if (isset($follow_araay[0]) and ($follow_araay[0] != "def")) {
			$follow = $follow_araay[0];
		} else {
			$follow = the_keni("list_tag_follow");
		}

	} else if (is_author()) {

		$author_index = the_keni("list_author_index");
		if ($author_index == "noindex_p2" and get_query_var('paged') > 1) {
			$index = "noindex";
		} else if ($author_index == "noindex_p2") {
			$index = "index";
		} else {
			$index = $author_index;
		}
		$follow = the_keni("list_author_follow");

	} else if (is_search()) {

		$search_index = the_keni("list_search_index");
		if ($search_index == "noindex_p2" and get_query_var('paged') > 1) {
			$index = "noindex";
		} else if ($search_index == "noindex_p2") {
			$index = "index";
		} else {
			$index = $search_index;
		}
		$follow = the_keni("list_search_follow");

	} else if (is_archive()) {

		$archive_inde = the_keni("list_archive_index");
		if ($archive_inde == "noindex_p2" and get_query_var('paged') > 1) {
			$index = "noindex";
		} else if ($archive_inde == "noindex_p2") {
			$index = "index";
		} else {
			$index = $archive_inde;
		}
		$follow = the_keni("list_archive_follow");
	}

	if ($index != "index" || $follow != "follow") {
		return "<meta name=\"robots\" content=\"". $index.",".$follow."\" />\n";
	} else {
		return "";
	}
}



//---------------------------------------------------------------------------
//	カテゴリ/タグにテキストエリアを設置
//---------------------------------------------------------------------------

add_action('category_add_form_fields', 'category_tag_add_form');
add_action('post_tag_add_form_fields', 'category_tag_add_form');

add_action('category_edit_form_fields', 'category_tag_edit_form');
add_action('post_tag_edit_form_fields', 'category_tag_edit_form');

add_action('created_term', 'insert_category_contents');
add_action('edit_term', 'update_category_contents');


function category_tag_add_form(){

	global $layout;
	global $index_menu;
	global $index_list_menu;
	global $follow_menu;
?>
	<div class="form-field">
	<label for="layout">レイアウト</label>
	<select name='layout' id='layout' class='postform' >
	<?php foreach ($layout as $key => $val) {
		if ( $layout_val == $key) { ?>
			<option value="<?php echo $key; ?>" selected="selected"><?php echo $val; ?></option>
<?php } else { ?>
			<option value="<?php echo $key; ?>"><?php echo $val; ?></option>
<?php }
		} ?>
		</select>
	</div>

	<div class="form-field">
	<label for="index">インデックス</label>
	<select name='meta_index' id='meta_index' class='postform' >
	<?php foreach ($index_list_menu as $key => $val) {
		if ( $index == $key) { ?>
			<option value="<?php echo $key; ?>" selected="selected"><?php echo $val; ?></option>
<?php } else { ?>
			<option value="<?php echo $key; ?>"><?php echo $val; ?></option>
<?php }
	} ?>
	</select>
	</div>

	<div class="form-field">
	<label for="follow">フォロー</label>
	<select name='meta_follow' id='meta_follow' class='postform' >
	<?php foreach ($follow_menu as $key => $val) {
		if ( $follow == $key) { ?>
			<option value="<?php echo $key; ?>" selected="selected"><?php echo $val; ?></option>
<?php } else { ?>
			<option value="<?php echo $key; ?>"><?php echo $val; ?></option>
<?php }
	} ?>
	</select>
	</div>

	<div class="form-field">
	<label for="follow">ページ タイトル</label>
	<input type="text" name="title" id="title" class="regular-text postform" value="" />
	</div>

	<div class="form-field">
	<label for="content">ページコンテンツ</label>
	<?php wp_editor('', "content", array('editor_css' => keni_rte_css())); ?>
	</div>
	<?php
}


function category_tag_edit_form(){

	global $tag_ID;
	global $layout;
	global $index_menu;
	global $index_list_menu;
	global $follow_menu;

	// レイアウト
	$layout_araay = get_post_meta( $tag_ID, "layout");
	if (isset($layout_araay[0]) and ($layout_araay[0] != "")) {
		$layout_val = $layout_araay[0];
	}

	// タイトル
	$title_araay = get_post_meta( $tag_ID, "title");
	if (isset($title_araay[0]) and ($title_araay[0] != "")) {
		$title = $title_araay[0];
	}

	// コンテンツ
	$content_araay = get_post_meta( $tag_ID, "content");
	if (isset($content_araay[0]) and ($content_araay[0] != "")) {
		$content = $content_araay[0];
	}

	// インデックス
	$index_araay = get_post_meta( $tag_ID, "meta_index");
	if (isset($index_araay[0]) and ($index_araay[0] != "")) {
		$index = $index_araay[0];
	}

	// follow
	$follow_araay = get_post_meta( $tag_ID, "meta_follow");
	if (isset($follow_araay[0]) and ($follow_araay[0] != "")) {
		$follow = $follow_araay[0];
	}
?>
	<style type="text/css">
		.quicktags-toolbar input { width:auto!important; }
		.wp-editor-area {border: none!important;}
	</style>
	<tr>
		<th scope="row" valign="top">レイアウト</th>
		<td><select name='layout' id='layout' class='postform' >
		<?php foreach ($layout as $key => $val) {
			if ( $layout_val == $key) { ?>
				<option value="<?php echo $key; ?>" selected="selected"><?php echo $val; ?></option>
<?php } else { ?>
				<option value="<?php echo $key; ?>"><?php echo $val; ?></option>
<?php }
		} ?>
		</select></td>
	</tr>

	<tr>
		<th scope="row" valign="top">インデックス</th>
		<td><select name='meta_index' id='meta_index' class='postform' >
		<?php foreach ($index_list_menu as $key => $val) {
			if ( $index == $key) { ?>
				<option value="<?php echo $key; ?>" selected="selected"><?php echo $val; ?></option>
<?php } else { ?>
				<option value="<?php echo $key; ?>"><?php echo $val; ?></option>
<?php }
		} ?>
		</select></td>
	</tr>

	<tr>
		<th scope="row" valign="top">フォロー</th>
		<td><select name='meta_follow' id='meta_follow' class='postform' >
		<?php foreach ($follow_menu as $key => $val) {
			if ( $follow == $key) { ?>
				<option value="<?php echo $key; ?>" selected="selected"><?php echo $val; ?></option>
<?php } else { ?>
				<option value="<?php echo $key; ?>"><?php echo $val; ?></option>
<?php }
		} ?>
		</select></td>
	</tr>

	<tr>
	<th scope="row" valign="top"><label for="content">ページ タイトル</label></th>
	<td><input type="text" name="title" id="title" class="regular-text postform" value="<?php echo $title; ?>" /></td>
	</tr>

	<tr>
	<th scope="row" valign="top"><label for="content">ページコンテンツ</label></th>
	<td><?php wp_editor($content, "content", array('textarea_name' => "content", 'editor_css' => keni_rte_css())); ?></td>
	</tr>
	<?php
}



function keni_rte_css() {
	return '
	<style type="text/css">
		.wp-editor-container .quicktags-toolbar input.ed_button {
			width:auto;
		}
		.html-active .wp-editor-area { border:0;}
	</style>';
}




function insert_category_contents($term_id) {
	if (($term_id > 0) and isset($_POST['taxonomy'])) {
		if (isset($_POST['layout'])) {
			add_metadata('post', $term_id, "layout", $_POST['layout'], true);
		}
		if (get_post_meta( $_POST['tag_ID'], "meta_index") == "") {
			add_metadata('post', $term_id, "meta_index", $_POST['meta_index'], true);
		}
		if (isset($_POST['meta_follow'])) {
			add_metadata('post', $term_id, "meta_follow", $_POST['meta_follow'], true);
		}
		if (isset($_POST['title'])) {
			add_metadata('post', $term_id, "title", $_POST['title'], true);
		}
		if (isset($_POST['content'])) {
			add_metadata('post', $term_id, "content", $_POST['content'], true);
		}
	}
}

function update_category_contents() {

	if (isset($_POST['tag_ID']) and isset($_POST['taxonomy'])) {

		// レイアウト
		$layout_araay = get_post_meta( $_POST['tag_ID'], "layout");
		if (isset($layout_araay[0]) and ($layout_araay[0] != "")) {
			$def_layout_val = $layout_araay[0];
		}

		// タイトル
		$title_araay = get_post_meta( $_POST['tag_ID'], "title");
		if (isset($title_araay[0]) and ($title_araay[0] != "")) {
			$def_title = $title_araay[0];
		}

		// コンテンツ
		$content_araay = get_post_meta( $_POST['tag_ID'], "content");
		if (isset($content_araay[0]) and ($content_araay[0] != "")) {
			$def_content = $content_araay[0];
		}

		// インデックス
		$index_araay = get_post_meta( $_POST['tag_ID'], "meta_index");
		if (isset($index_araay[0]) and ($index_araay[0] != "")) {
			$def_index = $index_araay[0];
		}

		// follow
		$follow_araay = get_post_meta( $_POST['tag_ID'], "meta_follow");
		if (isset($follow_araay[0]) and ($follow_araay[0] != "")) {
			$def_follow = $follow_araay[0];
		}


		if (isset($_POST['layout'])) {
			update_metadata('post', $_POST['tag_ID'], "layout", $_POST['layout'], $def_layout_val);
		}
		if (isset($_POST['meta_index'])) {
			update_metadata('post', $_POST['tag_ID'], "meta_index", $_POST['meta_index'], $def_index);
		}
		if (isset($_POST['meta_follow'])) {
			update_metadata('post', $_POST['tag_ID'], "meta_follow", $_POST['meta_follow'],$def_follow);
		}
		if (isset($_POST['title'])) {
			update_metadata('post', $_POST['tag_ID'], "title", $_POST['title'], $def_title);
		}
		if (isset($_POST['content'])) {
			update_metadata('post', $_POST['tag_ID'], "content", $_POST['content'], $def_content);
		}
	}
}


//---------------------------------------------------------------------------
// 賢威メニューの表示
//---------------------------------------------------------------------------
function keni_admin_menu() {
	add_menu_page( 'システム 設定メニュー', 'システム設定', 'edit_themes', 'keni_admin_menu', 'keni_setting' );
	$list = getKeniSetting();
	if (isset($list) and count($list) > 0) {
		foreach ($list as $no => $list_val) {
			$ks_group = $list_val['ks_group'];
			$keni_list[$ks_group][$no] = $list_val;
		}
		$menu_no = 0;
		foreach ($keni_list as $key => $val) {
			if ($menu_no > 0) {
				add_submenu_page( 'keni_admin_menu', $key, $key, 'edit_themes', 'keni_admin_menu&key='.urlencode($key), ''.$key.'' );
			}
			$menu_no++;
		}
	}
}



//---------------------------------------------------------------------------
// 賢威サポートチームからのお知らせ表示
//---------------------------------------------------------------------------
function add_keni_support_message( $screen_id ) {
    if ( $screen_id == 'dashboard' ) {
        wp_add_dashboard_widget( 'view_message', '賢威サポートチームからのおしらせ', 'view_message');
    }
}
add_action( 'do_meta_boxes', 'add_keni_support_message' );

function view_message() {
	$mon = array("Jan"=>"1", "Feb"=>"2", "Mar"=>"3", "Apr"=>"4", "May"=>"5", "Jun"=>"6", "Jul"=>"7", "Aug"=>"8", "Sep"=>"9", "Oct"=>"10", "Nov"=>"11", "Dec"=>"12");
	$rss = simplexml_load_file("http://www.keni.jp/news.php");
	$no = 0;
	echo "<ul>\n";
	foreach ($rss->channel->item as $item) {
		if ($no < 5) {
			$time = preg_match('/([0-9]{2}) ([A-Z]{1}[a-z]{2}) ([0-9]{4}) ([0-9]{2}):([0-9]{2}):([0-9]{2})/', $item->pubDate, $date);
			$view_date = date("Y年n月j日 H時i分", mktime(($date[4]+9), $date[5], $date[6], $mon[$date[2]], $date[1], $date[3]));
			echo "<li>".$view_date."&nbsp;<a href=\"".$item->link."\" target=\"_blank\">".$item->title."</a></li>\n";
		}
		$no++;
	}
	echo "</ul>\n";
}
/*
 * Custom Post Type Support
 * By default, the plugin only creates AMP content for posts.
 * You can add support for other post_types like so (assume our post_type slug is `xyz-review`):
 */
function nendebcom_amp_add_review_cpt() {
    add_post_type_support( 'page', AMP_QUERY_VAR );
}
add_action( 'amp_init', 'nendebcom_amp_add_review_cpt', 99 );

//---------------------------------------------------------------------------
// 管理画面内だけ管理者用cssを読み込む
//---------------------------------------------------------------------------
function add_keni_admin_css() {

	wp_register_style( 'advanced', get_stylesheet_directory_uri() .'/advanced.css');
	wp_register_style( 'keni_admin_css', get_stylesheet_directory_uri(). '/keni_admin.css');

	wp_enqueue_style('advanced');
	wp_enqueue_style('keni_admin_css');
}
add_action('admin_head','add_keni_admin_css');



// アイキャッチ画像を有効にする。
add_theme_support('post-thumbnails');

/**
 * テンプレートや投稿内に下記コードを挿入
 * exp. [tm_get_posts type="yokohama" cat="news" limit="5"]
*/
function tm_get_posts($atts) {
	global $post;
	$output = "";

	extract(shortcode_atts(array(
		'type' => 'post',
		'cat' => '',
		'limit' => 3,
	), $atts));

	$posts = get_posts(
		array(
			'post_type' => $type,
			$type . '_category' => $cat,
			'posts_per_page' => $limit,
		)
	);

	if ($posts) {
		$output .= '<ul class="school-top-list">'."\n";
		foreach ($posts as $post) {
			$taxonomy = get_post_taxonomies($post);//postのタクソノミーの名前だけ取得
			$terms = get_the_terms($post->ID, $taxonomy[1]);//postのtermを取得
			$slug = $terms[0]->slug;//term内のスラッグ取得
			//echo $slug;
			//サムネイル取得 thumb250
			$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
			$thumb = wp_get_attachment_image_src( $post_thumbnail_id,'thumb250' );
			setup_postdata($post); //ポストデータ取得（excerptとかこの後に回さないと動かない）
			$myExcerpt = str_replace(array("<p>", "</p>"), "", get_the_excerpt());//description取得



			if($slug == 'student'){//スラッグがstudentの場合
				$output .= '<li class="vbox">'
					. '<figure ontouchstart="this.classList.toggle(\'hover\');">'// 不明。
					. '<div class="text-over"><img src="'
					.$thumb[0]
					.'"><p>'
					. '<a href="'.get_permalink().'">' . get_the_title() . '</a></p></div>'
					. '<figcaption class="figcaption"><p><a href="'
					.get_permalink().
					'">'
					.mb_substr($myExcerpt, 0, 60)
					.'…'
					.'</a></p></figcaption></figure>'
					. "</li>\n";


			}elseif($slug == 'news'){//スラッグがnewsの場合
				$output .= '<li class="time_l">'
					.  get_the_date("Y年m月d日") . "</li>"
					. '<li class="time_r"><a href="'.get_permalink().'">' . get_the_title() . "</a>"
					. "</li>\n";

			}elseif($slug == 'blog'){//スラッグがnewsの場合
				$output .= '<li class="time_l">'
					.  get_the_date("Y年m月d日") . "</li>"
					. '<li class="time_r"><a href="'.get_permalink().'">' . get_the_title() . "</a>"
					. "</li>\n";


			}else{//それ以外
				$output .= "<li>"
					. '<a href="'.get_permalink().'">' . get_the_title() . "</a>"
					. "</li>\n";
			}
		}








		$output .= "</ul>\n";
	}
	wp_reset_postdata();
	return $output;
}
add_shortcode('tm_get_posts', 'tm_get_posts');
function sc_post($p_name,$sc_cat,$num){
		$sc='[tm_get_posts type="'.$p_name.'" cat="'.$sc_cat. '" limit='. $num. ']';
		return $sc;
	/*	$sc_blog='[tm_get_posts type="'.$posts[0]->post_name.'" cat="blog" limit="4"]';
		$sc_univ='[tm_get_posts type='.$posts[0]->post_name.' cat="univ" limit="4"]';
		$sc_school='[tm_get_posts type='.$posts[0]->post_name.' cat="school" limit="4"]';
		$sc_voice='[tm_get_posts type='.$posts[0]->post_name.' cat="voice" limit="4"]';
*/
}

$another_db_name = 'aogijuku_picks';
$another_db_user = 'aogijuku';
$another_db_pass = 'g8Wx4HY7';
$another_db_host = 'mysql499.db.sakura.ne.jp';
$another_tb_prefix = 'wp1e775d';

$anoteher_wpdb = new wpdb($another_db_user, $another_db_pass, $another_db_name, $another_db_host);

$anoteher_wpdb->set_prefix($another_tb_prefix);


?>
