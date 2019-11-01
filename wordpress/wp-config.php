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
define( 'DB_NAME', 'meals_builder_db1' );

/** MySQL database username */
define( 'DB_USER', 'amaxiuta' );

/** MySQL database password */
define( 'DB_PASSWORD', 'MashaVika!23' );

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
define( 'AUTH_KEY',         '> +i*ELJ4D3wj}:|L94.7F=B9K&>Sl*@]`d~Y*N?wcbK@_q^p;9TA EBv8T6tS*Q' );
define( 'SECURE_AUTH_KEY',  '3il{UlL>J e1k3h)vTw[cCm`85>6(Z/<~SiFVAav>4I}7?R;Ek<lvX`c<?ocKp7p' );
define( 'LOGGED_IN_KEY',    'gF@kXi^T|rpe2t,vU;+Ee&a+CX*GkA,t2o-P4q&;%p3P@/- <>#Tf{U@fUL[1d{k' );
define( 'NONCE_KEY',        'A<gSX*whoj|Vwz9vqwY3JVXNmN^!C~m2PC1L+U;Zftr9GwO5}X[&UTf_t(b2t9?|' );
define( 'AUTH_SALT',        'f}:>lG L}!C7JaHfYaXrk2!@FlZ-4tb~xG@O!;Stvr~QJy[t|JY~wJY^2QJhN`jw' );
define( 'SECURE_AUTH_SALT', 'HsL@$_r{hlKCBtlv{Zu9hcQXgZ[kp}R%dn(&|0(e%Cl]s~b4~.vdGJ01y,0ox*TB' );
define( 'LOGGED_IN_SALT',   '+Xc@qGIa%:9JlU9;v?HBt%]5>H/-n8dbWtsn07JSB65}RMxsB!z1otu9}QW1y,V7' );
define( 'NONCE_SALT',       'u7hl;[< 6}{H2} S_GWkh$7Tb#^V}2{IXNiL4lRI%l`RU8Y,^()ivAYYNMt$8*%;' );

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
