<?php

// ✅ Přidání Kč k ceně
add_filter('rwmb_cena_value', function ($value) {
    $value = trim(str_replace('Kč', '', $value));
    return $value ? $value . ' Kč' : '';
});

// ✅ Přidání m²
foreach (['uzitna_plocha', 'zastavena_plocha', 'plocha_pozemku', 'plocha_zahrady'] as $id) {
    add_filter("rwmb_{$id}_value", function ($value) {
        $value = trim(str_replace('m²', '', $value));
        return $value ? $value . ' m²' : '';
    });
}

// ✅ Překlad typu nemovitosti
add_filter('rwmb_typ_nemovitosti_value', function ($value) {
    $nazvy = [
        'byt'      => 'Byt',
        'dum'      => 'Dům',
        'pozemek'  => 'Pozemek',
        'komercni' => 'Komerční prostor',
    ];
    return $nazvy[$value] ?? $value;
});

// ✅ Překlad stavu nemovitosti
add_filter('rwmb_stav_nemovitosti_value', function ($value) {
    $nazvy = [
        'novostavba'         => 'Novostavba',
        'velmi_dobry'        => 'Velmi dobrý',
        'po_rekonstrukci'    => 'Po rekonstrukci',
        'pred_rekonstrukci'  => 'Před rekonstrukcí',
    ];
    return $nazvy[$value] ?? $value;
});

// ✅ Překlad druhu objektu
add_filter('rwmb_druh_objektu_value', function ($value) {
    $nazvy = [
        'cihla'       => 'Cihla',
        'panel'       => 'Panel',
        'drevostavba' => 'Dřevostavba',
        'smisena'     => 'Smíšená',
    ];
    return $nazvy[$value] ?? $value;
});

// ✅ Překlad typu domu
add_filter('rwmb_typ_domu_value', function ($value) {
    $nazvy = [
        'radovy'     => 'Řadový',
        'samostatny' => 'Samostatný',
        'patrovy'    => 'Patrový',
    ];
    return $nazvy[$value] ?? $value;
});
