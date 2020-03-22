<?php
if( trim( $GLOBALS["st_child_jet_data6"] ) !== '' ) :
	$pickup_id = intval( $GLOBALS["st_child_jet_data6"] );
else:
	$pickup_id = '';
endif;

$st_toppickup_query = new WP_Query( array(
	'p' => $pickup_id,  //指定した投稿IDの記事
	'posts_per_page' => 1,
));

if( $st_toppickup_query->have_posts()) : ?>
<?php while ($st_toppickup_query->have_posts())  : $st_toppickup_query->the_post();  ?>
<div class="st-top-box st-fist-post st-fist-post-pic">
			<dl><a class="st-box-a" href="<?php the_permalink(); ?>"></a>

<dt><div class="st-c-ami"></div>
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
						<?php the_post_thumbnail( 'full' ); ?>
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
							<?php st_rumdom_picktitile(); ?><?php if( trim( $GLOBALS["st_child_jet_data15"] ) !== '' ) : the_title(); else: echo wp_trim_words( get_the_title(), 30, '...' ); endif; ?>
						</h3>

						<?php if( trim( $GLOBALS['stdata202'] ) === '' ): ?>
								<p><?php echo mb_strimwidth(get_the_excerpt(), 0, 90, "…", "UTF-8"); ?></p>
						<?php endif; ?>
						<?php if ( function_exists ('wpp_get_views') && trim($GLOBALS['stdata225']) !== '' ): ?>
							<span class="st-magazine-cat"><i class="fa fa-folder-open-o" aria-hidden="true"></i>-<?php the_category( ', ' ) ?></span>
						<?php else: ?>
						<?php endif; ?>
					</div>
				</div>

			</dd>
		</dl>
		</div>


<?php endwhile; ?>
<?php wp_reset_postdata(); ?>

<?php else : ?>
<?php endif; ?>