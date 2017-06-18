<?php 
$view = "n";

if (is_front_page()) {	
	if (the_keni('view_top_side') == "y") {
		$view = "y";
	}
	
 } else if (is_home()) {

	if (the_keni('view_side') == "y") {
		$view = "y";
	}
	
} else if (is_singular()) {

	$side_bar_check = get_post_meta( $post->ID, "side");

	if ($side_bar_check != false) {
		if ($side_bar_check[0] == "y") {
			$view = "y";
		} else if ($side_bar_check[0] == "def" && the_keni('view_side') == "y") {
			$view = "y";
		}
	} else if (the_keni('view_side') == "y") {
		$view = "y";
	}

} else if (the_keni('view_side') == "y") {

	$view = "y";
}

if ($view == "y") { ?>
	<div id="sidebar" class="sub-column">
	<div class="sidebar-btn">サイドバー</div>

</div>
<?php
}
?>