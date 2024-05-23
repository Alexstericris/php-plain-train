<?php
return[
    'feedxml' => [
        'entity_id' => [
            'type' => \Doctrine\DBAL\Types\Types::INTEGER,
            'options' => [
                'notnull' => false
            ],
        ],
        'CategoryName' => [
            'type' => \Doctrine\DBAL\Types\Types::STRING,
            'options' => [
                'notnull' => false
            ],
        ],
        'sku' => [
            'type' => \Doctrine\DBAL\Types\Types::INTEGER,
            'options' => [
                'notnull' => false
            ],
        ],
        'name' => [
            'type' => \Doctrine\DBAL\Types\Types::STRING,
            'options' => [
                'notnull' => false
            ],
        ],
        'description' => [
            'type' => \Doctrine\DBAL\Types\Types::TEXT,
            'options' => [
                'notnull' => false
            ],
        ],
        'shortdesc' => [
            'type' => \Doctrine\DBAL\Types\Types::STRING,
            'options' => [
                'notnull' => false
            ],
        ],
        'price' => [
            'type' => \Doctrine\DBAL\Types\Types::FLOAT,
            'options' => [
                'notnull' => true
            ],
        ],
        'link' => [
            'type' => \Doctrine\DBAL\Types\Types::TEXT,
            'options' => [
                'notnull' => false
            ],
        ],
        'image' => [
            'type' => \Doctrine\DBAL\Types\Types::TEXT,
            'options' => [
                'notnull' => false
            ],
        ],
        'Brand' => [
            'type' => \Doctrine\DBAL\Types\Types::STRING,
            'options' => [
                'notnull' => false
            ],
        ],
        'Rating' => [
            'type' => \Doctrine\DBAL\Types\Types::INTEGER,
            'options' => [
                'notnull' => false
            ]
        ],
        'CaffeineType' => [
            'type' => \Doctrine\DBAL\Types\Types::STRING,
            'options' => [
                'notnull' => false
            ]
        ],
        'Count' => [
            'type' => \Doctrine\DBAL\Types\Types::INTEGER,
            'options' => [
                'notnull' => false,
                'default' => 0
            ]
        ],
        'Flavored' => [
            'type' => \Doctrine\DBAL\Types\Types::STRING,
            'options' => [
                'notnull' => true,
            ]
        ],
        'Seasonal' => [
            'type' => \Doctrine\DBAL\Types\Types::STRING,
            'options' => [
                'notnull' => true,
            ]
        ],
        'Instock' => [
            'type' => \Doctrine\DBAL\Types\Types::STRING,
            'options' => [
                'notnull' => true,
            ]
        ],
        'Facebook' => [
            'type' => \Doctrine\DBAL\Types\Types::BOOLEAN,
            'options' => [
                'notnull' => true,
                'default' => false
            ]
        ],
        'IsKCup' => [
            'type' => \Doctrine\DBAL\Types\Types::BOOLEAN,
            'options' => [
                'notnull' => true,
                'default' => false
            ]
        ],
    ],
    'exampletable2' => [
        'entity_id' => [
            'type' => \Doctrine\DBAL\Types\Types::INTEGER,
            'options' => [
                'notnull' => false
            ],
        ],
        'CategoryName' => [
            'type' => \Doctrine\DBAL\Types\Types::STRING,
            'options' => [
                'notnull' => false
            ],
        ],
        'sku' => [
            'type' => \Doctrine\DBAL\Types\Types::INTEGER,
            'options' => [
                'notnull' => false
            ],
        ],
        'name' => [
            'type' => \Doctrine\DBAL\Types\Types::STRING,
            'options' => [
                'notnull' => false
            ],
        ],
        'description' => [
            'type' => \Doctrine\DBAL\Types\Types::TEXT,
            'options' => [
                'notnull' => false
            ],
        ],
        'shortdesc' => [
            'type' => \Doctrine\DBAL\Types\Types::STRING,
            'options' => [
                'notnull' => false
            ],
        ],
        'price' => [
            'type' => \Doctrine\DBAL\Types\Types::FLOAT,
            'options' => [
                'notnull' => true
            ],
        ],
        'link' => [
            'type' => \Doctrine\DBAL\Types\Types::TEXT,
            'options' => [
                'notnull' => false
            ],
        ],
        'image' => [
            'type' => \Doctrine\DBAL\Types\Types::TEXT,
            'options' => [
                'notnull' => false
            ],
        ],
        'Brand' => [
            'type' => \Doctrine\DBAL\Types\Types::STRING,
            'options' => [
                'notnull' => false
            ],
        ],
        'Rating' => [
            'type' => \Doctrine\DBAL\Types\Types::INTEGER,
            'options' => [
                'notnull' => false
            ]
        ],
        'CaffeineType' => [
            'type' => \Doctrine\DBAL\Types\Types::STRING,
            'options' => [
                'notnull' => false
            ]
        ],
        'Count' => [
            'type' => \Doctrine\DBAL\Types\Types::INTEGER,
            'options' => [
                'notnull' => false,
                'default' => 0
            ]
        ],
        'Flavored' => [
            'type' => \Doctrine\DBAL\Types\Types::STRING,
            'options' => [
                'notnull' => true,
            ]
        ],
        'Seasonal' => [
            'type' => \Doctrine\DBAL\Types\Types::STRING,
            'options' => [
                'notnull' => true,
            ]
        ],
        'Instock' => [
            'type' => \Doctrine\DBAL\Types\Types::STRING,
            'options' => [
                'notnull' => true,
            ]
        ],
        'Facebook' => [
            'type' => \Doctrine\DBAL\Types\Types::BOOLEAN,
            'options' => [
                'notnull' => true,
                'default' => false
            ]
        ],
        'IsKCup' => [
            'type' => \Doctrine\DBAL\Types\Types::BOOLEAN,
            'options' => [
                'notnull' => true,
                'default' => false
            ]
        ],
    ]
];