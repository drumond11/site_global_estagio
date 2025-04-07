<?php

$valores = [
    "terreno" => 100,
    "bruto" => 1000,
    "estado" => [
        "novo" => 2500,
        "usado" => 1000,
        "ruinas" => 500
    ],
    "caracteristicas" => [
        "varanda" => 10000,
        "piscina" => 30000
    ],
    "localizacoes" => [
        "Ilha da Madeira" => [
            "terreno" => 150,
            "bruto" => 1500,
            "localizacoes" => [
                "Funchal" => [
                    "terreno" => 300,
                    "bruto" => 2000,
                    "localizacoes" => [
                        "Santo Antonio (Funchal)" => [
                            "terreno" => 1,
                            "caracteristicas" => [
                                "varanda" => 2000,
                                "piscina" => 50000
                            ]
                        ]
                    ]
                ],
                "Santa Cruz" => [
                    "localizacoes" => [
                        "Santo Antonio da Serra (Santa Cruz)" => [
                            "terreno" => 100000
                        ]
                    ]
                ]
            ]
        ],
        "Lisboa" => [
            "localizacoes" => [
                "lisboa" => [
                    "terreno" => 3000,
                    "localizacoes" => [
                    ]
                ]
            ]
        ]
    ]
];

