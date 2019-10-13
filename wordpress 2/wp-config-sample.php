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
define( 'DB_NAME', 'sweet' );

/** MySQL database username */
define( 'DB_USER', 'sweet' );

/** MySQL database password */
define( 'DB_PASSWORD', 'sweet' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define('AUTH_KEY',         '2!-.3FNpE+=x5#je&HR*!i--cl7T>jQ+!:9h>#:z7b@[HO$97A>e,4{B BS&+PjG');
define('SECURE_AUTH_KEY',  '!Yd@|Us?P{L *o]g9wUzd/}UfxiW-?XXe~uZLO.-fQjhHn7I@pF /v`F_v2-4M[6');
define('LOGGED_IN_KEY',    'G|]01 &ar 5pC:dBH89Xg/FH6/y}bW%3H)8}Fu5o70u[H19-:fP)-2eT2m5n.Fu8');
define('NONCE_KEY',        'HZ7H2ARG=>}Ss*f+XQ^fEUDR~g=t@g>tthyb~=`qs+vUH,0?2w.vp3g:A|A[>#^4');
define('AUTH_SALT',        'sGuK]9>`o(NyP%-iu@Zt_JYIZ;F*G-QfA eR*RR.[p{;>)0~fBK;^,MC2K`x!=%*');
define('SECURE_AUTH_SALT', ':Bg*Z&2]]?aMVeJ^9kf*5-HjAasi)^AZ2VF)8Ai@jX &<0bzMtwJ,Z<a#1*[f+f6');
define('LOGGED_IN_SALT',   '2w*Fcgfufr_l=||$1oFUR6c+cH$|&3RZ-X93V[WZlSr.-3p fT9GYK<r,V`ToOoj');
define('NONCE_SALT',       'UyPiEBEIg!eZ_v[K:~`?BAK-yuJ4S4nWuX[w IW$e=Q:+t)exOJjz+q XHD^fthF');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'sweet_';

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
