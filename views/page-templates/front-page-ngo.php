<?php
/**
 * NGO styled front page template.
 *
 * @package CkoTheme
 *
 * @var array $args Template args.
 */

$front = isset( $args['front'] ) ? $args['front'] : array();

$impact_items = array();
if ( ! empty( $front['impact_items_raw'] ) ) {
	$lines = preg_split( '/\r\n|\r|\n/', (string) $front['impact_items_raw'] );
	foreach ( $lines as $line ) {
		$parts = array_map( 'trim', explode( '|', $line ) );
		if ( 2 <= count( $parts ) ) {
			$impact_items[] = array( 'value' => $parts[0], 'label' => $parts[1] );
		}
	}
}

if ( empty( $impact_items ) ) {
	$impact_items = array(
		array( 'value' => '120+', 'label' => __( 'Podržanih zajednica', 'cko-theme' ) ),
		array( 'value' => '35', 'label' => __( 'Aktivnih projekata', 'cko-theme' ) ),
		array( 'value' => '18', 'label' => __( 'Partner organizacija', 'cko-theme' ) ),
	);
}
?>
<section class="hero-section reveal" style="<?php echo ! empty( $front['hero_image'] ) ? esc_attr( 'background-image:url(' . $front['hero_image'] . ');' ) : ''; ?>">
	<div class="hero-overlay"></div>
	<div class="container hero-content">
		<p class="hero-kicker"><?php esc_html_e( 'Community • Impact • Action', 'cko-theme' ); ?></p>
		<h1><?php echo esc_html( $front['hero_title'] ); ?></h1>
		<p class="hero-text"><?php echo esc_html( $front['hero_text'] ); ?></p>
		<a class="hero-cta" href="<?php echo esc_url( $front['hero_cta_url'] ); ?>"><?php echo esc_html( $front['hero_cta_text'] ); ?></a>
	</div>
</section>

<section class="impact-section reveal">
	<div class="container">
		<h2><?php echo esc_html( $front['impact_title'] ); ?></h2>
		<div class="impact-grid">
			<?php foreach ( $impact_items as $item ) : ?>
				<article class="impact-card card">
					<strong><?php echo esc_html( $item['value'] ); ?></strong>
					<span><?php echo esc_html( $item['label'] ); ?></span>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="container content-wrap reveal">
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<article <?php post_class( 'card frontpage-content' ); ?>>
				<div class="entry-content"><?php the_content(); ?></div>
			</article>
		<?php endwhile; ?>
	<?php endif; ?>
</section>

<section class="container recent-news-section reveal">
	<div class="section-heading-row">
		<h2><?php esc_html_e( 'Recent News', 'cko-theme' ); ?></h2>
		<a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>"><?php esc_html_e( 'See all', 'cko-theme' ); ?></a>
	</div>
	<?php echo do_shortcode( '[cko_latest_news posts_per_page="6"]' ); ?>
</section>

<section class="container cta-band reveal">
	<div class="cta-band__inner">
		<h2><?php esc_html_e( 'Podržite naš rad', 'cko-theme' ); ?></h2>
		<p><?php esc_html_e( 'Pridružite se zajednici koja gradi održive promene.', 'cko-theme' ); ?></p>
		<a class="hero-cta" href="#kontakt"><?php esc_html_e( 'Kontaktirajte nas', 'cko-theme' ); ?></a>
	</div>
</section>
