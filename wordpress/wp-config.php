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
define( 'DB_NAME', 'db2' );

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
define( 'AUTH_KEY',         'y$;ucKMw[^{%!l Y!pH@i3W@ [MLDk)~A6_fMmb!~>c`+ktycxI9C,_LEX@Lhs?h' );
define( 'SECURE_AUTH_KEY',  'e8[|!#-luWOd4`|qFHhiy$^)FB#Ctq!D&zTHcU^$7f4qWGM2Wb8:=J<]#%05|;G ' );
define( 'LOGGED_IN_KEY',    'df2y&Uk40q3h-.Ww9rL7e{TN%NIufo!p<u](+f+!`!c?oCnihcH9^eSu&GryNRqj' );
define( 'NONCE_KEY',        'MpB+2s W{[@NI6>dw|{1qSa?+#5PI] ,13pBR&5iirX_M-,*ghnIrH%kzk>Cp_`?' );
define( 'AUTH_SALT',        'DbA3Tm,kukC~r5c%*~:E@)E$V:2-+8~}oi+u!7%YfKWi1qXb}Xk*e297Xo(t5PK=' );
define( 'SECURE_AUTH_SALT', '&xZu#Ya3e6DUjO!1cd5 yd|.tt={~KR2~KTqEoDyZa~{SGi_!N4:#rS&t=$)V0u[' );
define( 'LOGGED_IN_SALT',   '2t^8xSqv}A5eag@=f5QBI3t>W[r!lxfX6_{ryMn(uF60][zw.UV@adGG<Pc+n0Vo' );
define( 'NONCE_SALT',       ':LBGBP _jP}S3j;R8x22Q-UM3eH Bkkb,:IP6[[U-EPmrH?x.VF[g$?qqck}3(u}' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'db2_';

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
