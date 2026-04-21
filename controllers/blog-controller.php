<?php
/**
 * Blog/archive controller.
 *
 * @package CkoTheme
 */

if ( ! function_exists( 'cko_render_post_list' ) ) {
	/**
	 * Render post listing with loop.
	 */
	function cko_render_post_list() {
		get_template_part( 'views/page-templates/post-listing' );
	}
}
