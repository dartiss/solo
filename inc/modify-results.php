<?php
/**
 * Modify results
 *
 * Make the appropriate changes to the search results.
 *
 * @package solo-search
 */

// Exit if accessed directly.

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * If just one post in result just show it
 */
function solo_remove_single_results() {

	if ( is_search() ) {

		global $wp_query;

		$posts  = get_option( 'solo_option_exact_posts' );
		$pages  = get_option( 'solo_option_exact_pages' );
		$single = get_option( 'solo_option_single' );
		if ( false === $single ) {
			$single = 1;
		}

		// If an exact match for a post or page title is found, go straight to that.
		if ( function_exists( 'wpcom_vip_get_page_by_title' ) ) {

			if ( wpcom_vip_get_page_by_title( get_search_query(), 'OBJECT', 'post' ) && 1 === $posts ) {
				wp_safe_redirect( get_permalink( wpcom_vip_get_page_by_title( get_search_query() )->ID ) );
				exit;
			}

			if ( wpcom_vip_get_page_by_title( get_search_query(), 'OBJECT', 'page' ) && 1 === $pages ) {
				wp_safe_redirect( get_permalink( wpcom_vip_get_page_by_title( get_search_query() )->ID ) );
				exit;
			}
		} else {

			if ( get_page_by_title( get_search_query(), 'OBJECT', 'post' ) && 1 === $posts ) { // @codingStandardsIgnoreLine -- for non-VIP environments
				wp_safe_redirect( get_permalink( get_page_by_title( get_search_query() )->ID ) ); // @codingStandardsIgnoreLine -- for non-VIP environments
				exit;
			}

			if ( get_page_by_title( get_search_query(), 'OBJECT', 'page' ) && 1 === $pages ) { // @codingStandardsIgnoreLine -- for non-VIP environments
				wp_safe_redirect( get_permalink( get_page_by_title( get_search_query() )->ID ) ); // @codingStandardsIgnoreLine -- for non-VIP environments
				exit;
			}
		}

		// If only one result is found, redirect straight to it!
		if ( 1 === $single && 1 === $wp_query->post_count && 1 === $wp_query->max_num_pages ) {
			wp_safe_redirect( get_permalink( $wp_query->posts[0]->ID ) );
			exit;
		}
	}
}

add_action( 'template_redirect', 'solo_remove_single_results' );
