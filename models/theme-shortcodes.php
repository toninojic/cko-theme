<?php
/**
 * Shortcodes and AJAX endpoints.
 *
 * @package CkoTheme
 */

if ( ! function_exists( 'cko_render_news_cards' ) ) {
	/**
	 * Render news cards HTML for a query.
	 *
	 * @param WP_Query $query Query object.
	 * @return string
	 */
	function cko_render_news_cards( $query ) {
		ob_start();
		while ( $query->have_posts() ) :
			$query->the_post();
			?>
			<article <?php post_class( 'cko-news-card card reveal' ); ?>>
				<a class="cko-news-thumb" href="<?php the_permalink(); ?>">
					<?php if ( has_post_thumbnail() ) : ?>
						<?php the_post_thumbnail( 'medium_large' ); ?>
					<?php else : ?>
						<span class="cko-news-placeholder"></span>
					<?php endif; ?>
				</a>
				<div class="cko-news-content">
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 20 ) ); ?></p>
					<a class="cko-news-readmore" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Pročitaj više', 'cko-theme' ); ?></a>
				</div>
			</article>
			<?php
		endwhile;
		return ob_get_clean();
	}
}

if ( ! function_exists( 'cko_latest_news_shortcode' ) ) {
	/**
	 * Latest news shortcode.
	 *
	 * @param array<string, mixed> $atts Shortcode attributes.
	 * @return string
	 */
	function cko_latest_news_shortcode( $atts ) {
		$atts = shortcode_atts(
			array(
				'posts_per_page' => 6,
			),
			$atts,
			'cko_latest_news'
		);

		$posts_per_page = max( 1, absint( $atts['posts_per_page'] ) );
		$query          = new WP_Query(
			array(
				'post_type'      => 'post',
				'post_status'    => 'publish',
				'posts_per_page' => $posts_per_page,
				'paged'          => 1,
			)
		);

		$container_id = 'cko-news-' . wp_rand( 1000, 999999 );
		$cards_html   = cko_render_news_cards( $query );
		$max_pages    = (int) $query->max_num_pages;
		ob_start();
		?>
		<section id="<?php echo esc_attr( $container_id ); ?>" class="cko-news-shortcode" data-current-page="1" data-max-pages="<?php echo esc_attr( $max_pages ); ?>" data-posts-per-page="<?php echo esc_attr( $posts_per_page ); ?>">
			<div class="cko-news-grid"><?php echo wp_kses_post( $cards_html ); ?></div>
			<?php if ( $max_pages > 1 ) : ?>
				<div class="cko-news-actions">
					<button type="button" class="cko-load-more" data-target="<?php echo esc_attr( $container_id ); ?>"><?php esc_html_e( 'Load More', 'cko-theme' ); ?></button>
				</div>
			<?php endif; ?>
		</section>
		<?php
		wp_reset_postdata();
		return ob_get_clean();
	}
}
add_shortcode( 'cko_latest_news', 'cko_latest_news_shortcode' );

if ( ! function_exists( 'cko_ajax_load_more_posts' ) ) {
	/**
	 * AJAX load more posts.
	 */
	function cko_ajax_load_more_posts() {
		check_ajax_referer( 'cko_load_more_posts', 'nonce' );

		$page           = isset( $_POST['page'] ) ? absint( wp_unslash( $_POST['page'] ) ) : 1;
		$posts_per_page = isset( $_POST['posts_per_page'] ) ? absint( wp_unslash( $_POST['posts_per_page'] ) ) : 6;

		$query = new WP_Query(
			array(
				'post_type'      => 'post',
				'post_status'    => 'publish',
				'posts_per_page' => max( 1, $posts_per_page ),
				'paged'          => max( 1, $page ),
			)
		);

		if ( ! $query->have_posts() ) {
			wp_send_json_error( array( 'message' => __( 'No more posts.', 'cko-theme' ) ) );
		}

		$html = cko_render_news_cards( $query );
		wp_reset_postdata();

		wp_send_json_success(
			array(
				'html'      => $html,
				'has_more'  => $page < (int) $query->max_num_pages,
				'next_page' => $page + 1,
			)
		);
	}
}
add_action( 'wp_ajax_cko_load_more_posts', 'cko_ajax_load_more_posts' );
add_action( 'wp_ajax_nopriv_cko_load_more_posts', 'cko_ajax_load_more_posts' );
