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