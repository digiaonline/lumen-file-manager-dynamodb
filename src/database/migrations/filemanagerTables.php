<?php

return [
    [
        'TableName'             => 'files',
        'AttributeDefinitions'  => [
            [
                'AttributeName' => 'id',
                'AttributeType' => 'S',
            ],
        ],
        'KeySchema'             => [
            [
                'AttributeName' => 'id',
                'KeyType'       => 'HASH',
            ],
        ],
        'ProvisionedThroughput' => [
            'ReadCapacityUnits'  => env('FILE_MANAGER_DYNAMODB_READ_CAPACITY_UNITS', 10),
            'WriteCapacityUnits' => env('FILE_MANAGER_DYNAMODB_WRITE_CAPACITY_UNITS', 20),
            'OnDemand'           => false,
        ],
    ],
];
