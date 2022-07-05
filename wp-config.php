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
define( 'DB_NAME', 'wordpress_myweb' );

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
define( 'AUTH_KEY',         ') 6pes#^eD/EXT-/M>c87g8V?yU]-gSbkb=x-r06J4{/Kj^zEm*7sI3$cZp}p?C,' );
define( 'SECURE_AUTH_KEY',  'Ohu~ccA.V0SdpRs|^KTbCtn(ZUAeEb[JM}s .3%gX5bhjWH&x)%ld`%*-hElq;.v' );
define( 'LOGGED_IN_KEY',    'r;#-Y2l[ns+gi3xOfft%xeDA]=Aa%U-)J%3w6z9?F#Fy<CHiF[~ !dmId.(}h3)g' );
define( 'NONCE_KEY',        'E%b:RpnE6AtngW8o=jFSG=hBoyV+&(8|$,NLeHiQaRA:~XCuwt}eKd[C`onVTm1i' );
define( 'AUTH_SALT',        '#2J4s@8!HD_vs HOII|K+s `^L@=y9XDi`@<B.#YkP6r5^d(sP(cwxy^bTTlysv2' );
define( 'SECURE_AUTH_SALT', 'l!xHT=7RbBVDG<f&Gc8cY+IS@yeS>$hIgcJ=Qd+@RcLtw>Ta$Mh*3]t7Q~9Kkjy%' );
define( 'LOGGED_IN_SALT',   '4 U$7e?,&,0@y4d8D/M,2lu] lsa+GE@kdG5VzI>#K@q>m4X]hymZP6cu:y$LFGO' );
define( 'NONCE_SALT',       '5%/PbL0^@M~8{AMKcA$39P>$QV(b8%yPB?<?Yq~-w3na;U5kISt&_a~NN4Y@;R9&' );

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
