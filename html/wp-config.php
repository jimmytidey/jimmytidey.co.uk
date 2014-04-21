<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'jimmytidey.co.uk');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '~TCM`pG7tMuUL!&?o!g*xZW/_>x!8qce(+dxpO_q$hp0Y&Bl<gmI8FP@PeaF+Aj4');
define('SECURE_AUTH_KEY',  'wQ+,r@c1Q{{KT{MR<Ecvz)7*ua>ZGSjm[KKaWW6<_c#OkpyAZH}A^b) E&|lVaex');
define('LOGGED_IN_KEY',    'j$`Um?0`n|(3pySw/~WQaQs:ktWHf2g]7-V;uv b3|xgODC?:;DV1k2k/Xf2(b8L');
define('NONCE_KEY',        'v`YT}Z.d0bK-yjXa|Ec_B%mh93*A7);[c8z)9B)u^!9BTX1N,jca$JYK|gf]-<-l');
define('AUTH_SALT',        'f~Fnow4KDBK?1$x^uIc:gT-[hj (rgj{Y(p*)]OFO!v;|m-Vm3+IfAkyQGMvh}GL');
define('SECURE_AUTH_SALT', '.t1~{}Av,xY{<R^(|va]-%%U{YpK1[9R{^J5OQ4|rvPGuNVkX<(^o,<M}1}_]W8}');
define('LOGGED_IN_SALT',   'JFF@3hSu+x()D.b%}+U3+NlwJs*YAwZ96NqG9ysT*H}HoG* |6n5?%JVZ|XSVx@H');
define('NONCE_SALT',       '!8W[2|r).xfus[lO,aZ!_i|!U7TSY3mfvS.;kaQ1dH0U8V4Cplr:5)-s&CBMo?Xo');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
