<?php
/**
 * Solo
 *
 * @package           solo
 * @author            David Artiss
 * @license           GPL-2.0-or-later
 *
 * Plugin Name:       Solo
 * Plugin URI:        https://wordpress.org/plugins/solo-search/
 * Description:       🔍 Instantly display a single search result
 * Version:           1.0.1
 * Requires at least: 4.6
 * Requires PHP:      7.4
 * Author:            David Artiss
 * Author URI:        https://artiss.blog
 * Text Domain:       solo-search
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License version 2, as published by the Free Software Foundation. You may NOT assume
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
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

		$links = array_merge(
			$links,
			array( '<a href="https://github.com/dartiss/solo">' . __( 'Github', 'solo-search' ) . '</a>' ),
			array( '<a href="https://wordpress.org/support/plugin/solo-search">' . __( 'Support', 'solo-search' ) . '</a>' ),
			array( '<a href="https://artiss.blog/donate">' . __( 'Donate', 'solo-search' ) . '</a>' ),
			array( '<a href="https://wordpress.org/support/plugin/solo-search/reviews/#new-post">' . __( 'Write a Review', 'solo-search' ) . '&nbsp;⭐️⭐️⭐️⭐️⭐️</a>' )
		);
	}

	return $links;
}

add_filter( 'plugin_row_meta', 'solo_plugin_meta', 10, 2 );

/**
 * Modify actions links.
 *
 * Add or remove links for the actions listed against this plugin
 *
 * @param    string $actions      Current actions.
 * @param    string $plugin_file  The plugin.
 * @return   string               Actions, now with deactivation removed!
 */
function solo_action_links( $actions, $plugin_file ) {

	// Make sure we only perform actions for this specific plugin!
	if ( strpos( $plugin_file, 'solo-search.php' ) !== false ) {

		// Add link to the settings page.
		array_unshift( $actions, '<a href="' . admin_url() . 'options-general.php">' . __( 'Settings', 'solo-search' ) . '</a>' );

	}

	return $actions;
}

add_filter( 'plugin_action_links', 'solo_action_links', 10, 2 );

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

/**
 * Add to settings
 *
 * Add a field to the general settings screen for assorted options
 */
function solo_settings_init() {

	add_settings_section( 'solo_section', __( 'Solo Search', 'solo-search' ), 'solo_section_callback', 'general' );

	add_settings_field( 'solo_option_single', __( 'Single result redirect', 'solo-search' ), 'solo_setting_single_callback', 'general', 'solo_section', array( 'label_for' => 'solo_option_single' ) );

	register_setting( 'general', 'solo_option_single' );

	add_settings_field( 'solo_option_exact_posts', __( 'Exact title match', 'solo-search' ), 'solo_setting_exact_posts_callback', 'general', 'solo_section', array( 'label_for' => 'solo_option_exact_posts' ) );

	register_setting( 'general', 'solo_option_exact_posts' );

	add_settings_field( 'solo_option_exact_pages', '', 'solo_setting_exact_pages_callback', 'general', 'solo_section', array( 'label_for' => 'solo_option_exact_pages' ) );

	register_setting( 'general', 'solo_option_exact_pages' );
}

add_action( 'admin_init', 'solo_settings_init' );

/**
 * Section callback
 *
 * Create the new section that we've added to the general settings screen
 */
function solo_section_callback() {

	echo esc_attr( __( 'Define how you want search results to be handled, when exact matches and single results are found.', 'solo-search' ) );
}

/**
 * Single match setting callback
 *
 * Output the settings field for whether to allow single matches
 */
function solo_setting_single_callback() {

	echo '<label><input name="solo_option_single" type="checkbox" value="1" ' . checked( 1, get_option( 'solo_option_single', 1 ), false ) . '>&nbsp;&nbsp;If a single result is found, redirect to that result</label>';
}

/**
 * Exact posts setting callback
 *
 * Output the settings field for whether to match exact named posts
 */
function solo_setting_exact_posts_callback() {

	echo '<label><input name="solo_option_exact_posts" type="checkbox" value="1" ' . checked( 1, get_option( 'solo_option_exact_posts', '' ), false ) . '>&nbsp;&nbsp;Posts</label>';
}

/**
 * Exact pages setting callback
 *
 * Output the settings field for whether to match exact named pages
 */
function solo_setting_exact_pages_callback() {

	echo '<label><input name="solo_option_exact_pages" type="checkbox" value="1" ' . checked( 1, get_option( 'solo_option_exact_pages', '' ), false ) . '>&nbsp;&nbsp;Pages</label><br><br><p class="description">If an exact match to a title is found, redirect to it.</p>';
}
