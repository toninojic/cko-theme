<?php
/**
 * NGO styled front page template.
 *
 * @package CkoTheme
 *
 * @var array $args Template args.
 */

$front = isset( $args['front'] ) ? $args['front'] : array();

$impact_items = ! empty( $front['impact_items'] ) && is_array( $front['impact_items'] ) ? $front['impact_items'] : array();

if ( empty( $impact_items ) ) {
	$impact_items = array(
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
}
?>
<section class="hero-section reveal" style="<?php echo ! empty( $front['hero_image'] ) ? esc_attr( 'background-image:url(' . $front['hero_image'] . ');' ) : ''; ?>">
	<div class="hero-overlay"></div>
	<div class="container hero-content">
		<p class="hero-kicker"><?php echo esc_html( $front['hero_kicker'] ); ?></p>
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
					<?php if ( ! empty( $item['icon'] ) ) : ?>
						<img src="<?php echo esc_url( $item['icon'] ); ?>" alt="" loading="lazy" />
					<?php endif; ?>
					<?php if ( ! empty( $item['title'] ) ) : ?>
						<h3><?php echo esc_html( $item['title'] ); ?></h3>
					<?php endif; ?>
					<strong><?php echo esc_html( isset( $item['value'] ) ? $item['value'] : '' ); ?></strong>
					<?php if ( ! empty( $item['description'] ) ) : ?>
						<span><?php echo esc_html( $item['description'] ); ?></span>
					<?php endif; ?>
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
		<h2><?php echo esc_html( $front['recent_news_title'] ); ?></h2>
		<a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>"><?php echo esc_html( $front['recent_news_link_text'] ); ?></a>
	</div>
	<?php echo do_shortcode( '[cko_latest_news posts_per_page="6"]' ); ?>
</section>

<section class="container cta-band reveal">
	<div class="cta-band__inner">
		<h2><?php echo esc_html( $front['cta_title'] ); ?></h2>
		<p><?php echo esc_html( $front['cta_text'] ); ?></p>
		<a class="hero-cta" href="<?php echo esc_url( $front['cta_button_url'] ); ?>"><?php echo esc_html( $front['cta_button_text'] ); ?></a>
	</div>
</section>
