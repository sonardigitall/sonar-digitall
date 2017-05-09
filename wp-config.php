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
define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', 'C:\xampp\htdocs\wordpress\wp-content\plugins\wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'eDci#(D^:KV;S,|+|P[@::Sl(lPr Rw24i:slIWm<BljdDd7AKfC/(y]<I|B-Emm');
define('SECURE_AUTH_KEY',  '_w8~9Y 8@{HjDFW+C2RNT|iQA(O|,]tkf0KLY|2C+qOnE,$-R8:c:-U3mGF-@xkY');
define('LOGGED_IN_KEY',    ',K]5m>K125K>ie>zun<2KW`DL5M0hAJjwpAQYuG2)+db]ZK}dV(EU?Ck`jh{qJg#');
define('NONCE_KEY',        '3r507AAcA4xg:sCGe`W<o:c}8l/Gr3d<7>?;F8%;IG+>(nx_r+^DkVSFE(g=oFaR');
define('AUTH_SALT',        'Vpk;RYt#^y:409oWV[MbAPG;mS5QugMsPt:$6ws1zxe,CdY4rfK8|o^)T9m`W!l%');
define('SECURE_AUTH_SALT', '&9i8msxwQHY;5_-#+Dv28+^I:a$z:uR;bYp1~6VDR4<|./UDVNSHhLRndN*zv0/b');
define('LOGGED_IN_SALT',   'wgr41FF)G9]3Ai;:O(ZNqKzgeIq)JEXPs4ZS:.WLZ)75;yX]Ahy`zP}6cRg^xjHo');
define('NONCE_SALT',       'P L/yW6iy,T#^NeM;{/*$(Tf9DT^{!~ps`12EjO2IG<<N%be;3y+%]t]=hwkpe;L');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
