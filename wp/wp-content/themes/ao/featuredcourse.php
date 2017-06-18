<?php
query_posts( array(
    'post_type' => 'post',
    'posts_per_page' => 50,
    'tag'  => 'campaign',
) ); ?>
<?php get_template_part( 'articlelist' ); ?>
    
<? /*

<h2 class="c-headline01">東大推薦2次試験”直前の総仕上げ”<span class="c-headline01_subtext">東大推薦1期生講師陣による授業・無料招待！</span></h2>
<div class="p-article_wrap small c-cardblock">
<p>下記日程にて授業を行っております。席数に限りがございますので、早めに<a href="https://goo.gl/p6ILV1">フォームよりお問い合わせ</a>ください。</p>
<ul>
<li>1日目講座 12月10日（土）10:00～21:00 代々木校</li>
<li>2日目講座 12月11日（日）10:00～17:00 代々木校</li>
<li>面接前日講座 12月16日（金）10:00～17:00 代々木校</li>
</ul>
</div>
*/ ?>