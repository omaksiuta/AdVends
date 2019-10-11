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
define('AUTH_KEY',         'LKHPA{Bf /W_T8++)) !i@lK9lt-<]Mx_jG`UzIz:F+-sw0^GBTahHx(k|y7F6RO');
define('SECURE_AUTH_KEY',  '*S{QK|8r-,IN+:*5pq|-3O+DaFmM+Z@yk$+Sl!NEI CSZ-qBP|]L&](sEU1BJ30-');
define('LOGGED_IN_KEY',    '0.{A!|fKzf+wR .+ Is** $#Vbjw=CzUNKN^r45|u==CUQ87]3tp*%CG/Bb_po=P');
define('NONCE_KEY',        '`5&ioKfIZ+:QJfJh{7rvc=Lu}W$zH5}->?GM[]5B`~Ubvht0=x,Py(?U+:5QoXes');
define('AUTH_SALT',        '=-CE+Wwely%&NmAEp>WM.M|fzi|Ufd?_%Cz|@m<v^D|s38n~(gg_0+Upu]{<E4u_');
define('SECURE_AUTH_SALT', 'nnthPJ5#>B)6y50T3hrNvS7+/n|)m`55Ev|6js:#TmK$P{z|X~-bMy]0Sv+>=Fp7');
define('LOGGED_IN_SALT',   '1K.U!Ewyif$j zA&>YafZ)>_be#6Z5c|Kk9&ptb8`@v4 |I[:dSB|$o S3b%+Erw');
define('NONCE_SALT',       '?tfX>6#`<Sr.%L-a+geC_5!D>wzBtO?-P ($FrnUmurx@-<KZl{MHL9Xn~:.{RI.');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'dbc_';

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
