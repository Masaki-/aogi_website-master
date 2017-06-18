<?php
/*-------------------------------------------------------
	賢威Ver.6 WP版 賢威の専用データベース
	
	株式会社ウェブライダー

	第1版	2012.3.5	新規作成
-------------------------------------------------------*/
$keni_version = "6.2";


if (!get_option('keni_version') or (get_option('keni_version') < $keni_version)) {
	CreateDB();
}

//---------------------------------------------------------------------
//データベースの初期化
//---------------------------------------------------------------------
function CreateDB() {
	
	global $wpdb;
	global $keni_version;

	$version = get_option("keni_version");
	if (($version != "") and ($version != "6.2")) {
		update_option("keni62_before", $version);
	}
	if (empty($version) or (!preg_match('/^6\.2/', $version))) {
		$keni_version = "6.2";
		update_option("keni_version", $keni_version);
			
	}

		
	$table_alive = $wpdb->get_results("SHOW TABLES LIKE '".KENI_SET."'");
	if (!isset($table_alive) or count($table_alive) <= 0) {
		
		// カテゴリーテーブル
		if ($wpdb->get_var("show tables like '".KENI_SET."'") != KENI_SET) {
			$char = defined("DB_CHARSET") ? DB_CHARSET : "utf8";
			$sql = "CREATE TABLE ".KENI_SET." (
								ks_id tinyint(1) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
								ks_group VARCHAR(32) NOT NULL,
								ks_sys_cont VARCHAR(32) NOT NULL,
								ks_view_cont VARCHAR(32) NOT NULL,
								ks_val TEXT,
								ks_def_val TEXT,
								ks_ext TEXT,
								ks_type ENUM('yn','int','text','textarea','column','meta_index','meta_follow','page2_index','menu','radio','image','include') NOT NULL DEFAULT 'yn',
								ks_active ENUM('y','n') NOT NULL DEFAULT 'y',
								ks_sort tinyint(1) UNSIGNED NOT NULL
							) DEFAULT CHARSET = ".$char.";";
			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
	
	
			$top_image = get_template_directory_uri()."/images/top-image.jpg";
			
			$insert = "INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('サイト内共通', 'mobile_layout', 'レスポンシブWebデザイン', 'y', 'y', 'yn','1')";
			$results = $wpdb->query( $insert );		
	
			$insert = "INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('サイト内共通', 'layout','サイトの基本レイアウト','col2','col2','column','2')";
			$results = $wpdb->query( $insert );
	
			$insert = "INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('サイト内共通', 'view_meta', 'メタキーワード・メタディスクリプションの表示', 'y', 'y', 'yn','3')";
			$results = $wpdb->query( $insert );		
	
			$insert = "INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('サイト内共通', 'keyword', 'サイト共通のメタキーワード<br />（カンマ区切りの文字列）', '', '', 'text','4')";
			$results = $wpdb->query( $insert );		
	
			$insert = "INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('サイト内共通', 'globalmenu','グローバルメニューの選択','0','0','menu','5')";
			$results = $wpdb->query( $insert );
	
			$insert = "INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('サイト内共通', 'view_sub', 'サブコンテンツエリアの表示', 'y', 'y', 'yn','6')";
			$results = $wpdb->query( $insert );
		
			$insert = "INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('サイト内共通', 'view_side', 'サイドバーエリアの表示', 'y', 'y', 'yn','7')";
			$results = $wpdb->query( $insert );
		
			$insert = "INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('トップページ', 'top_layout','トップページのレイアウト','def','def','column','20')";
			$results = $wpdb->query( $insert );
	
			$title = get_bloginfo('name');
	
			$insert = "INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_ext, ks_type, ks_sort) VALUES ('トップページ', 'top_title','トップページのタイトル','".$title."','".$title."','この項目を変更されても、サイトのタイトルは変更されません。<br />TOPページのタイトルのみの変更になります。','text','21')";
			$results = $wpdb->query( $insert );		
	
			$insert = "INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('トップページ', 'top_h1', 'トップページのH1タグ用テキスト', '', '', 'text','22')";
			$results = $wpdb->query( $insert );		
	
			$insert = "INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('トップページ', 'catchcopy','メイン画像のキャッチコピー','愛され続けて20年。\nすべてのお客様にご満足いただくために。','愛され続けて20年。\nすべてのお客様にご満足いただくために。','textarea','23')";
			$results = $wpdb->query( $insert );
	
			$insert = "INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('トップページ', 'mainimage','メイン画像','".$top_image."','".$top_image."','text','24')";
			$results = $wpdb->query( $insert );

			$insert = "INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('トップページ', 'mainimage_alt', 'メイン画像ALTテキスト', '', '', 'text','25')";
			$results = $wpdb->query( $insert );
	
			$insert = "INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('トップページ', 'view_top_sub', 'サブコンテンツエリアの表示', 'y', 'y', 'yn','26')";
			$results = $wpdb->query( $insert );
		
			$insert = "INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('トップページ', 'view_top_side', 'サイドバーエリアの表示', 'y', 'y', 'yn','27')";
			$results = $wpdb->query( $insert );
		
			$insert = "INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('トップページ', 'new_info','新着情報の表示','1','1','pulldown','28')";
			$results = $wpdb->query( $insert );
		
			$insert = "INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('トップページ', 'new_info_rows','新着情報の表示件数','5','5','int','29')";
			$results = $wpdb->query( $insert );

			$insert = "INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('トップページ', 'snd_page_index','2ページ目以降のインデックス','index','index','page2_index','30')";
			$results = $wpdb->query( $insert );
		
	
			$insert = "INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('一覧ページ', 'list_category','カテゴリーページ','def','def','column','40')";
			$results = $wpdb->query( $insert );

			$insert = "INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('一覧ページ', 'list_category_index','インデックス','index','index','meta_index','41')";
			$results = $wpdb->query( $insert );

			$insert = "INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('一覧ページ', 'list_category_follow','フォロー','follow','follow','meta_follow','42')";
			$results = $wpdb->query( $insert );
		
			$insert = "INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('一覧ページ', 'list_archive','アーカイブ（年月日）ページ','def','def','column','43')";
			$results = $wpdb->query( $insert );

			$insert = "INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('一覧ページ', 'list_archive_index','インデックス','index','index','meta_index','44')";
			$results = $wpdb->query( $insert );

			$insert = "INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('一覧ページ', 'list_archive_follow','フォロー','follow','follow','meta_follow','45')";
			$results = $wpdb->query( $insert );
						
			$insert = "INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('一覧ページ', 'list_tag','タグページ','def','def','column','46')";
			$results = $wpdb->query( $insert );

			$insert = "INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('一覧ページ', 'list_tag_index','インデックス','index','index','meta_index','47')";
			$results = $wpdb->query( $insert );
		
			$insert = "INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('一覧ページ', 'list_tag_follow','フォロー','follow','follow','meta_follow','48')";
			$results = $wpdb->query( $insert );
		
			$insert = "INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('一覧ページ', 'list_author','投稿者ページ','def','def','column','49')";
			$results = $wpdb->query( $insert );

			$insert = "INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('一覧ページ', 'list_author_index','インデックス','index','index','meta_index','50')";
			$results = $wpdb->query( $insert );
		
			$insert = "INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('一覧ページ', 'list_author_follow','フォロー','follow','follow','meta_follow','51')";
			$results = $wpdb->query( $insert );
		
			$insert = "INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('一覧ページ', 'list_search','検索結果ページ','def','def','column','52')";
			$results = $wpdb->query( $insert );

			$insert = "INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('一覧ページ', 'list_search_index','インデックス','index','index','meta_index','53')";
			$results = $wpdb->query( $insert );

			$insert = "INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('一覧ページ', 'list_search_follow','フォロー','follow','follow','meta_follow','54')";
			$results = $wpdb->query( $insert );
						
			$insert = "INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('一覧ページ', 'list_404','404エラーページ','def','def','column','55')";
			$results = $wpdb->query( $insert );

			$insert = "INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('フッター', 'footer_left_title', '見出し（左側）', 'アドレス','アドレス', 'text','90')";
			$results = $wpdb->query( $insert );		

			$author_image = get_template_directory_uri()."/images/address-image.gif";
			$insert = "INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('フッター', 'author_image', 'フッター画像', '".$author_image."','".$author_image."', 'text','91')";
			$results = $wpdb->query( $insert );

			$insert = "INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('フッター', 'author_image_alt', 'フッター画像ALTテキスト', '', '', 'text','92')";
			$results = $wpdb->query( $insert );
			
			$insert = "INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('フッター', 'author_info', '自由記述欄（タグ可）', '〒111-1111\n京都府京都市テスト町11-11\n電話番号：075-111-1111　/　FAX：075-111-1111', '〒111-1111\n京都府京都市テスト町11-11\n電話番号：075-111-1111　/　FAX：075-111-1111', 'textarea','93')";
			$results = $wpdb->query( $insert );		
		
			$insert = "INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('フッター', 'footer_right_title', '見出し（右側）', 'メニュー','メニュー', 'text','94')";
			$results = $wpdb->query( $insert );		

			$insert = "INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('フッター', 'footermenu1', 'フッタメニュー１の選択', '0', '0', 'menu','95')";
			$results = $wpdb->query( $insert );
	
			$insert = "INSERT INTO ".KENI_SET." (ks_group, ks_sys_cont, ks_view_cont, ks_val, ks_def_val, ks_type, ks_sort) VALUES ('フッター', 'footermenu2', 'フッタメニュー２の選択', '0', '0', 'menu','96')";
			$results = $wpdb->query( $insert );		

			update_option("keni_version", $keni_version);
		}
	
	
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

			$old_data = $wpdb->get_results("SELECT ks_sys_cont, ks_val FROM ".$table_name);
			foreach ( $old_data as $line) {
				$update = "UPDATE ".KENI_SET." SET ks_val='".$line->ks_val."' WHERE ks_sys_cont='".$line->ks_sys_cont."'";
				$results = $wpdb->query( $update );
			}
		}
	}
}
?>