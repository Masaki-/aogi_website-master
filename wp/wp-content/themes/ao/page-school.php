<?php
/*
Template Name: 固定ページ：school
*/
?>


<?php get_header(); ?>
<?php if(is_home()): ?>
<?php else : /*?>


	<section class="article_catch article_catch_school clearFix">
		<div id="article_catch_category">
			<img src="<?php bloginfo('template_url'); ?>/images/common/school.png" alt="<?php echo $post->post_title;?>校舎詳細">
			<p class="din_1451"><?php echo mb_strtoupper($post->post_name); ?></p>
		</div>
		<?php
		$Description = get_post_type_object(get_post_type())->description;
        $Descriptions = explode( ',', $Description );
        ?>
		<h1><?php echo $post->post_title;?><span><?php echo $Descriptions[0];?>の校舎詳細やブログを公開しています。</span></h1>
	</section>
<?php */ endif; ?>


<div id="breadcrumbs">
	<ol class="clearfix"><?php the_breadcrumbs(); ?></ol>
</div>

<div id="main-contents"><!--▽メインコンテンツ-->
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
<div class="post">
<div class="contents clearfix">
		<!--<div class="s_menu">
		<div class="inner880">
		<ul>
		<li><a href="./<?php echo $tax[1];?>/news">お知らせ・ブログ</a></li>
		<li><a href="./<?php echo $tax[1];?>/student">塾生の声</a></li>
		<li><a href="./<?php echo $tax[1];?>/tg-univ">狙い目大学</a></li>
		<li><a href="./<?php echo $tax[1];?>/voice">お悩み解決</a></li>
		<li><a href="./<?php echo $tax[1];?>/area-hs">高校紹介</a></li>
		<li><a href="./<?php echo $tax[1];?>/area-cs">予備校･塾紹介</a></li>
		</ul>
		<div class="fl-c"></div>
		</div>
		</div>-->

	<div class="">
		<div class="p-article_wrap inner880">
		<h2><?php echo $post->post_title; ?></h2>
		<div class="detail clearfix" style="padding:0; margin:0;">
		<div class="school-map">
			<?php
			$img_id=get_field('main-pic');
			$img_m = wp_get_attachment_image_src ( $img_id , $size_m ) ;
			if($img_m){
			?>
			<p><img src = "<?php echo $img_m[0] ; ?>" width="350" /></p>
			<?php } ?>
		</div>
		<div class="detail_in">
			<dl class="clearfix">
				<dt>近接エリア</dt>
				<dd><?php echo $area; ?></dd>
			</dl>

			<dl class="clearfix">
				<dt>受付時間</dt>
				<dd><?php echo $receptiontime; ?></dd>
			</dl>

			<dl class="clearfix">
				<dt>最寄駅</dt>
				<dd><?php echo $station; ?></dd>
			</dl>

			<dl class="clearfix">
				<dt>電話番号</dt>
				<dd><?php echo $tel; ?></dd>
			</dl>

			<dl class="clearfix">
				<dt>住所</dt>
				<dd>〒<?php echo $address1; ?><br/>
				<?php echo $address2; ?><br/>
				<?php echo $address3; ?></dd>
			</dl>

			<?php if(post_custom('remarks')): ?>
			<?php if( get_field('remarks') ): ?>
			<dl class="clearfix">
				<dt>備考</dt>
				<dd><?php echo $remarks; ?></dd>
			</dl>
			<?php else: ?>

			<?php endif; ?>
			<?php endif; ?>



		</div><!--detail01_in clearfix-->
		<div class="fl-c"></div>
		</div><!--detail clearfix-->

		</div><!--school_in-->
	</div><!--/article_school01-->




<div class="inner880" style="padding-bottom:30px;">
<div style="text-align:center; padding-top:30px;">
<a class="c-btn inPageLink" href="#gmap">地図を見る</a>&nbsp;
<a class="c-btn inPageLink" href="#in-page-form">この教室に無料受験相談を申し込む</a><br>
</div>
<div class="p-article_wrap"  style="text-align:center; display:block; width:100%;">
<p>
<a style="font-weight:bold;" href="http://aogijuku.com/contactjukusei">→塾生専用問い合わせフォームはこちら</a>
</p>
<p>
アポイントメントのないご訪問時にはご対応が難しくなることがございます。ご来校時には、必ずお電話かメールもしくはお問い合わせフォームより授業や面談をご予約ください
</p>
</div>
</div>

	<div style="background:#f8f8f8; padding:30px 0; border-top:solid 1px #eee; border-bottom:solid 1px #eee;">
	<div class="inner880">
		<div class="p-article_wrap">
			<h4><?php echo $post->post_title; ?>からのお知らせ・ブログ</h4>
		</div>
		<?php
			query_posts( array(
			'post_type' => $post->post_name,
			'posts_per_page' => 3,
			) );
		?>
		<?php get_template_part( 'articlelisthasday' ); ?>
		<div style="text-align:center; padding-top:13px;">
			<a class="c-btn" href="./<?php echo $post->post_name; ?>/all">すべての記事一覧</a>
		</div>
	</div>
	</div>

<?php the_content(); ?>




<div id="gmap">

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
<div id="school_map"></div>
<!--map_end-->

<?php else: ?>
<?php endif; ?>
<?php endif; ?>
</div>


<?php /*

<div class="article_school02">
<div class="school02_in">

<!--■　お知らせ/ブログ　■-->
<?php $code_output = do_shortcode($sc_post_1);?>
<?php if(!empty($code_output)):?>
	<h2><span><?php echo $post->post_title;?>からのお知らせ/ブログ</span></h2>
	<div class="box-news">
		<?php echo $code_output;?>
		<div class="article_view_detail_button">
			<a href="./<?php echo $tax[1];?>/news">全ての記事を見る</a>
		</div>
<div class="fl-c"></div>
	</div><!--box-news-->
<?php endif;?>

<!--■　通う塾生の声）　■ -->
<?php $code_output = do_shortcode($sc_post_5);?>
<?php if(!empty($code_output)):?>
	<div id="category-box-a">
		<h2><span><?php echo $post->post_title;?>に通う塾生の声</span></h2>
		<div class="box-a-in">
			<?php echo $code_output;?>
		</div><!--box-a-in-->
		<div class="article_view_detail_button">
			<a href="./<?php echo $tax[1];?>/student">全ての記事を見る</a>
		</div>
<div class="fl-c"></div>
	</div><!--category-box-a-->
<?php endif;?>

<!--■　【ここが狙い目】AO推薦でいける大学情報一覧（教室名編）　■-->
<?php $code_output = do_shortcode($sc_post_2);?>
<?php if(!empty($code_output)):?>
	<h2><span>【ここが狙い目】AO推薦でいける大学情報一覧（<?php echo $post->post_title;?>編）</span></h2>
	<div class="box-b-in">
		<?php echo $code_output;?>
	</div><!--box-b-in-->
	<div class="article_view_detail_button">
		<a href="./<?php echo $tax[1];?>/tg-univ">全ての記事を見る</a>
	</div>
<div class="fl-c"></div>
<?php endif;?>

<!--■　AO入試･推薦入試のお悩み解決！　■-->
<?php $code_output = do_shortcode($sc_post_6);?>
<?php if(!empty($code_output)):?>
	<h2><span>AO入試･推薦入試のお悩み解決！（<?php echo $post->post_title;?>編）</span></h2>
	<div class="box-b-in">
		<?php echo $code_output;?>
	</div><!--box-b-in-->
	<div class="article_view_detail_button">
		<a href="./<?php echo $tax[1];?>/voice">全ての記事を見る</a>
	</div>
<div class="fl-c"></div>
<?php endif;?>

<!--■　地域予備校・塾情報声　■-->
<?php $code_output = do_shortcode($sc_post_3);?>
<?php if(!empty($code_output)):?>
	<h2><span>AO推薦を対策している<?php echo $post->post_title;?>周辺の予備校･塾紹介＆比較</span></h2>
	<div class="box-b-in">
		<?php echo $code_output;?>
	</div><!--box-b-in-->
	<div class="article_view_detail_button">
		<a href="./<?php echo $tax[1];?>/area-cs">全ての記事を見る</a>
	</div>
<div class="fl-c"></div>
<?php endif;?>

<!--■　地域高校評判/進学実績　■-->
<?php $code_output = do_shortcode($sc_post_4);?>
<?php if(!empty($code_output)):?>
	<h2><span>AO推薦を応援してくれる<?php echo $post->post_title;?>周辺の高校一覧</span></h2>
	<div class="box-b-in">
		<?php echo $code_output;?>
	</div><!--box-b-in-->
	<div class="article_view_detail_button">
		<a href="./<?php echo $tax[1];?>/area-hs">全ての記事を見る</a>
	</div>
<div class="fl-c"></div>
<?php endif;?>
</div><!--school_in-->
</div><!--/article_school02-->
*/ ?>



	<?php if(get_the_tags()){ ?>
	<div class="post-tag">
	<p>タグ：<?php the_tags('', ', '); ?></p>
	</div>
	<?php } ?>

</div>
</div><!--/post-->
<?php endwhile; ?>
<?php

relation_keni();

pager_keni();

else : ?>

<h2>お探しの記事は見つかりませんでした。</h2>
<div class="contents">
<p>検索キーワードを変更し下記より再検索してください。</p><br />
<?php get_search_form(); ?>
</div>
<?php endif; ?>
</div><!--△メインコンテンツ-->
<?php get_footer(); ?>
