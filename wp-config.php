<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'netdev_wp_gopo4' );

/** Database username */
define( 'DB_USER', 'netdev_wp_uoqcp' );

/** Database password */
define( 'DB_PASSWORD', '8PtI^#r2Y70Zwln@' );

/** Database hostname */
define( 'DB_HOST', 'localhost:3306' );

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
define('AUTH_KEY', 'X]DoY[5:):qqnHH_CDA3T;4/9-9OB7k32jw*NG:g60k_09l#C93mc3D5DeO~Sm*U');
define('SECURE_AUTH_KEY', 'ul&j1DlC9D3-W6Ymun300F02kE;23@6wfxeW6uz0+Q4k(+PNn6dlob(y2m&rQN#L');
define('LOGGED_IN_KEY', 'xD|8:X]3005hC77I_%p2ikp4-09(9(Oa%n4&4V!c:!2]wYL]vr5Wy7(9%b9I997*');
define('NONCE_KEY', '8xZC!5W62c3|~0O;w21N8p&O9#w7Uu31FC(Lw&HKM7ap@N#q883S&+_4&IQur7P7');
define('AUTH_SALT', '0svd*]0k5P1-rVs80Hg&3HJ0m2P17cHzbNoKw+pigvb0(#~|9sQU28%ZE[:Y!kz8');
define('SECURE_AUTH_SALT', 'fPJ7ss5e8O/7nPc2~4F2)TC|)ys+k049N)2YmK3-|Hm(rD3(9*y1d|57&#_v5N_]');
define('LOGGED_IN_SALT', '~D-9UJc#K2R78|;gNw+r-9h3wp+F95cnoqQu@F|0W!o7HKE]U*2076EIXj@9X4_2');
define('NONCE_SALT', '+Whn)3:!4hr7%b~8;&We4[z~(4NT@2:;8UW3O03u8~Q&6P94rDXW&CJPo6/r+taI');


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'breeze';

define('WP_MEMORY_LIMIT', '256M');


/* Add any custom values between this line and the "stop editing" line. */

define('WP_ALLOW_MULTISITE', true);
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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

set_time_limit(1200);

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
