<?php
/*
Template Name: school-newtype
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php if (gp_check()) {
if (is_singular()) : $itemtype = "Article"; else: $itemtype = "Blog"; endif; ?>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" xml:lang="ja" lang="ja" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml" itemscope="itemscope" itemtype="http://schema.org/<?php echo $itemtype;?>">
<?php } else { ?>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" xml:lang="ja" lang="ja" xmlns:fb="http://www.facebook.com/2008/fbml">
<?php } ?>
<?php $label_obj = get_post_type_object( $post->post_name );?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $label_obj->labels->name;?><?php echo $post->post_title;?><?php title_keni(); ?></title>
<?php if (the_keni('mobile_layout') == "y") { ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php } ?>
<?php if (the_keni('view_meta') == "y") { ?>
<meta name="keywords" content="<?php keyword_keni(); ?>" />
<meta name="description" content="<?php description_keni(); ?>" />
<?php } ?>
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<!--[if IE]><meta http-equiv="imagetoolbar" content="no" /><![endif]-->
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/campaign.css" type="text/css" media="all" />
<?php if (the_keni('mobile_layout') == "y") { ?>
<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js?ver=4.4.2'></script>
<?php /*
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/main.js'></script>
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/index.js'></script>
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/index.js?ver=1'></script>

<!-- Nivo lightbox -->
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/extensions/nivo-lightbox/nivo-lightbox.css">
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/extensions/nivo-lightbox/themes/default/default.css">
<script src="<?php echo get_template_directory_uri(); ?>/extensions/nivo-lightbox/nivo-lightbox.min.js"></script>
<script>
$(document).ready(function(){
	$('a.nivo-lightbox').nivoLightbox({
		effect: 'fadeScale',
		theme: 'default'
	});
});
</script>

*/?>
<?php /*<script type='text/javascript' src='<?php echo includes_url();?>/js/jquery.form.min.js?ver=3.51.0-2014.06.20'></script>*/?>
<?php /*<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/map.js'></script>*/?>
<?php } ?>

<script type='text/javascript' src='http://maps.google.com/maps/api/js?sensor=true&#038;language=ja'></script>
<link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo('template_url'); ?>/images/common/favicon.ico" />
<link rel="apple-touch-icon" href="<?php bloginfo('template_url'); ?>/images/home-icon.png" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />

<?php wp_enqueue_script('jquery');
$public = get_option('blog_public');
if ($public > 0) {
	echo getIndexFollow();
}?>
<?php canonical_keni(); ?>
<?php facebook_keni();
google_plus_keni();
tw_cards_keni(); ?>

<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js?ver=4.4.2'></script>
<script>
$(window).on('load', function () {
  var $safnav = $('.js-scrollAndFixed'),
	  $safnavWrap = $('.js-scrollAndFixed_wrap'),
      safnavOffsetTop = $safnav.offset().top - 50;
  
  $(window).on('scroll', function () {
    if($(this).scrollTop() > safnavOffsetTop) {
      $safnav.addClass('is-fixed');
      $safnav.addClass('is-fixed_t50');
    } else {
      $safnav.removeClass('is-fixed');
      $safnav.removeClass('is-fixed_t50');
    }
  });
});

</script>
<?php wp_head(); ?>
</head>


<body id="body" <?php body_class(); ?> >


<?php include_once("analyticstracking.php") ?>
<?php
if($post->post_type == 'page'){
	$kousya = $post->post_name;
}else{
	$kousya = $post->post_type;
}
?>

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<?php
	$p_name = $posts[0]->post_name;
	$sc_post_1 = sc_post($p_name,"news",5);
	$sc_post_2 = sc_post($p_name,"tg-univ",3);
	$sc_post_3 = sc_post($p_name,"area-cs",4);
	$sc_post_4 = sc_post($p_name,"area-hs",3);
	$sc_post_5 = sc_post($p_name,"student",3);
	$sc_post_6 = sc_post($p_name,"voice",2);
	//var_dump($posts);
	$tax = get_object_taxonomies( $p_name );
	//var_dump($tax);
?>
<?php
	$area = get_field('area');
	$receptiontime = get_field('receptiontime');
	$station = get_field('station');
	$tel = get_field('tel');
	$address1 = get_field('address1');
	$address2 = get_field('address2');
	$address3 = get_field('address3');
	$remarks = get_field('remarks');
	$g_map = get_field('g_map');
?>

<?php if(post_custom('g_map')): ?>
<?php if( get_field('g_map') ): ?>	
<script>
var templatePath = "http://aogijyuku.mexce.xyz/wp-content/themes/ao";
var styleallay =
[
  {
    "stylers": [
      { "lightness": 1 },
      { "gamma": 1 },
      { "hue": "#0091ff" },
      { "saturation": -30 }
    ]
  }
];
var flagIcon_front = new google.maps.MarkerImage(templatePath + "/img/about/map_pin.png");
	flagIcon_front.size = new google.maps.Size(82, 77);
	flagIcon_front.anchor = new google.maps.Point(40, 75);
	flagIcon_front.scaledSize = new google.maps.Size(82, 77);
var mapCanvas;
function intialize() {
	mapCanvas = new google.maps.Map(document.getElementById("school_map"), {
		center : new google.maps.LatLng(<?php echo $g_map; ?>),
		zoom : 17,
		scrollwheel: false,
		styles: styleallay
	});
	var marker = new google.maps.Marker({
		position : new google.maps.LatLng(<?php echo $g_map; ?>),
		map: mapCanvas,
		icon: flagIcon_front,
	});
}
google.maps.event.addDomListener(window, "load", intialize);
</script>
<?php endif; ?>
<?php endif; ?>


<div class="l-header_wrap">
	<div class="l-header">
    <div class="u-inner u-pr">
        <p class="l-header_logo"><a href="http://aogijuku.com"><img src="http://aogijuku.com/wp-content/themes/ao/img/logo01.png"></a></p>
		<nav class="l-header_gnav hirakakuW6">
            <ul>
            	<li class="l-header_gnav_school is-active"><a href="http://aogijuku.com/school/">教室案内</a></li>
                <li class="l-header_gnav_entry"><a class="c-btn c-btn-entry " href="http://aogijuku.com/entry-camp?page=kichijoji">無料相談</a></li>
            </ul>
		</nav>        
	</div>
    </div>
</div>



   <?php the_content(); ?>


 <?php endwhile; else: ?>
 <?php endif; ?>
 
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 973424911;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/973424911/?guid=ON&amp;script=0"/>
</div>
</noscript>
<?php wp_footer(); ?>
</body>
</html>