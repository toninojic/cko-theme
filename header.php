<?php
/**
 * Header template.
 *
 * @package CkoTheme
 */

$lang_toggle = cko_get_language_toggle();
$is_en_toggle = 'EN' === $lang_toggle['current'];
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
			<a class="language-toggle <?php echo $is_en_toggle ? 'is-en' : 'is-sr'; ?>" href="<?php echo esc_url( $lang_toggle['url'] ); ?>" aria-label="<?php echo esc_attr( sprintf( 'Switch language to %s', $lang_toggle['target'] ) ); ?>">
				<span class="language-toggle__option language-toggle__option--sr" <?php echo $is_en_toggle ? '' : 'aria-current="true"'; ?>>SR</span>
				<span class="language-toggle__option language-toggle__option--en" <?php echo $is_en_toggle ? 'aria-current="true"' : ''; ?>>EN</span>
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
	<a class="language-toggle mobile-language-toggle <?php echo $is_en_toggle ? 'is-en' : 'is-sr'; ?>" href="<?php echo esc_url( $lang_toggle['url'] ); ?>" aria-label="<?php echo esc_attr( sprintf( 'Switch language to %s', $lang_toggle['target'] ) ); ?>">
		<span class="language-toggle__option language-toggle__option--sr" <?php echo $is_en_toggle ? '' : 'aria-current="true"'; ?>>SR</span>
		<span class="language-toggle__option language-toggle__option--en" <?php echo $is_en_toggle ? 'aria-current="true"' : ''; ?>>EN</span>
	</a>
</aside>

<main class="site-main">
