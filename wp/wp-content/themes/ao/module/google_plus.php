<?php
/*----------------------------------------
	賢威6.1

	Google+ タグ出力用モジュール
	
	第1版（賢威6.0）　2012.12.14
	第2版（賢威6.1）　2013. 6.20

	WEBライダー
----------------------------------------*/
global $wpdb;
$res = $wpdb->get_results("SELECT ks_id, ks_sys_cont, ks_val FROM ".KENI_SET." WHERE ks_group='Google＋' AND ks_active='y'");
foreach ($res as $fb) {
	$key = $fb->ks_sys_cont;
	$google_plus[$key] = $fb->ks_val;
}

if (!isset($google_plus)) {	// 新規登録

	// 過去のテーブルが存在するかどうかを確認
	$before_version = get_option("keni62_before");

	if (!empty($before_version)) {
		switch ($before_version) {
			case "6.1":
				$table_name = $wpdb->prefix."keni_setting61";
				break;
			case "6.0":
				$table_name = $wpdb->prefix."keni_setting";
				break;
		}

		$old_data = $wpdb->get_results("SELECT ks_sys_cont, ks_val FROM ".$table_name ." WHERE ks_group='Google＋'");
		foreach ($old_data as $cont) {
			$list[$cont->ks_sys_cont] = $cont->ks_val;
		}			
	}

	$res = $wpdb->get_var($wpdb->prepare("SELECT ks_id FROM ".KENI_SET." WHERE ks_sys_cont=%s AND ks_active='y'", 'gp_view'));
	if (!preg_match("/^[0-9]+$/",$res) or ($res <= 0)) {
		if (isset($list['gp_view'])) {
			$val = $list['gp_view'];
		} else {
			$val = 'n';
		}
		$results = $wpdb->query("INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('Google＋', 'gp_view','タグの出力','".$val."','n','yn','70')");
	}

	$image_url = get_template_directory_uri()."/ogp.jpg";

	$res = $wpdb->get_var($wpdb->prepare("SELECT ks_id FROM ".KENI_SET." WHERE ks_sys_cont=%s AND ks_active='y'", 'gp_image'));
	if (!preg_match("/^[0-9]+$/",$res) or ($res <= 0)) {
		if (isset($list['gp_image'])) {
			$val = $list['gp_image'];
		} else {
			$val = $image_url;
		}
		$results = $wpdb->query("INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('Google＋', 'gp_image','標準画像','".$val."','".$image_url."','text','71')");
	}
}


/* ------------------------------------------
	google+ タグを出力する関数
 ------------------------------------------*/
function google_plus_keni() {

	global $google_plus;

	if (($google_plus['gp_view'] == "y") and have_posts()) {

		echo "\n<!--microdata-->\n";

		if (is_front_page()){
			echo "<meta itemprop=\"name\" content=\"".esc_html(get_title_keni())."\" />\n";
			echo "<meta itemprop=\"description\" content=\"".esc_html(get_description_keni())."\" />\n";
			echo "<meta itemprop=\"image\" content=\"".$google_plus['gp_image']."\" />\n";

		} else if (is_home() and get_option('page_for_posts') > 1) {

			$page_ogp_title = get_post_meta(get_option('page_for_posts'),'page_ogp_title');
			if (isset($page_ogp_title[0]) and ($page_ogp_title[0] != "") and (the_keni('gp_view') == "y")) {
				echo "<meta itemprop=\"name\" content=\"".esc_html($page_ogp_title[0])."\" />\n";
			} else {
				echo "<meta itemprop=\"name\" content=\"".esc_html(get_title_keni())."\" />\n";
			}

			$page_ogp_description = get_post_meta(get_option('page_for_posts'),'page_ogp_description');
			if (isset($page_ogp_description[0]) and ($page_ogp_description[0] != "")) {
				echo "<meta itemprop=\"description\" content=\"".esc_html($page_ogp_description[0])."\" />\n";
			} else {
				echo "<meta itemprop=\"description\" content=\"".esc_html(get_description_keni())."\" />\n";
			}

			$image_id = get_post_thumbnail_id(get_option('page_for_posts'));
			$image = wp_get_attachment_image_src( $image_id, 'full');
			if (isset($image[0])) {
				echo "<meta itemprop=\"image\" content=\"".$image[0]."\" />\n";
			}
			echo "<meta itemprop=\"image\" content=\"".$google_plus['gp_image']."\" />\n";


		} else if (is_category() or is_tag() or is_archive() or is_search()) {

			if ( isset($_SERVER['HTTPS']) and $_SERVER['HTTPS'] == 'on' ) {  
				$protocol = 'https://';  
			} else {
				$protocol = 'http://';  
			}

			echo "<meta itemprop=\"name\" content=\"".esc_html(get_title_keni())."\" />\n";
			echo "<meta itemprop=\"description\" content=\"".esc_html(get_description_keni())."\" />\n";
			echo "<meta itemprop=\"image\" content=\"".$google_plus['gp_image']."\" />\n";


		} else if (is_singular()) {

			$page_ogp_title = get_post_meta(get_the_ID(),'page_ogp_title');
			if (isset($page_ogp_title[0]) and ($page_ogp_title[0] != "") and (the_keni('gp_view') == "y")) {
				echo "<meta itemprop=\"name\" content=\"".esc_html($page_ogp_title[0])."\" />\n";
			} else {
				echo "<meta itemprop=\"name\" content=\"".esc_html(get_title_keni())."\" />\n";
			}

			$page_ogp_description = get_post_meta(get_the_ID(),'page_ogp_description');
			if (isset($page_ogp_description[0]) and ($page_ogp_description[0] != "")) {
				echo "<meta itemprop=\"description\" content=\"".esc_html($page_ogp_description[0])."\" />\n";
			} else {
				echo "<meta itemprop=\"description\" content=\"".esc_html(get_description_keni())."\" />\n";
			}

			$image_id = get_post_thumbnail_id(get_the_ID());
			if (ereg("^[0-9]+$",$image_id) and ($image_id > 0)) {
				$image = wp_get_attachment_image_src( $image_id, 'full');
				if (isset($image[0])) {
					echo "<meta itemprop=\"image\" content=\"".$image[0]."\" />\n";
				}
			} else {
				$post_data = get_posts();
				foreach ($post_data as $post_lines) {
					if ($post_lines->ID == get_the_ID()) {
						$str = $post_lines->post_content;
						$searchPattern = '/<img.*?src=(["\'])(.+?)\1.*?>/i';
						if ( preg_match( $searchPattern, $str, $imgurl )) {
							echo "<meta itemprop=\"image\" content=\"".$imgurl[2]."\" />\n";
						}
					}
				}
			}

		} else {
			echo "<meta itemprop=\"image\" content=\"".$google_plus['gp_image']."\" />\n";
		}

		echo "<!--microdata-->\n";
	}
}



function gp_check() {
	global $google_plus;
	if ($google_plus['gp_view'] == "y") {
		return true;
	} else {
		return false;
	}
}



//---------------------------------------------------------------------------
//	管理画面上での個別title/descriptionの指定
//---------------------------------------------------------------------------

if (the_keni('fb_view') == "n" && the_keni('gp_view') == "y") {
	add_action('admin_menu', 'add_ogp_box');
	add_action('save_post', 'save_ogp_string');
}


?>