<?php
/*----------------------------------------
	賢威6.2

	賢威の基本設定メニュー
	
	第1版（賢威6.2）　2014. 5.9

	株式会社 ウェブライダー
----------------------------------------*/
global $wpdb;

if (isset($_POST) and (isset($_POST['submit']) or isset($_POST['submit_x']))) {

	// データベースを更新する為のデータを生成し、updateする
	foreach ($_POST['setting'] as $key => $val) {
		$data['ks_val'] = stripslashes($val);
		$where['ks_id'] = $key;
		
		$wpdb->update(KENI_SET, $data, $where);		
	}

	// タイトルとディスクリプションのアップデート
	if (isset($_POST['blogname'])) {
		update_option('blogname', stripslashes($_POST['blogname']));
	}
	if (isset($_POST['blogdescription'])) {
		update_option('blogdescription', stripslashes($_POST['blogdescription']));
	}

}

$list = getKeniSetting();
if (isset($list) and count($list) > 0) {
	foreach ($list as $no => $list_val) {
		$ks_group = $list_val['ks_group'];
		$keni_list[$ks_group][$no] = $list_val;
	}
}


if (isset($keni_list) and count($keni_list) > 0) {
	// 最初のキーを取得
	$key_first = key($keni_list);
	
	// 項目を取得
	if (isset($_GET['key']) and ($_GET['key'] != "")) {
		$_GET['key'] = urldecode($_GET['key']);
		
		if (isset($keni_list[$_GET['key']])) {
			$view_list = $keni_list[$_GET['key']];
		}
	}	
	
	if (!isset($view_list)) {
		$view_list = $keni_list[$key_first];
		$_GET['key'] = $key_first;
	}
}

// カスタムニューのリストを取得
$menu_list = get_menu_list();

global $layout;
if (isset($_GET['key'])) {
	if ($_GET['key'] != "トップページ" && $_GET['key'] != "一覧ページ") {
		unset($layout['def']);
	}
}

// index, follow のリストを取得
global $index_area;
global $index_list_menu;


// new_infoの設定リスト
$new_info = array("0" => "表示しない",
									"1" => "タイプ１",
									"2" => "タイプ２"
									);


if (isset($view_list)) { ?>

	<div class="wrap">

	<div id="icon-options-general" class="icon32"><br /></div><h2><?php echo $_GET['key']; ?>の設定</h2>

	<?php if ($_GET['key'] == "サイト内共通") { ?>
	<p>サイト全体の「<?php echo $_GET['key']; ?>」を変更できます。</p>
	<?php } else { ?>
	<p>「<?php echo $_GET['key']; ?>」を変更できます。</p>
	<?php } ?>

<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
	<?php wp_nonce_field('update-options');

	if ($_GET['key'] == "一覧ページ") {

		$now_count = 0;
		foreach ($view_list as $no => $val) {
			if ($now_count%3 == 0) {
				echo "<h3>".$val['ks_view_cont']."</h3>\n";
				echo "<table class=\"form-table\">\n";
				echo "<tbody>\n";
				echo "<tr>\n";
				echo "<th>レイアウト</th>\n";

			} else {
				echo "<tr>\n";
				echo "<th>".$val['ks_view_cont']."</th>\n";
			}

			echo "<td>";


			if ($val['ks_type'] == "column") {
				echo "<select name=\"setting[".$no."]\">\n";
				foreach ($layout as $type => $name) {
					if ($type == $val['ks_val']) {
						echo "<option value=\"".$type."\" selected=\"selected\" />".$name."\n";
					} else {
						echo "<option value=\"".$type."\" />".$name."\n";
					}
				}
				echo "</select>";
	
			} else if ($val['ks_type'] == "meta_index") {
				unset($index_list_menu['def']);
				echo "<select name=\"setting[".$no."]\">\n";
				foreach ($index_list_menu as $type => $name) {
					if ($type == $val['ks_val']) {
						echo "<option value=\"".$type."\" selected=\"selected\" />".$name."\n";
					} else {
						echo "<option value=\"".$type."\" />".$name."\n";
					}
				}
				echo "</select>";
	
			} else if ($val['ks_type'] == "meta_follow") {
				echo "<select name=\"setting[".$no."]\">\n";
				foreach ($index_area['follow'] as $type => $name) {
					if ($type == $val['ks_val']) {
						echo "<option value=\"".$type."\" selected=\"selected\" />".$name."\n";
					} else {
						echo "<option value=\"".$type."\" />".$name."\n";
					}
				}
				echo "</select>";
			}

			echo "</td>\n";
			echo "</tr>\n";

			if ($now_count%3 == 2) {
				echo "</tbody>\n";
				echo "</table>\n";
			}
	
			$now_count++;
		}

		echo "</tbody>\n";
		echo "</table>\n";

 } else { ?>

	<table class="form-table">
		<tbody>

<?php if (($key_first == $_GET['key']) or !isset($_GET['key']) ) { ?>
		<tr valign="top">
		<th scope="row"><label for="blogname">サイトのタイトル</label></th>
		<td><input name="blogname" type="text" id="blogname" value="<?php bloginfo('name'); ?>" class="regular-text" /></td>
		</tr>
		<tr valign="top">
		<th scope="row"><label for="blogdescription">サイトの簡単な説明</label></th>
		<td><input name="blogdescription" type="text" id="blogdescription" value="<?php bloginfo('description'); ?>" class="regular-text" />
		<p class="description">このサイトの簡単な説明。メタディスクリプションなどに使用します</p></td>
		</tr>
<?php 
	}

foreach ($view_list as $no => $val) {

	if ($val['ks_group'] != "一覧ページ") { ?>
	<tr valign="top">
	<th scope="row"><?php echo $val['ks_view_cont']; ?></th>
<?php } ?>
		<td><?php
		if ($val['ks_type'] == "menu") {
			if (preg_match('/^footermenu/', $val['ks_sys_cont'])) {
				unset($menu_list['-1']);
			}
			echo "<select name=\"setting[".$no."]\">\n";
			foreach ($menu_list as $term_id => $name) {
				if ($term_id == $val['ks_val']) {
					echo "<option value=\"".$term_id."\" selected=\"selected\" />".$name."\n";
				} else {
					echo "<option value=\"".$term_id."\" />".$name."\n";
				}
			}
			echo "</select>";

		} else if ($val['ks_type'] == "column") {
			echo "<select name=\"setting[".$no."]\">\n";
			foreach ($layout as $type => $name) {
				if ($type == $val['ks_val']) {
					echo "<option value=\"".$type."\" selected=\"selected\" />".$name."\n";
				} else {
					echo "<option value=\"".$type."\" />".$name."\n";
				}
			}
			echo "</select>";


		} else if ($val['ks_type'] == "page2_index") {
			if ($val['ks_val'] == "index") { ?>
				<label><input type="radio" name="setting[<?php echo $no ?>]" value="index" checked="checked" />する</label>
				<label><input type="radio" name="setting[<?php echo $no ?>]" value="noindex" />しない</label>
<?php } else { ?>
				<label><input type="radio" name="setting[<?php echo $no ?>]" value="index" />する</label>
				<label><input type="radio" name="setting[<?php echo $no ?>]" value="noindex" checked="checked" />しない</label>
<?php	}
		} else if ($val['ks_sys_cont'] == "new_info") { 
			$last_type = end($new_info);
			$res = "";
			foreach ($new_info as $type => $view) {
				if ($type == $val['ks_val']) {
					$res .= "<label for=\"setting_".$no."_".$type."\"><input type=\"radio\" name=\"setting[".$no."]\" value=\"".$type."\" id=\"setting_".$no."_".$type."\" checked=\"checked\" >&nbsp;".$view."</label>";
				} else {
					$res .= "<label for=\"setting_".$no."_".$type."\"><input type=\"radio\" name=\"setting[".$no."]\" value=\"".$type."\" id=\"setting_".$no."_".$type."\" >&nbsp;".$view."</label>";
				}
				if ($last_type != $view) {
					$res .= "<br />\n";
				}
			}
			echo $res;
			unset($res);

		} else if ($val['ks_type'] == "yn") {
			if ($val['ks_val'] == "y") { ?>
				<label><input type="radio" name="setting[<?php echo $no ?>]" value="y" checked="checked" />有効にする</label>
				<label><input type="radio" name="setting[<?php echo $no ?>]" value="n" />無効にする</label>
<?php } else { ?>
				<label><input type="radio" name="setting[<?php echo $no ?>]" value="y" />有効にする</label>
				<label><input type="radio" name="setting[<?php echo $no ?>]" value="n" checked="checked" />無効にする</label>
<?php }
		} else if ($val['ks_sys_cont'] == "globalmenu" || $val['ks_sys_cont'] == "footermenu1" || $val['ks_sys_cont'] == "footermenu2") {
			echo "<select name=\"setting[".$no."]\">\n";
			foreach ($menu_list as $term_id => $name) {
				if ($term_id == $val['ks_val']) {
					echo "<option value=\"".$term_id."\" selected=\"selected\" />".$name."\n";
				} else {
					echo "<option value=\"".$term_id."\" />".$name."\n";
				}
			}
			echo "</select>\n";
		} else if ($val['ks_sys_cont'] == "author_view") {
			echo "<select name=\"setting[".$no."]\">\n";
			foreach ($user_list as $user_id => $display_name) {
				if ($user_id == $val['ks_val']) {
					echo "<option value=\"".$user_id."\" selected=\"selected\" />".$display_name."\n";
				} else {
					echo "<option value=\"".$user_id."\" />".$display_name."\n";
				}
			}
			echo "</select>\n";
		} else if (preg_match('/image$/', $val['ks_sys_cont'])) {	// 画像データ
			if($val['ks_val'] !="") {
			$info = @getimagesize($val['ks_val']);
			if (isset($info) and is_array($info)) {
				$width = $info[0]/2;
				$height = $info[1]/2; ?>
				<p><img src="<?php echo $val['ks_val']; ?>" width="<?php echo $width;?>" height="<?php echo $height; ?>" /><br />
				<span class="keni_note">※ 実際のサイズより、縦横1/2サイズで表示をしております。</span></p>
		<?php } else { ?>
				<p><img src="<?php echo $val['ks_val']; ?>" /></p>
		<?php }
	 } ?>
			<input id="upload_image" type="text" size="80" name="setting[<?php echo $no ?>]" value="<?php if($val['ks_val'] !="") echo esc_html($val['ks_val']) ?>" /><br />
        画像を変更: <img src="images/media-button-other.gif" alt="画像を変更"  id="upload_image_button" value="Upload Image" style="cursor:pointer;" />
<?php
		} else if ($val['ks_sys_cont'] == "top_content") {
			
			wp_editor(the_keni('top_content'), "top_content", array('media_buttons' => false, 'textarea_name' => "setting[".$no."]", 'editor_css' => keni_rte_css()));

		} else if ($val['ks_type'] == "textarea") {
?>
			<textarea name="setting[<?php echo $no ?>]" cols="70" rows="5"><?php echo $val['ks_val']; ?></textarea>
<?php
		} else if ($val['ks_sys_cont'] == "tw_type") {
			global $tw_type;
			$sel_tw_type = the_keni("tw_type");
			foreach ($tw_type as $tw_type_val) {
				if ($tw_type_val == $sel_tw_type) { ?>
					<label><input type="radio" name="setting[<?php echo $no ?>]" value="<?php echo $tw_type_val; ?>" checked="checked" /><?php echo $tw_type_val; ?></label>
	<?php } else { ?>
					<label><input type="radio" name="setting[<?php echo $no ?>]" value="<?php echo $tw_type_val; ?>" /><?php echo $tw_type_val; ?></label>
	<?php }
			}

		} else { ?>
			<input type="text" name="setting[<?php echo $no ?>]" value="<?php echo esc_html($val['ks_val']); ?>" width="64" height="64" />
<?php }

if ($val['ks_ext'] != "") { ?>
	<br /><span class="keni_note"><?php echo $val['ks_ext']; ?></span>
<?php } ?>

</td>
<?php if (($val['ks_group'] != "一覧ページ") or ($val['ks_type'] != "column") && ($val['ks_type'] != "meta_index") && ($val['ks_type'] != "page2_index")) { ?>
	</tr>
<?php } ?>
<?php } ?>

		</tbody>
	</table>

<?php
} ?>


	<p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="変更を保存"  /></p></form>
	
	</form>
<?php } ?>

</div>
