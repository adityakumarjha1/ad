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
define( 'DB_NAME', 'wp' );

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
define( 'AUTH_KEY',         '_>hKEh9=]q>jt`q/cX`S72BK0Lm:E?y?!]R*#WTW=;iH+]Arg/Ny7}rNgE*=kKTf' );
define( 'SECURE_AUTH_KEY',  'UYN6J,MNfNi_l;FNt5QQZ^Z[AFhzPW5km9-UgaF/YC6^vZX*F}Ef{P:M;sDnA<##' );
define( 'LOGGED_IN_KEY',    'jb&fg# gUTlxd|#97Pr%ym[q!w#1FZ;azZ~)4F@@AssKi)/5UdS?4rGkB+MHJC*T' );
define( 'NONCE_KEY',        'd=3NB-,HxH~pb0#fcJ(4Qx.)Q-Cg9EyU&aVm_i(KffD^g<703FiEYG1C49{L{a-O' );
define( 'AUTH_SALT',        'VCYno%cEKS[i/;@#(SX_8N~^$fpZBrpz T,RQ[`6u|Bqrfw7$A-Yr(MpcqJ`e&T{' );
define( 'SECURE_AUTH_SALT', 't#toqz2oU.K1(uK~S|5M0)KM]:N(cv<)h<hYV{ubJ1mDnnj($SVtc/Bxk(Pt[L^Q' );
define( 'LOGGED_IN_SALT',   'r[Y}H7gF8yGMp?Y~<Q=HLZBVex^k6<8v+3m~wBX?;f4|!`mtu}zk{_ag=hB#Ldl2' );
define( 'NONCE_SALT',       'PZJ$/Y.oZ:zLkIYs_,N^G6 N!K905b!X1+l[]<~szs_(/eLoN~|g|y6}54cos~2E' );

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
