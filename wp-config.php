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
define( 'DB_NAME', 'bft2' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'd6:,nzkg$ge]Be5nU{e/okn,WGzcG&jslCkZ51^e?eB[5uhN~lJ5(Y2~pONj#pT(' );
define( 'SECURE_AUTH_KEY',  '7fd6I/+V~X,KPpyA8Q{H)11?`%was0#r[#.%jp{tMuxy3OgXND_6 3dP[wuKY8xV' );
define( 'LOGGED_IN_KEY',    'P53D9C+-L_.juM0vc_pf!W4OTD4()j!SC~5U9glZ+5=HDeBu .FO}lTkhaDC^B.s' );
define( 'NONCE_KEY',        '.d@_Me#3~gkeGXSo_B^QrWM:ee*y2x`J2CmOs+PIRQQW@i2=l9[9gaI*GvV[-HwH' );
define( 'AUTH_SALT',        '~i&rfk1<_g*37|`P~~g!vn[Q]Y5{y0A*`oEuw*BhTh1TH!3Rh5/i8_PZ6y.,|Qhs' );
define( 'SECURE_AUTH_SALT', '~RdC<q:FO!,pGK|2yYQ}]9A(K.LW#%?O^xh)vEI#qi1#iz)W40v#dJ?y(%.6$Rz~' );
define( 'LOGGED_IN_SALT',   'c}:0JI:h+44Y_H`WaFX;4Y.#za7uv6Y#&$F9$xLU[xKHeqN*Ji$Khnpkffov&X#E' );
define( 'NONCE_SALT',       'PF@>pBf:%pBv|PmyVe[u qhB4WK%-A=gji8}2<L.<#XR+IH`uyipnt^lw%V50$;!' );

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
