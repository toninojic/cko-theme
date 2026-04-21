<?php
/**
 * Page meta fields registration and saving.
 *
 * @package CkoTheme
 */

if ( ! function_exists( 'cko_register_page_meta_boxes' ) ) {
	/**
	 * Register meta boxes for pages.
	 */
	function cko_register_page_meta_boxes() {
		add_meta_box( 'cko-language-settings', __( 'CKO • Language Settings', 'cko-theme' ), 'cko_render_language_settings_meta_box', 'page', 'side', 'default' );
		add_meta_box( 'cko-frontpage-content', __( 'CKO • Front Page Content', 'cko-theme' ), 'cko_render_frontpage_content_meta_box', 'page', 'normal', 'default' );
		add_meta_box( 'cko-impact-items', __( 'CKO • Impact Items', 'cko-theme' ), 'cko_render_impact_items_meta_box', 'page', 'normal', 'default' );
	}
}
add_action( 'add_meta_boxes_page', 'cko_register_page_meta_boxes' );

if ( ! function_exists( 'cko_render_language_settings_meta_box' ) ) {
	/**
	 * Render language relation field.
	 *
	 * @param WP_Post $post Current post object.
	 */
	function cko_render_language_settings_meta_box( $post ) {
		wp_nonce_field( 'cko_save_page_meta', 'cko_page_meta_nonce' );
		$current_alt = absint( get_post_meta( $post->ID, 'cko_alt_lang_page_id', true ) );
		$pages       = get_pages(
			array(
				'post_status'  => array( 'publish', 'draft', 'private' ),
				'sort_column'  => 'post_title',
				'sort_order'   => 'ASC',
				'exclude'      => array( $post->ID ),
				'hierarchical' => 0,
			)
		);
		?>
		<p>
			<label for="cko_alt_lang_page_id"><strong><?php esc_html_e( 'Alternative language page', 'cko-theme' ); ?></strong></label>
			<select id="cko_alt_lang_page_id" name="cko_alt_lang_page_id" class="widefat">
				<option value="0"><?php esc_html_e( '— Not linked —', 'cko-theme' ); ?></option>
				<?php foreach ( $pages as $page ) : ?>
					<option value="<?php echo esc_attr( $page->ID ); ?>" <?php selected( $current_alt, (int) $page->ID ); ?>>
						<?php echo esc_html( sprintf( '#%1$d — %2$s', (int) $page->ID, $page->post_title ) ); ?>
					</option>
				<?php endforeach; ?>
			</select>
		</p>
		<?php
	}
}

if ( ! function_exists( 'cko_render_frontpage_content_meta_box' ) ) {
	/**
	 * Render front page content fields.
	 *
	 * @param WP_Post $post Current post object.
	 */
	function cko_render_frontpage_content_meta_box( $post ) {
		wp_nonce_field( 'cko_save_page_meta', 'cko_page_meta_nonce' );
		$keys = array(
			'cko_hero_kicker',
			'cko_hero_title',
			'cko_hero_text',
			'cko_hero_cta_text',
			'cko_hero_cta_url',
			'cko_impact_title',
			'cko_recent_news_title',
			'cko_recent_news_link_text',
			'cko_cta_title',
			'cko_cta_text',
			'cko_cta_button_text',
			'cko_cta_button_url',
		);
		$values = array();
		foreach ( $keys as $key ) {
			$values[ $key ] = (string) get_post_meta( $post->ID, $key, true );
		}
		?>
		<h4 style="margin-top:0;"><?php esc_html_e( 'Hero sekcija', 'cko-theme' ); ?></h4>
		<p><label><?php esc_html_e( 'Kicker', 'cko-theme' ); ?><input type="text" class="widefat" name="cko_hero_kicker" value="<?php echo esc_attr( $values['cko_hero_kicker'] ); ?>"></label></p>
		<p><label><?php esc_html_e( 'Naslov', 'cko-theme' ); ?><input type="text" class="widefat" name="cko_hero_title" value="<?php echo esc_attr( $values['cko_hero_title'] ); ?>"></label></p>
		<p><label><?php esc_html_e( 'Opis', 'cko-theme' ); ?><textarea class="widefat" rows="3" name="cko_hero_text"><?php echo esc_textarea( $values['cko_hero_text'] ); ?></textarea></label></p>
		<p><label><?php esc_html_e( 'CTA tekst', 'cko-theme' ); ?><input type="text" class="widefat" name="cko_hero_cta_text" value="<?php echo esc_attr( $values['cko_hero_cta_text'] ); ?>"></label></p>
		<p><label><?php esc_html_e( 'CTA URL', 'cko-theme' ); ?><input type="url" class="widefat" name="cko_hero_cta_url" value="<?php echo esc_attr( $values['cko_hero_cta_url'] ); ?>"></label></p>
		<hr>
		<h4><?php esc_html_e( 'Impact sekcija', 'cko-theme' ); ?></h4>
		<p><label><?php esc_html_e( 'Naslov sekcije', 'cko-theme' ); ?><input type="text" class="widefat" name="cko_impact_title" value="<?php echo esc_attr( $values['cko_impact_title'] ); ?>"></label></p>
		<hr>
		<h4><?php esc_html_e( 'Recent news sekcija', 'cko-theme' ); ?></h4>
		<p><label><?php esc_html_e( 'Naslov sekcije', 'cko-theme' ); ?><input type="text" class="widefat" name="cko_recent_news_title" value="<?php echo esc_attr( $values['cko_recent_news_title'] ); ?>"></label></p>
		<p><label><?php esc_html_e( 'Tekst linka', 'cko-theme' ); ?><input type="text" class="widefat" name="cko_recent_news_link_text" value="<?php echo esc_attr( $values['cko_recent_news_link_text'] ); ?>"></label></p>
		<hr>
		<h4><?php esc_html_e( 'CTA sekcija', 'cko-theme' ); ?></h4>
		<p><label><?php esc_html_e( 'CTA naslov', 'cko-theme' ); ?><input type="text" class="widefat" name="cko_cta_title" value="<?php echo esc_attr( $values['cko_cta_title'] ); ?>"></label></p>
		<p><label><?php esc_html_e( 'CTA opis', 'cko-theme' ); ?><textarea class="widefat" rows="3" name="cko_cta_text"><?php echo esc_textarea( $values['cko_cta_text'] ); ?></textarea></label></p>
		<p><label><?php esc_html_e( 'CTA dugme tekst', 'cko-theme' ); ?><input type="text" class="widefat" name="cko_cta_button_text" value="<?php echo esc_attr( $values['cko_cta_button_text'] ); ?>"></label></p>
		<p><label><?php esc_html_e( 'CTA dugme URL / anchor', 'cko-theme' ); ?><input type="text" class="widefat" name="cko_cta_button_url" value="<?php echo esc_attr( $values['cko_cta_button_url'] ); ?>"></label></p>
		<?php
	}
}

if ( ! function_exists( 'cko_render_impact_items_meta_box' ) ) {
	/**
	 * Render fixed 4 impact items fields.
	 *
	 * @param WP_Post $post Current post object.
	 */
	function cko_render_impact_items_meta_box( $post ) {
		wp_nonce_field( 'cko_save_page_meta', 'cko_page_meta_nonce' );
		$items = get_post_meta( $post->ID, 'cko_impact_items', true );
		$items = is_array( $items ) ? array_values( $items ) : array();
		?>
		<p style="margin-top:0;"><?php esc_html_e( 'Unesite sadržaj za 4 impact kartice (naslov, broj/statistika, opis, opcioni URL ikonice).', 'cko-theme' ); ?></p>
		<?php for ( $index = 0; $index < 4; $index++ ) : ?>
			<?php $item = isset( $items[ $index ] ) && is_array( $items[ $index ] ) ? $items[ $index ] : array(); ?>
			<div class="cko-impact-row" style="border:1px solid #ddd;padding:12px;margin-bottom:12px;">
				<h4 style="margin:0 0 10px;"><?php echo esc_html( sprintf( __( 'Impact kartica %d', 'cko-theme' ), $index + 1 ) ); ?></h4>
				<p><label><?php esc_html_e( 'Naslov', 'cko-theme' ); ?><input type="text" class="widefat" name="cko_impact_items[<?php echo esc_attr( $index ); ?>][title]" value="<?php echo esc_attr( isset( $item['title'] ) ? (string) $item['title'] : '' ); ?>"></label></p>
				<p><label><?php esc_html_e( 'Broj / statistika', 'cko-theme' ); ?><input type="text" class="widefat" name="cko_impact_items[<?php echo esc_attr( $index ); ?>][value]" value="<?php echo esc_attr( isset( $item['value'] ) ? (string) $item['value'] : '' ); ?>"></label></p>
				<p><label><?php esc_html_e( 'Opis', 'cko-theme' ); ?><textarea class="widefat" rows="2" name="cko_impact_items[<?php echo esc_attr( $index ); ?>][description]"><?php echo esc_textarea( isset( $item['description'] ) ? (string) $item['description'] : '' ); ?></textarea></label></p>
				<p><label><?php esc_html_e( 'Ikonica / slika URL (opciono)', 'cko-theme' ); ?><input type="url" class="widefat" name="cko_impact_items[<?php echo esc_attr( $index ); ?>][icon]" value="<?php echo esc_attr( isset( $item['icon'] ) ? (string) $item['icon'] : '' ); ?>"></label></p>
			</div>
		<?php endfor; ?>
		<?php
	}
}

if ( ! function_exists( 'cko_save_page_meta_fields' ) ) {
	/**
	 * Save page meta values.
	 *
	 * @param int $post_id Post ID.
	 */
	function cko_save_page_meta_fields( $post_id ) {
		if ( ! isset( $_POST['cko_page_meta_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['cko_page_meta_nonce'] ) ), 'cko_save_page_meta' ) ) {
			return;
		}
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		if ( 'page' !== get_post_type( $post_id ) || ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		$scalar_fields = array(
			'cko_alt_lang_page_id', 'cko_hero_kicker', 'cko_hero_title', 'cko_hero_text', 'cko_hero_cta_text', 'cko_hero_cta_url',
			'cko_impact_title', 'cko_recent_news_title', 'cko_recent_news_link_text', 'cko_cta_title', 'cko_cta_text',
			'cko_cta_button_text', 'cko_cta_button_url',
		);
		foreach ( $scalar_fields as $field_key ) {
			if ( ! isset( $_POST[ $field_key ] ) ) {
				continue;
			}
			$raw = wp_unslash( $_POST[ $field_key ] );
			if ( 'cko_alt_lang_page_id' === $field_key ) {
				$value = absint( $raw );
			} elseif ( false !== strpos( $field_key, '_url' ) ) {
				$value = esc_url_raw( $raw );
			} else {
				$value = sanitize_textarea_field( $raw );
			}
			if ( '' === (string) $value || 0 === $value ) {
				delete_post_meta( $post_id, $field_key );
			} else {
				update_post_meta( $post_id, $field_key, $value );
			}
		}

		if ( isset( $_POST['cko_impact_items'] ) && is_array( $_POST['cko_impact_items'] ) ) {
			$raw_items = wp_unslash( $_POST['cko_impact_items'] );
			$items     = array();
			for ( $index = 0; $index < 4; $index++ ) {
				$item      = isset( $raw_items[ $index ] ) && is_array( $raw_items[ $index ] ) ? $raw_items[ $index ] : array();
				$items[] = array(
					'title'       => isset( $item['title'] ) ? sanitize_text_field( $item['title'] ) : '',
					'value'       => isset( $item['value'] ) ? sanitize_text_field( $item['value'] ) : '',
					'description' => isset( $item['description'] ) ? sanitize_textarea_field( $item['description'] ) : '',
					'icon'        => isset( $item['icon'] ) ? esc_url_raw( $item['icon'] ) : '',
				);
			}
			update_post_meta( $post_id, 'cko_impact_items', $items );
		}
	}
}
add_action( 'save_post_page', 'cko_save_page_meta_fields' );
