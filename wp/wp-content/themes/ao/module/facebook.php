<?php
/*----------------------------------------
	賢威6.2

	facebook OGP出力用モジュール
	
	第1版（賢威6.0）　2012.12.14
	第2版（賢威6.1）　2013. 6.20
	第2版（賢威6.2）　2014. 6.02

	WEBライダー
----------------------------------------*/
global $wpdb;

$res = $wpdb->get_results("SELECT ks_id, ks_sys_cont, ks_val FROM ".KENI_SET." WHERE ks_group='Facebook' AND ks_active='y'");
foreach ($res as $fb) {
	$key = $fb->ks_sys_cont;
	$facebook[$key] = $fb->ks_val;
}



if (!isset($facebook)) {	// 新規登録

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

		$old_data = $wpdb->get_results("SELECT ks_sys_cont, ks_val FROM ".$table_name ." WHERE ks_group='Facebook'");
		foreach ($old_data as $cont) {
			$list[$cont->ks_sys_cont] = $cont->ks_val;
		}			
	}


	$res = $wpdb->get_var($wpdb->prepare("SELECT ks_id FROM ".KENI_SET." WHERE ks_sys_cont=%s AND ks_active='y'", 'fb_view'));
	if (!preg_match("/^[0-9]+$/",$res) or ($res <= 0)) {
		if (isset($list['fb_view'])) {
			$val = $list['fb_view'];
		} else {
			$val = 'n';
		}
		$results = $wpdb->query("INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('Facebook', 'fb_view','タグの出力','".$val."','n','yn','60')");
	}

	$res = $wpdb->get_var($wpdb->prepare("SELECT ks_id FROM ".KENI_SET." WHERE ks_sys_cont=%s AND ks_active='y'", 'fb_app_id'));
	if (!preg_match("/^[0-9]+$/",$res) or ($res <= 0)) {
		if (isset($list['fb_app_id'])) {
			$val = $list['fb_app_id'];
		} else {
			$val = '';
		}
		$results = $wpdb->query("INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('Facebook', 'fb_app_id','App ID','".$val."','','text','61')");
	}

	$res = $wpdb->get_var($wpdb->prepare("SELECT ks_id FROM ".KENI_SET." WHERE ks_sys_cont=%s AND ks_active='y'", 'fb_admins'));
	if (!preg_match("/^[0-9]+$/",$res) or ($res <= 0)) {
		if (isset($list['fb_admins'])) {
			$val = $list['fb_admins'];
		} else {
			$val = '';
		}
		$results = $wpdb->query("INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('Facebook', 'fb_admins','管理者ID<br />（カンマ区切りで入力して下さい）','".$val."','','text','62')");
	}

	$res = $wpdb->get_var($wpdb->prepare("SELECT ks_id FROM ".KENI_SET." WHERE ks_sys_cont=%s AND ks_active='y'", 'fb_type'));
	if (!preg_match("/^[0-9]+$/",$res) or ($res <= 0)) {
		if (isset($list['fb_type'])) {
			$val = $list['fb_type'];
		} else {
			$val = 'blog';
		}
		$results = $wpdb->query("INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('Facebook', 'fb_type','サイトタイプ','".$val."','blog','text','63')");
	}

	$res = $wpdb->get_var($wpdb->prepare("SELECT ks_id FROM ".KENI_SET." WHERE ks_sys_cont=%s AND ks_active='y'", 'fb_lang'));
	if (!preg_match("/^[0-9]+$/",$res) or ($res <= 0)) {
		if (isset($list['fb_lang'])) {
			$val = $list['fb_lang'];
		} else {
			$val = 'ja_JP';
		}
		$results = $wpdb->query("INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('Facebook', 'fb_lang','言語','".$val."','ja_JP','text','64')");
	}

	$image_url = get_template_directory_uri().'/ogp.jpg';
	$res = $wpdb->get_var($wpdb->prepare("SELECT ks_id FROM ".KENI_SET." WHERE ks_sys_cont=%s AND ks_active='y'", 'fb_ogpimage'));
	if (!preg_match("/^[0-9]+$/",$res) or ($res <= 0)) {
		if (isset($list['fb_ogpimage'])) {
			$val = $list['fb_ogpimage'];
		} else {
			$val = $image_url;
		}
		$results = $wpdb->query("INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('Facebook', 'fb_ogpimage','標準画像','".$val."','".$image_url."','text','65')");
	}
}

// サイトの種類
$app_type = array("blog" => "blog",
									"website" => "website",
									"other" => "other");


if (mb_ereg("/wp-admin/", $_SERVER['REQUEST_URI']) and isset($_GET['key']) and ($_GET['key'] == "facebook")) {
	if (isset($_POST) and (isset($_POST['submit']) or isset($_POST['submit_x']))) {

		$first_key = key($_POST['setting']);
		$fb_app_id = $_POST['setting'][$first_key];
		if ($fb_app_id == "") {
			$fb_app_id = (string)"";
		}
	}
}


/* ------------------------------------------
	facebook タグを出力する関数
 ------------------------------------------*/
function facebook_keni() {

	global $facebook;

	if (($facebook['fb_view'] == "y") and have_posts()) {

		if ( isset($_SERVER['HTTPS']) and $_SERVER['HTTPS'] == 'on' ) {  
	    $protocol = 'https://';  
		} else {
	    $protocol = 'http://';  
		}

		echo "\n<!--OGP-->\n";

		if (is_front_page() && !get_query_var('paged')){
			echo "<meta property=\"og:type\" content=\"".$facebook['fb_type']."\" />\n";
		} else {
			echo "<meta property=\"og:type\" content=\"article\" />\n";
		}

		if (is_front_page()) {
			echo "<meta property=\"og:url\" content=\"".get_bloginfo('url')."\" />\n";
			echo "<meta property=\"og:title\" content=\"".esc_html(get_title_keni())."\" />\n";
			echo "<meta property=\"og:description\" content=\"".esc_html(get_description_keni())."\" />\n";


		} else if (is_home() and get_option('page_for_posts') > 1) {
			$post_canonical_array = get_post_meta(get_option('page_for_posts'),'page_canonical');
			if (isset($post_canonical_array[0]) and ($post_canonical_array[0] != "")) {
				echo "<meta property=\"og:url\" content=\"".$post_canonical_array[0]."\" />\n";
			} else {
				echo "<meta property=\"og:url\" content=\"".$protocol.$_SERVER['HTTP_HOST'].htmlspecialchars($_SERVER['REQUEST_URI'])."\" />\n";
			}

			$page_ogp_title = get_post_meta(get_option('page_for_posts'),'page_ogp_title');
			if (isset($page_ogp_title[0]) and ($page_ogp_title[0] != "") and (the_keni('fb_view') == "y")) {
				echo "<meta property=\"og:title\" content=\"".esc_html($page_ogp_title[0])."\" />\n";
			} else {
				echo "<meta property=\"og:title\" content=\"".esc_html(get_title_keni())."\" />\n";
			}

			$page_ogp_description = get_post_meta(get_option('page_for_posts'),'page_ogp_description');
			if (isset($page_ogp_description[0]) and ($page_ogp_description[0] != "")) {
				echo "<meta property=\"og:description\" content=\"".esc_html($page_ogp_description[0])."\" />\n";
	
			} else {
				echo "<meta property=\"og:description\" content=\"".esc_html(get_description_keni())."\" />\n";
			}

		} else if (is_category() or is_tag() or is_archive() or is_search()) {

			echo "<meta property=\"og:url\" content=\"".$protocol.$_SERVER['HTTP_HOST'].htmlspecialchars($_SERVER['REQUEST_URI'])."\" />\n";
			echo "<meta property=\"og:title\" content=\"".esc_html(get_archive_title_keni())."\" />\n";
			echo "<meta property=\"og:description\" content=\"".esc_html(get_description_keni())."\" />\n";

		} else {

			$post_canonical_array = get_post_meta(get_the_ID(),'page_canonical');
			if (isset($post_canonical_array[0]) and ($post_canonical_array[0] != "")) {
				echo "<meta property=\"og:url\" content=\"".$post_canonical_array[0]."\" />\n";
			} else {
				echo "<meta property=\"og:url\" content=\"".$protocol.$_SERVER['HTTP_HOST'].htmlspecialchars($_SERVER['REQUEST_URI'])."\" />\n";
			}

			$page_ogp_title = get_post_meta(get_the_ID(),'page_ogp_title');
			if (isset($page_ogp_title[0]) and ($page_ogp_title[0] != "") and (the_keni('fb_view') == "y")) {
				echo "<meta property=\"og:title\" content=\"".esc_html($page_ogp_title[0])."\" />\n";
			} else {
				echo "<meta property=\"og:title\" content=\"".esc_html(get_title_keni())."\" />\n";
			}

			$page_ogp_description = get_post_meta(get_the_ID(),'page_ogp_description');
			if (isset($page_ogp_description[0]) and ($page_ogp_description[0] != "")) {
				echo "<meta property=\"og:description\" content=\"".esc_html($page_ogp_description[0])."\" />\n";
	
			} else {
				echo "<meta property=\"og:description\" content=\"".esc_html(get_description_keni())."\" />\n";
			}

		}


		echo "<meta property=\"og:site_name\" content=\"".esc_html(get_bloginfo('name'))."\" />\n";

		if (is_front_page() && !get_query_var('paged')){
			echo "<meta property=\"og:image\" content=\"".$facebook['fb_ogpimage']."\" />\n";
		} else {
			if (is_singular()) {
				$image_id = get_post_thumbnail_id(get_the_ID());
				if (ereg("^[0-9]+$",$image_id) and ($image_id > 0)) {
					$image = wp_get_attachment_image_src( $image_id, 'full');
					if (isset($image[0])) {
						echo "<meta property=\"og:image\" content=\"".$image[0]."\" />\n";
					}
				} else {
					$post_data = get_posts();
					foreach ($post_data as $post_lines) {
						if ($post_lines->ID == get_the_ID()) {
							$str = $post_lines->post_content;
							$searchPattern = '/<img.*?src=(["\'])(.+?)\1.*?>/i';
							if ( preg_match( $searchPattern, $str, $imgurl )) {
								echo "<meta property=\"og:image\" content=\"".$imgurl[2]."\" />\n";
							}
						}
					}
				}
			}
			echo "<meta property=\"og:image\" content=\"".$facebook['fb_ogpimage']."\" />\n";
		}

		if ($facebook['fb_app_id'] != "") {
			echo "<meta property=\"fb:app_id\" content=\"".$facebook['fb_app_id']."\" />\n";
		}

		if ($facebook['fb_admins'] != "") {
			echo "<meta property=\"fb:admins\" content=\"".$facebook['fb_admins']."\" />\n";
		}
		
		echo "<meta property=\"og:locale\" content=\"".$facebook['fb_lang']."\" />\n";

		echo "<!--OGP-->\n";
	} else {
		echo "";
	}
}



//---------------------------------------------------------------------------
//	管理画面上での個別title/descriptionの指定
//---------------------------------------------------------------------------


if (the_keni('fb_view') == "y") {
	add_action('admin_menu', 'add_ogp_box');
	add_action('save_post', 'save_ogp_string');
}

function add_ogp_box() {	
	add_meta_box('ogp', 'OGP・Microdata・Twitterカードの個別設定', 'ogp_setting', 'post', 'normal');
	add_meta_box('ogp', 'OGP・Microdata・Twitterカードの個別設定', 'ogp_setting', 'page', 'normal');
}

function ogp_setting() {
	if (isset($_GET['post'])) {
		$page_ogp_title_array = get_post_meta( $_GET['post'], 'page_ogp_title');
		if (isset($page_ogp_title_array[0])) {
			$page_ogp_title = $page_ogp_title_array[0];
		} else {
			$page_ogp_title = "";
		}

		$page_ogp_description_array = get_post_meta( $_GET['post'], 'page_ogp_description');
		if (isset($page_ogp_description_array[0])) {
			$page_ogp_description = $page_ogp_description_array[0];
		} else {
			$page_ogp_description = "";
		}
	} else {
		$page_ogp_title = "";
		$page_ogp_description = "";
	}

	echo "<table>\n<tbody>\n";
	echo "<tr>\n<th>タイトル</th>\n<td class=\"keni_ogp_title\"><input type=\"text\" name=\"page_ogp_title\" value=\"".htmlspecialchars($page_ogp_title)."\" size=\"64\" maxlength=\"64\" /></td>\n</tr>\n";
	echo "<tr>\n<th>ディスクリプション</th>\n<td class=\"keni_ogp_description\"><input type=\"text\" name=\"page_ogp_description\" value=\"".htmlspecialchars($page_ogp_description)."\" size=\"64\" maxlength=\"64\" /></td>\n</tr>\n";
	echo "</tbody>\n</table>\n";
}

function save_ogp_string($post_id) {
	if (isset($_POST['page_ogp_title'])) {
		$change_ogp_title = $_POST['page_ogp_title'];
		if (get_post_meta( $post_id, 'page_ogp_title') == "") {
			add_post_meta( $post_id, 'page_ogp_title', $change_ogp_title, true);
		} else {
			update_post_meta( $post_id, 'page_ogp_title', $change_ogp_title);
		}

		$change_ogp_description = $_POST['page_ogp_description'];
		if (get_post_meta( $post_id, 'page_ogp_description') == "") {
			add_post_meta( $post_id, 'page_ogp_description', $change_ogp_description, true);
		} else {
			update_post_meta( $post_id, 'page_ogp_description', $change_ogp_description);
		}
	}
}



?>