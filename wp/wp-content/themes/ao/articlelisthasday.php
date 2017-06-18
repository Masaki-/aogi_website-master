
  <nav class="p-article_list">
  <ul>
  <?php if ( have_posts()): ?>
  <?php while (have_posts()) : the_post(); ?>
    <?php if(strpos(get_the_title($ID),'準備中') == false){ ?>
    <?php // if(esc_html(get_post_type_object(get_post_type())->name)=="page"){} else { //固定ページを除く記述?>
  	<li class="clearfix">
      <?php if( get_the_post_thumbnail_url() ){ ?>
        <a href="<?php the_permalink(); ?>" style="float:left;"><img style="width:120px; margin-right:13px;" src="<?php echo get_the_post_thumbnail_url(); ?>"></a>
      <?php } ?>
      <span style="font-weight:bold;" class="c-smpblock"><?php echo get_post_time('Y/m/d'); ?>
        <?php if(esc_html(get_post_type_object(get_post_type())->name)=="post"){}
          elseif(esc_html(get_post_type_object(get_post_type())->name)=="page"){}
          else { ?>
            <a href="http://aogijuku.com/<?php echo esc_html(get_post_type_object(get_post_type())->name); ?>" style="background-color:#b0b0b0; font-weight:bold; font-size:0.7em; padding:4px 9px 4px 11px; margin:0 2px; border-radius:3px; color:#fff;">
              <?php echo "",esc_html(get_post_type_object(get_post_type())->label),""; ?>
            </a>
              <?php }?>
            <span style="font-size:0.85em; padding:0 3px;"><?php $cat = get_the_category(); $cat = $cat[0]; { echo $cat->cat_name; } ?></span>
        </span><br class="u-pconly">
      <a class="clearfix" href="<?php the_permalink(); ?>">
          <?php
              $title = get_the_title($ID);
          ?>
          <?php echo $title ?>
          <?php if(esc_html(get_post_type_object(get_post_type())->name)=="post"){}
            elseif(esc_html(get_post_type_object(get_post_type())->name)=="page"){echo "ページを追加･更新しました！";}
            else { }?>
      </a>
      </li>
      <?php// } ?>
      <?php } ?>
  <?php endwhile; ?>
  <?php wp_reset_postdata(); ?>
  <?php else : ?>
  <?php endif; ?>
  <?php wp_reset_query();?>
  </ul>
  </nav>
