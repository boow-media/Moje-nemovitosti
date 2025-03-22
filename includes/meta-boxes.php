<?php

add_filter('rwmb_meta_boxes', function ($meta_boxes) {
    // ✅ Základní údaje
    $meta_boxes[] = [
        'title'      => 'Základní údaje',
        'id'         => 'zakladni_udaje',
        'post_types' => ['nemovitosti'],
        'fields'     => [
            ['name' => 'Cena', 'id' => 'cena', 'type' => 'text'],
            ['name' => 'Dispozice', 'id' => 'dispozice', 'type' => 'text'],
            ['name' => 'Adresa', 'id' => 'adresa', 'type' => 'text'],
            ['name' => 'Užitná plocha', 'id' => 'uzitna_plocha', 'type' => 'text'],
            [
                'name'    => 'Typ nemovitosti',
                'id'      => 'typ_nemovitosti',
                'type'    => 'select',
                'options' => [
                    'byt'       => 'Byt',
                    'dum'       => 'Dům',
                    'pozemek'   => 'Pozemek',
                    'komercni'  => 'Komerční prostor'
                ]
            ],
        ]
    ];

    // ✅ Technické info (volitelné)
    $meta_boxes[] = [
        'title'      => 'Technické informace',
        'id'         => 'technicke_info',
        'post_types' => ['nemovitosti'],
        'fields'     => [
            [
                'name' => 'Stav nemovitosti',
                'id'   => 'stav_nemovitosti',
                'type' => 'select',
                'options' => [
                    'novostavba'         => 'Novostavba',
                    'velmi_dobry'        => 'Velmi dobrý',
                    'po_rekonstrukci'    => 'Po rekonstrukci',
                    'pred_rekonstrukci'  => 'Před rekonstrukcí',
                ]
            ],
            [
                'name' => 'Druh objektu',
                'id'   => 'druh_objektu',
                'type' => 'select',
                'options' => [
                    'cihla'       => 'Cihla',
                    'panel'       => 'Panel',
                    'drevostavba' => 'Dřevostavba',
                    'smisena'     => 'Smíšená',
                ]
            ],
            [
                'name' => 'Typ domu',
                'id'   => 'typ_domu',
                'type' => 'select',
                'options' => [
                    'radovy'     => 'Řadový',
                    'samostatny' => 'Samostatný',
                    'patrovy'    => 'Patrový',
                ]
            ],
            ['name' => 'Počet podlaží', 'id' => 'pocet_podlazi', 'type' => 'text'],
            ['name' => 'Zastavěná plocha', 'id' => 'zastavena_plocha', 'type' => 'text'],
            ['name' => 'Plocha pozemku / parcely', 'id' => 'plocha_pozemku', 'type' => 'text'],
            ['name' => 'Plocha zahrady', 'id' => 'plocha_zahrady', 'type' => 'text'],
            [
                'name' => 'Energetická třída',
                'id'   => 'energeticka_trida',
                'type' => 'select',
                'options' => array_combine(range('A', 'G'), range('A', 'G'))
            ],
        ]
    ];

    // ✅ Média a galerie
    $meta_boxes[] = [
        'title'      => 'Média a galerie',
        'id'         => 'media_galerie',
        'post_types' => ['nemovitosti'],
        'fields'     => [
            ['name' => 'Galerie obrázků', 'id' => 'galerie', 'type' => 'image_advanced'],
            ['name' => 'Půdorys', 'id' => 'pudorys', 'type' => 'image'],
            ['name' => 'Virtuální prohlídka (YouTube)', 'id' => 'virtualni_prohlidka', 'type' => 'url'],
        ]
    ];

    // ✅ Popisky a doplňky
    $meta_boxes[] = [
        'title'      => 'Doplňující informace',
        'id'         => 'popisky',
        'post_types' => ['nemovitosti'],
        'fields'     => [
            ['name' => 'Číslo zakázky', 'id' => 'cislo_zakazky', 'type' => 'text'],
            [
                'name'    => 'Vybavení',
                'id'      => 'vybaveni',
                'type'    => 'checkbox_list',
                'options' => [
                    'linka'   => 'Kuchyňská linka',
                    'lednice' => 'Lednice',
                    'nabytek' => 'Nábytek',
                    'skrin'   => 'Skříně'
                ]
            ],
            ['name' => 'Poznámky k ceně', 'id' => 'poznamky_cena', 'type' => 'textarea']
        ]
    ];

    return $meta_boxes;
});