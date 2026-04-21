<?php
/**
 * Header template.
 *
 * @package CkoTheme
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="site-header">
	<div class="container header-inner">
		<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>

		<nav class="primary-nav desktop-nav" aria-label="<?php esc_attr_e( 'Primary Navigation', 'cko-theme' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'fallback_cb'    => 'cko_primary_menu_fallback',
				)
			);
			?>
		</nav>

		<button class="menu-toggle" type="button" aria-label="<?php esc_attr_e( 'Open menu', 'cko-theme' ); ?>" aria-expanded="false" aria-controls="mobile-drawer">
			<span></span>
			<span></span>
			<span></span>
		</button>
	</div>
</header>

<div class="nav-overlay" aria-hidden="true"></div>
<aside id="mobile-drawer" class="mobile-drawer" aria-hidden="true">
	<nav class="primary-nav mobile-nav" aria-label="<?php esc_attr_e( 'Mobile Navigation', 'cko-theme' ); ?>">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'primary',
				'container'      => false,
				'fallback_cb'    => 'cko_primary_menu_fallback',
			)
		);
		?>
	</nav>
</aside>

<main class="site-main">
