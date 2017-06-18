<?php
if($post->post_type == 'page'){
    $kousya = $post->post_name;
}else{
    $kousya = $post->post_type;
}
?>
<?php if(in_category('8')){ ?>

<nav class="sp-footer sp-footer--hide cover-line cover-line--d-blackfill">
    <a class="btn btn--d-blue-paper btn--d-blue-paper__pagelink" href="#in-page-form" title="この授業を無料体験する">無料体験授業に申し込む</a>
</nav>

<?php }elseif(is_page('entry-camp')) { ?>
<?php }elseif(is_page('entry-sate')) { ?>
<?php }else { ?>

<nav class="sp-footer sp-footer--hide cover-line cover-line--d-blackfill">
    <a class="btn btn--d-blue-paper btn--d-blue-paper__otherpage" target="_blank" href="http://aogijyuku.mexce.xyz/entry-camp">無料相談･体験授業の申し込み</a>
</nav>

<?php } ?>



<?php if(in_category('8')){ //授業告知カテゴリーでの例外処理?>
<footer style="background:#f9f9f9; border-top:solid 1px #ccc; margin-top:30px;">
    <section id="in-page-form" class="form--take-lesson sp-footer__eraseposition">
    <div class="inner880">
        <p style="color:#1b1a1a; padding:50px 0 20px 0; line-height:1.2em; font-size:26px; font-weight:bold; letter-spacing: 0.1em;">まずは下記より無料体験授業にお申込みください｡</p>
        <p>担当より席に空きのある授業を24時間以内にご案内させていただきます。</p>
        <div style="text-align:left;">
            <?php echo do_shortcode( '[contact-form-7 id="1146" title="無料体験のお申込みフォーム"]' ); ?>
        </div>
    </div>
    </section>
<footer>

<?php }elseif(is_page('entry-camp')) { ?>

<?php }else { ?>

<footer>

<section class="nav-to-contact sp-footer__eraseposition">
    <div class="contact-ttl din_1451">CONTACT</div>
    <div class="contact-sub-ttl">AO入試対策をAO義塾の無料体験授業で気軽に始めてみませんか。</div>
    <?php
    $sate = ["matsudo","mito","ochanomizu","nerima","atsugi","sugamo","shinyokohama","kanazawa","toyama","shizuoka","nigata","gifu","naganoekimae","tsu","himeji","takamatu","school-st"];
    $key = in_array($kousya, $sate);
    if ($key){
    $status = 'entry-sate';
    }else{
    $status = 'entry-camp';
    }
    ?>
    <a class="footer_cv" href="<?php bloginfo('url'); ?>/<?php echo $status;?>?page=<?php echo $kousya;?>" title="">
    <img src="<?php bloginfo('template_url'); ?>/images/common/mail.png">無料体験のお問い合せ・ご相談はこちらから
    </a>
</section>

<?php } ?>



<nav class="footer_nav">
    <ul>
        <li><a href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('template_url'); ?>/images/common/footer_logo.png"></a></li>
        <li><a href="<?php bloginfo('url'); ?>/company">企業情報</a></li>
        <li><a href="<?php bloginfo('url'); ?>/company">採用情報</a></li>
        <li><a href="<?php bloginfo('url'); ?>/company">プライバシーポリシー</a></li>
    <li><a href="<?php bloginfo('url'); ?>/contact">メディア様向けのお問い合わせ</a></li>
    </ul>
    <address>&copy;2010-2014 aogijuku.com <!-- by Edventure,inc. --></address>
</nav>

<?php if ( !is_front_page()): ?>
<div class="pagetop_button pagetop_button_hide">
    <a class="din_1451" href="#body">PAGE TOP</a>
</div>
<?php else: ?>
<?php endif; ?>

</footer>
</div>

    <!-- Tweet-btn Code -->
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
        <!-- Google+1btn Code -->
        <script type="text/javascript">
          window.___gcfg = {lang: 'ja'};

          (function() {
            var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
            po.src = 'https://apis.google.com/js/platform.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
          })();
        </script>
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 973424911;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/973424911/?guid=ON&amp;script=0"/>
</div>
</noscript>
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 973424911;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/973424911/?guid=ON&amp;script=0"/>
</div>
</noscript>
        <?php wp_footer(); ?>
</body>
</html>