# lumen-file-manager-dynamodb
DynamoDB support for the lumen-file-manager module

# Getting started

Configure your DynamoDB server, either with the local standalone, or the one in AWS. 
If locally, make sure the DynamoDB server is running.

Edit your `Kernel.php` file, and add the following command to the commands list:

    protected $commands = [
        ...
        'Nord\Lumen\FileManager\DynamoDB\Console\Commands\CreateTablesCommand',
    ];

This will introduce a new command to artisan:

    php artisan filemanager:dynamodb:create

The command will create the necessary File manager tables in your DynamoDB.

You may set the `ProvisionedThroughput.ReadCapacityUnits/WriteCapacityUnits` with the following environment variables:
    
    FILE_MANAGER_DYNAMODB_READ_CAPACITY_UNITS=10
    FILE_MANAGER_DYNAMODB_WRITE_CAPACITY_UNITS=20

The default values are 10 for read capacity and 20 for write capacity. They're quite high values, so you might want
to modify the values to better serve your usage of the `files` table.

# License
See [LICENSE](LICENSE).
