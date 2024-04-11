<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'bitnami_wordpress' );

/** Database username */
define( 'DB_USER', 'bn_wordpress' );

/** Database password */
define( 'DB_PASSWORD', '6f6f05d03573f38a35eca9299d6893508effd60a361b4034d1d3e21f560e0391' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1:3306' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'spDjpKx!Qj[c!DKs]kS}k&Q!DQ.t[|,!Ties6RE*ft=^,;?|q,lynUi.kYP>>gm-' );
define( 'SECURE_AUTH_KEY',  'Z>^W0fXs0P!yO`wZ7jnGcS Uc=)D{&yYbycb$%Yn0DRcbe5bDr~1{t$P {_V& [:' );
define( 'LOGGED_IN_KEY',    'X1ux&2ef1!>qq]zB])Zcpjd_?KHOAl6icPz D>zho47!EIoFx)Jf4/]t()I#Fe:H' );
define( 'NONCE_KEY',        'g3crTp*z,(.OVMtkEo3trzS c+f$a^{|mLaDX-=2$ aVp^-N,d*]R`$_QewXcFi{' );
define( 'AUTH_SALT',        '_9zJ|E8dHYX5RAeM$1TbNN9)_G PW6g}{ JVw_gT5v|X5.WpJOdV6E-,MQ#!.^ f' );
define( 'SECURE_AUTH_SALT', 'f{0tHp&EDy5:N5$Pu#[jvAs9D_HJn5Y:?Fb/pitnjv^dz3Scg/_=Wp05=*,fK,$d' );
define( 'LOGGED_IN_SALT',   'h/OB7$/<l0.b7(lnnBQ01llKwTwg^C_d9Q0rQ3~jLz76p|Cl#6OOjlagB#h]_UsM' );
define( 'NONCE_SALT',       'B5Q8V{(3kl7#-EMKKK4P]]B$;UiLSF_%R0WH*cT<_K*TBOuEr?xrKZ:a0zgy4k4:' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



define( 'FS_METHOD', 'direct' );
/**
 * The WP_SITEURL and WP_HOME options are configured to access from any hostname or IP address.
 * If you want to access only from an specific domain, you can modify them. For example:
 *  define('WP_HOME','http://example.com');
 *  define('WP_SITEURL','http://example.com');
 *
 */
if ( defined( 'WP_CLI' ) ) {
	$_SERVER['HTTP_HOST'] = '127.0.0.1';
}

define( 'WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] . '/' );
define( 'WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

/**
 * Disable pingback.ping xmlrpc method to prevent WordPress from participating in DDoS attacks
 * More info at: https://docs.bitnami.com/general/apps/wordpress/troubleshooting/xmlrpc-and-pingback/
 */
if ( !defined( 'WP_CLI' ) ) {
	// remove x-pingback HTTP header
	add_filter("wp_headers", function($headers) {
		unset($headers["X-Pingback"]);
		return $headers;
	});
	// disable pingbacks
	add_filter( "xmlrpc_methods", function( $methods ) {
		unset( $methods["pingback.ping"] );
		return $methods;
	});
}
