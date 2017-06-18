<?php
/*----------------------------------------
	賢威6.2

	Twitter Cards タグ出力用モジュール
	
	第1版（賢威6.2）　2014. 3.14

	株式会社 ウェブライダー
----------------------------------------*/
global $wpdb;
$res = $wpdb->get_results("SELECT ks_id, ks_sys_cont, ks_val FROM ".KENI_SET." WHERE ks_group='Twitterカード' AND ks_active='y'");
foreach ($res as $tw) {
	$key = $tw->ks_sys_cont;
	$twitter[$key] = $tw->ks_val;
}

$image_url = get_template_directory_uri().'/ogp.jpg';

if (!isset($twitter)) {	// 新規登録
	$res = $wpdb->get_var($wpdb->prepare("SELECT ks_id FROM ".KENI_SET." WHERE ks_sys_cont=%s AND ks_active='y'", 'tw_view'));
	if (!preg_match("/^[0-9]+$/",$res) or ($res <= 0)) {
		$results = $wpdb->query("INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('Twitterカード', 'tw_view','タグの出力','n','n','yn','75')");
	}

	$res = $wpdb->get_var($wpdb->prepare("SELECT ks_id FROM ".KENI_SET." WHERE ks_sys_cont=%s AND ks_active='y'", 'tw_type'));
	if (!preg_match("/^[0-9]+$/",$res) or ($res <= 0)) {
		$results = $wpdb->query("INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_ext, ks_type, ks_sort) VALUES ('Twitterカード', 'tw_type','種類','Summary Card','Summary Card','','text','76')");
	}

	$res = $wpdb->get_var($wpdb->prepare("SELECT ks_id FROM ".KENI_SET." WHERE ks_sys_cont=%s AND ks_active='y'", 'tw_screen_name'));
	if (!preg_match("/^[0-9]+$/",$res) or ($res <= 0)) {
		$results = $wpdb->query("INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('Twitterカード', 'tw_screen_name','アカウント名','','twitterのアカウント名を入力して下さい（任意）','text','77')");
	}

	$res = $wpdb->get_var($wpdb->prepare("SELECT ks_id FROM ".KENI_SET." WHERE ks_sys_cont=%s AND ks_active='y'", 'tw_image'));
	if (!preg_match("/^[0-9]+$/",$res) or ($res <= 0)) {
		$results = $wpdb->query("INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('Twitterカード', 'tw_image','標準画像','".$image_url."','".$image_url."','text','78')");
	}
}

$tw_type = array("Summary Card", "Summary Card with Large Image");
	


function tw_cards_keni() {

	global $twitter;

	if (($twitter['tw_view'] == "y") and have_posts()) {
	
		switch ($twitter['tw_type']) {

			case "Summary Card":

				echo "\n<!--Twitterカード-->\n";
				echo "<meta name=\"twitter:card\" content=\"summary\" />\n";
				if ($twitter['tw_screen_name'] != "") {
					echo "<meta name=\"twitter:site\" content=\"@".str_replace("@","",$twitter['tw_screen_name'])."\" />\n";
				}

				if (is_category() or is_tag() or is_archive() or is_search()) {

					echo "<meta name=\"twitter:title\" content=\"".get_archive_title_keni()."\" />\n";
					echo "<meta name=\"twitter:description\" content=\"".esc_html(get_description_keni())."\" />\n";
					echo "<meta name=\"twitter:image:src\" content=\"".$twitter['tw_image']."\" />\n";

				} else {

					$page_ogp_title = get_post_meta(get_the_ID(),'page_ogp_title');
					if (isset($page_ogp_title[0]) and ($page_ogp_title[0] != "")) {
						echo "<meta name=\"twitter:title\" content=\"".$page_ogp_title[0]."\" />\n";
					} else {
						echo "<meta name=\"twitter:title\" content=\"".get_title_keni()."\" />\n";
					}
	
					$page_ogp_description = get_post_meta(get_the_ID(),'page_ogp_description');
					if (isset($page_ogp_description[0]) and ($page_ogp_description[0] != "")) {
						echo "<meta name=\"twitter:description\" content=\"".$page_ogp_description[0]."\" />\n";
					} else {
						echo "<meta name=\"twitter:description\" content=\"".get_description_keni()."\" />\n";
					}
	
					$image_id = get_post_thumbnail_id(get_the_ID());
					if (ereg("^[0-9]+$",$image_id) and ($image_id > 0)) {
						$image = wp_get_attachment_image_src( $image_id, 'full');
						if (isset($image[0])) {
							echo "<meta name=\"twitter:image\" content=\"".$image[0]."\" />\n";
						} else {
							echo "<meta name=\"twitter:image\" content=\"".$twitter['tw_image']."\" />\n";
						}
					} else {
						echo "<meta name=\"twitter:image\" content=\"".$twitter['tw_image']."\" />\n";
					}
				}
				echo "<!--Twitterカード-->\n\n";			
				break;


			case "Summary Card with Large Image":
	
				echo "\n<!--Twitterカード-->\n";			
				echo "<meta name=\"twitter:card\" content=\"summary_large_image\" />\n";
				if ($twitter['tw_screen_name'] != "") {
					echo "<meta name=\"twitter:site\" content=\"@".str_replace("@","",$twitter['tw_screen_name'])."\" />\n";
				}


				if (is_category() or is_tag() or is_archive() or is_search()) {

					echo "<meta name=\"twitter:title\" content=\"".get_archive_title_keni()."\" />\n";
					echo "<meta name=\"twitter:description\" content=\"".esc_html(get_description_keni())."\" />\n";
					echo "<meta name=\"twitter:image:src\" content=\"".$twitter['tw_image']."\" />\n";

				} else {
					$page_ogp_title = get_post_meta(get_the_ID(),'page_ogp_title');
					if (isset($page_ogp_title[0]) and ($page_ogp_title[0] != "")) {
						echo "<meta name=\"twitter:title\" content=\"".$page_ogp_title[0]."\" />\n";
					} else {
						echo "<meta name=\"twitter:title\" content=\"".get_title_keni()."\" />\n";
					}
	
					$page_ogp_description = get_post_meta(get_the_ID(),'page_ogp_description');
					if (isset($page_ogp_description[0]) and ($page_ogp_description[0] != "")) {
						echo "<meta name=\"twitter:description\" content=\"".$page_ogp_description[0]."\" />\n";
					} else {
						echo "<meta name=\"twitter:description\" content=\"".get_description_keni()."\" />\n";
					}
	
					
					$image_id = get_post_thumbnail_id(get_the_ID());
					if (ereg("^[0-9]+$",$image_id) and ($image_id > 0)) {
						$image = wp_get_attachment_image_src( $image_id, 'full');
						if (isset($image[0])) {
							echo "<meta name=\"twitter:image:src\" content=\"".$image[0]."\" />\n";
						} else {
							echo "<meta name=\"twitter:image:src\" content=\"".$twitter['tw_image']."\" />\n";
						}
					} else {
						echo "<meta name=\"twitter:image:src\" content=\"".$twitter['tw_image']."\" />\n";
					}
				}
				echo "<!--Twitterカード-->\n\n";			
				break;
		}
	}
}

?>