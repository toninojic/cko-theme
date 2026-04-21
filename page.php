<?php
/**
 * Default page template dispatcher.
 *
 * @package CkoTheme
 */

get_header();

$slug = get_post_field( 'post_name', get_post() );

if ( 'kontaktiraj-nas' === $slug ) {
	cko_render_contact_page();
} elseif ( 'underground' === $slug ) {
	cko_render_underground_page();
} elseif ( 'english' === $slug ) {
	cko_render_about_page( 'en' );
} else {
	cko_render_page_content();
}

get_footer();
