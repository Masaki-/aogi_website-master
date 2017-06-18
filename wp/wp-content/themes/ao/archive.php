<?php get_header(); ?>


<?php if (is_category('notice')) : ?>
<section class="article_catch article_catch_curriculum clearFix">
    <div id="article_catch_category">
			<img src="<?php bloginfo('template_url'); ?>/images/curriculum/curriculum_rogo.png" alt="授業告知">
        <p class="din_1451">FREE LESSON</p>
    </div>
		<h1>未入塾の方､今ならまだ無料体験できます！<span><?php echo category_description(); ?></span></h1>
</section>

<?php else : /* ?>

<section class="article_catch article_catch_archive clearFix">
    <div id="article_catch_category">
			<img src="<?php bloginfo('template_url'); ?>/images/archive/draw.png" alt="AO入試とは!!!!!">
        <p class="din_1451">CATEGORY</p>
    </div>

		<h1><?php single_cat_title(); ?><span><?php echo category_description(); ?></span></h1>
</section>
<?php */ endif; ?>

<div id="breadcrumbs">
<ol class="clearfix">
<?php the_breadcrumbs(); ?>
</ol>
</div>


<div class="c-delete-br">
<?php
remove_filter('the_content', 'wpautop'); // 本文のタグ生成を停止する
remove_filter('the_excerpt', 'wpautop'); // 抜粋のタグ生成を停止する
?>

<?php
if (is_category() or is_tag()) {
	if (is_category()) {
		$content_araay = get_post_meta( get_query_var('cat'), "content");
	} else {
		$content_araay = get_post_meta( get_query_var('tag_id'), "content");
	}
	if (isset($content_araay[0]) and ($content_araay[0] != "") and (get_query_var('paged') <= 1)) {
		echo "<div class=\"content_area contents\">\n";
		echo nl2br($content_araay[0]);
		echo "\n</div>\n";
	}
}
?>
</div>

<?php /*
	$cat = get_the_category();
	$cat = $cat[0];
	echo $cat->cat_ID;

	$args = array(
		'child_of'	=> $cat->cat_ID
	);
	wp_list_categories( $args );
*/ ?>

<?php /* $children = get_category_children($cat); ?>
<?php if($children) : ?>

<?php
$cats_id = get_category_by_slug($category_name)->term_id;
$args = array('orderby' => 'name', 'order' => 'ASC','child_of' => $cats_id,'hide_empty'=>'0' );
$categories = get_categories($args); ?>

<h3><?php single_cat_title(); ?>の子カテゴリー</h3>
<ul>
<?php foreach($categories as $category){
   echo '<li><a href="' . get_category_link( $category->term_id ) . '" title="' . $category->name . '" ' . '>' . $category->name . '（' .$category->count . '）' .'</a></li>';
} ?>
</ul>

<?php endif; */?>

<?php
/*
$categories = get_categories(array('parent' => get_query_var('cat')));//子カテゴリーの情報を取得
if ($categories)//もし子カテゴリーがあったら
{
?>
<section class="c-coverline01">
<ul>
<?php foreach ($categories as $category)
{
?>
<li><a href="<?php echo get_category_link($category->cat_ID); ?>"><?php echo $category->cat_name ?></a></li>
<?php
}
?>
</ul>
</section>
<?php
}

*/?>


<section style="padding:20px; background-color:#f8f8f8;">
<div class="inner880">
<?php
$cat_info = get_category( $cat );
query_posts( array(
	'post_type' => 'any',
	'category_name' => $cat_info->slug,
	'posts_per_page' => -1,
	'paged' => get_query_var( 'paged' )
) ); ?>
<?/*
<h2 class="c-headline01">｢<?php echo $cat_info->name; ?>｣に関連する過去の記事･講座情報<span class="c-headline01_subtext">ARCHIVE</span></h2>
*/ ?>
<?php get_template_part( 'articlelisthasday' ); ?>
</div>
</section>


<div id="main-contents"><!--▽メインコンテンツ-->
<?php if (is_category( array( waseda, keio, ) ) ): ?>
<div class="contents">
	<div class="inner880">
		<h2 class="article_h2"><span><?php echo $cat_info->name; ?>合格者の検索結果</span></h2>
				<section class="result_archive clearfix">
			<?php
			query_posts( array(
				'tax_query' => array(
		                array(
		                    'taxonomy'=>'university',
		                    'terms'=> array($cat_info->slug),
		                    'field'=>'slug',
		                    'include_children'=>true,
		                    'operator'=>'IN'
		                    ),
		                'relation' => 'AND'
		         ),
				'posts_per_page' => '10',
				'paged' => get_query_var( 'paged' )
			) ); ?>
			<?php if ( have_posts()): ?>
				<?php while (have_posts()) : the_post();
					$whenGraduates = post_custom('whenGraduates');
					$graduateHighschool = post_custom('graduateHighschool');
					$examination = post_custom('examination');
					$passedUniv = post_custom('passedUniv');
					$faculty = post_custom('faculty');
				?>
					<article>
						<a href="<?php the_permalink(); ?>" class="card">

							<?php if(has_post_thumbnail()): ?>
								<?php the_post_thumbnail('thumb_result'); ?>
							<?php endif; ?>

							<div class="info">
								<aside><?php if(post_custom('whenGraduates')): ?><?php echo $whenGraduates; ?>期生<?php endif; ?></aside>
								<h3><?php if(mb_strlen($post->post_title)>30) { $title= mb_substr($post->post_title,0,30) ; echo $title. ･･･ ;} else {echo $post->post_title;}?></h3>
								<dl class="clearfix">
									<?php if(post_custom('graduateHighschool')): ?>
										<dt>高校：</dt>
										<dd><?php echo $graduateHighschool; ?></dd>
									<?php endif; ?>

									<?php if(post_custom('examination')): ?>
										<dt>入試：</dt>
										<dd><?php echo $examination; ?></dd>
									<?php endif; ?>

									<?php if(post_custom('passedUniv')): ?>
										<dt>大学：</dt>
										<dd><?php echo $passedUniv; ?></dd>
									<?php endif; ?>

									<?php if(post_custom('faculty')): ?>
										<dt>学部：</dt>
										<dd><?php echo $faculty; ?></dd>
									<?php endif; ?>
								</dl>
							</div>
						</a>
					</article>
				<?php endwhile; ?>
			<?php endif; ?>
	</div>
</div>
<?php else : ?>
<?php endif; ?>

</div><!--△メインコンテンツ-->

<?php get_footer(); ?>
