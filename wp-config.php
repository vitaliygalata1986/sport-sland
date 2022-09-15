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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'sport-island' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'e*2U*gF4u|taP4|p2Q/T>hQ+tE0C.ZK7h8]=Pc i3dAI<6zah8)oiW=o[Q5bqm9i' );
define( 'SECURE_AUTH_KEY',  'GIq4wCfLt*o5]7yIr/>bN?/b~BKJ!kK(Gq?ic>14G6VAPF2mm,sf@Lr(3lQNJ3*c' );
define( 'LOGGED_IN_KEY',    '@8zVvnWD^HOeAqQCo{=I~7;V8wbu>S$rR7ua|khtJm>av%43TIMHoGQ%|h!W*z8q' );
define( 'NONCE_KEY',        'o%Z;AkqrpPIw3i~p+tKLM1lQJ4[PmCbk2~9y7@Z|~G7VsQuft9#ki${j]!<ZQH[J' );
define( 'AUTH_SALT',        'L)v)78|_J>$2PcQZyjjq/KaIpe+b5)g*LT]@S[RQGq)F%uuCXNom4/@@mp$d@}>x' );
define( 'SECURE_AUTH_SALT', '0$u(&`DoQjs=zF(^! 3.x.j+CyQ3O^qc8P&IW`Z?y]N6T!2d@#FOau6|rZ`YwBM{' );
define( 'LOGGED_IN_SALT',   'a&Z`-2,ch~O*bNxU;MTfODZSIW2,G=r9<D;b}~NCYCbp9WN$J<ef$!?H[8Jm&`N,' );
define( 'NONCE_SALT',       '7I,Dg76<k+}kw-J%8bD8<1xg1FRthj7t||}[a;6)t/5*![=JL5p[Fd.IR>rbY&HM' );
// JWT Settings
define('JWT_AUTH_SECRET_KEY', '7I,Dg76<k+}kw-J%8bD8<1xg1FRthj7t||}[a;6)t/5*![=JL5p[Fd.IR>rbY&HM'); // второй параметр будет шифиовать токен
define('JWT_AUTH_CORS_ENABLE', true); // плагин добавить необходимые заголовки, чтобы кросс домены работали
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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
