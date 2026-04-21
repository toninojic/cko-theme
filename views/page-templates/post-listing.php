<?php
/**
 * Post listing view.
 *
 * @package CkoTheme
 */
?>
<section class="container content-wrap">
	<header class="archive-header">
		<h1><?php single_post_title(); ?></h1>
		<?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>
	</header>
	<?php if ( have_posts() ) : ?>
		<div class="post-grid">
			<?php while ( have_posts() ) : the_post(); ?>
				<article <?php post_class( 'card post-card' ); ?>>
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<div class="meta"><?php echo esc_html( get_the_date() ); ?></div>
					<div class="entry-content"><?php the_excerpt(); ?></div>
				</article>
			<?php endwhile; ?>
		</div>
		<div class="pagination"><?php the_posts_pagination(); ?></div>
	<?php else : ?>
		<p><?php esc_html_e( 'No posts found.', 'cko-theme' ); ?></p>
	<?php endif; ?>
</section>
