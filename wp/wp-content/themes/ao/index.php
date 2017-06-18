<?php
/*
Template Name: トップページ用テンプレート
*/
?>
<?
	wp_enqueue_script('pagejs', get_bloginfo("template_directory").'/js/index.js', array('jquery'), true, true );
?>

<?php get_header(); ?>

<section class="index_catch clearFix">
	<p><img src="<?php bloginfo('template_url'); ?>/images/index/catchcopy.png"　alt="AO義塾｜志を抱く、場所となる"></p>
    <h1>AO入試をきっかけに、人生は変わる。<br />日本の未来を担う若者が集う志塾</h1>


</section>


    <?php
        the_content(); ?>


<?php /*
▼スマホ向けのソースコード */ ?>

<section id="feature" class="c-coverline01 topshadow slim c-smponly">

<? /*
    <section id="featured-news" class="c-linkedinpage">
        <h2 class="c-headline01">無料体験受付中の講座<span class="c-headline01_subtext">FREE TRIAL</span></h2>
        <?php
        query_posts( array(
            'post_type' => 'any',
            'posts_per_page' => 5,
            'tag'  => 'trial',
        ) ); ?>
		<?php get_template_part( 'articlelist' ); ?>
    </section>
*/ ?>
    <section id="featured-course" class="c-linkedinpage">
		<h2 class="c-headline01">キャンペーン情報<span class="c-headline01_subtext">CAMPAIGN</span></h2>

<ul>
<li><a href="http://aogijuku.com/medical-mita">【医学部合格率88%】AO義塾メディカル三田キャンプ開校！</a></li>
<li><a href="http://aogijuku.com/horizon">【ハーバード大合格者輩出！】AO義塾海外大進学コース</a></li>
</ul>

		<?php get_template_part( 'featuredcourse' ); ?>
    </section>


    <section id="topnews" class="c-linkedinpage">
        <h2 class="c-headline01">AO義塾からのお知らせ<span class="c-headline01_subtext">NEWS</span></h2>
        <?php
        query_posts( array(
            'post_type' => 'any',
            'posts_per_page' => 50,
            'tag'  => 'topnews',
        ) ); ?>
        <?php get_template_part( 'articlelist' ); ?>
    </section>

</section>


<?php /*
▼PC向けのソースコード
*/ ?>

<section id="feature" class="c-coverline03 midmargin topshadow c-pconly c-2col_wrap clearfix">
	<div class="c-2col">

<? /*
        <section id="featured-news" class="c-linkedinpage">
            <h2 class="c-headline01">無料体験受付中の講座<span class="c-headline01_subtext">FREE TRIAL</span></h2>
            <?php
            query_posts( array(
                'post_type' => 'any',
                'posts_per_page' => 50,
                'tag'  => 'trial',
            ) ); ?>
            <?php get_template_part( 'articlelist' ); ?>
        </section>
*/ ?>

        <section id="featured-course" class="c-linkedinpage">
            <h2 class="c-headline01">キャンペーン情報<span class="c-headline01_subtext">CAMPAIGN</span></h2>
<nav class="p-article_list">
<ul>
<li><a href="http://aogijuku.com/medical-mita">【医学部合格率88%】AO義塾メディカル三田キャンプ開校！</a></li>
<li><a href="http://aogijuku.com/horizon">【ハーバード大合格者輩出！】AO義塾海外大進学コース</a></li>
</ul>
</nav>
            <?php get_template_part( 'featuredcourse' ); ?>
        </section>

	</div>
	<div class="c-2col">

        <section id="topnews">
	    <h2 class="c-headline01">AO義塾からのお知らせ<span class="c-headline01_subtext">NEWS</span></h2>
            <?php
            query_posts( array(
                'post_type' => 'any',
                'posts_per_page' => 10,
                'tag'  => 'topnews',
            ) ); ?>
            <?php get_template_part( 'articlelist' ); ?>
        </section>

	</div>

</section>

<div class="clearfix">
	<section id="top_content_01">
				<div class="inner_content_01">
					<div class="graduating_class">
					<p class="graduating_class_headline">［6期生/AO推薦による合格者］</p>
					</div>
					<div class="results_number">
						<p>合格<span class="din_1451">153</span><span class="unit">名<span class="results_number_notes">(慶應大)</span></span></p>
						<p>慶應法学部･SFC合格者数No.1
					</div>
					<div class="results_graph">
						<img src="<?php bloginfo('template_url'); ?>/images/index/top_graph.png" alt="AO義塾6期生合格実績">
					</div>
					<div class="link_area c-pconly">
						<a class="" href="<?php bloginfo('url'); ?>/results"><img src="<?php bloginfo('template_url'); ?>/images/common/arrow.png">もっと詳しく</a>

					</div>
				</div>
	</section>

    <section id="top_content_02" class="adjust-margin c-pconly">
    <h2><!-- AO義塾は、21世紀を代表する<br>ソーシャルビジネスカンパニーを目指します。 -->
    ｢もっといい大学に行きたい｡｣
    <br><span class="content-smalltxt">あなたがそう思ったなら､いつどんなタイミングでも､<br>
    AO義塾を始めることができます｡</span></h2>
    <div class="link_area">
    <a class="" href="<?php bloginfo('url'); ?>/feature"><img src="<?php bloginfo('template_url'); ?>/images/common/arrow.png">AO義塾の特徴･仕組み</a>
    </div>
    <!--<div id="top_content_02_button_wrapper" class="clearfix">
    <h2 class="top_content_02_button_1"><a href="#"><img src="<?php bloginfo('template_url'); ?>/images/common/arrow.png">推薦文</a></h2>
    <h2 class="top_content_02_button_2"><a href="<?php bloginfo('url'); ?>/contributions/scholarship"><img src="<?php bloginfo('template_url'); ?>/images/common/arrow.png">あおぎ奨学金</a></h2>
    </div>-->
    </section>
</div>



<section class="university-link c-coverline01">
    <div class="inner880">
    <div class="p-article_wrap">
	    <h2>あなたの合格したい大学はどこですか？</h2>
    </div>
    <div class="howto-box1">
    <div class="howto-box1-in">
    <ul>
    <li class="left-box even"><a href="./gogaku">海外の大学について</a></li>
    <li class="right-box odd"><a href="./tokyo">東京大学</a></li>
    <li class="left-box even"><a href="./keio">慶應義塾大学</a></li>
    <li class="right-box odd"><a href="./waseda">早稲田大学</a></li>
    <li class="left-box even"><a href="./chuo">中央大学</a></li>
    <li class="right-box odd"><a href="./sophia">上智大学</a></li>
    <li class="left-box even"><a href="./osaka">大阪大学</a></li>
    <li class="right-box odd"><a href="./other">その他大学 AO入試対策</a></li>
    <div class="fl-c"></div>
    </ul>
    </div>
    </div>
    </div>
</section>

<section class="university-link c-coverline01">
    <div class="inner880">
    <div class="p-article_wrap">
	    <h2>世界中どこでも受講可能！あなたはどこで受講する？</h2>
    </div>
    <div class="howto-box1">
    <div class="howto-box1-in">
    <ul>
<li class="left-box even"><a href="./yoyogi">代々木キャンプ</a></li>
<li class="right-box odd"><a href="./jiyugaoka">自由が丘キャンプ</a></li>
<li class="left-box even"><a href="./kichijoji">吉祥寺キャンプ</a></li>
<li class="right-box odd"><a href="./yokohama">横浜キャンプ</a></li>
<li class="left-box even"><a href="./kashiwa">柏キャンプ</a></li>
<li class="right-box odd"><a href="./medical-mita">メディカル三田キャンプ</a></li>
<li class="left-box even"><a href="./aobadai">青葉台キャンプ</a></li>
<li class="right-box odd"><a href="./system/skype">遠隔Skype授業</a></li>
<li class="left-box even"><a href="./school-st">サテライト校</a></li>
    <div class="fl-c"></div>
    </ul>
    </div>
    </div>
    </div>
</section>


<nav id="sp_tab_nav">
	<ul class="nottransition sp_tab_nav_button">
		<li class="selected"><a menu="#sp_tab_nav_box1">AO義塾とは</a></li>
		<li><a menu="#sp_tab_nav_box2">AO義塾で学ぶ</a></li>
		<li><a menu="#sp_tab_nav_box3">合格実績</a></li>
	</ul>
	<div id="sp_tab_nav_field">
		<div id="sp_tab_nav_box1" class="selected_box">
			<ul class="clearfix">
				<li>
					AO義塾はAO入試の対策を専門とした学習塾です
				</li>
				<li>
					<a href="<?php bloginfo('url'); ?>/aboutus"><span>AO義塾について</a>
				</li>
				<li>
					<a href="<?php bloginfo('url'); ?>/aboutus/saiki">塾長メッセージ</a>
				</li>
				<li>
					<a href="<?php bloginfo('url'); ?>/aboutus/vision2020">21世紀の教育の姿</a>
				</li>
				<li>
					<a href="<?php bloginfo('url'); ?>/access">アクセス</a>
				</li>
			</ul>
		</div>
		<div id="sp_tab_nav_box2">
			<ul>
				<li>
					AO義塾は新しい塾生を募集しています
				</li>
				<li>
					<a href="<?php bloginfo('url'); ?>/curriculum">カリキュラム</a>
				</li>
				<li>
					<a href="<?php bloginfo('url'); ?>/contributions">学費について</a>
				</li>
				<li>

				</li>
			</ul>
		</div>
		<div id="sp_tab_nav_box3">
			<ul>
				<li>
					難関大学のAO入試対策で２年連続・全国No.1
				</li>
				<li>
					<a href="<?php bloginfo('url'); ?>/result">合格実績</a>
				</li>
				<li>
					<a href="<?php bloginfo('url'); ?>/voice">合格者の声</a>
				</li>
			</ul>
		</div>
	</div>
</nav>


<section class="about_sec clearfix">
	<div class="din_1451">ABOUT</div>
	<div class="title-sub">AO義塾は、21世紀を代表する<br>ソーシャルビジネスカンパニーを目指します。</div>
	<a href="<?php bloginfo('url'); ?>/howto"><img src="<?php bloginfo('template_url'); ?>/images/index/index_content_04_arrow.png" width="17px" height="17px">AO入試についてもっと知る</a>
	<a href="<?php bloginfo('url'); ?>/aboutus"><img src="<?php bloginfo('template_url'); ?>/images/index/index_content_04_arrow.png" width="17px" height="17px">AO義塾についてもっと知る</a>
</section>

<section class="sohatsu clearfix">
	<div class="sohatsu__content clearfix">
		<img class="sohatsu__content__img clearfix" src="<?php bloginfo('template_url'); ?>/images/campaign/catch_h1_logo.png" width="90" alt="探求プログラム">
		<div class="sohatsu__content__text clearfix">
			<h2>社会問題を発見し、<br>ロールモデルに出会い、<br>自ら実践するプログラム</h2>
		</div>
		<a href="<?php bloginfo('url'); ?>/tankyu"><img src="<?php bloginfo('template_url'); ?>/images/index/index_content_04_arrow.png" width="17px" height="17px">探求プログラムについてもっと見る</a>
	</div>
</section>
<section class="result_section">
  <div id="result_content" class="inner880">
		<div class="result_content_top">
			<h1>5期生合格おめでとう！</h1>
			<h2>― 十人十色の志が、明るい未来を創造していきますように ―</h2>
			<p>塾長 斎木陽平</p>
		</div>
		<div class="result_content_middle">
			<div class="catch_center">
				<p style="line-height:1.4em" class="univ">東京大学 推薦入試<br>合格者数</p>
				<p class="number"><span>14</span>名</p>
				<p class="per" style="font-size:14px !important;">5.5人に1人がAO義塾生</p>
			</div>
			<div class="catch_center_bottom clearfix">
				<div class="catch_left">
					<p class="univ">慶應義塾大学<br>法学部FIT入試</p>
					<p class="number"><span>74</span>名</p>
					<p class="per">全合格者に占める割合<br>160名中46.3%</p>
				</div>
				<div class="catch_right">
					<p class="univ">慶應義塾大学<br>SFCAO入試</p>
					<p class="number"><span>42</span>名</p>
					<p class="per">全合格者に占める割合<br>200名中21%</p>
				</div>
			</div>
		</div>
		<div class="result_bottom clearfix">
			<div class="result_bottom_left">
<dl class="clearfix">
  <dt>慶應義塾大学　文学部　自主推薦応募</dt>
  <dd><span>2</span>名</dd>
  <dt>慶應義塾大学　SFC 一般入試</dt>
  <dd><span>4</span>名</dd>
  <dt>早稲田大学　政治経済学部 グローバル入試</dt>
  <dd><span>2</span>名</dd>
  <dt>早稲田大学　国際教養学部　AO入試</dt>
  <dd><span>1</span>名</dd>
  <dt>九州大学 21世紀プログラム AO入試</dt>
  <dd><span>1</span>名</dd>
  <dt>高知大学 人文社会学部 推薦入試</dt>
  <dd><span>1</span>名</dd>
  <dt>愛媛大学　社会共創学部　推薦入試</dt>
  <dd><span>2</span>名</dd>
  <dt>中央大学　法学部　自己推薦入試</dt>
  <dd><span>６</span>名</dd>
  <dt>中央大学　法学部　 英語運用能力利用入試</dt>
  <dd><span>1</span>名</dd>
  <dt>中央大学　経済学部　中国語利用入試</dt>
  <dd><span>1</span>名</dd>
  <dt>上智大学 法学部 公募制推薦入試</dt>
  <dd><span>2</span>名</dd>
  <dt>上智大学 国際教養学部 公募制推薦入試</dt>
  <dd><span>1</span>名</dd>
  <dt>東洋大学　経済学部　AO入試</dt>
  <dd><span>1</span>名</dd>
  <dt>同志社　商学部　AO入試</dt>
  <dd><span>3</span>名</dd>
  <dt>立教大学　法学部　自由選抜入試</dt>
  <dd><span>1</span>名</dd>
  <dt>立教大学　現代心理学部　自由選抜入試</dt>
  <dd><span>2</span>名</dd>
  <dt>立教大学　経営学部　自由選抜入試</dt>
  <dd><span>2</span>名</dd>
  <dt>立教大学　社会福祉学部　自由選抜入試</dt>
  <dd><span>1</span>名</dd>
  <dt>立教大学　コミュニティ福祉学部　自由選抜入試</dt>
  <dd><span>1</span>名</dd>
  <dt>海外大学への進学</dt>
  <dd><span>3</span>名</dd>
</dl>
			</div>
		</div>

	</div>
</section>




<section class="result_archive index_result_archive">


	<?php
	$args = array(
	     'post_type' => 'voice',
	     'posts_per_page' => 6,
	     'orderby' => 'rand',
	     'post_status' => 'publish'
	); ?>
	<?php $my_posts = get_posts( $args ); ?>

	<?php global $post;
	     foreach ( $my_posts as $post ) :
	     setup_postdata( $post ); ?>

	<article>
		<a href="<?php the_permalink(); ?>" class="card">

			<?php if(has_post_thumbnail()): ?>
				<?php the_post_thumbnail('thumb_result'); ?>
			<?php endif; ?>

			<div class="info">
				<aside><?php if(post_custom('whenGraduates')): ?><?php echo post_custom('whenGraduates'); ?>期生<?php endif; ?></aside>
				<h3><?php if(mb_strlen($post->post_title)>30) { $title= mb_substr($post->post_title,0,30) ; echo $title. ･･･ ;} else {echo $post->post_title;}?></h3>
				<dl class="clearfix">
					<?php if(post_custom('graduateHighschool')): ?>
						<dt>高校：</dt>
						<dd><?php echo post_custom('graduateHighschool'); ?></dd>
					<?php endif; ?>

					<?php if(post_custom('examination')): ?>
						<dt>入試：</dt>
						<dd><?php echo post_custom('examination'); ?></dd>
					<?php endif; ?>

					<?php if(post_custom('passedUniv')): ?>
						<dt>大学：</dt>
						<dd><?php echo post_custom('passedUniv'); ?></dd>
					<?php endif; ?>

					<?php if(post_custom('faculty')): ?>
						<dt>学部：</dt>
						<dd><?php echo post_custom('faculty'); ?></dd>
					<?php endif; ?>
				</dl>
			</div>
		</a>
	</article>

	<?php endforeach; ?>
	<?php wp_reset_postdata(); ?>

	<div class="clearfix"></div>
</section>

    <section id="topnews" class="c-coverline03 slim c-linkedinpage" style="margin-top:-100px;">
	<div class="inner880">
        <h2 class="c-headline01">更新情報<span class="c-headline01_subtext">What's NEW</span></h2>
        <?php
        query_posts( array(
            'post_type' => 'any',
                'posts_per_page' => 10,
                'tag'  => 'topnews',
        ) ); ?>
    
    
    <nav class="p-article_list">
    <ul>
    <?php if ( have_posts()): ?>
    <?php while (have_posts()) : the_post(); ?>
    	<li>
        <span class="c-smpblock"><?php echo get_post_time('Y/m/d'); ?></span>        
        <a class="clearfix" href="<?php the_permalink(); ?>">
            <?php
                $title = get_the_title($ID);
            ?>
            <?php echo $title ?>
        </a>
        </li>
    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>
    <?php else : ?>
    <?php endif; ?>
    <?php wp_reset_query();?> 
    </ul>
    </nav>
</div>
    </section>

<?php get_footer(); ?>
