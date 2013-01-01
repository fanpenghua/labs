<?php
/**
 * Labs Theme Options
 *
 * @package WordPress
 * @subpackage Labs_Theme
 * @since Labs Theme 1.0
 */

/**
 * Properly enqueue styles and scripts for our theme options page.
 *
 * This function is attached to the admin_enqueue_scripts action hook.
 *
 * @since Labs Theme 1.0
 *
 */
function labs_admin_enqueue_scripts( $hook_suffix ) {
	wp_enqueue_style( 'farbtastic' );
}


/**
 * Change the capability required to save the 'labs_options' options group.
 *
 * @see labs_theme_options_init() First parameter to register_setting() is the name of the options group.
 * @see labs_theme_options_add_page() The edit_theme_options capability is used for viewing the page.
 *
 * By default, the options groups for all registered settings require the manage_options capability.
 * This filter is required to change our theme options page to edit_theme_options instead.
 * By default, only administrators have either of these capabilities, but the desire here is
 * to allow for finer-grained control for roles and users.
 *
 * @param string $capability The capability used for the page, which is manage_options by default.
 * @return string The capability to actually use.
 */
function labs_option_page_capability( $capability ) {
}


/**
 * widgets Tools
 */
function labs_get_theme_options() {
}