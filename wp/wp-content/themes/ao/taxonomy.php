<?php get_header(school); ?>
<?php
if($post->post_type == 'page'){
	$kousya = $post->post_name;
}else{
	$kousya = $post->post_type;
}
?>
<section class="article_catch article_catch_school_kg clearFix">
    <div id="article_catch_category">
			<img src="<?php bloginfo('template_url'); ?>/images/common/interface.png" alt="AO入試とは">
        <p class="din_1451"><?php echo mb_strtoupper($kousya); ?></p>
    </div>
    <h1><?php single_cat_title(); ?><span><?php echo category_description(); ?></span></h1>
</section>

<div id="breadcrumbs">
<ol class="clearfix">
<?php the_breadcrumbs(); ?>
</ol>
</div>
<div id="main-contents"><!--▽メインコンテンツ-->
<?php 
$p_name = $posts[0]->post_type;
$tax = get_object_taxonomies( $p_name );
//var_dump($tax);
?>
<?php if($tax[1] != 'post_tag') :?>
	
<? endif;?>


		<div class="s_menu_single">
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
		</div>

<section class="inner880 clearfix">
	<section class="blog_archive">

				<?php
				$taxonomy = $wp_query->get_queried_object();
				//var_dump($taxonomy);
				$cat_info = get_category( $cat );
				$args=array(
					'taxonomy' => $taxonomy->taxonomy, //タクソノミーを指定
					'term' => $taxonomy->slug,
					'posts_per_page'=> 7, //表示件数（-1で全ての記事を表示）
					'paged' => get_query_var( 'page' )
				);
				query_posts($args); ?>

				<!--<h2 class="article_h2"><span><?php echo $cat_info->name; ?></span></h2>-->

				<?php if ( have_posts()): ?>
					<?php while (have_posts()) : the_post(); ?>
						<article class="archive_article clearfix">
							<?php /*
							<div class="archive_left_box">
								<?php if(has_post_thumbnail()): ?>
									<a href="<?php the_permalink(); ?>" ><?php the_post_thumbnail(); ?></a>
								<?php endif; ?>
							</div>
							<div class="archive_right_box">
							</div>
							*/ ?>
                            <div class="article_info clearfix">
                                <time><?php echo get_post_time('Y.m.d D'); ?></time>
                            </div>
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <p><?php echo mb_substr(strip_tags($post-> post_content),0,100).'...'; ?></p>
						</article>
					<?php endwhile; ?>

				<?php else: ?>
					<h2 class="article_h3">申し訳ありませんが、記事はまだありませんでした。</h2>
				<?php endif; ?>
                
		<nav class="archive_prev_next clearfix">
			<?php posts_nav_link('', '<div class="archive_prev">PREV</div>', '<div class="archive_next">NEXT</div>'); ?>
		</nav>
		<?php wp_reset_query(); ?>
	</section>
</section>
<?php if($tax[1] != 'post_tag') :?>

<? endif;?>
</div><!--△メインコンテンツ-->

<?php get_footer(); ?>