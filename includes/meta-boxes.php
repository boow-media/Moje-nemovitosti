<?php

add_filter('rwmb_meta_boxes', function ($meta_boxes) {

    // 1. Detaily nemovitosti
    $meta_boxes[] = [
        'title'      => 'Detaily nemovitosti',
        'id'         => 'detaily_nemovitosti',
        'post_types' => ['nemovitosti'],
        'context'    => 'normal',
        'priority'   => 'high',
        'fields'     => [
            ['name' => 'Číslo zakázky', 'id' => 'cislo_zakazky', 'type' => 'text'],
            ['name' => 'Stav nabídky', 'id' => 'stav_nabidky', 'type' => 'select', 'options' => [
                'aktivni'      => 'Na prodej',
                'rezervovano'  => 'Rezervace',
                'prodano'      => 'Prodáno',
            ]],
            ['name' => 'Adresa', 'id' => 'adresa', 'type' => 'text'],
            ['name' => 'Cena', 'id' => 'cena', 'type' => 'text', 'sanitize_callback' => false],
            ['name' => 'Poznámky k ceně', 'id' => 'poznamky_cena', 'type' => 'textarea'],
            ['name' => 'Typ nemovitosti', 'id' => 'typ_nemovitosti', 'type' => 'select', 'options' => [
                'byt'       => 'Byt',
                'dum'       => 'Dům',
                'pozemek'   => 'Pozemek',
                'komercni'  => 'Komerční prostor',
            ]],
            ['name' => 'Dispozice', 'id' => 'dispozice', 'type' => 'text', 'placeholder' => 'Např. 3+kk'],
            ['name' => 'Užitná plocha', 'id' => 'uzitna_plocha', 'type' => 'text'],
        ]
    ];

    // 2. Technické informace
    $meta_boxes[] = [
        'title'      => 'Technické informace',
        'id'         => 'technicke_info',
        'post_types' => ['nemovitosti'],
        'context'    => 'normal',
        'priority'   => 'default',
        'fields'     => [
            ['name' => 'Počet podlaží', 'id' => 'pocet_podlazi', 'type' => 'text'],
            ['name' => 'Zastavěná plocha', 'id' => 'zastavena_plocha', 'type' => 'text'],
            ['name' => 'Plocha pozemku', 'id' => 'plocha_pozemku', 'type' => 'text'],
            ['name' => 'Plocha zahrady', 'id' => 'plocha_zahrady', 'type' => 'text'],
            ['name' => 'Stav nemovitosti', 'id' => 'stav_nemovitosti', 'type' => 'select', 'options' => [
                'novostavba'         => 'Novostavba',
                'velmi_dobry'        => 'Velmi dobrý',
                'po_rekonstrukci'    => 'Po rekonstrukci',
                'pred_rekonstrukci'  => 'Před rekonstrukcí',
            ]],
            ['name' => 'Druh objektu', 'id' => 'druh_objektu', 'type' => 'select', 'options' => [
                'cihla'      => 'Cihla',
                'panel'      => 'Panel',
                'drevostavba'=> 'Dřevostavba',
                'smisena'    => 'Smíšená',
            ]],
            ['name' => 'Typ domu', 'id' => 'typ_domu', 'type' => 'select', 'options' => [
                'radovy'     => 'Řadový',
                'samostatny' => 'Samostatný',
                'patrovy'    => 'Patrový',
            ]],
            ['name' => 'Energetická třída', 'id' => 'energeticka_trida', 'type' => 'select', 'options' => [
                'A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D', 'E' => 'E', 'F' => 'F', 'G' => 'G',
            ]],
        ]
    ];

    // 3. Média
    $meta_boxes[] = [
        'title'      => 'Média',
        'id'         => 'media_nemovitosti',
        'post_types' => ['nemovitosti'],
        'context'    => 'normal',
        'priority'   => 'default',
        'fields'     => [
            ['name' => 'Galerie obrázků', 'id' => 'galerie', 'type' => 'image_advanced'],
            ['name' => 'Půdorys', 'id' => 'pudorys', 'type' => 'image_advanced'],
            ['name' => 'Virtuální prohlídka (YouTube)', 'id' => 'virtualni_prohlidka', 'type' => 'url'],
        ]
    ];

    // 4. Doplňující informace – použity radio buttony místo checkboxů
    $meta_boxes[] = [
        'title'      => 'Doplňující informace',
        'id'         => 'dopl_info',
        'post_types' => ['nemovitosti'],
        'context'    => 'normal',
        'priority'   => 'low',
        'fields'     => [
            ['name' => 'Elektřina',       'id' => 'elektrina',    'type' => 'radio', 'options' => ['ANO' => 'Ano', 'NE' => 'Ne'], 'inline' => true],
            ['name' => 'Veřejný vodovod', 'id' => 'voda',         'type' => 'radio', 'options' => ['ANO' => 'Ano', 'NE' => 'Ne'], 'inline' => true],
            ['name' => 'Kanalizace',      'id' => 'kanalizace',   'type' => 'radio', 'options' => ['ANO' => 'Ano', 'NE' => 'Ne'], 'inline' => true],
            ['name' => 'Plyn',            'id' => 'plyn',         'type' => 'radio', 'options' => ['ANO' => 'Ano', 'NE' => 'Ne'], 'inline' => true],
            ['name' => 'Internet',        'id' => 'internet',     'type' => 'radio', 'options' => ['ANO' => 'Ano', 'NE' => 'Ne'], 'inline' => true],
        ]
    ];

    return $meta_boxes;
});