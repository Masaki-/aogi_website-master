<?php
if($post->post_type == 'page'){
$kousya = $post->post_name;
}else{
$kousya = $post->post_type;
}
?>

<nav class="sp-footer sp-footer--hide cover-line cover-line--d-blackfill">
<a class="btn btn--d-blue-paper btn--d-blue-paper__otherpage" target="_blank" href="#in-page-form">無料相談･体験授業に申し込む</a>
</nav>

<footer style="background:#f9f9f9; border-top:solid 1px #ccc; margin-top:30px;">
<section id="in-page-form" class="form--take-lesson sp-footer__eraseposition">
<div class="inner880">
<p style="color:#1b1a1a; padding:50px 0 20px 0; line-height:1.2em; font-size:26px; font-weight:bold; letter-spacing: 0.1em;">お申込みフォーム</p>
  <p>担当より、志望学部に応じて、席に空きのある相談会や、個別相談を24時間以内にご案内させていただきます。</p>
<a href="./contactjukusei"><strong>塾生の授業、授業契約などに関する問い合わせはこちらにお願いします→こちら</strong></a>
<div style="text-align:left;">
  <?php echo do_shortcode( '[contact-form-7 id="1146" title="無料体験のお申込みフォーム"]' ); ?>
  </div>
</div>
</section>

<div style="border-top:solid 2px #f0f0f0; background-color:#fff; text-align:left; padding:20px 0;">
<?php get_template_part( 'mod_school-list' ); ?>
</div>

<nav class="footer_nav">
<ul>
<li><a href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('template_url'); ?>/images/common/footer_logo.png"></a></li>
<li><a href="<?php bloginfo('url'); ?>/aboutus">教育理念</a></li>
<li><a href="<?php bloginfo('url'); ?>/message">塾長プロフィール</a></li>
<li><a href="<?php bloginfo('url'); ?>/company">企業情報・採用情報</a></li>
<li><a href="<?php bloginfo('url'); ?>/company">プライバシーポリシー</a></li>
<li><a href="<?php bloginfo('url'); ?>/contact">メディア様向けのお問い合わせ</a></li>
</ul>
<address>&copy;2010-2014 aogijuku.com <!-- by Edventure,inc. --></address>
</nav>


</footer>
</div>

<div style="overflow:hidden; height:0;">
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

<!-- Yahoo Code for your Target List -->
<script type="text/javascript">
/* <![CDATA[ */
var yahoo_ss_retargeting_id = 1000385489;
var yahoo_sstag_custom_params = window.yahoo_sstag_params;
var yahoo_ss_retargeting = true;
/* ]]> */
</script>
<script type="text/javascript" src="//s.yimg.jp/images/listing/tool/cv/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//b97.yahoo.co.jp/pagead/conversion/1000385489/?guid=ON&script=0&disvt=false"/>
</div>
</noscript>

<!-- User Heat Tag -->
<script type="text/javascript">
(function(add, cla){window['UserHeatTag']=cla;window[cla]=window[cla]||function(){(window[cla].q=window[cla].q||[]).push(arguments)},window[cla].l=1*new Date();var ul=document.createElement('script');var tag = document.getElementsByTagName('script')[0];ul.async=1;ul.src=add;tag.parentNode.insertBefore(ul,tag);})('//uh.nakanohito.jp/uhj2/uh.js', '_uhtracker');_uhtracker({id:'uhpl8nsY0h'});
</script>
<!-- End User Heat Tag -->
</div>
  <?php wp_footer(); ?>
</body>
</html>
