
<nav class="p-article_list">
<ul>
<?php if ( have_posts()): ?>
<?php while (have_posts()) : the_post(); ?>
<?php if(esc_html(get_post_type_object(get_post_type())->name)=="page"){} else { //固定ページを除く記述?>
<li>
  <?php if(esc_html(get_post_type_object(get_post_type())->name)=="post"){} else { echo "【",esc_html(get_post_type_object(get_post_type())->label),"】"; }?>
<a class="clearfix" href="<?php the_permalink(); ?>">
<?php
  $title = get_the_title($ID);
?>
<?php echo $title ?>
</a>
</li>
<?php } ?>




<?php endwhile; ?>
<?php wp_reset_postdata(); ?>
<?php else : ?>
<?php endif; ?>
<?php wp_reset_query();?>
</ul>
</nav>
