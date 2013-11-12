<?php
/*
Plugin Name: Simple Everlytic Nesletter Subscription
Plugin URI: http://sprout.co.ke
Description: Simple customisable plugin to collect email addresses
Version: 1
Author: Trevor Kimenye
Author URI: http://sprout.co.ke
License: GPL

*/

// Plugin Activation
function ns_install() {
    global $wpdb;
}

register_activation_hook( __FILE__, 'ns_install');

// Plugin Deactivation
function ns_uninstall() {
    global $wpdb;	
}

register_deactivation_hook( __FILE__, 'ns_uninstall');

// Generate Subscribe Form
function nssubform($atts=array()) {	
	extract(shortcode_atts(array(
		"form_id" => ""
	), $atts));


	$return = '<div class="newsletter">';
	$return .= '<form class="subscribe-form method="POST" action="http://localhost:3000/public/contacts/subscription">';
	$return .= '<input type="text" name="contact_email" placeholder="example@domain.com" />';
	$return .= '<input type="hidden" name="op" value="subscribe" id="op" />';
	$return .= '<input type="hidden" name="form_hash" value="oivBL9gqFt7fNzlz" id="form_hash" />';
	$return .= '<input type="hidden" name="list_id[]" value="68273" id="list_id[]" />';
	$return .= '<a class="mail-icon" href="#"></a>';
	$return .= '<span class="instructions">Subscribe to our newsletter</span>';
	$return .= '</form>';
	$return .= '</div>';

	return $return;
}

add_shortcode( 'nssubform', 'nssubform' );

add_action( 'wp_enqueue_scripts', 'prefix_add_my_scripts' );

/**
 * Enqueue plugin style-file
 */
function prefix_add_my_scripts() {
    // Respects SSL, Style.css is relative to the current file
    wp_register_style( 'prefix-style', plugins_url('style.css', __FILE__) );
    wp_enqueue_script('main', plugins_url('main.js', __FILE__));
    wp_enqueue_style( 'prefix-style' );
}

if ($_POST['sml_subscribe']) {
}


function plugin_get_version() {
	$plugin_data = get_plugin_data(__FILE__);
	$plugin_version = $plugin_data['Version'];
	return $plugin_version;
}

?>