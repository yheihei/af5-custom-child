<?php
if ( ! function_exists( 'st_child_current_page_post_ids' ) ) {
	function st_child_current_page_post_ids() {
		if ( ! is_home() && ! is_front_page() && ! is_archive() ) {
			return array();
		}

		$args = array(
			'posts_per_page' => get_option( 'posts_per_page' ),
			'paged'          => ( $paged = (int) get_query_var( 'paged' ) ) ? $paged : 1,
			'fields'         => 'ids',
		);

		if ( is_archive() ) {
			switch ( true ) {
				case is_category():
					$args['cat'] = get_queried_object_id();

					break;

				case is_tag():
					$args['tag_id'] = get_queried_object_id();

					break;

				case is_author():
					$args['author'] = get_queried_object_id();

					break;

				case is_year():
				case is_month():
				case is_day():
				case is_date():
					$args['year']     = get_query_var( 'year' ) ? (int) get_query_var( 'year' ) : null;
					$args['m']        = get_query_var( 'm' ) ? (int) get_query_var( 'm' ) : null;
					$args['monthnum'] = get_query_var( 'monthnum' ) ? (int) get_query_var( 'monthnum' ) : null;
					$args['day']      = get_query_var( 'day' ) ? (int) get_query_var( 'day' ) : null;

					break;

				case is_tax():
					$term            = get_queried_object();
					$args['term_id'] = $term->term_id;

					break;

				case is_post_type_archive():
					$args['post_type'] = get_queried_object();

					break;

				default:
					break;
			}
		}

		$wp_query = new WP_Query( $args );

		if ( $wp_query->max_num_pages <= 1 ) {
			return array();
		}

		return $wp_query->posts;
	}
}

if ( ! function_exists( 'st_child_create_random_post_filter' ) ) {
	function st_child_create_random_post_filter( array $excluded_post_ids = [] ) {
		static $filters = array();

		if ( count( $excluded_post_ids ) === 0 ) {
			return '__return_null';
		}

		$excluded_post_ids = array_unique( array_map( 'intval', $excluded_post_ids ) );

		sort( $excluded_post_ids );

		$key = hash( 'md5', __FUNCTION__ . serialize( func_get_args() ) );

		if ( array_key_exists( $key, $filters ) ) {
			return $filters[ $key ];
		}

		$filters[ $key ] = function ( WP_Query $query ) use ( $excluded_post_ids ) {
			if ( is_admin() ) {
				return;
			}

			if ( ! $query->is_home() && ! $query->is_front_page() && ! $query->is_archive() ) {
				return;
			}

			if ( ! $query->get( '_st_itiran_random_top', false ) ) {
				return;
			}

			$post__not_in = array_merge( $query->get( 'post__not_in', array() ), $excluded_post_ids );
			$post__not_in = array_unique( array_map( 'intval', $post__not_in ) );

			$query->set( 'post__not_in', $post__not_in );
		};

		return $filters[ $key ];
	}
}

add_action( 'pre_get_posts', st_child_create_random_post_filter( st_child_current_page_post_ids() ) );

$st_toprandom_query = new WP_Query( array(
	'posts_per_page' => 1,
	'orderby' => 'rand',
	'post__not_in' => get_option('sticky_posts'),
	'_st_itiran_random_top' => true,
));

if( $st_toprandom_query->have_posts()) : ?>
<?php while ($st_toprandom_query->have_posts())  : $st_toprandom_query->the_post(); ?>
<div class="st-top-box st-fist-post st-fist-post-random">
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
