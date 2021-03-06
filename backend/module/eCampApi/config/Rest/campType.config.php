<?php

use eCampApi\ConfigFactory;

$entity = 'CampType';
$config = ConfigFactory::createConfig($entity);

// read-only endpoint
$config['api-tools-rest']["eCampApi\\V1\\Rest\\{$entity}\\Controller"]['entity_http_methods'] = ['GET'];
$config['api-tools-rest']["eCampApi\\V1\\Rest\\{$entity}\\Controller"]['collection_http_methods'] = ['GET'];

$config['api-tools-content-validation'] = [
    'eCampApi\\V1\\Rest\\CampType\\Controller' => [
        'input_filter' => 'eCampApi\\V1\\Rest\\CampType\\Validator',
    ],
];

$config['input_filter_specs'] = [
    'eCampApi\\V1\\Rest\\CampType\\Validator' => [
        0 => [
            'name' => 'name',
            'required' => true,
            'filters' => [
                0 => [
                    'name' => 'Laminas\\Filter\\StringTrim',
                ],
                1 => [
                    'name' => 'Laminas\\Filter\\StripTags',
                ],
            ],
            'validators' => [
                0 => [
                    'name' => 'Laminas\\Validator\\StringLength',
                    'options' => [
                        'min' => 1,
                        'max' => 64,
                    ],
                ],
            ],
        ],
        1 => [
            'name' => 'isJS',
            'required' => true,
            'filters' => [],
            'validators' => [],
        ],
        2 => [
            'name' => 'isCourse',
            'required' => true,
            'filters' => [],
            'validators' => [],
        ],
        3 => [
            'name' => 'jsonConfig',
            'required' => false,
            'filters' => [],
            'validators' => [],
        ],
    ],
];

return $config;
