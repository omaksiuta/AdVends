<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'constructor' );

/** MySQL database username */
define( 'DB_USER', 'constructor' );

/** MySQL database password */
define( 'DB_PASSWORD', 'constructor' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'ysLPe*%<}])B,O}-zC>F}UN)rTC.ci.V488Dmm,$qb>+UA+TEi-rw);px<|ZOmka' );
define( 'SECURE_AUTH_KEY',  'Nmwp=5:M,7V~~P,^TZp^L8{]]EVWYqBBacaMdN{RQ&(Lh0[o^oq7s1n_4(JMa+&?' );
define( 'LOGGED_IN_KEY',    '{u5)KK<a`~BTa?uDaz5o9_U91^W8vu`-y>,^D@I|h}u|$,i;gvZ|R*&DbE1Y^Sq|' );
define( 'NONCE_KEY',        'wVVFnD&2;HoF^%uX<9{-o**HsxZ5rKhrV9XQeN3.[!<&&(U%tOc;1y`7!$.Pn28&' );
define( 'AUTH_SALT',        'A8WyE-SN,;{;dib,E_lllMYTPNKYS=p/mRI`XXIO(W1_f%XzJ%gG.8KF3X9BIz2y' );
define( 'SECURE_AUTH_SALT', '{vKO*|>mwLCB!0zwNNv14}pMs>cU1@I>`qnqE~D46aw>ka?xGKUB:T/j~up8YZzn' );
define( 'LOGGED_IN_SALT',   'kQ%QysFa|X+7ejRwB&v|Y2JKD$e:<`i/h952d&sH&[DOS!vXTb6#?3u<XN[AofI-' );
define( 'NONCE_SALT',       'pj-dLWmDB>q^f0Q4XYdBf]X9ln$Idr ee8)^,%9@O#9;(W8NkgQ]+:ch*.UUce.(' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
