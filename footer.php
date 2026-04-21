<?php
/**
 * Footer template.
 *
 * @package CkoTheme
 */
?>
</main>
<footer class="site-footer">
	<div class="container footer-grid">
		<div class="footer-col">
			<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
				<?php dynamic_sidebar( 'footer-1' ); ?>
			<?php else : ?>
				<section class="footer-widget">
					<h3 class="footer-widget-title"><?php esc_html_e( 'Naša misija', 'cko-theme' ); ?></h3>
					<p><?php esc_html_e( 'Dodajte mission tekst kroz Footer Column 1 widget.', 'cko-theme' ); ?></p>
				</section>
			<?php endif; ?>
		</div>

		<div class="footer-col">
			<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
				<?php dynamic_sidebar( 'footer-2' ); ?>
			<?php else : ?>
				<section class="footer-widget">
					<h3 class="footer-widget-title"><?php esc_html_e( 'Korisni linkovi', 'cko-theme' ); ?></h3>
					<p><?php esc_html_e( 'Dodajte meni/linkove kroz Footer Column 2.', 'cko-theme' ); ?></p>
				</section>
			<?php endif; ?>
		</div>

		<div class="footer-col">
			<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
				<?php dynamic_sidebar( 'footer-3' ); ?>
			<?php else : ?>
				<section class="footer-widget">
					<h3 class="footer-widget-title"><?php esc_html_e( 'Kontakt i društvene mreže', 'cko-theme' ); ?></h3>
					<p><?php esc_html_e( 'Dodajte kontakt i social linkove kroz Footer Column 3.', 'cko-theme' ); ?></p>
				</section>
			<?php endif; ?>
		</div>
	</div>
	<div class="container footer-bottom">
		<p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?></p>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
