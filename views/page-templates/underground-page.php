<?php
/**
 * Underground mixed content page.
 *
 * @package CkoTheme
 *
 * @var array $args Template args.
 */

$sections = isset( $args['sections'] ) ? $args['sections'] : array();
?>
<section class="container content-wrap">
	<h1><?php the_title(); ?></h1>
	<?php foreach ( $sections as $section ) : ?>
		<section id="<?php echo esc_attr( $section['id'] ); ?>" class="underground-section card">
			<h2><?php echo esc_html( $section['label'] ); ?></h2>
			<?php if ( 'posts' === $section['type'] ) : ?>
				<?php
				$query = new WP_Query( $section['query_args'] );
				if ( $query->have_posts() ) :
					while ( $query->have_posts() ) :
						$query->the_post();
						?>
						<article class="mini-post">
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<?php the_excerpt(); ?>
						</article>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				<?php else : ?>
					<p><?php esc_html_e( 'No posts available yet.', 'cko-theme' ); ?></p>
				<?php endif; ?>
			<?php else : ?>
				<div class="entry-content">
					<?php
					$content = get_post_meta( get_the_ID(), $section['id'] . '_content', true );
					echo $content ? wp_kses_post( wpautop( $content ) ) : '<p>' . esc_html__( 'Add static content for this section in custom fields.', 'cko-theme' ) . '</p>';
					?>
				</div>
			<?php endif; ?>
		</section>
	<?php endforeach; ?>
</section>
