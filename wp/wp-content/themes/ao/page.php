<?php
/*
Template Name: 固定ページ用テンプレート

Single Post Template: 色々排除したテンプレート
*/
?>
<?php
get_header(); ?>

<?php

if (get_root_page_name() == 'aboutus'): ?>
    <section class="article_catch article_catch_aboutus clearFix">
        <div id="article_catch_category">
            <img src="<?php
    bloginfo('template_url'); ?>/images/common/header_catch.png" alt="AO義塾とは">
            <p class="din_1451">ABOUT AOGIJUKU</p>
        </div>
        <?php
    if (get_the_title($post->post_parent)): ?>
        <h1><?php
        echo get_the_title($post->post_parent); ?><?php
    endif; ?>
        <?php
    if (is_subpage()): ?><p class="child_ttl">～<?php
        the_title(); ?>～</p><?php
    endif; ?><span><?php
    h1_keni(); ?></span></h1>
    </section>

<?php
elseif (get_root_page_name() == 'howto'): ?>
<?php /*
    <section class="article_catch article_catch_howto clearFix">
        <div id="article_catch_category">
            <img src="<?php
    bloginfo('template_url'); ?>/images/ao_examination_value/ao_examination_value_icon.png" alt="AO入試とは">
            <p class="din_1451">HOW TO AO</p>
        </div>
        <?php
    if (get_the_title($post->post_parent)): ?>
        <h1><?php
        echo get_the_title($post->post_parent); ?><?php
    endif; ?>
        <?php
    if (is_subpage()): ?><p class="child_ttl">～<?php
        the_title(); ?>～</p><?php
    endif; ?><span><?php
    h1_keni(); ?></span></h1>
    </section>
*/ ?>
<?php
elseif (get_root_page_name() == 'tankyu'): ?>
    <section class="article_catch article_catch_curriculum clearFix">
        <div id="article_catch_category">
            <img src="<?php
    bloginfo('template_url'); ?>/images/curriculum/curriculum_rogo.png" alt="探求プログラム">
            <p class="din_1451">EXPLORATION</p>
        </div>
        <?php
    if (get_the_title($post->post_parent)): ?>
        <h1><?php
        echo get_the_title($post->post_parent); ?><?php
    endif; ?>
        <?php
    if (is_subpage()): ?><p class="child_ttl">～<?php
        the_title(); ?>～</p><?php
    endif; ?><span><?php
    h1_keni(); ?></span></h1>
    </section>

<?php
elseif (get_root_page_name() == 'contributions'): ?>
    <section class="article_catch article_catch_contributions clearFix">
        <div id="article_catch_category">
            <img src="<?php
    bloginfo('template_url'); ?>/images/common/header_catch.png" alt="学費について">
            <p class="din_1451">CONTRIBUTIONS</p>
        </div>
        <?php
    if (get_the_title($post->post_parent)): ?>
        <h1><?php
        echo get_the_title($post->post_parent); ?><?php
    endif; ?>
        <?php
    if (is_subpage()): ?><p class="child_ttl">～<?php
        the_title(); ?>～</p><?php
    endif; ?><span><?php
    h1_keni(); ?></span></h1>
    </section>

<?php
elseif (get_root_page_name() == 'system'): ?>
<?php /*
    <section class="article_catch article_catch_curriculum clearFix">
        <div id="article_catch_category">
            <img src="<?php
    bloginfo('template_url'); ?>/images/curriculum/curriculum_rogo.png" alt="カリキュラム">
            <p class="din_1451">SYSTEM</p>
        </div>
        <?php
    if (get_the_title($post->post_parent)): ?>
        <h1><?php
        echo get_the_title($post->post_parent); ?><?php
    endif; ?>
        <?php
    if (is_subpage()): ?><p class="child_ttl">～<?php
        the_title(); ?>～</p><?php
    endif; ?><span><?php
    h1_keni(); ?></span></h1>
    </section>
<?php
elseif (get_root_page_name() == 'ao-notice'): ?>
    <section class="article_catch article_catch_curriculum clearFix">
        <div id="article_catch_category">
            <img src="<?php
    bloginfo('template_url'); ?>/images/curriculum/curriculum_rogo.png" alt="カリキュラム">
            <p class="din_1451">AO NOTICE</p>
        </div>
        <?php
    if (get_the_title($post->post_parent)): ?>
        <h1><?php
        echo get_the_title($post->post_parent); ?><?php
    endif; ?>
        <?php
    if (is_subpage()): ?><p class="child_ttl">～<?php
        the_title(); ?>～</p><?php
    endif; ?><span><?php
    h1_keni(); ?></span></h1>
    </section>

<?php
elseif (get_root_page_name() == 'company'): ?>
    <section class="article_catch article_catch_company clearFix">
        <div id="article_catch_category">
            <img src="<?php
    bloginfo('template_url'); ?>/images/company/company_icon.png" alt="企業情報">
            <p class="din_1451">COMPANY PROFILE</p>
        </div>
        <?php
    if (get_the_title($post->post_parent)): ?>
        <h1><?php
        echo get_the_title($post->post_parent); ?><?php
    endif; ?>
        <?php
    if (is_subpage()): ?><p class="child_ttl">～<?php
        the_title(); ?>～</p><?php
    endif; ?><span><?php
    h1_keni(); ?></span></h1>
    </section>
*/ ?>

<?php
elseif (get_root_page_name() == 'contact'): ?>
    <section class="article_catch article_catch_contact clearFix">
        <div id="article_catch_category">
            <img src="<?php
    bloginfo('template_url'); ?>/images/contact/contact_icon.png" alt="コンタクトアイコン">
            <p class="din_1451">CONTACT</p>
        </div>
        <?php
    if (get_the_title($post->post_parent)): ?>
        <h1><?php
        echo get_the_title($post->post_parent); ?><?php
    endif; ?>
        <?php
    if (is_subpage()): ?><p class="child_ttl">～<?php
        the_title(); ?>～</p><?php
    endif; ?><span><?php
    h1_keni(); ?></span></h1>
    </section>

<?php
elseif (get_root_page_name() == 'entry'): ?>

<!--
    <section class="article_catch article_catch_contact clearFix">
        <div id="article_catch_category">
            <img src="<?php
    bloginfo('template_url'); ?>/images/contact/contact_icon.png" alt="コンタクトアイコン">
            <p class="din_1451">Entry</p>
        </div>
        <h1><p class="child_ttl"><?php the_title(); ?><span><?php h1_keni(); ?></span></h1>
    </section>
-->
<?php
elseif (get_root_page_name() == 'entry-sate'): ?>
    <section class="article_catch article_catch_contact clearFix">
        <div id="article_catch_category">
            <img src="<?php
    bloginfo('template_url'); ?>/images/contact/contact_icon.png" alt="コンタクトアイコン">
            <p class="din_1451">Entry</p>
        </div>
        <?php
    if (get_the_title($post->post_parent)): ?>
        <h1><?php
        echo get_the_title($post->post_parent); ?><?php
    endif; ?>
        <?php
    if (is_subpage()): ?><p class="child_ttl">～<?php
        the_title(); ?>～</p><?php
    endif; ?><span><?php
    h1_keni(); ?></span></h1>
    </section>
<?php
elseif (get_root_page_name() == 'entry-camp'): ?>
    <section class="article_catch article_catch_contact clearFix">
        <div id="article_catch_category">
            <img src="<?php
    bloginfo('template_url'); ?>/images/contact/contact_icon.png" alt="コンタクトアイコン">
            <p class="din_1451">Entry</p>
        </div>
        <?php
    if (get_the_title($post->post_parent)): ?>
        <h1><?php
        echo get_the_title($post->post_parent); ?><?php
    endif; ?>
        <?php
    if (is_subpage()): ?><p class="child_ttl">～<?php
        the_title(); ?>～</p><?php
    endif; ?><span><?php
    h1_keni(); ?></span></h1>
    </section>

<?php
elseif (get_root_page_name() == 'school'): ?>
    <section class="article_catch article_catch_school clearFix">
        <div id="article_catch_category">
            <img src="<?php
    bloginfo('template_url'); ?>/images/school/location.png" alt="AO義塾教室案内">
            <p class="din_1451">SCHOOL GUIDANCE</p>
        </div>
        <h1><?php
    the_title(); ?><span><?php
    h1_keni(); ?></span></h1>
    </section>

<?php
elseif (get_root_page_name() == 'school-st'): ?>
    <section class="article_catch article_catch_school clearFix">
        <div id="article_catch_category">
            <img src="<?php
    bloginfo('template_url'); ?>/images/school/location.png" alt="AO義塾サテライト校舎">
            <p class="din_1451">SCHOOL GUIDANCE</p>
        </div>
        <h1><?php
    the_title(); ?><span><?php
    h1_keni(); ?></span></h1>
    </section>



<?php
elseif (get_root_page_name() == 'message'): ?>
    <section class="article_catch article_catch_profile clearFix">
        <div id="article_catch_category">
            <img src="<?php
    bloginfo('template_url'); ?>/images/profile/profile.png" alt="塾長紹介">
            <p class="din_1451">PROFILE</p>
        </div>
        <?php
    if (get_the_title($post->post_parent)): ?>
        <h1><?php
        echo get_the_title($post->post_parent); ?><?php
    endif; ?>
        <?php
    if (is_subpage()): ?><p class="child_ttl">～<?php
        the_title(); ?>～</p><?php
    endif; ?><span><?php
    h1_keni(); ?></span></h1>
    </section>

<?php
else: ?>

<?php
endif; ?>

<?php /*
<div id="breadcrumbs">
<ol class="clearfix">
<?php
the_breadcrumbs(); ?>
</ol>
</div>
*/ ?>

<!--▽メインコンテンツ-->
<div id="main-contents">

<?php

if (have_posts()): ?>

<?php
    while (have_posts()):
        the_post(); ?>

<div class="post">

<div class="contents clearfix">
    <div class="article">
    <?php
        the_content(); ?>
    </div>
</div>

</div><!--/post-->


<?php
    endwhile; ?>

<?php
    relation_keni();
    pager_keni();
else: ?>

<h2>お探しの記事は見つかりませんでした。</h2>
<div class="contents">
<p>検索キーワードを変更し下記より再検索してください。</p><br />
<?php
    get_search_form(); ?>


</div>

<?php
endif; ?>


</div>
<!--△メインコンテンツ-->



<?php

if (is_page('message')): ?>
<!--message blog-->
<div class="inner880">
    <h2 class="article_h2"><span>塾長BLOG</span></h2>
<?php
    $args = array(
        'posts_per_page' => 5,
        'cat' => '1'
    );
?>

<?php
    $the_query = new WP_Query($args); ?>
<?php
    if ($the_query->have_posts()):
        while ($the_query->have_posts()):
            $the_query->the_post(); ?>

    <article class="blog-bx clearfix">
        <div class="blog-left">
            <?php
            the_post_thumbnail(array(
                150,
                150
            )); ?>
        </div>
        <div class="blog-right">
            <ul>
                <li class="blog-time"><span class="blog-time-box"><?php
            the_time('Y.m.d'); ?></span></li>
                <li class="blog-ttl"><a class="blog-ttl-box" href="<?php
            the_permalink(); ?>"><?php
            the_title(); ?></a></li>
                <li class="blog-text"><?php
            echo mb_substr(strip_tags($post->post_content) , 0, 120); ?>・・・<a href="<?php
            the_permalink(); ?>">続きを読む</a></li>
                <div class="fl-c"></div>
            </ul>       
        </div>

    </article>

<?php
        endwhile; ?>
<div class="blog-button"><a href="<?php
        echo get_category_link('11'); ?>">ブログ一覧はこちら</a></div>
<?php
        wp_reset_postdata(); ?>
<?php
    else: ?>
<p class="no-blog">只今準備中です。</p>
<?php
    endif; ?>

</div><!--inner880-->


<?php
else: ?>
<?php
endif; ?>

<?php

if (is_page(array(
    300,
    81,
    204,
    209,
    211,
    121,
    330,
    332,
    327,
    325,
    335,
    338,
    342,
    345,
    119,
    375,
    213,
    223,
    215,
    234,
))): ?>
<nav class="child_page_nav">
    <div class="inner880">
        <h2 class="parent_title"><?php
    echo get_the_title($post->post_parent); ?></h2>

        <ul class="child_page_list clearfix">
            <?php // そのページが属する親子全て表示
    $ancestor = array_pop(get_post_ancestors($post->ID));
    if ($ancestor)
        {
        $parent = $ancestor;
        }
      else
        {
        $parent = $post->ID;
        }

    $children = wp_list_pages("depth=1&title_li=&child_of=" . $parent . "&echo=0&sort_column=menu_order");
    if ($children)
        {
        echo '<li><a href="' . get_permalink($parent) . '">' . esc_html(get_the_title($parent)) . "</a></li>";
        echo "<li>" . $children . "</li>";
        }

?>

        </ul>
    </div>
</nav>
<?php
else: ?>

<?php
endif; ?>



<?php
get_footer(); ?>