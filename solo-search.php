<?php
/**
Plugin Name: Solo
Plugin URI: https://wordpress.org/plugins/solo-search/
Description: 🔍 Instantly display a single search result
Version: 0.1
Author: David Artiss
Author URI: https://artiss.blog
Text Domain: solo

@package solo
 */

/**
 * Add meta to plugin details
 *
 * Add options to plugin meta line
 *
 * @param    string $links  Current links.
 * @param    string $file   File in use.
 * @return   string         Links, now with settings added.
 */
function solo_plugin_meta( $links, $file ) {

	if ( false !== strpos( $file, 'solo-search.php' ) ) {

		$links = array_merge( $links, array( '<a href="https://github.com/dartiss/solo">' . __( 'Github', 'solo' ) . '</a>' ) );

		$links = array_merge( $links, array( '<a href="https://wordpress.org/support/plugin/solo-search">' . __( 'Support', 'solo' ) . '</a>' ) );

		$links = array_merge( $links, array( '<a href="https://artiss.blog/donate">' . __( 'Donate', 'solo' ) . '</a>' ) );

		$links = array_merge( $links, array( '<a href="https://wordpress.org/support/plugin/solo-search/reviews/#new-post">' . __( 'Write a Review', 'solo' ) . '&nbsp;⭐️⭐️⭐️⭐️⭐️</a>' ) );
	}

	return $links;
}

add_filter( 'plugin_row_meta', 'solo_plugin_meta', 10, 2 );

/**
 * If just one post in result just show it
 */
function solo_remove_single_results() {

	if ( is_search() ) {

		global $wp_query;

		if ( 1 == $wp_query->post_count && 1 == $wp_query->max_num_pages ) {
			wp_safe_redirect( get_permalink( $wp_query->posts[0]->ID ) );
			exit;
		}
	}
}

add_action( 'template_redirect', 'solo_remove_single_results' );
