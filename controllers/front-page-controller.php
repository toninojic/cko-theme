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

		$impact_items = get_post_meta( $page_id, 'cko_impact_items', true );
		$impact_items = is_array( $impact_items ) ? array_values( $impact_items ) : array();

		$impact_defaults = array(
			array(
				'title'       => __( 'Podržane zajednice', 'cko-theme' ),
				'value'       => '120+',
				'description' => __( 'Lokalne inicijative koje su dobile našu podršku.', 'cko-theme' ),
				'icon'        => '',
			),
			array(
				'title'       => __( 'Aktivni projekti', 'cko-theme' ),
				'value'       => '35',
				'description' => __( 'Programi koje trenutno realizujemo sa partnerima.', 'cko-theme' ),
				'icon'        => '',
			),
			array(
				'title'       => __( 'Partner organizacije', 'cko-theme' ),
				'value'       => '18',
				'description' => __( 'Organizacije sa kojima gradimo dugoročan uticaj.', 'cko-theme' ),
				'icon'        => '',
			),
		);

		for ( $index = 0; $index < 3; $index++ ) {
			$item = isset( $impact_items[ $index ] ) && is_array( $impact_items[ $index ] ) ? $impact_items[ $index ] : array();
			$impact_items[ $index ] = array(
				'title'       => isset( $item['title'] ) && '' !== $item['title'] ? $item['title'] : $impact_defaults[ $index ]['title'],
				'value'       => isset( $item['value'] ) && '' !== $item['value'] ? $item['value'] : $impact_defaults[ $index ]['value'],
				'description' => isset( $item['description'] ) && '' !== $item['description'] ? $item['description'] : $impact_defaults[ $index ]['description'],
				'icon'        => isset( $item['icon'] ) ? $item['icon'] : '',
			);
		}

		return array(
			'hero_kicker'            => get_post_meta( $page_id, 'cko_hero_kicker', true ) ?: __( 'Community • Impact • Action', 'cko-theme' ),
			'hero_title'             => get_post_meta( $page_id, 'cko_hero_title', true ) ?: get_the_title( $page_id ),
			'hero_text'              => get_post_meta( $page_id, 'cko_hero_text', true ) ?: get_bloginfo( 'description' ),
			'hero_cta_text'          => get_post_meta( $page_id, 'cko_hero_cta_text', true ) ?: __( 'Saznaj više', 'cko-theme' ),
			'hero_cta_url'           => get_post_meta( $page_id, 'cko_hero_cta_url', true ) ?: '#',
			'hero_image'             => get_the_post_thumbnail_url( $page_id, 'full' ),
			'impact_title'           => get_post_meta( $page_id, 'cko_impact_title', true ) ?: __( 'Naš uticaj', 'cko-theme' ),
			'impact_items'           => $impact_items,
			'recent_news_title'      => get_post_meta( $page_id, 'cko_recent_news_title', true ) ?: __( 'Recent News', 'cko-theme' ),
			'recent_news_link_text'  => get_post_meta( $page_id, 'cko_recent_news_link_text', true ) ?: __( 'See all', 'cko-theme' ),
			'cta_title'              => get_post_meta( $page_id, 'cko_cta_title', true ) ?: __( 'Podržite naš rad', 'cko-theme' ),
			'cta_text'               => get_post_meta( $page_id, 'cko_cta_text', true ) ?: __( 'Pridružite se zajednici koja gradi održive promene.', 'cko-theme' ),
			'cta_button_text'        => get_post_meta( $page_id, 'cko_cta_button_text', true ) ?: __( 'Kontaktirajte nas', 'cko-theme' ),
			'cta_button_url'         => get_post_meta( $page_id, 'cko_cta_button_url', true ) ?: '#kontakt',
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
