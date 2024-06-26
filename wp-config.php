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
define( 'DB_NAME', 'des.sun.test.wp.woo.loc' );

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
define( 'AUTH_KEY',         'or <F%}mN)]3}+&3Rt}P;*2<~Wc1?jTa?`R!.Ih;n*(+IU@MT$i$c:s?W2nql%bA' );
define( 'SECURE_AUTH_KEY',  '/`6U-RB7s9hKrVu7/C7-Y6P?L={W?SLonTWE$qbH5Vu>}NwN}CN7$ 2W K]/b}}O' );
define( 'LOGGED_IN_KEY',    'NU}@~RUPH.7#|jxEDyX64B5?R2y.`{1;}_kWx2lSC6)AUNdKzCPSV91z1rg;]v*W' );
define( 'NONCE_KEY',        'b+o;:pSN;|%+YkAnTa).4}P[p#c}.8Ji}&<Rua(_$<Tu2ogl!3PztLb6m.+76k%p' );
define( 'AUTH_SALT',        '^~bEyws+OmXv2@_o=VGx$|2ZBV`Csm$36cSOkkjkT;4? co 28o=uKP}DZf?w?8u' );
define( 'SECURE_AUTH_SALT', 'dqm^5N}]#kQXiv#}!/wW3r*}SKb$#DankZe}q_)zz;^k,dqi+8ljjDa%E_sU@oZ|' );
define( 'LOGGED_IN_SALT',   '^=Dp^9C6lnbV_+0%_`kO2x80xL/SW:*5y*u$dBv{iC-E vQ+U4*P:g<m?B!Gzb)1' );
define( 'NONCE_SALT',       'XiYCcUj|$pmb=v~rT&:(&XoUH_1kCH=EO*haJQstCrxyffX[j%ii*6]C!|y,<9@@' );

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
