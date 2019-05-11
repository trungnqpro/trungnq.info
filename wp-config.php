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
define( 'DB_NAME', 'zsgrebyu_trungnq' );

/** MySQL database username */
define( 'DB_USER', 'zsgrebyu_trungnq' );

/** MySQL database password */
define( 'DB_PASSWORD', 'S1I.K!pB64' );

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
define( 'AUTH_KEY',         'no8eirjwnyfmm8xzbuegbv5wv883p4be9zeidc33oqdiayhwvwrlwkrjq8vrzi0v' );
define( 'SECURE_AUTH_KEY',  '2pqapbbymjygbnmknfhty9tniez8oz3kn0qrxz6wbpxx6venkfvcsmulnpusavzc' );
define( 'LOGGED_IN_KEY',    'lehfm7orwgpc5zcs0offh7xxws4uuivbssqqdy4swhxw3pjdfd98qk9fdh3apvq2' );
define( 'NONCE_KEY',        '7elqdihupcjbnqexnxfpqmuaha199b8brnjgfj1ov89iccntnlnis7wynroi7djq' );
define( 'AUTH_SALT',        'xswy3wkcclnqkrdgiarculnfhwqdfrxqbyx1xdmft2yhs20p0tfjyifchwe1jyvy' );
define( 'SECURE_AUTH_SALT', 'wwapgjg8cejbuhpz2mnv1aznphlqfnq9ug7zaecizlo3ffrpaerzd3pcwhl6gh7k' );
define( 'LOGGED_IN_SALT',   'e63lhlieaz2vl7mj8l8j0qbqei4era6myh4sn0hzsklx4pimemqmrvjcazuuwvef' );
define( 'NONCE_SALT',       'qmvg2jmd8olks9dj07jdyxlf2fg5wb1r6rmo9gvn0jkvfexmntneqhbgselirig3' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 't_';

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
