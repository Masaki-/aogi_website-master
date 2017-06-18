<?php
/*----------------------------------------
	賢威6

	はてなブックマーク数出力モジュール
	
	2012.12.14	WEBライダー
----------------------------------------*/
function get_hatena_bookmark( $url = '') {
	if ( $url ) {
		$url = esc_url( $url ) ;
	} else {
		$url = get_permalink();
	}

	$get_url = "http://api.b.st-hatena.com/entry.count?url=".$url;
	$ch = curl_init();	
	curl_setopt( $ch, CURLOPT_URL, $get_url );	
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	$res = curl_exec( $ch );	
	curl_close( $ch );	
	if ($res != "") {
		return sprintf(' <span class="hatena"><a href="http://b.hatena.ne.jp/entry/%1$s" target="_blank"><img src="http://b.hatena.ne.jp/entry/image/%1$s" class="vl-m" style="border: none;" alt="" /></a></span>', $url );
	} else {
		return "";
	}
}
?>