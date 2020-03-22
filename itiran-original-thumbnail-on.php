<?php if(!is_front_page() && !is_archive()): //TOPページとアーカイブ以外
	include(TEMPLATEPATH . '/itiran-thumbnail-on.php');
else: ?>
<?php
	if ( trim( $GLOBALS["stdata99"] ) !== '' ) {
		$category_ID = esc_attr( $GLOBALS["stdata99"] );
	} else {
		$category_ID = 0 ;
	}
	$args = array(
		'cat' => array($category_ID),
		'paged' => $paged
	);
	if(trim($GLOBALS['stdata214']) !== ''):
		$st_infeed = $GLOBALS['stdata214'];
	else:
		$st_infeed = '';
	endif;
	$st_infeed_count = 1;
	$st_query = new WP_Query( $args ); ?>
<div id="st-magazine" class="clearfix">
<div class="kanren">

	<?php if(trim($GLOBALS['st_child_jet_data6']) !== ''):?>
		<?php get_template_part( 'itiran-pickup-top' ); //ピックアップ ?>
	<?php elseif(trim($GLOBALS['st_child_jet_data3']) !== ''):?>
		<?php get_template_part( 'itiran-random-top' ); //ランダム ?>
	<?php endif; ?>

	<?php
	if ( $st_query->have_posts() ):
		 $post_count = 1; ?>
		<?php
		while ( $st_query->have_posts() ) : $st_query->the_post(); ?>
		<?php //インフィード広告
			if( (is_active_sidebar( 26 ) && (trim($st_infeed) !== '')) && ($st_infeed_count % $st_infeed === 0) ){ ?>
				<div class="st-top-box st-magazine-infeed">
					<dl class="heightLine">
						<?php if ( function_exists( 'dynamic_sidebar' ) && dynamic_sidebar( 26 ) ) : else : ?>
						<?php endif; ?>
					</dl>
				</div>
		<?php
		}
		$st_infeed_count ++;
		?>
		<?php if ( ( $post_count === 1 ) && is_front_page() && trim($GLOBALS['st_child_jet_data1']) === '' && trim($GLOBALS['st_child_jet_data3']) === '' && trim($GLOBALS['st_child_jet_data6']) === '') : ?>
			<div class="st-top-box st-fist-post">
				<dl><a class="st-box-a" href="<?php the_permalink(); ?>"></a>
		<?php else: ?>
			<div class="st-top-box st-continuation-post">
				<dl class="heightLine"><a class="st-box-a" href="<?php the_permalink(); ?>"></a>
		<?php endif; ?>
				<dt><div class="st-c-ami"></div>
	
				<?php if( trim($GLOBALS['st_child_jet_data18']) === '' ): ?>
					<div class="st-top-time <?php st_hidden_class(); //投稿日 ?>">
						<p>
							<?php if( $st_is_ex ): //更新日の表示確認
								$postID = $wp_query->post->ID;
								$updatewidgetset = get_post_meta( $postID, 'updatewidget_set', true );
							else:
								$updatewidgetset = '';
							endif;

							$show_published_date = ( get_option( 'st-data140', '' ) === 'yes' ); // 更新日がある場合も投稿日を表示する

							if ( ! $show_published_date && trim ( $updatewidgetset ) === '' && ( get_the_date() != get_the_modified_date() ) ) : //更新がある場合 ?>
								<i class="fa fa-refresh"></i><?php the_modified_date( 'Y/n/j' ); ?>
							<?php else: ?>
								<i class="fa fa-clock-o"></i><?php the_time( 'Y/n/j' ); ?>
							<?php endif; ?>
						</p>
					</div>
				<?php endif; ?>

				<?php //View数
				if ( function_exists ('wpp_get_views') && trim($GLOBALS['stdata225']) !== '' ):
					$st_wppview_limit = ! empty( $GLOBALS['stdata223'] ) ? $GLOBALS['stdata223'] : '9999';
					$st_wppview_limit_label = ! empty( $GLOBALS['stdata224'] ) ? $GLOBALS['stdata224'] : '殿堂';
					if((wpp_get_views(get_the_ID())) > intval($st_wppview_limit)): ?>
						<div class="st-wp-views-limit"><span class="wpp-views"><?php echo esc_html($st_wppview_limit_label);?></span></div>
					<?php else: ?>
						<div class="st-wp-views"><span class="wpp-views"><?php echo wpp_get_views ( get_the_ID() );?><span class="wpp-text">view</span></span></div>
					<?php endif;
				else:
					get_template_part( 'st-single-category' ); //カテゴリー ?
				endif; ?>

				<?php if ( has_post_thumbnail() ): // サムネイルを持っているときの処理 ?>
					<?php if ( ( trim($GLOBALS['st_child_jet_data17']) !== '' ) || ( stFirstpost() && is_front_page() && trim($GLOBALS['st_child_jet_data1']) === '' && trim($GLOBALS['st_child_jet_data3']) === '' ) ) : ?>
						<?php the_post_thumbnail( 'full' ); ?>
					<?php else: ?>
						<?php the_post_thumbnail( 'st_thumb_card' ); ?>
					<?php endif; ?>
				<?php else: // サムネイルを持っていないときの処理 ?>
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

							<?php get_template_part( 'st-excerpt' ); //抜粋 ?>
							<?php if ( function_exists ('wpp_get_views') && trim($GLOBALS['stdata225']) !== '' ): ?>
								<span class="st-magazine-cat"><i class="fa fa-folder-open-o" aria-hidden="true"></i>-<?php the_category( ', ' ) ?></span>
							<?php else: ?>
							<?php endif; ?>

						</div>
					</div>
					<?php if( trim($GLOBALS['st_child_jet_data18']) !== '' ): ?>
						<div class="st-top-time-under <?php st_hidden_class(); //投稿日 ?>">
							<p>
								<?php if( $st_is_ex ): //更新日の表示確認
									$postID = $wp_query->post->ID;
									$updatewidgetset = get_post_meta( $postID, 'updatewidget_set', true );
								else:
									$updatewidgetset = '';
								endif;

								$show_published_date = ( get_option( 'st-data140', '' ) === 'yes' ); // 更新日がある場合も投稿日を表示する

								if ( ! $show_published_date && trim ( $updatewidgetset ) === '' && ( get_the_date() != get_the_modified_date() ) ) : //更新がある場合 ?>
									<i class="fa fa-refresh"></i><?php the_modified_date( 'Y/n/j' ); ?>
								<?php else: ?>
									<i class="fa fa-clock-o"></i><?php the_time( 'Y/n/j' ); ?>
								<?php endif; ?>
							</p>
						</div>
					<?php endif; ?>
				</dd>
			</dl>
		</div>
	<?php ++$post_count;
		  endwhile;
	else: ?>
		<p>記事がありません</p>
	<?php endif; ?>
	</div>
</div>
<?php endif; ?>