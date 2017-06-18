<?php
/*
Single Post Template: 東京大学推薦入試合格物語テンプレート
*/
?>


<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<!doctype html>
<html>
<head>
  <?php
    if($posts): foreach($posts as $post): setup_postdata($post);
  ?>
  <meta charset="utf-8">
  <meta property="og:title" content="<?php the_title(); ?>" />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="<?php the_permalink( $post ); ?>" />
  <?php
if (is_single() or is_page()){//投稿記事か固定ページ
if (has_post_thumbnail()){//アイキャッチがある場合
$image_id = get_post_thumbnail_id();
$image = wp_get_attachment_image_src($image_id, 'full');
echo '<meta property="og:image" content="'.$image[0].'">';echo "\n";
} elseif( preg_match( '/<img.*?src=(["\'])(.+?)\1.*?>/i', $post->post_content, $imgurl ) && !is_archive()) {//アイキャッチ以外の画像がある場合
echo '<meta property="og:image" content="'.$imgurl[2].'">';echo "\n";
} else {//画像が1つも無い場合
echo '<meta property="og:image" content="○○○○">';echo "\n"; //画像が1つも無い場合に表示する画像URL
}
} else { //ホーム・カテゴリーページなど
echo '<meta property="og:image" content="○○○○">';echo "\n"; //画像が1つも無い場合に表示する画像URL
}
?>
  <meta property="og:site_name"  content="<?php the_title(); ?>" />
  <meta property="og:description" content="<?php the_field('category-text') ?>" />
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:site" content="@ao_fit" />
  <meta name="twitter:title" content="<?php the_title(); ?> | AO義塾">
  <meta name="twitter:text:description" content="<?php the_field('category-text') ?>" />
  <?php
if (is_single() or is_page()){//投稿記事か固定ページ
if (has_post_thumbnail()){//アイキャッチがある場合
$image_id = get_post_thumbnail_id();
$image = wp_get_attachment_image_src($image_id, 'full');
echo '<meta name="twitter:image" content="'.$image[0].'">';echo "\n";
} elseif( preg_match( '/<img.*?src=(["\'])(.+?)\1.*?>/i', $post->post_content, $imgurl ) && !is_archive()) {//アイキャッチ以外の画像がある場合
echo '<meta name="twitter:image" content="'.$imgurl[2].'">';echo "\n";
}
}
?>
  <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
  <meta name="viewport" content="initial-scale=1">
  <title><?php the_title(); ?></title>
  <?php endforeach; endif; ?>
  <link href="<?php bloginfo('template_url'); ?>/todai-stylesheets/all.css" rel="stylesheet" type="text/css" />
  <script src="<?php bloginfo('template_url'); ?>/todai-stylesheets/jquery-3.2.1.min.js" type="text/javascript"></script>
  <script src="<?php bloginfo('template_url'); ?>/todai-stylesheets/contents-remover.js" type="text/javascript"></script>
  <link rel="shortcut icon" type="image/x-icon" href="http://aogijuku.com/wp-content/themes/ao/images/common/favicon.ico">
  <!-- GA -->
  <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-46463798-1', 'auto');
  ga('send', 'pageview');

</script>
</head>

  <body class="x02 x02_index">
    <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.8";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
    <header>
  <div class="logoarea">
    <div class="logo">
      <a href="http://aogijuku.com/">
        <img src="<?php bloginfo('template_url'); ?>/todai-stylesheets/images/nav_logo.png" />
      </a>
    </div>
  </div>
</header>


<div class="introduction">
  <div class="title-category">
    <h1>
      Interview
    </h1>
  </div>
  <div class="introduction_image-wrap">
    <?php the_post_thumbnail(); ?>
  </div>
  <div class="introduction_text-wrap">
  <time><?php echo get_the_date(); ?></time>
    <div class="share">
      <div class="facebook">
        <div class="fb-like" data-href="https://www.facebook.com/aogijuku/" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="false"></div>
      </div>
      <div class="twitter pc">
        <a class="twitter-follow-button" href="https://twitter.com/ao_fit" data-show-count="true">Follow @ao_fit</a>
        <script>
          !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
        </script>
      </div>
      <div class="twitter sp">
        <a class="twitter-follow-button" href="https://twitter.com/ao_fit" data-show-count="false">Follow @ao_fit</a>
        <script>
          !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
        </script>
      </div>
      <div class="youtube"><a target="_blank" href="https://www.youtube.com/channel/UC76vBPrC2ZE9sBjdnrT8IYw">
                <img src="<?php bloginfo('template_url'); ?>/todai-stylesheets/images/youtube.png" /></a>
      </div>
    </div>
    <div class="interview-wrap">
      <div class="overview_text">
        <p>
          <?php the_field('description'); ?>
        </p>
      </div>
    </div>
    <div class="interview-wrap border">
      <div class="introduction_person">
        <div class="textwrap">
          <div class="pic">
            <img src="<?php the_field('image-speaker');?>">
          </div>
          <p class="interviewee">
            話し手
          </p>
          <h3>
            <?php the_field('name-speaker'); ?>
          </h3>
          <p>
            <?php the_field('introduction-speaker'); ?>
          </p>
        </div>
      </div>
      <div class="introduction_person">
        <div class="textwrap">
          <div class="pic">
            <img src="<?php the_field('image-interviewer');?>">
          </div>
          <p class="interviewee">
            聞き手
          </p>
          <h3>
            <?php the_field('name-interviewer');?>
          </h3>
          <p>
            <?php the_field('introduction-interviewer');?>
          </p>
        </div>
      </div>
    </div>
    <div class="interview-wrap">
      <div class="overview_table">
        <img src="<?php bloginfo('template_url'); ?>/todai-stylesheets/images/mokuji.png" />
        <ul>
          <?php the_field('mokuji') ?>
        </ul>
      </div>
    </div>
  </div>
</div>



<div class="contents">

  <?php the_content(); ?>

  <div class="pagenation-wrap">
    <?php
    // ページングの表示
    $args = array(
        'before' => '<ul class="pagenation">',
        'after' => '</ul>',
        'link_before' => '<li>',
        'link_after' => '</li>'
    );
    wp_link_pages( $args );
    ?>
  </div>
  </div>
</div>
<?php endwhile; endif; ?>
<!--
<div class="contact-wrap">
  <div class="contact-form">
    <img src="<?php bloginfo('template_url'); ?>/todai-stylesheets/images/question.png" />
    <form action="<?php bloginfo('template_url'); ?>/todai-stylesheets/php/mail.php" method="post" id="ajax-contact-form">
      <ul>
        <li>
          <p>
            質問
          </p>
          <textarea name="message" placeholder="例)東大推薦入試は学部ごとに傾向と対策はありますか？"></textarea>
        </li>
        <li>
          <p>
            メール
          </p>
          <input type="text" name="Email" placeholder="i_will_be_todaisei@gmail.com">
        </li>
      </ul>
      <div class="button">
        <input type="submit" value="送信">
      </div>
    </form>
  </div>
</div>
-->
<div class="other-contents">
  <div class="recommend-wrap">

      <h2>おすすめ記事</h2>
      <ul>
        <?php
          $posts = get_posts('category=220,221&orderby=rand&showposts=100&post_type=any');
          global $post;
        ?>
        <?php
          if($posts): foreach($posts as $post): setup_postdata($post);
        ?>
        <li>
          <a href="<?php the_permalink( $post ); ?>">
            <?php the_post_thumbnail(); ?>
            <div class="recommend-article_textwrap">
              <h3>
                <?php the_title(); ?>
              </h3>
              <time>
                <?php echo the_date(); ?>
              </time>
              <p>
                <?php the_field('category-text') ?>
              </p>
            </div>
          </a>
        </li>
        <?php endforeach; endif; ?>
      </ul>
  </div>
  <div class="share">
    <p>
      このページが気に入ったらフォローしよう！
    </p>
    <div class="facebook">
      <div class="fb-like" data-href="https://www.facebook.com/aogijuku/" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="false"></div>
    </div>
    <div class="twitter pc">
      <a class="twitter-follow-button" href="https://twitter.com/ao_fit" data-show-count="true">Follow @ao_fit</a>
      <script>
        !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
      </script>
    </div>
    <div class="twitter sp">
      <a class="twitter-follow-button" href="https://twitter.com/ao_fit" data-show-count="false">Follow @ao_fit</a>
      <script>
        !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
      </script>
    </div>
    <div class="youtube"><a target="_blank" href="https://www.youtube.com/channel/UC76vBPrC2ZE9sBjdnrT8IYw">
            <img src="<?php bloginfo('template_url'); ?>/todai-stylesheets/images/youtube.png" /></a>
    </div>
  </div>
</div>
<footer>
  <section class="nav-to-contact sp-footer__eraseposition">
    <div class="contact-ttl din_1451">
      <p>
        CONTACT
      </p>
      <div class="contact-sub-ttl">
        <p>
          AO入試対策をAO義塾の無料体験授業で気軽に始めてみませんか。
        </p>
        <a class="footer_cv" href="http://aogijuku.com/entry-camp?page=post" title=""><img src="http://aogijuku.com/wp-content/themes/ao/images/common/mail.png">無料体験のお問い合せ・ご相談はこちらから</img></a>
      </div>
    </div>
  </section>
  <nav class="footer_nav">
    <ul>
      <li class="odd">
        <a href="http://aogijuku.com"><img src="http://aogijuku.com/wp-content/themes/ao/images/common/footer_logo.png"></a>
      </li>
      <li class="even">
        <a href="http://aogijuku.com/company">企業情報</a>
      </li>
      <li class="odd">
        <a href="http://aogijuku.com/company">採用情報</a>
      </li>
      <li class="even">
        <a href="http://aogijuku.com/company">プライバシーポリシー</a>
      </li>
      <li class="odd">
        <a href="http://aogijuku.com/contact">メディア様向けのお問い合わせ</a>
      </li>
    </ul>
    <address>©2010-2014 aogijuku.com <!-- by Edventure,inc. --></address>
  </nav>
</footer>
  </body>
</html>
