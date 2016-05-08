<?php

use Roots\Sage\Extras;

/**
 * Creates the Board and General Meeting Agenda post types.
 * This file also registers functions for filtering these
 * post types' archives by semester.
 *
 * This file also hooks a function to set any menu item with the title
 * "Meeting Agenda" as the current menu item on the agenda archive page.
 *
 * The combined Board and General Meeting Agenda archive can be found at
 * {home_url}/agenda
 * (This assumes that permalinks are "pretty" and set to be by post name)
 *
 * The Board Agenda post type is registered as "board_agenda".
 * The General Meeting Agenda post type is registered as "general_agenda".
 *
 * This file follows the coding standards detailed here:
 * http://codex.wordpress.org/WordPress_Coding_Standards
 * from https://github.com/HBC-Rochester/Website/tree/master/wp-content/themes/cif/semesterly-post-types
 */

/**
 * Registers the Board and General Meeting Agenda post types.
 */
function register_agenda_post_type() {
	/**
	 * Register a custom post type for board meeting agenda.
	 * See http://codex.wordpress.org/Function_Reference/register_post_type
	 * for more information on how this works.
	 */
	$board_agenda_labels = array(
		'name'				 => 'Board Agenda',
		'singular_name'		 => 'Board Agenda',
		'add_new_item'		 => 'Add New Board Agenda',
		'edit_item'			 => 'Edit Board Agenda',
		'new_item'			 => 'New Board Agenda',
		'view_item'			 => 'View Board Agenda',
		'search_items'		 => 'Search Board Agenda',
		'not_found'			 => 'No board agenda found.',
		'not_found_in_trash' => 'No board agenda found in Trash.',
	);

	$board_agenda_args = array(
		'labels'		=> $board_agenda_labels,
		'description'	=> 'Agenda for HBC board meetings.',
		'public'		=> true,
		'menu_position'	=> 5, // Appears below Posts in the admin sidebar
		'has_archive'	=> true,
	);

	register_post_type( 'board_agenda', $board_agenda_args );



	/**
	 * Register a custom post type for floor meeting agenda.
	 * See http://codex.wordpress.org/Function_Reference/register_post_type
	 * for more information on how this works.
	 */
	$floor_agenda_labels = array(
		'name'				 => 'General Meeting Agenda',
		'singular_name'		 => 'General Meeting Agenda',
		'add_new_item'		 => 'Add New General Meeting Agenda',
		'edit_item'			 => 'Edit General Meeting Agenda',
		'new_item'			 => 'New General Meeting Agenda',
		'view_item'			 => 'View General Meeting Agenda',
		'search_items'		 => 'Search General Meeting Agenda',
		'not_found'			 => 'No floor agenda found.',
		'not_found_in_trash' => 'No floor agenda found in Trash.',
	);

	$floor_agenda_args = array(
		'labels'		=> $floor_agenda_labels,
		'description'	=> 'Agenda for HBC floor meetings.',
		'public'		=> true,
		'menu_position'	=> 5, // Appears below Posts in the admin sidebar
		'has_archive'	=> true,
	);

	register_post_type( 'general_agenda', $floor_agenda_args );
}
add_action( 'init', 'register_agenda_post_type' );



/**
 * Generates the post title for meeting agenda posts.
 *
 * The generated post title is in the format "Board/General Meeting Agenda for {date}".
 *
 * This function is called just before post data is saved because the
 * time of publication is required for generating the meeting agenda titles.
 *
 * @param $post_id The id of the post which was just saved.
 */
function generate_agenda_post_title( $data ) {
	// Only generate the title for board/floor agenda
	if ( ! ( 'board_agenda' == $data['post_type'] || 'general_agenda' == $data['post_type'] ) )
		return $data;

	// Get a human readable meeting date string (Month dd{st/nd/rd/th}, YYYY)
	$date = new DateTime($data['post_date_gmt']);
	$meeting_date_string = $date->format( 'F jS, Y' );

	// Create the new title in the format "Board/General Meeting Agenda for {date}"
	if ( 'board_agenda' == $data['post_type'] )
		$new_title = 'Board';
	else if ( 'general_agenda' == $data['post_type'] )
		$new_title = 'Floor';

	$new_title .= ' Agenda for ' . $meeting_date_string;

	$data['post_title'] = $new_title;
	$data['post_name'] = sanitize_title( $meeting_date_string );

	return $data;
}
add_action( 'wp_insert_post_data', 'generate_agenda_post_title' );


/**
 * Filters the HTML title on the combined agenda archive page to always display
 * as "{Semester} {Year} Meeting Agenda".
 *
 * Without this filter the archives may simply display the year as the title.
 *
 * @param string $title Title of the page.
 * @param string $sep (optional) How to separate the various items within the page title. Default is '»'.
 * @param string $seplocation (optional) Direction to display title, 'right'.
 */
function agenda_semesterly_archive_title_filter( $title, $sep = '&raquo;', $seplocation = 'right' ) {
	$title = semesterly_archive_title_filter( $title, 'general_agenda', 'Meeting Agenda', $sep, $seplocation );
	return semesterly_archive_title_filter( $title, 'board_agenda', 'Meeting Agenda', $sep, $seplocation );
}
add_filter( 'wp_title', 'agenda_semesterly_archive_title_filter', 10, 3 );



/**
 * Allows WordPress to recognize the semesterly URL structure of the
 * combined Floor and Board Agenda post types' archive page.
 *
 * All URL rewrites are documented inside this function's contents.
 *
 * When changing these rewrite rules, the .htaccess file will need to be updated.
 * This can be done by clicking the "Save" button on the Permalinks settings page
 * in WordPress, or by calling flush_rewrite_rules(), which should only
 * be called once. Do NOT make a call to flush_rewrite_rules() on every page load!
 * It's unnecessary and impacts performance.
 *
 * @param WP_Rewrite $wp_rewrite The global WP_Rewrite instance for managing rewrite rules.
 */
function add_agenda_url_rewrite_rules( $wp_rewrite ) {
	$wp_rewrite->rules = array(

		/**
		 * Meeting agenda archive URL structure.
		 * Shows agenda for the latest semester.
		 */
		'agenda/?$' => $wp_rewrite->index . '?post_type=board_agenda',

		/**
		 * Meeting agenda archive URL structure.
		 * agenda/{string}/{year}/
		 * Example: agenda/spring/2013/
		 */
		'agenda/?([^/]*)/([0-9]{4})/?$' => $wp_rewrite->index . '?post_type=board_agenda&semester=' . $wp_rewrite->preg_index(1) . '&year=' . $wp_rewrite->preg_index(2),

	) + $wp_rewrite->rules;
}
add_filter( 'generate_rewrite_rules', 'add_agenda_url_rewrite_rules' );




/**
 * Applies the current-menu-item class to any menu item with
 * the title "Meeting Agenda" in a WordPress menu if the current page
 * is a meeting agenda archive.
 *
 * @param array $class The classes to apply to the menu item.
 * @param object $menu_item The menu item object.
 * @return array An array of classes to apply to the menu item.
 */
function add_agenda_current_menu_item_class( $classes = array(), $menu_item = false ) {
    if ( 'board_agenda' == Extras\get_post_type_outside_loop() && 'Meeting Agenda' == $menu_item->title && ! in_array( 'current-menu-item', $classes ) )
        $classes[] = 'current-menu-item';

    return $classes;
}
add_filter( 'nav_menu_css_class', 'add_agenda_current_menu_item_class', 10, 2 );


