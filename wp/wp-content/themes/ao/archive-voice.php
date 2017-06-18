<?php
/*
Template Name: 合格者インタビューアーカイブ
*/
?>

<?php
	wp_enqueue_script('pagejs', get_bloginfo("template_directory")."/js/voice.js", array('jquery'), true, true );
?>
<?php get_header(); ?>

<section class="voice_catch clearFix">
	<div id="voice_catch_category">
		<img src="<?php bloginfo('template_url'); ?>/images/voice/catch_right.png" alt="AO義塾合格者インタビュー ぼくらの未来の設計図">
	</div>
	<!-- <h1 class="voice_catch__headline">
		大学合格をゴールからスタートに。<br />AO義塾の卒業生一人一人が己の志を叶え、社会に貢献できますように。
	</h1> -->
</section>

<div id="breadcrumb">
	<ul class="clearfix">
		<li><a href="<?php bloginfo('url'); ?>">AO義塾</a></li>
		<li class="breadcrumb_break">&gt;</li>
		<li>合格者の声</li>
	</ul>
</div>

<div class="page_article">
	<div class="inner880">
		<div class="search">
			<a title="条件検索"><img src="<?php bloginfo('template_url'); ?>/images/voice/search_icon.png" alt="サーチアイコン">条件検索<img class="arrow" src="<?php bloginfo('template_url'); ?>/images/voice/arrow_under.png"></a>
			<div class="search_detail clearfix">
				<div class="search_left clearfix">
					<ul class="clearfix">
						<?php wp_list_categories(array('title_li' => '', 'taxonomy' => 'university','hide_empty' => false)); ?>
					</ul>
				</div>
				<div class="search_right">
					<ul>
						<?php wp_list_categories(array('title_li' => '', 'taxonomy' => 'major','hide_empty' => false)); ?>
					</ul>
				</div>
			</div>
		</div>

		<section class="result_archive clearfix">

			<?php
			query_posts( array(
				'post_type' => 'voice',
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

			<?php else: ?>
			<?php endif; ?>

		</section>
	</div>
</div>

<?php get_footer(); ?>