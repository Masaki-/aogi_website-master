
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
