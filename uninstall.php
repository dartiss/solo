<?php
/**
 * Uninstaller
 *
 * Uninstall the plugin by removing any options from the database
 *
 * @package solo-search
 */

// If the uninstall was not called by WordPress, exit.

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

// Delete options.

delete_option( 'solo_option_single' );
delete_option( 'solo_option_exact_posts' );
delete_option( 'solo_option_exact_pages' );
