<?php
/**
 * Plugin Name: Makléř+
 * Plugin URI: https://boow.cz
 * Description: Plugin pro realitní makléře – přidávání, správa a zobrazení nemovitostí. Funguje s Meta Box pluginem.
 * Version: 1.0.9
 * Author: Boow Media
 * Author URI: https://boow.cz
 * License: GPL2
 */

if (!defined('ABSPATH')) exit;

// Načteme jednotlivé části pluginu
require_once plugin_dir_path(__FILE__) . 'includes/post-type.php';
require_once plugin_dir_path(__FILE__) . 'includes/meta-boxes.php';
require_once plugin_dir_path(__FILE__) . 'includes/updater.php';