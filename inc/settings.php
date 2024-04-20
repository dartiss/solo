<?php
/**
 * Settings Functions
 *
 * Add the various settings to the menus.
 *
 * @package solo-search
 */

// Exit if accessed directly.

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

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
