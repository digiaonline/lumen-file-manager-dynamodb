# lumen-file-manager-dynamodb
DynamoDB support for the lumen-file-manager module

# Getting started

Configure your DynamoDB server, either with the local standalone, or the one in AWS. 
If locally, make sure the DynamoDB server is running.

Edit your `Kernel.php` file, and add the following commands to the commands list:

    protected $commands = [
        ...
        'Nord\Lumen\FileManager\DynamoDB\Console\Commands\CreateTablesCommand',
    ];

This will introduce two new commands to artisan:

    php artisan filemanager:dynamodb:create

The command will create the necessary File manager tables in your DynamoDB.

# License
MIT
