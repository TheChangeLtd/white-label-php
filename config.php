<?php
return [
    'api_key' => '',
    'api_base_url' => 'https://api.thechange.ltd',
    'fee' => 1,
    'name' => 'White Label',
    'lang' => "en",
    'supported_languages' => [
        'en' => 'en_US',
        'ru' => 'ru_RU'
    ],
    'contacts' => [
        'mail' => [
            'link' => 'mailto:example@gmail.com',
            'label' => 'example@gmail.com',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>',
            'background_color' => 'rgb(243, 61, 17)',
        ],
        'telegram' => [
            'link' => 'https://t.me/example',
            'label' => '@example',
            'icon' => '<svg viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M4.32376 10.6974C9.40886 8.03186 12.7941 6.26071 14.494 5.40144C19.3321 2.96392 20.3491 2.54305 21.0029 2.52551C21.1482 2.52551 21.4678 2.56059 21.6857 2.77102C21.8601 2.94638 21.9037 3.17435 21.9327 3.34971C21.9618 3.52507 21.9909 3.89333 21.9618 4.17391C21.7003 7.50578 20.567 15.5899 19.9859 19.3076C19.7389 20.8859 19.2594 21.4119 18.7945 21.4646C17.7775 21.5698 17.0075 20.6579 16.034 19.8863C14.494 18.6763 13.6368 17.9222 12.1403 16.7298C10.4114 15.362 11.5301 14.6079 12.518 13.3804C12.7796 13.0647 17.2399 8.15462 17.3271 7.71621C17.3416 7.6636 17.3416 7.45317 17.2399 7.34795C17.1382 7.24274 16.9929 7.27781 16.8767 7.31288C16.7169 7.34795 14.276 9.312 9.52509 13.1875C8.82771 13.7662 8.20296 14.0468 7.63634 14.0292C7.0116 14.0117 5.82023 13.6084 4.91944 13.2576C3.82978 12.8368 2.95805 12.6088 3.03069 11.8723C3.07428 11.4865 3.51014 11.1007 4.32376 10.6974Z" fill="currentColor"></path></svg>',
            'background_color' => 'rgb(20, 75, 255)',
        ],
    ],
    'header_menu' => [
        [
            'label' => 'common.faq',
            'path' => '/faq',
        ],
        [
            'label' => 'common.contacts',
            'path' => '/contacts',
        ]
    ],
    'footer_menu' => [
        [
            'label' => 'common.service_policy',
            'path' => '/service-policy',
        ],
        [
            'label' => 'common.aml_policy',
            'path' => '/aml-policy',
        ],
        [
            'label' => 'common.privacy_policy',
            'path' => '/privacy-policy',
        ],
        [
            'label' => 'common.faq',
            'path' => '/faq',
        ],
        [
            'label' => 'common.contacts',
            'path' => '/contacts',
        ]
    ],
    'trustpilot' => '',
];
