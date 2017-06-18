<?php
/*
Template Name: トップページ用テンプレート
*/
?>
<?
/*	wp_enqueue_script('pagejs', get_bloginfo("template_directory").'/js/index.js', array('jquery'), true, true );*/
?>

<?php get_header(); ?>

<div class="main-bg">
	<ul class="main-bg-normal">
		<li class="even"></li>
		<li class="odd selected"></li>
		<li class="even"></li>
	</ul>
	<ul class="main-bg-blur" style="clip: rect(3673px 335px 275px 0px);">
		<li class="odd"></li>
		<li class="even selected"></li>
		<li class="odd"></li>
	</ul>
</div>


<section class="index_catch index_catch-custom">
	<p><img src="http://aogijuku.com/wp-content/themes/ao/images/index/catchcopy.png" 　alt="AO義塾｜志を抱く、場所となる"></p>
	<h1>AO入試をきっかけに、人生は変わる。<br>日本の未来を担う若者が集う志塾</h1>
</section>

<section class="about_sec about_sec-custom clearfix u-pconly">
	<a href="http://aogijuku.com/system"><img src="http://aogijuku.com/wp-content/themes/ao/images/index/index_content_04_arrow.png" width="17px" height="17px">AO義塾の特徴</a>
	<a href="http://aogijuku.com/ao"><img src="http://aogijuku.com/wp-content/themes/ao/images/index/index_content_04_arrow.png" width="17px" height="17px">AO入試とは？</a>
</section>

<nav id="sp_tab_nav">
	<div id="sp_tab_nav_field">
		<div id="sp_tab_nav_box1" class="selected_box">
			<ul class="clearfix" style="text-align:center;">
				<li class="even" style="display:none;"></li>
				<li class="odd">
					<a style="color:#444; padding-left:0;" href="http://aogijuku.com/system">▶︎ AO義塾の特徴</a>
				</li>
				<li class="even">
					<a style="color:#444; padding-left:0;" href="http://aogijuku.com/aboutus/ao">▶︎ AO入試とは？</a>
				</li>
				<li class="odd">
					<a style="color:#444; padding-left:0;" href="http://aogijuku.com/system/skype">▶︎ 在宅受講コース</a>
				</li>
				<li class="even">
					<a style="color:#444; padding-left:0;" href="http://aogijuku.com/school">▶︎ 教室案内</a>
				</li>
			</ul>
			</ul>
		</div>
	</div>
</nav>

<!--
<div class="p-article_wrap u-aligncenter">
	<h3 style="margin:0px !important; border-bottom:solid 1px #e0e0e0;">お知らせ： <a href="http://aogijuku.com/special/yoyogi-gw2017.html">▶︎【特別価格：今だけ50%OFF!】で受講できるゴールデンウィーク特別講習実施中です！</a><br class="u-smponly"> ／ <a href="#bottom">▼すべてのお知らせ</a>  </h3>
</div>
-->

<div class="c-coverline01 u-bdbtm03 slim" style="background:#f5f5f5; padding:20px 0 10px;">

	<div class="inner880 p-article_wrap">
		<a href="http://aogijuku.com/norikae_kakemochi_campaign"><img src="http://aogijuku.com/wp-content/uploads/2017/05/7e1d0e0ea6ac90803e0b53d8d2452af9.png" class="u-w100img" /></a>
	</div>

	<div class="inner880">
		<?php
			query_posts( array(
			'post_type' => 'any',
			'posts_per_page' => -1,
			'category_name' => 'campaign-active',
			) );
		?>
		<?php get_template_part( 'articlelisthasday' ); ?>
	</div>

</div>

<div class="c-coverline01 u-bdbtm03 slim">

	<div class="inner880 p-article_wrap">
		<h3>【AO義塾の合格実績】東大慶應合格者数No.1・難関大進学率86.1%</h3>
		<div class="c-belowbox">
			<p><a href="http://aogijuku.com/ao/sokuho_2017.html">▶︎ 2017年度入試 合格速報</a></p>
<!--			<p><a href="http://aogijuku.com/tokyo/eg-html.html">▶︎ 【国公立推薦入試まとめ】東京大学推薦入試合格者数10名！合格率81.8%。ほか京大農学部１名、阪大医学部１名、阪大薬学部１名合格！</a></p> -->
		</div>
	</div>
</div>

<div style="border-bottom:solid 2px #f0f0f0; text-align:left; padding:20px 0; background:#fff;">
<?php get_template_part( 'mod_school-list' ); ?>
</div>

<div class="c-coverline01 u-bdbtm03 slim">
	<div class="p-article_wrap inner880">
		<?php get_template_part( 'mod_universitylist-nankan' ); ?>
		<p style="text-align:center;">
			<a href="http://aogijuku.com/aogi-curriculum/univ#yuryokulist" class="c-btn">そのほか対応している大学の一覧を見る</a>
		</p>
	</div>
</div>

<section class="c-coverline01 u-bdbtm03 slim">
  <div class="inner880 p-article_wrap">
    <h2>AOPicks</h2>
    <?php
    //一覧情報取得
    $result = $anoteher_wpdb->get_results("
    SELECT post_title, id, guid, post_date
    FROM $anoteher_wpdb->posts
    WHERE post_type = 'post'
    AND post_status = 'publish' /* かつ公開済の記事 */
    ORDER BY post_date DESC /* 新しい順に並び替え */
    LIMIT 6
    ");


    //表示
    foreach ($result as $value) {

    $sql_for_eyecatch = "SELECT meta_value
    FROM {$anoteher_wpdb->postmeta} WHERE post_id = (SELECT meta_value FROM {$anoteher_wpdb->postmeta} WHERE post_id =
     {$value->id} AND meta_key = '_thumbnail_id') AND meta_key = '_wp_attached_file'";


    $eyecatch = $anoteher_wpdb->get_var($sql_for_eyecatch);
    $date = str_replace('-', '.', mb_substr($value->post_date, 0, 10));
    ?>
    <div class="section-picks">
      <a href="<?php echo $value->guid; ?>">
        <div class="picks">
          <div class="p-thumb">
            <img src ="http://aogijuku.com/picks/wp-content/uploads/<?php echo $eyecatch; ?>"/>
          </div>
          <div class="p-detail">
            <div class="p-title">
              <?php echo $value->post_title;?>
            </div>
            <div class="p-date">
              <?php echo $date;?>
            </div>
          </div>
        </div>
      </a>
    </div>
    <?php
    }
    ?>
    <a href="http://aogijuku.com/picks"><center class="center">view all</center></a>
  </div>
</section>

<?php /*
<section class="c-coverline01 u-bdbtm03 slim">
	<div class="inner880">
		<div class="p-article_wrap">
			<h2>大学別AO入試対策情報</h2>
			<h3>受験生必見の情報を公開</h3>
			<ul>
				<li class="left-box even">
					<a href="./keio">慶應義塾大学</a>【5年連続合格者数全国No.1】
					<ul>
						<li>
							<a href="http://aogijuku.com/keio/fit-ao.html">
								慶應法学部FIT入試について
							</a>
						</li>
						<li>
							<a href="http://aogijuku.com/keio/sfc-ao.html">
								慶應SFC(総合政策/環境情報)AO入試について
							</a>
						</li>
						<li>
							<a href="http://aogijuku.com/keio/keio-bun.html">
								慶應文学部自己推薦入試について
							</a>
						</li>
						<li>
							<a href="http://aogijuku.com/keio/keio-keizai-pearl.html">
								慶應経済学部PEARL入試について
							</a>
						</li>
					</ul>
				</li>
				<li class="right-box odd">
					<a href="./waseda">早稲田大学</a>【全員合格した学部が続出！】 <br>受験生向けに複雑化した入試方式を一覧化・解説しています</li>
				<li class="right-box odd"><a href="./tokyo">東京大学</a></li>
				<li class="right-box odd"><a href="http://aogijuku.com/hitotsubashi+">一橋大学</a></li>
				<li class="left-box even"><a href="./chuo">中央大学</a></li>
				<li class="right-box odd"><a href="./sophia">上智大学</a></li>
				<li class="left-box even"><a href="./osaka">大阪大学</a></li>
				<li class="left-box even"><a href="./yokokoku">横浜国立大学</a></li>
				<li class="left-box even"><a href="http://aogijuku.com/horizon">海外の大学</a></li>
				<li><a href="http://aogijuku.com/medical-mita">医学部のある大学</a></li>
				<li class="right-box odd"><a href="./other">その他大学 AO入試対策</a></li>
			</ul>
		</div>
	</div>
</section>
*/ ?>

<!--
<section class="c-coverline01 u-bdbtm03 slim">
	<div class="inner880">
		<div class="p-article_wrap">
			<h2>教室案内</h2>
			<h3>AO義塾は世界中どこでも受講可能！あなたはどこで受講する？</h3>
			<ul>
				<li class="left-box even"><a href="./yoyogi">代々木キャンプ</a></li>
				<li class="right-box odd"><a href="./jiyugaoka">自由が丘キャンプ</a></li>
				<li class="left-box even"><a href="./kichijoji">吉祥寺キャンプ</a></li>
				<li class="right-box odd"><a href="./yokohama">横浜キャンプ</a></li>
				<li class="right-box odd"><a href="./wasedatop">早稲田大学特進キャンプ</a></li>
				<li class="left-box even"><a href="./kashiwa">柏キャンプ</a></li>
				<li class="right-box odd"><a href="./medical-mita">メディカル三田キャンプ</a></li>
				<li class="left-box even"><a href="./aobadai">青葉台キャンプ</a></li>
				<li class="right-box odd"><a href="./system/skype">遠隔Skype授業</a></li>
				<li class="left-box even"><a href="./school-st">サテライト校</a></li>
			</ul>
		</div>
	</div>
<p></p>
</section>
-->

    <div style="padding:40px 0 10px; background-color:#f8f8f8;" class="clearfix">
		<div class="inner880">
				<div class="p-article_wrap">
			      <h2 style="margin-top:0;">更新情報</h2>
				</div>
		      <?php
		      query_posts( array(
		          'post_type' => 'any',
		              'posts_per_page' => 5,
		      ) ); ?>
					<?php get_template_part( 'articlelisthasday' ); ?>

		</div>
		<p class="u-aligncenter" style="padding:30px 0;"><a class="c-btn" href="http://aogijuku.com/allinformation">すべてのお知らせ一覧</a></p>
	</div>

<!--
<section class="c-coverline01 u-bdbtm03 slim">
	<div class="inner880 p-article_wrap">
		<h2>【特集】AO入試受験の参考になるオススメ記事</h2>

		<h3>ノウハウまとめ記事</h3>
		<ul>
			<li><a href="http://aogijuku.com/ao/activity_record.html">
				AO入試合格者に共通する 「活動実績」について ”正直に” お伝えします。</a></li>
			<li><a href="http://aogijuku.com/ao/osusume-book2017.html">
				AO義塾シェルパ陣が厳選！ AO・推薦入試を勝ち抜くためのおススメ本・サイトまとめ</a></li>
			<li><a href="http://aogijuku.com/ao/interview.html">
				面接・口頭試問で、国公立・早慶上智への最終合格をつかむには</a></li>
		</ul>
		<h3>合格者が語る、合格者と語る</h3>
		<ul>
			<li><a href="http://aogijuku.com/todai/02.html">
				地理オリンピックから東大へ。先輩が語る"面接で合格を勝ち取る最初の１分"について</a></li>
			<li><a href="http://aogijuku.com/todai/04.html">
				【一般９割、AO推薦１割】東大推薦合格に繋がった１割の準備とは？</a></li>
		</ul>
	</div>
</section>
-->

<section class="result_archive index_result_archive clearfix">
	<div class="inner880 clearfix">
		<article>
			<a href="http://aogijuku.com/voice/iida" class="card">


				<div class="info">
					<aside>5期生</aside>
					<h3>紛争の予防や停止に貢献したい</h3>
					<dl class="clearfix">

						<dt>入試：</dt>
						<dd>推薦入試</dd>

						<dt>大学：</dt>
						<dd>東京大学</dd>

						<dt>学部：</dt>
						<dd>法学部</dd>
					</dl>
				</div>
			</a>
		</article>


		<article>
			<a href="http://aogijuku.com/voice/kaishimizu" class="card">

				<img width="170" height="240" src="http://aogijuku.com/wp-content/uploads/2016/04/shimizu-170x240.jpg" class="attachment-thumb_result size-thumb_result wp-post-image" alt="" srcset="http://aogijuku.com/wp-content/uploads/2016/04/shimizu-170x240.jpg 170w, http://aogijuku.com/wp-content/uploads/2016/04/shimizu-213x300.jpg 213w, http://aogijuku.com/wp-content/uploads/2016/04/shimizu.jpg 340w" sizes="(max-width: 170px) 100vw, 170px">
				<div class="info">
					<aside>4期生</aside>
					<h3>ソーシャルイノベーションを起こす社会起業家同士のつながりの場･･･</h3>
					<dl class="clearfix">
						<dt>高校：</dt>
						<dd>国際基督教大学高等学校</dd>

						<dt>入試：</dt>
						<dd>AO入試</dd>

						<dt>大学：</dt>
						<dd>慶應義塾大学</dd>

						<dt>学部：</dt>
						<dd> 総合政策学部(2期A方式)</dd>
					</dl>
				</div>
			</a>
		</article>


		<article>
			<a href="http://aogijuku.com/voice/tei" class="card">

				<img width="170" height="240" src="http://aogijuku.com/wp-content/uploads/2016/04/tei-170x240.jpg" class="attachment-thumb_result size-thumb_result wp-post-image" alt="" srcset="http://aogijuku.com/wp-content/uploads/2016/04/tei-170x240.jpg 170w, http://aogijuku.com/wp-content/uploads/2016/04/tei-213x300.jpg 213w, http://aogijuku.com/wp-content/uploads/2016/04/tei.jpg 340w" sizes="(max-width: 170px) 100vw, 170px">
				<div class="info">
					<aside>4期生</aside>
					<h3>中国に青空を取り戻したい</h3>
					<dl class="clearfix">
						<dt>高校：</dt>
						<dd>私立高校</dd>

						<dt>入試：</dt>
						<dd>総合選抜入試・AO入試</dd>

						<dt>大学：</dt>
						<dd>早稲田大学</dd>

						<dt>学部：</dt>
						<dd>政治経済学部国際政治学科</dd>
					</dl>
				</div>
			</a>
		</article>


		<article>
			<a href="http://aogijuku.com/voice/sayakaoshima" class="card">

				<img width="170" height="240" src="http://aogijuku.com/wp-content/uploads/2016/04/oshima-170x240.jpg" class="attachment-thumb_result size-thumb_result wp-post-image" alt="" srcset="http://aogijuku.com/wp-content/uploads/2016/04/oshima-170x240.jpg 170w, http://aogijuku.com/wp-content/uploads/2016/04/oshima-213x300.jpg 213w, http://aogijuku.com/wp-content/uploads/2016/04/oshima.jpg 340w" sizes="(max-width: 170px) 100vw, 170px">
				<div class="info">
					<aside>4期生</aside>
					<h3>地域に密着した海洋保全活動を日本に定着させたい</h3>
					<dl class="clearfix">
						<dt>高校：</dt>
						<dd>私立高校</dd>

						<dt>入試：</dt>
						<dd>FIT入試</dd>

						<dt>大学：</dt>
						<dd>慶應義塾大学</dd>

						<dt>学部：</dt>
						<dd>法学部法律学科(A・B方式)</dd>
					</dl>
				</div>
			</a>
		</article>


		<article>
			<a href="http://aogijuku.com/voice/rikuyamada" class="card">


				<div class="info">
					<aside>5期生</aside>
					<h3>東大で新しいエネルギーを探る研究をしたい</h3>
					<dl class="clearfix">
						<dt>高校：</dt>
						<dd>秋田高校</dd>

						<dt>入試：</dt>
						<dd>推薦入試</dd>

						<dt>大学：</dt>
						<dd>東京大学</dd>

						<dt>学部：</dt>
						<dd>工学部（理科一類）</dd>
					</dl>
				</div>
			</a>
		</article>


		<article>
			<a href="http://aogijuku.com/voice/harunamori" class="card">

				<img width="170" height="240" src="http://aogijuku.com/wp-content/uploads/2016/04/mori-170x240.jpg" class="attachment-thumb_result size-thumb_result wp-post-image" alt="" srcset="http://aogijuku.com/wp-content/uploads/2016/04/mori-170x240.jpg 170w, http://aogijuku.com/wp-content/uploads/2016/04/mori-213x300.jpg 213w, http://aogijuku.com/wp-content/uploads/2016/04/mori.jpg 340w" sizes="(max-width: 170px) 100vw, 170px">
				<div class="info">
					<aside>4期生</aside>
					<h3>効果的に人々に情報を伝えられる人材になりたい</h3>
					<dl class="clearfix">
						<dt>高校：</dt>
						<dd>横浜雙葉高等学校</dd>

						<dt>入試：</dt>
						<dd>自主応募制推薦入試</dd>

						<dt>大学：</dt>
						<dd>慶應義塾大学</dd>

						<dt>学部：</dt>
						<dd>文学部</dd>
					</dl>
				</div>
			</a>
		</article>


		<div class="clearfix" id="bottom"></div>
	</div>
</section>

<?php get_footer(); ?>
