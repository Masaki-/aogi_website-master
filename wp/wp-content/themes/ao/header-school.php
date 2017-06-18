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
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css" type="text/css" media="all" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style_2.css" type="text/css" media="all" />
<?php if (the_keni('mobile_layout') == "y") { ?>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/mobile.css" type="text/css" media="all" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/mobile_layout.css" type="text/css" media="all" />
<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js?ver=4.4.2'></script>
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/main.js'></script>
<?php /*
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/index.js'></script>
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/index.js?ver=1'></script>
*/?>
<?php /*<script type='text/javascript' src='<?php echo includes_url();?>/js/jquery.form.min.js?ver=3.51.0-2014.06.20'></script>*/?>
<script type='text/javascript' src='http://maps.google.com/maps/api/js?sensor=true&#038;language=ja'></script>
<?php /*<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/map.js'></script>*/?>
<?php } ?>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/advanced.css" type="text/css" media="all" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/print.css" type="text/css" media="print" />
<link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo('template_url'); ?>/images/common/favicon.ico" />
<link rel="apple-touch-icon" href="<?php bloginfo('template_url'); ?>/images/home-icon.png" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />

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


<?php wp_enqueue_script('jquery');
$public = get_option('blog_public');
if ($public > 0) {
	echo getIndexFollow();
}?>
<?php canonical_keni(); ?>
<?php wp_head();?>
<?php facebook_keni();
google_plus_keni();
tw_cards_keni(); ?>

<?php wp_head(); ?>
</head>

<body id="body" <?php body_class(); ?> >
<?php include_once("analyticstracking.php") ?>
		<?php if(is_archive('blog')):?>
			<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&appId=467961416646699&version=v2.0";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>
		<?php else: ?>
		<?php endif; ?>

<nav class="g_nav">
	<div class="menu_button">
		<span class="nav_icon"></span>
	</div>
<ul>
    <li id="g_nav_logo"><a href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('template_url'); ?>/img/common/nav_logo.png" alt="AO入試対策専門塾　AO義塾"></a></li>
    <li><a href="<?php bloginfo('url'); ?>/aboutus" title="AO義塾とは About AOGIJUKU">AO義塾について<span class="english_title">About&amp;Concept</span></a></li>
    <li><a href="<?php bloginfo('url'); ?>/howto" title="AO入試とは">AO入試･推薦入試対策法<span class="english_title">How to AO Examination</span></a></li>
    <li><a href="<?php bloginfo('url'); ?>/feature" title="AO義塾の特徴･仕組み">AO義塾の特徴･仕組み<span class="english_title">System</span></a></li>
    <li><a href="<?php bloginfo('url'); ?>/contributions" title="入塾案内･学費 Service Fee">入塾案内･学費<span class="english_title">Joinus</span></a></li>
    <li><a href="<?php bloginfo('url'); ?>/message" title="塾長プロフィール Matricurata">塾長プロフィール<span class="english_title">Profile</span></a></li>
    <li><a href="<?php bloginfo('url'); ?>/results" title="合格実績･卒業生の声 Result">合格実績･卒業生の声<span class="english_title">Result&amp;Voice</span></a></li>
    <li><a href="<?php bloginfo('url'); ?>/school">教室案内<span class="english_title">Classroom</span></a></li>
    <!--<li><a href="<?php bloginfo('url'); ?>/notice" title="お知らせ">お知らせ<span class="english_title">Notice</span></a></li>-->
    <!--<li><a href="<?php bloginfo('url'); ?>/curriculum" title="カリキュラム Curiculum">カリキュラム<span class="english_title">Curriculum</span></a></li>-->
</ul>
	<ul class="g_nav_sns">
		<li><a href="https://www.facebook.com/aogijuku?fref=ts" title="Facebookページ" rel="nofollow" target="_blank"><span>Facebook</span></a></li>
	</ul>
</nav>

<nav class="sp_g_nav clearfix">
	<div id="sp_g_nav_logo">
		<a href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('template_url'); ?>/images/common/sp_g_nav_logo.png" width="108" alt="AO義塾 志を実現するためのAO入試専門塾"></a>
	</div>
	<div id="map_nav">
		<a href="<?php bloginfo('url'); ?>/school"><img src="<?php bloginfo('template_url'); ?>/images/school-map.png" width="108" alt="教室の場所"></a>
        </div>
	<div id="menu_button">
		<span class="nav_icon"></span>
	</div>
</nav>
		
<div class="sp_g_nav_field">
<ul>
<li><a href="<?php bloginfo('url'); ?>/aboutus">AO義塾について</a></li>
<li><a href="<?php bloginfo('url'); ?>/feature">AO義塾の特徴･仕組み</a></li>
<li><a href="<?php bloginfo('url'); ?>/howto">AO入試･推薦入試対策法</a></li>                
<li><a href="<?php bloginfo('url'); ?>/contributions">入塾案内･学費</a></li>
<li><a href="<?php bloginfo('url'); ?>/results">合格実績･合格者の声</a></li>
<li><a href="<?php bloginfo('url'); ?>/message">塾長プロフィール</a></li>
<li><a href="<?php bloginfo('url'); ?>/school">教室案内</a></li>
<!--<li><a href="<?php bloginfo('url'); ?>/notice">お知らせ</a></li>-->
<!--<li><a href="<?php bloginfo('url'); ?>/curriculum">カリキュラム</a></li>-->
</ul>
</div>

	<div class="main">
			<?php if ( is_home() || is_front_page() ) : ?>
				<div class="main-bg">
					<ul class="main-bg-normal">
						<li class="selected"></li>
						<li></li>
						<li></li>
					</ul>
					<ul class="main-bg-blur">
						<li class="selected"></li>
						<li></li>
						<li></li>
					</ul>
				</div>
			<?php endif; ?>
<?php
if($post->post_type == 'page'){
	$kousya = $post->post_name;
}else{
	$kousya = $post->post_type;
}
?>
<header class="header clearfix">
	<div class="header-menu01">
		<ul>
			<li><a href="<?php bloginfo('url'); ?>/company">企業情報</a></li>
        		<li><a href="<?php bloginfo('url'); ?>/company">採用情報</a></li>
        		<li><a href="<?php bloginfo('url'); ?>/company">プライバシーポリシー</a></li>
        		<li><a href="<?php bloginfo('url'); ?>/contact">メディア様向けのお問い合わせ</a></li>
		</ul>
	</div>
	<!--<ul>
		<li style="width:400px;"><a class="btn--fckheader" href="http://aogijuku.com/2015opencampus" title="全授業無料オープンキャンパス">【お知らせ】★全授業無料キャンペーン実施中(2015年12月まで)</a></li>
		<li><a href="#" title="高校生の方へ"><img src="<?php bloginfo('template_url'); ?>/img/common/header_high.png" alt="高校生の方へ" >高校生の方へ</a></li>
		<li><a href="#" title="保護者の方"へ><img src="<?php bloginfo('template_url'); ?>/img/common/header_parent.png" alt="保護者の方">保護者の方へ</a></li>
		<li><a href="#" title="メディアの方へ"><img src="<?php bloginfo('template_url'); ?>/img/common/header_media.png" alt="メディアの方">メディアの方へ</a></li>
	</ul> -->
	<div class="header_cv">
		<div class="header_cv_inner" class="clearfix">
			<!--<div class="header_cv_tel">
				<img src="<?php bloginfo('template_url'); ?>/images/common/header_phone.png" alt="AO義塾お問い合せ電話番号">
				<span id="tel" >TEL.</span><span id="tel_number">03-6300-0506<span style="0.8em">(13:00～21:00)</span></span>
			</div>-->
			<div class="header_cv_freetrial">
             <?php
            $sate = ["matsudo","mito","ochanomizu","nerima","atsugi","sugamo","shinyokohama","kanazawa","toyama","shizuoka","nigata","gifu","naganoekimae","tsu","himeji","takamatu","school-st"];
            $key = in_array($kousya, $sate);
            if ($key){
                $status = 'entry-sate';
            }else{
                $status = 'entry-camp';
            }
            ?>
				<a href="<?php bloginfo('url'); ?>/<?php echo $status;?>?page=<?php echo $kousya;?>" title="無料AO・推薦相談/体験申込"><!-- <img src="<?php bloginfo('template_url'); ?>/img/common/header_mail.png" alt="メールアイコン"> -->無料相談/体験申込</a>
			</div>
		</div>
	</div>
</header>