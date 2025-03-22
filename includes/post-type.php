<?php

// Vytvoření vlastního post typu "Nemovitosti"
function mp_register_post_type_nemovitosti() {
    $labels = [
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
    ];

    $args = [
        'labels' => $labels,
        'public' => true,
        'menu_icon' => 'dashicons-admin-home',
        'supports' => ['title', 'editor', 'thumbnail'],
        'has_archive' => true,
        'rewrite' => ['slug' => 'nemovitosti'],
    ];

    register_post_type('nemovitosti', $args);
}
add_action('init', 'mp_register_post_type_nemovitosti');