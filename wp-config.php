<?php
// ==========================================
// Set the environment and load the db config
// ==========================================
$env = isset( $_SERVER['ENV'] ) ? $_SERVER['ENV'] : 'development';
switch( $env ) {
	case 'production':
		ini_set( 'display_errors', 0 );
		define( 'WP_DEBUG_DISPLAY', false );
		break;
	case 'dev' || 'development':
		define( 'SAVEQUERIES', true );
		define( 'WP_DEBUG', true );
		define( 'WP_DEBUG_DISPLAY', true );
		break;
	default:
		exit( 'Invalid Environment' );
}
require_once dirname( __FILE__ ) . '/config/db.php';

// =======================================================
// Load the salts.php, set some defaults if no salt exists
// Pagoda will automatically generate salts when deployed
// =======================================================
require_once dirname( __FILE__ ) . '/config/salts.php';
if( !defined( 'AUTH_KEY' ) )
	define('AUTH_KEY', 'put your unique phrase here');
if( !defined( 'SECURE_AUTH_KEY' ) )
	define('SECURE_AUTH_KEY', 'put your unique phrase here');
if( !defined( 'LOGGED_IN_KEY' ) )
	define('LOGGED_IN_KEY', 'put your unique phrase here');
if( !defined( 'NONCE_KEY' ) )
	define('NONCE_KEY', 'put your unique phrase here');
if( !defined( 'AUTH_SALT' ) )
	define('AUTH_SALT', 'put your unique phrase here');
if( !defined( 'SECURE_AUTH_SALT' ) )
	define('SECURE_AUTH_SALT', 'put your unique phrase here');
if( !defined( 'LOGGED_IN_SALT' ) )
	define('LOGGED_IN_SALT', 'put your unique phrase here');
if( !defined( 'NONCE_SALT' ) )
	define('NONCE_SALT', 'put your unique phrase here');

// ===========================
// Custom Directories & Domain
// ===========================
$domain = isset( $_SERVER['CUSTOM_DOMAIN'] ) ? trim( $_SERVER['CUSTOM_DOMAIN'] ) : $_SERVER['HTTP_HOST'];
define( 'WP_CONTENT_URL', 'http://' . $domain . '/content' );
define( 'WP_SITEURL', 'http://' . $domain . '/wordpress' );
define( 'WP_HOME', 'http://' . $domain );
define( 'ABSPATH', dirname( __FILE__ ) . '/wordpress/' );
define( 'WP_CONTENT_DIR', dirname( __FILE__ ) . '/content' );

// ============
// Table prefix
// ============
if( !isset( $table_prefix ) )
	$table_prefix  = 'wp_';

// ========
// Language
// ========
if( !defined( 'WPLANG' ) )
	define( 'WPLANG', '' );

// ================================================
// You almost certainly do not want to change these
// ================================================
if( !defined( 'DB_CHARSET' ) )
	define( 'DB_CHARSET', 'utf8' );
if( !defined( 'DB_COLLATE' ) )
	define( 'DB_COLLATE', '' );
if( !defined( 'DISABLE_WP_CRON' ) )
	define( 'DISABLE_WP_CRON', true );

// ======================================
// Load a Memcached config if we have one
// ======================================
if ( file_exists( dirname( __FILE__ ) . '/config/memcached.php' ) )
	$memcached_servers = include( dirname( __FILE__ ) . '/config/memcached.php' );

// ===================
// Bootstrap WordPress
// ===================
require_once( ABSPATH . 'wp-settings.php' );