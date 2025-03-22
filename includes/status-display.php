<?php

// Zobrazení štítku stavu nabídky nahoře při editaci nemovitosti
add_action('edit_form_after_title', function () {
    global $post;

    if ($post->post_type !== 'nemovitosti') {
        return;
    }

    $stav = get_post_meta($post->ID, 'stav_nabidky', true);

    $nazvy = [
        'aktivni' => 'Aktivní',
        'rezervovano' => 'Rezervováno',
        'prodano' => 'Prodáno',
    ];

    $barvy = [
        'aktivni' => 'makler-aktivni',
        'rezervovano' => 'makler-rezervovano',
        'prodano' => 'makler-prodano',
    ];

    if (!empty($nazvy[$stav]) && !empty($barvy[$stav])) {
        printf(
            '<div style="margin-top: 8px; margin-bottom: 16px;"><span class="makler-badge %s">Stav nabídky: %s</span></div>',
            esc_attr($barvy[$stav]),
            esc_html($nazvy[$stav])
        );
    }
});