<?php
/**
 * Contact page view.
 *
 * @package CkoTheme
 */
?>
<section class="container content-wrap">
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<article <?php post_class( 'card contact-page' ); ?>>
				<h1><?php the_title(); ?></h1>
				<div class="entry-content"><?php the_content(); ?></div>
				<div class="contact-placeholder">
					<p><?php esc_html_e( 'Form placeholder: integrate Contact Form 7, Gravity Forms, or a custom block later.', 'cko-theme' ); ?></p>
				</div>
			</article>
		<?php endwhile; ?>
	<?php endif; ?>
</section>
