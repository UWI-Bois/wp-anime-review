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
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Xtf4scBVseIVrHOlEwWtTNUpL8ZIWhH/aeZMDo+AVp5yRd+8WjkoGal3lyzXWEPWuPtV/G6Za/H9KkhNpGbIHA==');
define('SECURE_AUTH_KEY',  'Rmj5cx07NdY7v+gdYAdf53hSrOSnrdOxVCj//j2PCNHKKziVu6qAFyA4hJMl8rUmR00dX/M8AXNZq/466mrxYg==');
define('LOGGED_IN_KEY',    'pqBnUEnXsO6XWBHzWK+8TKxiRC9VF28XZdyicrHxJ2xUskKuRzRh/BU5yhD/V07qi4Axic7v4eXmOvlgk0/j/w==');
define('NONCE_KEY',        'wLI+VLVz+f7vb5SPWJyPhg+mpNTvBWM6WzTJsSLAsOSQUdLUQO+gK0u89nWqMinj+EThKSEyecHRhF0TmpDJvA==');
define('AUTH_SALT',        'y0fuv+chF1qPAlFWWU0xioVHfVKxfjl5RjtlJvJ6Mj0UeBlhDAIRYo43ZtFQZMZFoIGpSGyYYtfVtctjbAdkHQ==');
define('SECURE_AUTH_SALT', 'KTmkOzP0Ys//gIDf1zPNaF/vE4hPqSJzSxAwAmn2H9RcW6FITLgssCzFrBXf4XhwROmWZBUs2+pYv6UmC1debA==');
define('LOGGED_IN_SALT',   'k1O1R+AANTDVMJEChioD6o8NZs0nx18/SOQ0cUBnwQl1KqYIvQVvFIHBS+7Kw12PkFyh/vqf6GM9FEGQU0vBUQ==');
define('NONCE_SALT',       'M4GkqkD3t1aKukmRBLOV8SR4mxuQp5PwyOE/ANNKdE3ZbTdJ6CHyFmnUKo6+2IL/xvCNK84O19YDHAHRiDLSdw==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
