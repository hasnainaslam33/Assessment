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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'assessment' );

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
define( 'AUTH_KEY',         'J[QN6`%hPknBNrweNnO%F/R dC93<y|FeDG`w,xrB%fC$KVeBg?6kJ$Um0~[]!@@' );
define( 'SECURE_AUTH_KEY',  'ZnQ;;!6w48X,SOK^Z]_iLsnh[J*hf3BN(<R:_8?Gvv6!(_dsFO#]@Z{(Ih=[7{~P' );
define( 'LOGGED_IN_KEY',    '*NgyyNM_f3U?#6oW!uxAv;OgOKI7D8*&a7P`a`_kLD~^Q~9Fs6(M$5=D ?V|SOui' );
define( 'NONCE_KEY',        'z-+(q[5T2HG*+9@XJNJyBNdk_HI|7HdsEr<S^?K#)43LkO@Gd<MGtl=hvc[.1&a6' );
define( 'AUTH_SALT',        ')l[[$ja^DV%soa>NaD{#Z+3NTRRM`$.nf<^*lAp@<*t.]y@L.)Yx,>J2NGT&zbvB' );
define( 'SECURE_AUTH_SALT', 'E,SNK9!w.<D5BMsr;WOR^mg(MldB<fh+$1/TvE%&4qa6T1=MMv5I*-4^i{]0GT_P' );
define( 'LOGGED_IN_SALT',   '<ZCd#PTT7$dw =KuEUHWP^7bmAO&0r1mPw/coMmEIc$QM,/[SQX1+FL?S0},Ni8f' );
define( 'NONCE_SALT',       '_$RNi:Rhv{d<tgl;V/=IOLeCxwXc|=r7LAfR,]=$U[Z?A!-{,. aD*EUM}[45c]k' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
