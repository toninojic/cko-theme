<?php
/**
 * About style page with anchors.
 *
 * @package CkoTheme
 *
 * @var array $args Template args.
 */

$sections = isset( $args['sections'] ) ? $args['sections'] : array();
?>
<section class="container about-nav-wrap">
	<nav class="anchor-nav" aria-label="Section navigation">
		<ul>
			<?php foreach ( $sections as $section ) : ?>
				<li><a href="#<?php echo esc_attr( $section['id'] ); ?>"><?php echo esc_html( $section['title'] ); ?></a></li>
			<?php endforeach; ?>
		</ul>
	</nav>
</section>

<?php foreach ( $sections as $section ) : ?>
	<section id="<?php echo esc_attr( $section['id'] ); ?>" class="anchor-section">
		<div class="container">
			<h2><?php echo esc_html( $section['title'] ); ?></h2>
			<div class="wysiwyg">
				<?php
				$page = get_page_by_path( $section['id'] );
				if ( $page instanceof WP_Post ) {
					echo apply_filters( 'the_content', $page->post_content );
				} else {
					echo '<p>' . esc_html__( 'Add content for this section by creating a page with this slug or using blocks on this page.', 'cko-theme' ) . '</p>';
				}
				?>
			</div>
		</div>
	</section>
<?php endforeach; ?>
