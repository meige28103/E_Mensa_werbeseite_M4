<?php
/**
 * Praktikum DBWT . Autoren:
 * Yisen Fang, 3575875
 * Gelun Zheng, 3308763
 */
$gerichts=[
    ["name"=>"Rindfleisch mit Bambus, Kaiserschoten und rotem Paprika, dazu Mie-Nudeln",
        "preis_intern"=>"3.50", "preis_extern"=>"6.20",
        "photo"=>"img/Rindfleisch.jpg"],
    ["name"=>"Spinatrisotto mit kleinen Samosateigecken und gemischter Salat",
        "preis_intern"=>"2.90", "preis_extern"=>"5.30",
        "photo"=>"img/Spinatrisotto.jpg"],
    ["name"=>"Gebratene Tomaten mit Rühre und Reis als Beilage(chinesisches Essen)",
        "preis_intern"=>"5.00", "preis_extern"=>"8.00",
        "photo"=>"img/Gebratene.jpg"

    ],[
        "name"=>"Thausendjähriges Ei","preis_intern"=>"10.00", "preis_extern"=>"12.00",
        "photo"=>"img/Thausendjähriges.jpg"
    ]
];

function gerichte() {
    return  [
        ["name"=>"Rindfleisch mit Bambus, Kaiserschoten und rotem Paprika, dazu Mie-Nudeln",
            "preis_intern"=>"3.50", "preis_extern"=>"6.20",
            "photo"=>"img/Rindfleisch.jpg"],
        ["name"=>"Spinatrisotto mit kleinen Samosateigecken und gemischter Salat",
            "preis_intern"=>"2.90", "preis_extern"=>"5.30",
            "photo"=>"img/Spinatrisotto.jpg"],
        ["name"=>"Gebratene Tomaten mit Rühre und Reis als Beilage(chinesisches Essen)",
            "preis_intern"=>"5.00", "preis_extern"=>"8.00",
            "photo"=>"img/Gebratene.jpg"

        ],[
            "name"=>"Thausendjähriges Ei","preis_intern"=>"10.00", "preis_extern"=>"12.00",
            "photo"=>"img/Thausendjähriges.jpg"
        ]
    ];
}