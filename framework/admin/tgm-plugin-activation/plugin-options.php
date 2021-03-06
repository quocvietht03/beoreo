<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.3.6
 * @author     Thomas Griffin <thomas@thomasgriffinmedia.com>
 * @author     Gary Jones <gamajo@gamajo.com>
 * @copyright  Copyright (c) 2012, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */
/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname(__FILE__) . '/class-tgm-plugin-activation.php';
add_action('tgmpa_register', 'beoreo_register_required_plugins');
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function beoreo_register_required_plugins() {
    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
	$root = 'http://beplusthemes.com/install/plugin/';
    $plugins = array(
		array(
            'name'               => esc_html__('Bears Core', 'beoreo'),
            'slug'               => 'bears_core',
            'source'             => $root .'bears_core.zip',
            'required'           => true,
        ),
        array(
            'name'               => esc_html__('Bears Shortcode', 'beoreo'),
            'slug'               => 'bears_shortcodes',
            'source'             => $root .'bears_shortcodes.zip',
            'required'           => true,
        ),
		array(
            'name'      		 => esc_html__('Custom Post Type UI', 'beoreo'),
            'slug'       		 => 'custom-post-type-ui',
            'required'  		 => true,
        ),
		array(
            'name'               => esc_html__('Lemon Grid', 'beoreo'),
            'slug'               => 'lemongrid',
            'source'             => $root .'lemongrid.zip',
            'required'           => true,
        ),
        array(
            'name'               => esc_html__('Revolution Slider', 'beoreo'),
            'slug'               => 'revslider',
            'source'             => $root .'revslider.zip',
            'required'           => true,
        ),
        array(
            'name'               => esc_html__('WPBakery Page Builder', 'beoreo'),
            'slug'               => 'js_composer',
            'source'             => $root .'js_composer.zip',
            'required'           => true,
        ),
        array(
            'name'               => esc_html__('Bears Fullscreen Login', 'beoreo'),
            'slug'               => 'bears-fullscreen-login',
            'source'             => $root .'bears-fullscreen-login.zip',
            'required'           => false,
        ),
        array(
            'name'               => esc_html__('WooCommerce - excelling eCommerce', 'beoreo'),
            'slug'               => 'woocommerce',
            'required'           => false,
        ),
		array(
            'name'               => esc_html__('Contact Form 7', 'beoreo'),
            'slug'               => 'contact-form-7',
            'required'           => false,
        ),
		array(
            'name'               => esc_html__('Newsletter', 'beoreo'),
            'slug'               => 'newsletter',
            'required'           => false,
        ),
		array(
            'name' 				=> esc_html__('WP User Avatar', 'beoreo'),
            'slug' 				=> 'wp-user-avatar',
            'required' 			=> false,
        )
    );
    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'domain' => 'beoreo', // Text domain - likely want to be the same as your theme.
        'default_path' => '',
        //'parent_menu_slug' => 'themes.php', // Default parent menu slug
        //'parent_url_slug' => 'themes.php', // Default parent URL slug
        'menu' => 'install-required-plugins', // Menu slug
        'has_notices' => true, // Show admin notices or not
        'is_automatic' => false, // Automatically activate plugins after installation or not
        'message' => '', // Message to output right before the plugins table
        'strings' => array(
            'page_title' => __('Install Required Plugins', 'beoreo'),
            'menu_title' => __('Install Plugins', 'beoreo'),
            'installing' => __('Installing Plugin: %s', 'beoreo'), // %1$s = plugin name
            'oops' => __('Something went wrong with the plugin API.', 'beoreo'),
            'notice_can_install_required' => _n_noop('This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'beoreo'), // %1$s = plugin name(s)
            'notice_can_install_recommended' => _n_noop('This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'beoreo'), // %1$s = plugin name(s)
            'notice_cannot_install' => _n_noop('Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'beoreo'), // %1$s = plugin name(s)
            'notice_can_activate_required' => _n_noop('The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'beoreo'), // %1$s = plugin name(s)
            'notice_can_activate_recommended' => _n_noop('The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'beoreo'), // %1$s = plugin name(s)
            'notice_cannot_activate' => _n_noop('Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'beoreo'), // %1$s = plugin name(s)
            'notice_ask_to_update' => _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'beoreo'), // %1$s = plugin name(s)
            'notice_cannot_update' => _n_noop('Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'beoreo'), // %1$s = plugin name(s)
            'install_link' => _n_noop('Begin installing plugin', 'Begin installing plugins', 'beoreo'),
            'activate_link' => _n_noop('Activate installed plugin', 'Activate installed plugins', 'beoreo'),
            'return' => __('Return to Required Plugins Installer', 'beoreo'),
            'plugin_activated' => __('Plugin activated successfully.', 'beoreo'),
            'complete' => __('All plugins installed and activated successfully. %s', 'beoreo'), // %1$s = dashboard link
            'nag_type' => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
        )
    );
    tgmpa($plugins, $config);
}