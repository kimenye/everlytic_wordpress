<?php
/*
Plugin Name: Simple Everlytic Newsletter Subscription
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
	$return .= '<form class="subscribe-form" method="POST" action="'.get_option('ns_form_submit_url').'">';
	$return .= '<input type="text" name="contact_email" class="subscribe_email" placeholder="example@domain.com" />';
	$return .= '<input type="hidden" name="op" value="subscribe" id="op" />';
	$return .= '<input type="hidden" name="form_hash" value="'.get_option('ns_form_hash').'" id="form_hash" />';
	$return .= '<input type="hidden" name="list_id[]" value="'.get_option('ns_form_list_id').'" id="list_id[]" />';
	$return .= '<a class="mail-icon" href="#"></a>';
	$return .= '<span class="instructions">Subscribe to our newsletter</span>';
	$return .= '</form>';
	$return .= '</div>';

	return $return;
}

add_shortcode( 'nssubform', 'nssubform' );

add_action( 'wp_enqueue_scripts', 'prefix_add_my_scripts' );

add_action('admin_menu', 'ns_plugin_settings');

/**
 * Add Newsletter page settings
 */
function ns_plugin_settings() {
    // add_menu_page('1stWD Slider Settings', '1stWD Slider Settings', 'administrator', 'fwds_settings', 'fwds_display_settings');

    add_menu_page('Everlytic Settings', 'Everlytic Settings', 'administrator', 'ns_settings', 'ns_display_settings');
}

function ns_display_settings() {
	$form_submit_url = get_option('ns_form_submit_url');
	$form_success_url = get_option('ns_form_success_url');
	$form_hash = get_option('ns_form_hash');
	$form_list_id = get_option('ns_form_list_id');

	$html = '<pre><div class="wrap">';
	$html .= '<form action="options.php" method="post" name="options">';
	$html .= '<h2>Select Your Settings</h2>';
	$html .= wp_nonce_field('update-options');

	$html .= '<table class="form-table" width="100%" cellpadding="10">';
	$html .= '<tbody>';
	
	$html .= '<tr>';
	$html .= '<td scope="row" align="left">';
	$html .= '<label>Submission Url</label>';
	$html .= '<input name="ns_form_submit_url" type="text" class="regular-text code" value="'.$form_submit_url.'" />';
	$html .= '</td>';
	$html .= '</tr>';

	$html .= '<tr>';
	$html .= '<td scope="row" align="left">';
	$html .= '<label>Form Hash</label>';
	$html .= '<input name="ns_form_hash" type="text" class="regular-text code" value="'.$form_hash.'"/>';
	$html .= '</td>';
	$html .= '</tr>';

	$html .= '<tr>';
	$html .= '<td scope="row" align="left">';
	$html .= '<label>List ID</label>';
	$html .= '<input name="ns_form_list_id" type="text" class="regular-text code" value="'.$form_list_id.'" />';
	$html .= '</td>';
	$html .= '</tr>';

	$html .= '<tr>';
	$html .= '<td>';
	$html .= '<label>Success Url</label>';
	$html .= '<input name="ns_form_success_url" type="text" class="regular-text code" value="'.$form_success_url.'">';
	$html .= '</td>';
	$html .= '</tr>';

	$html .= '</tbody>';
	$html .= '</table>';

	$html .= '<input type="hidden" name="action" value="update" /><input type="hidden" name="page_options" value="ns_form_submit_url,ns_form_success_url,ns_form_hash,ns_form_list_id" />';
	$html .= '<input type="submit" name="Submit" value="Update" />';

	$html .= '</form>';
	$html .= '</pre>';

	echo $html;
}


/**
 * Enqueue plugin style-file
 */
function prefix_add_my_scripts() {
    // Respects SSL, Style.css is relative to the current file
    wp_register_style( 'prefix-style', plugins_url('style.css', __FILE__) );
    wp_enqueue_script('main', plugins_url('main.js', __FILE__));
    wp_enqueue_style( 'prefix-style' );

    $form_success_url = get_option('ns_form_success_url');
    $config_array = array(
    	'success_url' => $form_success_url
	);

    wp_localize_script('main', 'setting', $config_array);
}

// if ($_POST['sml_subscribe']) {
// }


function plugin_get_version() {
	$plugin_data = get_plugin_data(__FILE__);
	$plugin_version = $plugin_data['Version'];
	return $plugin_version;
}

?>