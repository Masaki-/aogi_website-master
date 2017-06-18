<?php get_header(); /* get_header(school); */?>



<?php /*

<?php if(in_category('8')){ ?>
<section class="article_catch article_catch_curriculum clearFix">
    <div id="article_catch_category">
			<img src="<?php bloginfo('template_url'); ?>/images/curriculum/curriculum_rogo.png" alt="授業告知">
        <p class="din_1451">FREE LESSON</p>
    </div>
    <h1><?php the_title(); ?><span><?php h1_keni(); ?></span></h1>
</section>

<?php }else { ?>


<section class="article_catch article_catch_school_kg clearFix">
    <div id="article_catch_category">
			<img src="<?php bloginfo('template_url'); ?>/images/common/interface.png" alt="AO入試とは">
        <p class="din_1451">ARTICLE</p>
    </div>
    <h1><?php the_title(); ?><span><?php h1_keni();?></span></h1>
</section>


<?php } ?>
*/ ?>

<?php /*
<div id="breadcrumbs">
<ol class="clearfix">
<?php the_breadcrumbs(); ?>
</ol>
</div>
*/ ?>

<div id="main-contents"><!--▽メインコンテンツ-->
<article>
	<?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>


<?php
$p_name = $posts[0]->post_type;
$tax = get_object_taxonomies( $p_name );
//var_dump($p_name);
?>
<?php if($tax[1] != 'post_tag') :?>
	<!--<div class="s_menu_single">
	<div class="inner880">
			<ul>
			<li><a href="../<?php echo $p_name;?>">トップ</a></li>
			<li><a href="../<?php echo $tax[1];?>/news">お知らせ</a></li>
			<li><a href="../<?php echo $tax[1];?>/student">塾生の声</a></li>
			<li><a href="../<?php echo $tax[1];?>/tg-univ">狙い目大学</a></li>
			<li><a href="../<?php echo $tax[1];?>/voice">お悩み解決</a></li>
			<li><a href="../<?php echo $tax[1];?>/area-hs">高校紹介</a></li>
			<li><a href="../<?php echo $tax[1];?>/area-cs">予備校･塾紹介</a></li>
			</ul>
			<div class="fl-c"></div>
	</div>
	</div>-->
<? endif;?>
<div>


	<?php if(esc_html(get_post_type_object(get_post_type())->name)=="post"){}
	elseif(esc_html(get_post_type_object(get_post_type())->name)=="page"){}
	else { ?>
<div id="breadcrumbs">
	<ol vocab="http://schema.org/" typeof="BreadcrumbList" class="clearfix">
		<li property="itemListElement" typeof="ListItem" class="even">
			<a property="item" typeof="WebPage" href="http://aogijuku.com/">
				<span property="name">AO義塾</span></a>&nbsp;&gt;
			<meta property="position" content="1">
		</li>
			<li property="itemListElement" typeof="ListItem" class="odd">
				<a property="item" typeof="WebPage" href="http://aogijuku.com/<?php echo esc_html(get_post_type_object(get_post_type())->name); ?>">
					<span property="name"><?php echo esc_html(get_post_type_object(get_post_type())->label); ?></span>
				</a>&nbsp;&gt;
				<meta property="position" content="2">
			</li>
			<li property="itemListElement" typeof="ListItem" class="odd">
				<a property="item" typeof="WebPage" href="http://aogijuku.com/<?php echo esc_html(get_post_type_object(get_post_type())->name); ?>/all">
					<span property="name">すべてのお知らせ</span>
				</a>&nbsp;&gt;
				<meta property="position" content="3">
			</li>
	</ol>
</div>
<?php } ?>

<?php the_content(); ?>

        <?php endwhile; ?>
    <?php else : ?>
    <div class="inner880">
        <section>お探しのページがみつかりません</section>
    </div>
    <?php endif; ?>
</div>
	<?php if($tax[1] != 'post_tag') :?>

<? endif;?>
</div>
</article>


<?php get_footer(); ?>
