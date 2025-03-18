<?php
/**
 * Plugin Name: Moje Nemovitosti
 * Description: Vlastní post type Nemovitosti + Meta Box pole pro správu realit.
 * Version: 1.0
 * Author: Boow Media (www.boow.cz)
 */

if (!defined('ABSPATH')) {
    exit; // Zabrání přímému přístupu
}

// ✅ Kontrola, jestli je Meta Box aktivní
if (!class_exists('RWMB_Loader')) {
    add_action('admin_notices', function () {
        echo '<div class="notice notice-error"><p><strong>Plugin Moje Nemovitosti potřebuje aktivní Meta Box!</strong></p></div>';
    });
    return; // Zastaví běh pluginu, pokud Meta Box není aktivní
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
add_action('init', 'vytvorit_nemovitosti_cpt', 10); // Opravená registrace CPT

// ✅ Přidání vlastních polí pomocí Meta Box
add_filter('rwmb_meta_boxes', function($meta_boxes) {
    $meta_boxes[] = [
        'title'  => 'Detaily nemovitosti',
        'id'     => 'detaily_nemovitosti',
        'post_types' => ['nemovitosti'],
        'fields' => [
            [
                'name' => 'Cena',
                'id'   => 'cena',
                'type' => 'text',
                'placeholder' => 'Zadejte cenu v Kč',
            ],
            [
                'name' => 'Dispozice',
                'id'   => 'dispozice',
                'type' => 'text',
                'placeholder' => 'Např. 3+kk',
            ],
            [
                'name' => 'Adresa',
                'id'   => 'adresa',
                'type' => 'text',
                'placeholder' => 'Např. Praha 1, Karlova 10',
            ],
            [
                'name' => 'Velikost (m²)',
                'id'   => 'velikost',
                'type' => 'number',
                'placeholder' => 'Např. 75',
            ],
            [
                'name' => 'Typ nemovitosti',
                'id'   => 'typ_nemovitosti',
                'type' => 'select',
                'options' => [
                    'byt' => 'Byt',
                    'dum' => 'Dům',
                    'pozemek' => 'Pozemek',
                    'komercni' => 'Komerční prostor',
                ],
            ],
        ],
    ];
    return $meta_boxes;
});