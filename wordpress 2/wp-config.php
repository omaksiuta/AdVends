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
define( 'AUTH_KEY',         '2sd]t3.P2@?II%3E{dzJx<2Pog&7M_K7ZWZpyk5j4F+}Mr!uc&z0n@W+!R*rC7? ' );
define( 'SECURE_AUTH_KEY',  '!.e:sNIh}k!.hA0GG9``W})O/0p37QhZ69G2aw#lZ$S&l$ln~fnVV2v5MJ&$M_+l' );
define( 'LOGGED_IN_KEY',    'FtENG]L=S_._oq-2*.<D7J#U7]d/;^::#10hsIutR[1GCPQR7d15_`u.y3~O6v]r' );
define( 'NONCE_KEY',        'u)P7e;XM>mB`)H(fd.oq j0||x|os0xzH/Ypw}g5#{Aeqb*l<h7]<K,:`6fmw7*B' );
define( 'AUTH_SALT',        'MP}QW=*:4h/S(Xp.Pu^w;AfOcl1yc1v2.pCIr*.s5*_l/7HtwF4&:6XmFkfx=e{/' );
define( 'SECURE_AUTH_SALT', 'E6zl F@*{<UVv]mbBiXWC-xMi~qqMsm]R[0c5Y~@@!k{RzkH[iGA[!3}c06>RIUy' );
define( 'LOGGED_IN_SALT',   '* q`GZD_aLdvy=s.=];wGG9DAW(gT@lQW1=bPg6XFwAT3^?Rsug5m>*kYU{W(Ub=' );
define( 'NONCE_SALT',       'imAJ#8Q#v|ZHZVCbn7xXW;0;k@[V.tfq[0Uoz^<bt]~DXxe/ng9_j*}Q0dgAL>nI' );

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
