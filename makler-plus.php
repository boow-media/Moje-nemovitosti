<?php
/**
 * Plugin Name: Makléř+
 * Plugin URI: https://boow.cz
 * Description: Plugin pro realitní makléře – přidávání, správa a zobrazení nemovitostí. Funguje s Meta Box pluginem.
 * Version: 1.2.0
 * Author: Boow Media
 * Author URI: https://boow.cz
 * License: GPL2
 */

if (!defined('ABSPATH')) {
    exit;
}

// ✅ Načtení vlastního CSS a JS pro administraci
add_action('admin_enqueue_scripts', function () {
    wp_enqueue_style('makler-plus-admin-style', plugin_dir_url(__FILE__) . 'assets/css/admin-style.css');
    wp_enqueue_script('makler-plus-admin-script', plugin_dir_url(__FILE__) . 'assets/js/admin-script.js', [], false, true);
});

// ✅ Načtení pluginu po načtení všech ostatních
add_action('plugins_loaded', function () {
    if (!class_exists('RWMB_Loader')) {
        add_action('admin_notices', function () {
            echo '<div class="notice notice-error"><p><strong>Plugin Makléř+ potřebuje aktivní Meta Box!</strong></p></div>';
        });
        return;
    }

    // ✅ Načtení částí pluginu
    require_once plugin_dir_path(__FILE__) . 'includes/post-type.php';
    require_once plugin_dir_path(__FILE__) . 'includes/meta-boxes.php';
    require_once plugin_dir_path(__FILE__) . 'includes/updater.php';
    require_once plugin_dir_path(__FILE__) . 'includes/admin-columns.php';
    require_once plugin_dir_path(__FILE__) . 'includes/filters.php';
    require_once plugin_dir_path(__FILE__) . 'includes/status-display.php';
});