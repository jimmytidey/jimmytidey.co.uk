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
define('DB_NAME', 'jimmy');

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
define('AUTH_KEY',         '!~lb^|hn]Uj0Gv9jP--ET+K{OE/&/U.^=C.>+*K5)C3>cwQ1I,2[#W,.~#^<OA,-');
define('SECURE_AUTH_KEY',  '(E(|8N?I[9j2:KQpBf`0vzy//3c2d?f%OYOAfsp3RbHavp))g~r%o-)7[j/MPa *');
define('LOGGED_IN_KEY',    'OoD@daDj$ rPNkVn8NQ#8vz/i4_ZdfxR*^E.h+O8E-jU#C73,_n=o}=Jd[e~ Dk]');
define('NONCE_KEY',        '2=80YZsK|)m`)ImRd=`>B2j+1W!R]V.z4]R{T.dBwR#FVR@0cwi@~Xc4^sR=Y,6J');
define('AUTH_SALT',        '&UOyW%/utp[)MtFsDj)9mNQ?u?vkN11B>d=L;7Q?,t!19 !MXrm8jP`&^0)qaa3H');
define('SECURE_AUTH_SALT', '[+|j:/tt@&_{+;7*dR,.Y|7v_D^V?h%& ]wc]~{@M}8DyB48A4k4{U;R!E&KeXeI');
define('LOGGED_IN_SALT',   'A-?6jA1s1PxxhIA`vnX6GH/-fhHWa02-9]!1~#8fw&}{fIzv-s*X1~eUU}wDRuU-');
define('NONCE_SALT',       '{AO-r^94AOrTGJ;<qqE4}4OEZS14[0:*j-s+NCs{H:hYT<|Cv)A W*f(c(,0Z1bI');

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
