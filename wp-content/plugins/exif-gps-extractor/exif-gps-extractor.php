<?php
/**
 * Plugin Name: GPS Metadata Plugin
 * Description: Extract GPS data from uploaded images and save to metadata.
 * Version: 1.0
 * Author: haokexin
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Autoload classes
spl_autoload_register(function ($class_name) {
    if (strpos($class_name, 'GPSMetadata') !== false || strpos($class_name, 'ImageMetaInjector') !== false) {
        include plugin_dir_path(__FILE__) . 'includes/' . $class_name . '.php';
    }
});

// Initialize the plugin
add_action('plugins_loaded', function() {
    GPSMetadataPlugin::get_instance();
    ImageMetaInjector::get_instance();
});