<?php
/**
 * Theme bootstrap.
 *
 * @package CkoTheme
 */

define( 'CKO_THEME_VERSION', '1.0.0' );
define( 'CKO_THEME_DIR', get_template_directory() );
define( 'CKO_THEME_URI', get_template_directory_uri() );

require_once CKO_THEME_DIR . '/models/theme-support.php';
require_once CKO_THEME_DIR . '/models/theme-assets.php';
require_once CKO_THEME_DIR . '/models/theme-helpers.php';
require_once CKO_THEME_DIR . '/controllers/front-page-controller.php';
require_once CKO_THEME_DIR . '/controllers/page-controller.php';
require_once CKO_THEME_DIR . '/controllers/blog-controller.php';
