<?php
/**
 * Plugin Name: Moje nemovitosti
 * Plugin URI: https://boow.cz
 * Description: Plugin pro realitní makléře – umožňuje snadno přidávat a upravovat nabídky nemovitostí.
 * Version: 1.0.4
 * Author: Boow Media
 * Author URI: https://boow.cz
 * License: GPL2
 */

if (!defined('ABSPATH')) {
    exit; // Zabrání přímému přístupu
}

// ✅ Kontrola, jestli je Meta Box aktivní
if (!class_exists('RWMB_Loader')) {
    add_action('admin_notices', function () {
        echo '<div class="notice notice-error"><p><strong>Plugin Moje Nemovitosti potřebuje aktivní Meta Box!</strong></p></div>';
    });
    return;
}

// ✅ Vytvoření vlastního post typu "Nemovitosti"
function vytvorit_nemovitosti_cpt() {
    $args = array(
        'labels' => array(
            'name' => 'Nemovitosti',
            'singular_name' => 'Nemovitost',
            'add_new' => 'Přidat novou',
            'add_new_item' => 'Přidat novou nemovitost',
            'edit_item' => 'Upravit nemovitost',
            'new_item' => 'Nová nemovitost',
            'view_item' => 'Zobrazit nemovitost',
            'search_items' => 'Hledat nemovitosti',
            'not_found' => 'Žádné nemovitosti nenalezeny',
            'not_found_in_trash' => 'Žádné nemovitosti v koši',
        ),
        'public' => true,
        'menu_icon' => 'dashicons-admin-home',
        'supports' => array('title', 'editor', 'thumbnail'),
        'has_archive' => true,
        'rewrite' => array('slug' => 'nemovitosti'),
    );
    register_post_type('nemovitosti', $args);
}
add_action('init', 'vytvorit_nemovitosti_cpt', 10);

// ✅ Přidání vlastních polí pomocí Meta Box
add_filter('rwmb_meta_boxes', function($meta_boxes) {
    $meta_boxes[] = [
        'title'  => 'Detaily nemovitosti',
        'id'     => 'detaily_nemovitosti',
        'post_types' => ['nemovitosti'],
        'fields' => [
            ['name' => 'Cena', 'id' => 'cena', 'type' => 'text', 'placeholder' => 'Zadejte cenu v Kč'],
            ['name' => 'Dispozice', 'id' => 'dispozice', 'type' => 'text', 'placeholder' => 'Např. 3+kk'],
            ['name' => 'Adresa', 'id' => 'adresa', 'type' => 'text', 'placeholder' => 'Např. Praha 1, Karlova 10'],
            ['name' => 'Velikost (m²)', 'id' => 'velikost', 'type' => 'number', 'placeholder' => 'Např. 75'],
            ['name' => 'Typ nemovitosti', 'id' => 'typ_nemovitosti', 'type' => 'select', 'options' => ['byt' => 'Byt', 'dum' => 'Dům', 'pozemek' => 'Pozemek', 'komercni' => 'Komerční prostor']],
        ],
    ];
    return $meta_boxes;
});

// ✅ Automatické aktualizace pluginu z GitHubu
class Moje_Nemovitosti_Updater {
    private $plugin_slug = 'moje-nemovitosti/moje-nemovitosti.php';
    private $github_user = 'boow-media';
    private $github_repo = 'Moje-nemovitosti';

    public function __construct() {
        add_filter('pre_set_site_transient_update_plugins', [$this, 'check_for_updates']);
        add_filter('plugins_api', [$this, 'plugin_info'], 10, 3);
    }

    public function check_for_updates($transient) {
        if (empty($transient->checked)) {
            return $transient;
        }

        $request = wp_remote_get("https://api.github.com/repos/{$this->github_user}/{$this->github_repo}/releases/latest", ['headers' => ['User-Agent' => 'WordPress']]);

        if (is_wp_error($request)) {
            return $transient;
        }

        $release = json_decode(wp_remote_retrieve_body($request));

        if (!empty($release->tag_name)) {
            $transient->response[$this->plugin_slug] = (object) [
                'new_version' => ltrim($release->tag_name, 'v'),
                'package' => $release->zipball_url,
                'url' => $release->html_url
            ];
        }

        return $transient;
    }

    public function plugin_info($false, $action, $args) {
        if ($action !== 'plugin_information' || $args->slug !== 'moje-nemovitosti') {
            return $false;
        }

        $request = wp_remote_get("https://api.github.com/repos/{$this->github_user}/{$this->github_repo}/releases/latest", ['headers' => ['User-Agent' => 'WordPress']]);

        if (is_wp_error($request)) {
            return $false;
        }

        $release = json_decode(wp_remote_retrieve_body($request));

        return (object) [
            'name' => 'Moje Nemovitosti',
            'slug' => 'moje-nemovitosti',
            'version' => ltrim($release->tag_name, 'v'),
            'author' => 'Boow Media',
            'download_link' => $release->zipball_url ?? '',
            'sections' => ['description' => 'Plugin pro správu nemovitostí s automatickými aktualizacemi přes GitHub.']
        ];
    }
}

// ✅ Spuštění updateru
new Moje_Nemovitosti_Updater();

// ✅ Reset cache aktualizací po aktivaci pluginu
register_activation_hook(__FILE__, function () {
    delete_site_transient('update_plugins');
    wp_update_plugins();
});
