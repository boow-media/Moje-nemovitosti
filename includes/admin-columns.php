<?php

// Přidání vlastního sloupce do seznamu nemovitostí
add_filter('manage_nemovitosti_posts_columns', function ($columns) {
    // Odebereme a pak přidáme, aby byl stav hned za názvem
    $new_columns = [];
    foreach ($columns as $key => $value) {
        $new_columns[$key] = $value;
        if ($key === 'title') {
            $new_columns['stav_nabidky'] = 'Stav nabídky';
        }
    }
    return $new_columns;
});

// Výstup sloupce "Stav nabídky"
add_action('manage_nemovitosti_posts_custom_column', function ($column, $post_id) {
    if ($column === 'stav_nabidky') {
        $stav = get_post_meta($post_id, 'stav_nabidky', true);

        $nazvy = [
            'aktivni' => 'Aktivní',
            'rezervovano' => 'Rezervováno',
            'prodano' => 'Prodáno',
        ];

        if ($stav && isset($nazvy[$stav])) {
            echo '<span class="makler-badge makler-' . esc_attr($stav) . '">' . esc_html($nazvy[$stav]) . '</span>';
        } else {
            echo '—';
        }
    }
}, 10, 2);
