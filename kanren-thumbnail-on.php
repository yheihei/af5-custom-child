<?php

$query   = isset( $query ) ? $query : $GLOBALS['wp_query'];
$classes = isset( $classes ) ? $classes : array();

$uuid = wp_generate_uuid4();

$in_feed_ad_per = max( 0, (int) trim( get_option( 'st-data216', '0' ) ) );

$show_in_feed_ad = ( ! amp_is_amp() && is_active_sidebar( 26 ) );
$show_in_feed_ad = ( $show_in_feed_ad && $in_feed_ad_per > 0 );
$postID = get_the_ID();
$koukoku_set = get_post_meta( $postID, 'koukoku_set', true );
if ( isset( $koukoku_set ) && $koukoku_set === 'yes' ):
	$show_in_feed_ad = '';
endif;

$wpp_view_limit = trim( get_option( 'st-data223', '' ) );
$wpp_view_limit = ( $wpp_view_limit !== '' ) ? (int) $wpp_view_limit : 9999;

$wpp_view_limit_label = trim( get_option( 'st-data224', '' ) );
$wpp_view_limit_label = ( $wpp_view_limit_label !== '' ) ? $wpp_view_limit_label : '殿堂';

$show_wpp_view_count = ( trim( get_option( 'st-data227', '' ) ) === 'yes' );

$default_thumbnail_url = trim( get_option( 'st-data97', '' ) );

$load_more_enabled     = ( trim( get_option( 'st-data421', '' ) ) === 'yes' );
$load_more_loading_img = get_theme_file_uri( 'images/st_loading.gif' );

$do_not_use_card_design = ( trim( get_option( 'st-child-jet-data4' ) ) === 'yes' );

$use_full_size_image = ( trim( get_option( 'st-child-jet-data17' ) ) === 'yes' );

$do_not_trim_title = ( trim( get_option( 'st-child-jet-data15' ) ) === 'yes' );

$default_classes = array(
	'kanren',
	'st-wp-viewbox',
);

$classes = array_unique( array_filter( array_merge( $default_classes, $classes ) ) );
$class   = implode( ' ', $classes );
?>

<?php if ( $do_not_use_card_design ): ?>
	<?php include TEMPLATEPATH . '/kanren-thumbnail-on.php'; ?>
<?php else: ?>
	<div id="st-magazine" class="clearfix st-magazine-k">
		<div class="<?php echo esc_attr( $class ); ?>" data-st-load-more-content
		     data-st-load-more-id="<?php echo esc_attr( $uuid ); ?>">
			<?php if ( $query->have_posts() ): $offset = _st_query_calculate_offset( $query ); ?>
				<?php while ( $query->have_posts() ): $query->the_post(); ?>
					<?php // インフィード広告 ?>
					<?php if ( $show_in_feed_ad && ( ( $offset + $query->current_post + 1 ) % $in_feed_ad_per === 0 ) ): ?>
						<div class="st-top-box st-magazine-infeed">
							<dl class="heightLine">
								<?php if ( function_exists( 'dynamic_sidebar' ) ): ?>
									<?php dynamic_sidebar( 26 ); ?>
								<?php endif; ?>
							</dl>
						</div>
					<?php endif; ?>

					<div class="st-top-box">
						<dl class="clearfix heightLine">
							<dt style="position:relative;overflow:hidden;"><a href="<?php the_permalink() ?>">

									<?php // View 数 ?>
									<?php if ( function_exists( 'wpp_get_views' ) && $show_wpp_view_count && ! amp_is_amp() ): ?>
										<?php if ( wpp_get_views( get_the_ID() ) > $wpp_view_limit ): ?>
											<div class="st-wp-views-limit">
												<span
													class="wpp-views"><?php echo esc_html( $wpp_view_limit_label ); ?></span>
											</div>
										<?php else: ?>
											<div class="st-wp-views">
												<span
													class="wpp-views"><?php echo wpp_get_views( get_the_ID() ); ?><span
														class="wpp-text">view</span></span>
											</div>
										<?php endif; ?>
									<?php endif; ?>

									<?php if ( has_post_thumbnail() ):    // サムネイルを持っているときの処理 ?>

										<?php if ( $use_full_size_image ) : ?>
											<?php the_post_thumbnail( 'full' ); ?>
										<?php else : ?>
											<?php the_post_thumbnail( 'st_thumb_card' ); ?>
										<?php endif; ?>

									<?php else: // サムネイルを持っていないときの処理 ?>

										<?php if ( $default_thumbnail_url !== '' ): ?>
											<img src="<?php echo esc_url( $default_thumbnail_url ); ?>" alt="no image"
											     title="no image" width="400" height="300"/>
										<?php else: ?>
											<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/no-img.png"
											     alt="no image" title="no image" width="400" height="300"/>
										<?php endif; ?>
									<?php endif; ?>
								</a></dt>
							<dd>
								<?php // get_template_part( 'st-single-category' );    // カテゴリー ?>
								<h5 class="kanren-t">
									<a href="<?php the_permalink(); ?>">
										<?php if ( $do_not_trim_title ): ?>
											<?php the_title(); ?>
										<?php else: ?>
											<?php echo wp_trim_words( get_the_title(), 23, '...' ); ?>
										<?php endif; ?>
									</a>
								</h5>

								<?php get_template_part( 'st-excerpt' );    // 抜粋 ?>
							</dd>
						</dl>
					</div>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			<?php else: ?>
				<p>関連記事はありませんでした</p>
			<?php endif; ?>
		</div>
	</div>

	<?php if ( ! amp_is_amp() && $load_more_enabled && _st_query_has_next_page( $query ) ): ?>
		<?php $options = wp_json_encode( _st_load_more_get_kanren_posts_options( $_post, $query ) ); ?>
		<div class="load-more-action kanren-load-more-action">
			<button class="load-more-btn" data-st-load-more="<?php echo esc_attr( $options ); ?>"
			        data-st-load-more-controls="<?php echo esc_attr( $uuid ); ?>"
			        data-st-load-more-loading-img="<?php echo esc_attr( $load_more_loading_img ); ?>">もっと読む
			</button>
		</div>
	<?php endif; ?>
<?php endif; ?>
