<?php
////////////////////////////
//おすすめ記事取得処理
////////////////////////////
$define_recommend_tag_names = array(
  'ピックアップ',
);

$tags = get_tags();
$recommend_tag_ids = array();

// var_dump($tags);

foreach ( $tags as $tag ) {
  if (in_array($tag->name, $define_recommend_tag_names)) {
    // おすすめタグであった場合、tag_idを保存
    $recommend_tag_ids[] = $tag->term_id;
  }
}

if(empty($recommend_tag_ids)) {
  // おすすめタグが設定されていない場合終わり
  return;
}

$args = array(
    'tag__in' => $recommend_tag_ids, //おすすめタグのidを含む記事を表示
    'posts_per_page' => 3, //表示する件数
    'orderby' => 'date',
);
$query = new WP_Query( $args );
$count = 0;
if ($query->have_posts()) : // WordPress ループ ?>
  <?php
  while ($query->have_posts()) : $query->the_post(); // 繰り返し処理開始
    ?>
<div class="st-top-box <?php if ($count === 0) { echo 'st-fist-post'; } ?>">
  <dl>
    <a class="st-box-a" href="<?php the_permalink(); ?>"></a>
    <dt>
      <div class="st-c-ami"></div>
      <div class="st-top-time ">
        <div class="blog_info">
          <p>
            <i class="fa fa-refresh"></i><?php echo get_the_date('Y/m/d'); ?>
          </p>
        </div>
      </div>
      <p class="st-catgroup itiran-category">
        <?php
          $category = get_the_category();
          $category_name = $category[0]->name;
          $category_link = get_category_link($category[0]->cat_ID);
        ?>
        <a href="<?= $category_link ?>" title="<?= $category_name ?>" rel="category tag">
          <span class="catname st-catid3"><?= $category_name ?></span>
        </a>
      </p>
      <?php if ( has_post_thumbnail() ): // サムネイルを持っているときの処理 ?>
        <?php if ( ( trim($GLOBALS['st_child_jet_data17']) !== '' ) || ( stFirstpost() && is_front_page() && trim($GLOBALS['st_child_jet_data1']) === '' && trim($GLOBALS['st_child_jet_data3']) === '' ) ) : ?>
          <?php the_post_thumbnail( 'full' ); ?>
        <?php else: ?>
          <?php the_post_thumbnail( 'st_thumb_card' ); ?>
        <?php endif; ?>
      <?php else: ?>
        <?php if(trim($GLOBALS['stdata97']) !== ''){ ?>
          <img src="<?php echo esc_url( ($GLOBALS['stdata97']) ); ?>" alt="no image" title="no image" width="400" height="300" />
        <?php }else{ ?>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/no-img.png" alt="no image" title="no image" width="400" height="300" />
        <?php } ?>
      <?php endif; ?>
    </dt>
    <dd>
      <div class="st-cards-content">
        <div class="st-cards-content-in">
          <h3>
            <?php if( trim( $GLOBALS["st_child_jet_data15"] ) !== '' ) : the_title(); else: echo wp_trim_words( get_the_title(), 30, '...' ); endif; ?>
          </h3>
        </div>
      </div>
    </dd>
  </dl>
</div>
    
  <?php
  $count++;
  endwhile; // 繰り返し処理終了 ?>
<?php
endif;
wp_reset_postdata();
?>