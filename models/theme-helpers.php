<?php
/**
 * Helpers and reusable data providers.
 *
 * @package CkoTheme
 */

if ( ! function_exists( 'cko_get_about_sections' ) ) {
	/**
	 * Return reusable sections for about-like pages.
	 *
	 * @param string $locale Page locale identifier.
	 * @return array<int, array<string, string>>
	 */
	function cko_get_about_sections( $locale = 'sr' ) {
		if ( 'en' === $locale ) {
			return array(
				array( 'id' => 'who-we-are', 'title' => 'Who We Are' ),
				array( 'id' => 'our-mission', 'title' => 'Our Mission' ),
				array( 'id' => 'our-projects', 'title' => 'Our Projects' ),
				array( 'id' => 'our-partnerships', 'title' => 'Our Partnerships' ),
			);
		}

		return array(
			array( 'id' => 'ko-smo-mi', 'title' => 'Ko smo mi?' ),
			array( 'id' => 'nasa-misija', 'title' => 'Naša misija' ),
			array( 'id' => 'nasi-projekti', 'title' => 'Naši projekti' ),
			array( 'id' => 'nasa-partnerstva', 'title' => 'Naša partnerstva' ),
		);
	}
}

if ( ! function_exists( 'cko_get_underground_sections' ) ) {
	/**
	 * Underground section configuration.
	 *
	 * @return array<int, array<string, mixed>>
	 */
	function cko_get_underground_sections() {
		return array(
			array(
				'id'         => 'underground-vesti',
				'label'      => 'Vesti',
				'type'       => 'posts',
				'query_args' => array( 'posts_per_page' => 5 ),
			),
			array(
				'id'         => 'underground-blog',
				'label'      => 'Blog',
				'type'       => 'posts',
				'query_args' => array( 'posts_per_page' => 5 ),
			),
			array(
				'id'    => 'underground-o-nama',
				'label' => 'O nama',
				'type'  => 'static',
			),
		);
	}
}

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
