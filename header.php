<?php
/**
 * Header template.
 *
 * @package CkoTheme
 */

$lang_toggle = cko_get_language_toggle();
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
		<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<span class="brand-text"><?php bloginfo( 'name' ); ?></span>
			<?php endif; ?>
		</a>

		<div class="header-actions">
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
			<a class="language-toggle" href="<?php echo esc_url( $lang_toggle['url'] ); ?>" aria-label="<?php echo esc_attr( sprintf( 'Switch language to %s', $lang_toggle['target'] ) ); ?>">
				<span class="language-toggle__current is-active" aria-current="true"><?php echo esc_html( $lang_toggle['current'] ); ?></span>
				<span class="language-toggle__target"><?php echo esc_html( $lang_toggle['target'] ); ?></span>
			</a>
		</div>

		<button class="menu-toggle" type="button" aria-label="<?php esc_attr_e( 'Open menu', 'cko-theme' ); ?>" aria-expanded="false" aria-controls="mobile-drawer">
			<span></span>
			<span></span>
			<span></span>
		</button>
	</div>
</header>

<div class="nav-overlay" aria-hidden="true"></div>
<aside id="mobile-drawer" class="mobile-drawer" aria-hidden="true">
	<button class="mobile-drawer-close" type="button" aria-label="<?php esc_attr_e( 'Close menu', 'cko-theme' ); ?>">×</button>
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
	<a class="language-toggle mobile-language-toggle" href="<?php echo esc_url( $lang_toggle['url'] ); ?>" aria-label="<?php echo esc_attr( sprintf( 'Switch language to %s', $lang_toggle['target'] ) ); ?>">
		<span class="language-toggle__current is-active" aria-current="true"><?php echo esc_html( $lang_toggle['current'] ); ?></span>
		<span class="language-toggle__target"><?php echo esc_html( $lang_toggle['target'] ); ?></span>
	</a>
</aside>

<main class="site-main">
