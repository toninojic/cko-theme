<?php
/**
 * Front page controller.
 *
 * @package CkoTheme
 */

if ( ! function_exists( 'cko_get_front_page_data' ) ) {
	/**
	 * Build front-page data from page meta.
	 *
	 * @return array<string, mixed>
	 */
	function cko_get_front_page_data() {
		$page_id = get_queried_object_id();

		return array(
			'hero_title'       => get_post_meta( $page_id, 'cko_hero_title', true ) ?: get_the_title( $page_id ),
			'hero_text'        => get_post_meta( $page_id, 'cko_hero_text', true ) ?: get_bloginfo( 'description' ),
			'hero_cta_text'    => get_post_meta( $page_id, 'cko_hero_cta_text', true ) ?: __( 'Saznaj više', 'cko-theme' ),
			'hero_cta_url'     => get_post_meta( $page_id, 'cko_hero_cta_url', true ) ?: '#',
			'hero_image'       => get_the_post_thumbnail_url( $page_id, 'full' ),
			'impact_title'     => get_post_meta( $page_id, 'cko_impact_title', true ) ?: __( 'Naš uticaj', 'cko-theme' ),
			'impact_items_raw' => get_post_meta( $page_id, 'cko_impact_items', true ),
		);
	}
}

if ( ! function_exists( 'cko_render_front_page' ) ) {
	/**
	 * Render structured NGO-like front page.
	 */
	function cko_render_front_page() {
		$data = cko_get_front_page_data();
		get_template_part( 'views/page-templates/front-page-ngo', null, array( 'front' => $data ) );
	}
}
