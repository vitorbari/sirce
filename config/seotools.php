<?php

return [
    'meta'      => [
        /*
         * The default configurations to be used by the meta generator.
         */
        'defaults'       => [
            'title'       => "Sirce.info - Sketches of Embedded Projects", // set false to total remove
            'description' => 'Sirce.info is a website that allows people to create and share sketches of embedded projects.', // set false to total remove
            'separator'   => ' - ',
            'keywords'    => ['IoT', 'Internet of Things', 'Arduino', 'DIY', 'Raspberry Pi', 'Eletronics', 'Prototyping', 'Components'],
        ],

        /*
         * Webmaster tags are always added.
         */
        'webmaster_tags' => [
            'google'    => null,
            'bing'      => null,
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null
        ]
    ],
    'opengraph' => [
        /*
         * The default configurations to be used by the opengraph generator.
         */
        'defaults' => [
            'title'       => 'Sirce.info - Sketches of Embedded Projects', // set false to total remove
            'description' => false, // set false to total remove
            'url'         => false,
            'type'        => 'website',
            'site_name'   => 'Sirce.info',
            'images'      => [],
        ]
    ],
    'twitter' => [
        /*
         * The default values to be used by the twitter cards generator.
         */
        'defaults' => [
          //'card'        => 'summary',
          //'site'        => '@LuizVinicius73',
        ]
    ]
];
