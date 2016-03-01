<?php
/**
 * Create File manager DynamoDB tables.
 */
namespace Nord\Lumen\FileManager\DynamoDB\Console\Commands;

/**
 * Class CreateTablesCommand.
 *
 * @package Nord\Lumen\FileManager\DynamoDB\Console\Commands
 */
class CreateTablesCommand extends \Nord\Lumen\DynamoDb\Console\CreateTablesCommand
{

    /**
     * @var string $name The name of the command.
     */
    protected $name = 'filemanager:dynamodb:create';

    /**
     * The name and signature of the command.
     *
     * @var string $signature The signature of the command.
     */
    protected $signature = 'filemanager:dynamodb:create';

    /**
     * @var string $description The description of the command.
     */
    protected $description = 'Create the necessary file manager tables.';

    /**
     * Run the command.
     */
    public function handle()
    {
        self::$tables = include_once( sprintf('%s/../../database/migrations/filemanagerTables.php', __DIR__) );
        $this->createTables();
    }
}
