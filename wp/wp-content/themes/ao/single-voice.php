<?php
	wp_enqueue_script('pagejs', get_bloginfo("template_directory")."/js/voice.js", array('jquery'), true, true );
?>
<?php get_header(); ?>

<section class="result_catch clearFix">
	<div id="result_catch_category">
		<img src="<?php bloginfo('template_url'); ?>/images/voice/catchcategory.png" alt="MY_VISION">

<?php
	if(have_posts()): while(have_posts()):the_post();
	$post_id = $post->ID;
?>


			<h1>
<?php the_title() ?>
				<?php /* the_field('visionSubTitle', $post_id); */ ?>
			</h1>
			<div class="catch_bottombox">
				<div class="catch_bottom clearfix">
					<div class="catch_bottom_leftbox">
						<p class="grade"><?php the_field('whenGraduates', $post_id); ?>期生</p>
					</div>
					<div class="catch_bottom_rightbox">
						<p class="name">	<?php the_field('name', $post_id); ?></p>
					</div>
				</div>
				<ul>
					<?php if(post_custom('graduateHighschool')): ?>
					<li>出身高校 ：<?php the_field('graduateHighschool', $post_id); ?></li>
					<?php endif;?>

					<?php if(post_custom('passedUniv')): ?>
					<li>合格大学 ：<?php the_field('passedUniv', $post_id); ?></li>
					<?php endif;?>

					<?php if(post_custom('faculty')): ?>
					<li>合格学部 ：<?php the_field('faculty', $post_id); ?></li>
					<?php endif;?>

					<?php if(post_custom('examination')): ?>
					<li>入試形式 ：<?php the_field('examination', $post_id); ?></li>
					<?php endif;?>
				</ul>
			</div>
		</div>

		<div id="catch_img">
			<?php
			$img_id=get_field('studentImage');
			$size_m = "full";
			$img_m = wp_get_attachment_image_src ( $img_id , $size_m ) ;
			$img_ttlalt = get_post ( get_field ('studentImage') ) ;
			$img_alt = get_post_meta ( $img_ttlalt -> ID , '_wp_attachment_image_alt' , true );
			$img_ttl = $img_ttlalt -> post_title ;
			?>
			<?php if(post_custom('studentImage')): ?>
			<img src = "<?php echo $img_m[0] ; ?>"
			     alt = "<?php echo $img_alt ; ?>" >
			<?php else: ?>
			<img src="<?php bloginfo('template_url'); ?>/images/voice/no-images.jpg">
			<?php endif; ?>
		</div>
	</section>

	<div id="breadcrumb">
		<ul class="clearfix">
			<li><a href="<?php bloginfo('url')?>">AO義塾</a></li>
			<li class="breadcrumb_break">&gt;</li>
			<li><a href="<?php bloginfo('url')?>/voice">合格者の声</a></li>
			<li class="breadcrumb_break">&gt;</li>
			<li><?php the_title(); ?></li>
		</ul>
	</div>
	<article class="article_voice">
		<div class="inner880">
			<div class="search">
				<a title="条件検索"><img src="<?php bloginfo('template_url'); ?>/images/voice/search_icon.png" alt="サーチアイコン">条件検索<img class="arrow" src="<?php bloginfo('template_url'); ?>/images/voice/arrow_under.png"></a>
				<div class="search_detail clearfix">
					<div class="search_left clearfix">
						<ul class="clearfix">
							<?php wp_list_categories(array('title_li' => '', 'taxonomy' => 'university','hide_empty' => true)); ?>
						</ul>
					</div>
					<div class="search_right">
						<ul>
							<?php wp_list_categories(array('title_li' => '', 'taxonomy' => 'major','hide_empty' => true)); ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<?php
		$img_id=get_field('vision_img');
		$img_m = wp_get_attachment_image_src ( $img_id , $size_m ) ;
		?>
		<?php if(post_custom('vision_img')): ?>
		<p class="voice_images"><img src="<?php echo $img_m[0] ; ?>"></p>
		<?php else: ?>
		<?php endif; ?>

		<?php if(post_custom('title-01')): ?><!--項目1-->
		<?php if( get_field('title-01') ): ?>
		<section class="vision_detail clearfix">
			<div class="contents_detail_leftbox">
				<p class="vision_ttl"><?php the_field('title-01', $post_id); ?></p>
				<h2><?php the_field('title-sub-01', $post_id); ?></h2>
			</div>
			<div class="contents_detail_rightbox">
				<p><?php the_field('text-01', $post_id); ?></p>
			</div>
		</section>
		<?php else: ?>

		<?php endif; ?>
		<?php endif; ?>


		<?php
		$img_id=get_field('why_img');
		$img_m = wp_get_attachment_image_src ( $img_id , $size_m ) ;
		?>
		<?php if(post_custom('vision_img')): ?>
		<p class="voice_images"><img src="<?php echo $img_m[0] ; ?>"></p>
		<?php else: ?>
		<?php endif; ?>

		<?php if(post_custom('title-02')): ?><!--項目2-->
		<?php if( get_field('title-02') ): ?>
		<section class="why_detail clearfix">
			<div class="contents_detail_leftbox">
				<p class="vision_ttl"><?php the_field('title-02', $post_id); ?></p>
				<h2><?php the_field('whySubTitle', $post_id); ?></h2>
			</div>
			<div class="contents_detail_rightbox">
				<p><?php the_field('whyContent', $post_id); ?></p>
			</div>
		</section>
		<?php else: ?>

		<?php endif; ?>
		<?php endif; ?>

		<?php
		$img_id=get_field('what_img');
		$img_m = wp_get_attachment_image_src ( $img_id , $size_m ) ;
		?>
		<?php if(post_custom('what_img')): ?>
		<p class="voice_images"><img src="<?php echo $img_m[0] ; ?>"></p>
		<?php else: ?>
		<?php endif; ?>

		<?php if(post_custom('title-03')): ?><!--項目3-->
		<?php if( get_field('title-03') ): ?>
		<section class="what_detail clearfix">
			<div class="contents_detail_leftbox">
				<p class="vision_ttl"><?php the_field('title-03', $post_id); ?></p>
				<h2><?php the_field('whatSubTiltle', $post_id); ?></h2>
			</div>
			<div class="contents_detail_rightbox">
				<p><?php the_field('whatSubTitle', $post_id); ?></p>
			</div>
		</section>
		<?php else: ?>

		<?php endif; ?>
		<?php endif; ?>

		<?php
		$img_id=get_field('how_img');
		$img_m = wp_get_attachment_image_src ( $img_id , $size_m ) ;
		?>
		<?php if(post_custom('how_img')): ?>
		<p class="voice_images"><img src="<?php echo $img_m[0] ; ?>"></p>
		<?php else: ?>
		<?php endif; ?>


		<?php if(post_custom('title-04')): ?><!--項目4-->
		<?php if( get_field('title-04') ): ?>
		<section class="how_detail clearfix">
			<div class="contents_detail_leftbox">
				<p class="vision_ttl"><?php the_field('title-04', $post_id); ?></p>
				<h2><?php the_field('howSubTitle', $post_id); ?></h2>
			</div>
			<div class="contents_detail_rightbox">
				<p><?php the_field('howContent', $post_id); ?></p>
			</div>
		</section>
		<?php else: ?>

		<?php endif; ?>
		<?php endif; ?>

		<?php
		$img_id=get_field('action_img');
		$img_m = wp_get_attachment_image_src ( $img_id , $size_m ) ;
		?>
		<?php if(post_custom('action_img')): ?>
		<p class="voice_images"><img src="<?php echo $img_m[0] ; ?>"></p>
		<?php else: ?>
		<?php endif; ?>

		<?php if(post_custom('title-05')): ?><!--項目5-->
		<?php if( get_field('title-05') ): ?>
		<section class="action_detail clearfix">
			<div class="contents_detail_leftbox">
				<p class="vision_ttl"><?php the_field('title-05', $post_id); ?></p>
				<h2><?php the_field('actionSubTitle', $post_id); ?></h2>
			</div>
			<div class="contents_detail_rightbox">
				<p><?php the_field('actionContent', $post_id); ?></p>
			</div>
		</section>
		<?php else: ?>

		<?php endif; ?>
		<?php endif; ?>


		<?php
		$img_id=get_field('item-img-06');
		$img_m = wp_get_attachment_image_src ( $img_id , $size_m ) ;
		?>
		<?php if(post_custom('item-img-06')): ?>
		<p class="voice_images"><img src="<?php echo $img_m[0] ; ?>"></p>
		<?php else: ?>
		<?php endif; ?>

		<?php if(post_custom('title-06')): ?><!--項目6-->
		<?php if( get_field('title-06') ): ?>
		<section class="action_detail clearfix">
			<div class="contents_detail_leftbox">
				<p class="vision_ttl"><?php the_field('title-06', $post_id); ?></p>
				<h2><?php the_field('title-sub-06', $post_id); ?></h2>
			</div>
			<div class="contents_detail_rightbox">
				<p><?php the_field('text-06', $post_id); ?></p>
			</div>
		</section>
		<?php else: ?>

		<?php endif; ?>
		<?php endif; ?>


		<?php
		$img_id=get_field('item-img-07');
		$img_m = wp_get_attachment_image_src ( $img_id , $size_m ) ;
		?>
		<?php if(post_custom('item-img-07')): ?>
		<p class="voice_images"><img src="<?php echo $img_m[0] ; ?>"></p>
		<?php else: ?>
		<?php endif; ?>

		<?php if(post_custom('title-07')): ?><!--項目7-->
		<?php if( get_field('title-07') ): ?>
		<section class="action_detail clearfix">
			<div class="contents_detail_leftbox">
				<p class="vision_ttl"><?php the_field('title-07', $post_id); ?></p>
				<h2><?php the_field('title-sub-07', $post_id); ?></h2>
			</div>
			<div class="contents_detail_rightbox">
				<p><?php the_field('text-07', $post_id); ?></p>
			</div>
		</section>
		<?php else: ?>

		<?php endif; ?>
		<?php endif; ?>

		<?php
		$img_id=get_field('item-img-08');
		$img_m = wp_get_attachment_image_src ( $img_id , $size_m ) ;
		?>
		<?php if(post_custom('item-img-08')): ?>
		<p class="voice_images"><img src="<?php echo $img_m[0] ; ?>"></p>
		<?php else: ?>
		<?php endif; ?>

		<?php if(post_custom('title-08')): ?><!--項目8-->
		<?php if( get_field('title-08') ): ?>
		<section class="action_detail clearfix">
			<div class="contents_detail_leftbox">
				<p class="vision_ttl"><?php the_field('title-08', $post_id); ?></p>
				<h2><?php the_field('title-sub-08', $post_id); ?></h2>
			</div>
			<div class="contents_detail_rightbox">
				<p><?php the_field('text-08', $post_id); ?></p>
			</div>
		</section>
		<?php else: ?>

		<?php endif; ?>
		<?php endif; ?>

		<?php
		$img_id=get_field('item-img-09');
		$img_m = wp_get_attachment_image_src ( $img_id , $size_m ) ;
		?>
		<?php if(post_custom('item-img-09')): ?>
		<p class="voice_images"><img src="<?php echo $img_m[0] ; ?>"></p>
		<?php else: ?>
		<?php endif; ?>

		<?php if(post_custom('title-09')): ?><!--項目9-->
		<?php if( get_field('title-09') ): ?>
		<section class="action_detail clearfix">
			<div class="contents_detail_leftbox">
				<p class="vision_ttl"><?php the_field('title-09', $post_id); ?></p>
				<h2><?php the_field('title-sub-09', $post_id); ?></h2>
			</div>
			<div class="contents_detail_rightbox">
				<p><?php the_field('text-09', $post_id); ?></p>
			</div>
		</section>
		<?php else: ?>

		<?php endif; ?>
		<?php endif; ?>

		<?php
		$img_id=get_field('item-img-10');
		$img_m = wp_get_attachment_image_src ( $img_id , $size_m ) ;
		?>
		<?php if(post_custom('item-img-10')): ?>
		<p class="voice_images"><img src="<?php echo $img_m[0] ; ?>"></p>
		<?php else: ?>
		<?php endif; ?>

		<?php if(post_custom('title-10')): ?><!--項目10-->
		<?php if( get_field('title-10') ): ?>
		<section class="action_detail clearfix">
			<div class="contents_detail_leftbox">
				<p class="vision_ttl"><?php the_field('title-10', $post_id); ?></p>
				<h2><?php the_field('title-sub-10', $post_id); ?></h2>
			</div>
			<div class="contents_detail_rightbox">
				<p><?php the_field('text-10', $post_id); ?></p>
			</div>
		</section>
		<?php else: ?>

		<?php endif; ?>
		<?php endif; ?>

<?php if( get_field(forAogiMessage) ): ?>
		<div class="inner880">
		<div class="for_aogijuku clearfix">
			<div class="ao_contents_detail_leftbox">
				<img src="<?php bloginfo('template_url'); ?>/images/voice/messages.png">
				<p class="vision_ttl">AO義塾に一言</p>
			</div>
			<div class="ao_contents_detail_rightbox">
				<p><?php the_field('forAogiMessage', $post_id); ?></p>
			</div>
		</section>
		</div>
	</div>
<?php endif; ?>

<?php endwhile; ?>
<?php else : ?>
	<section>大変申し訳ありませんが、記事が見つかりませんでした。</section>
<?php endif; ?>
		</div>
</article>
<?php get_footer(); ?>