<?php
/**
 * Helpers and reusable data providers.
 *
 * @package CkoTheme
 */

if ( ! function_exists( 'cko_primary_menu_fallback' ) ) {
	/**
	 * Fallback menu output.
	 */
	function cko_primary_menu_fallback() {
		echo '<ul class="menu">';
		echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'cko-theme' ) . '</a></li>';
		echo '<li><a href="' . esc_url( home_url( '/vesti/' ) ) . '">' . esc_html__( 'Vesti', 'cko-theme' ) . '</a></li>';
		echo '<li><a href="' . esc_url( home_url( '/underground/' ) ) . '">' . esc_html__( 'Underground', 'cko-theme' ) . '</a></li>';
		echo '<li><a href="' . esc_url( home_url( '/kontaktiraj-nas/' ) ) . '">' . esc_html__( 'Kontakt', 'cko-theme' ) . '</a></li>';
		echo '</ul>';
	}
}

if ( ! function_exists( 'cko_is_english_context' ) ) {
	/**
	 * Detect if current context is English variant.
	 *
	 * @return bool
	 */
	function cko_is_english_context() {
		if ( is_page() ) {
			$slug            = (string) get_post_field( 'post_name', get_queried_object_id() );
			$is_english_slug = false !== strpos( $slug, 'english' ) || '-en' === substr( $slug, -3 );
			if ( $is_english_slug ) {
				return true;
			}
		}

		$request_uri = isset( $_SERVER['REQUEST_URI'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '';
		return 0 === strpos( trim( $request_uri, '/' ), 'en/' );
	}
}

if ( ! function_exists( 'cko_guess_alt_language_page_id' ) ) {
	/**
	 * Try guessing opposite language page by slug convention.
	 *
	 * @param int  $page_id Page id.
	 * @param bool $is_en Current language context.
	 * @return int
	 */
	function cko_guess_alt_language_page_id( $page_id, $is_en ) {
		$slug = (string) get_post_field( 'post_name', $page_id );
		if ( ! $slug ) {
			return 0;
		}

		$target_slug = $is_en ? preg_replace( '/-en$/', '', $slug ) : $slug . '-en';
		if ( ! $target_slug ) {
			return 0;
		}

		$target_page = get_page_by_path( $target_slug );
		return $target_page instanceof WP_Post ? (int) $target_page->ID : 0;
	}
}

if ( ! function_exists( 'cko_get_language_toggle' ) ) {
	/**
	 * Build language switch data.
	 *
	 * Uses page custom field `cko_alt_lang_page_id` for manual SR/EN mapping.
	 *
	 * @return array{current:string,target:string,url:string}
	 */
	function cko_get_language_toggle() {
		$is_en  = cko_is_english_context();
		$url    = $is_en ? home_url( '/' ) : home_url( '/english/' );
		$target = $is_en ? 'SR' : 'EN';
		$curr   = $is_en ? 'EN' : 'SR';

		if ( is_page() ) {
			$page_id     = get_queried_object_id();
			$alt_page_id = absint( get_post_meta( $page_id, 'cko_alt_lang_page_id', true ) );

			if ( $alt_page_id && 'page' === get_post_type( $alt_page_id ) ) {
				$alt_url = get_permalink( $alt_page_id );
				if ( $alt_url ) {
					$url = $alt_url;
				}
			} else {
				$url = get_permalink( $page_id );
			}
		}

		return array(
			'current' => $curr,
			'target'  => $target,
			'url'     => esc_url( $url ),
		);
	}
}

if ( ! function_exists( 'cko_add_anchor_navigation_to_content' ) ) {
	/**
	 * Add anchor navigation for selected pages based on H2 headings.
	 *
	 * @param string $content Page content.
	 * @return string
	 */
	function cko_add_anchor_navigation_to_content( $content ) {
		if ( is_admin() || ! is_page() || ! in_the_loop() || ! is_main_query() ) {
			return $content;
		}

		$page_id = get_queried_object_id();
		$slug    = (string) get_post_field( 'post_name', $page_id );
		if ( ! in_array( $slug, array( 'o-nama', 'underground', 'english', 'o-nama-en', 'underground-en' ), true ) ) {
			return $content;
		}

		if ( false !== strpos( $content, 'class="anchor-nav generated-anchor-nav"' ) ) {
			return $content;
		}

		$anchors = array();
		$index   = 0;
		$updated = preg_replace_callback(
			'/<h2([^>]*)>(.*?)<\/h2>/is',
			function ( $matches ) use ( &$anchors, &$index ) {
				$attrs   = $matches[1];
				$title   = trim( wp_strip_all_tags( $matches[2] ) );
				$anchor  = sanitize_title( $title );
				$anchor  = $anchor ? $anchor : 'section-' . $index;
				$anchor .= '-' . $index;
				$index++;

				$anchors[] = array(
					'id'    => $anchor,
					'label' => $title,
				);

				if ( false === strpos( $attrs, 'id=' ) ) {
					$attrs .= ' id="' . esc_attr( $anchor ) . '"';
				}

				return '<h2' . $attrs . '>' . $matches[2] . '</h2>';
			},
			$content
		);

		if ( empty( $anchors ) ) {
			return $content;
		}

		$nav = '<nav class="anchor-nav generated-anchor-nav" aria-label="Page sections"><ul>';
		foreach ( $anchors as $anchor ) {
			$nav .= '<li><a href="#' . esc_attr( $anchor['id'] ) . '">' . esc_html( $anchor['label'] ) . '</a></li>';
		}
		$nav .= '</ul></nav>';

		return $nav . $updated;
	}
}
add_filter( 'the_content', 'cko_add_anchor_navigation_to_content', 15 );
