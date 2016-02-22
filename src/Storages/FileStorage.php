<?php namespace Nord\Lumen\FileManager\DynamoDB\Storages;

use Nord\Lumen\FileManager\Contracts\File as FileContract;
use Nord\Lumen\FileManager\Contracts\FileStorage as FileStorageContract;
use Nord\Lumen\FileManager\DynamoDB\Models\File;

/**
 * Class FileStorage.
 *
 * @package Nord\Lumen\FileManager\DynamoDB
 */
class FileStorage implements FileStorageContract
{

    /**
     * @inheritdoc
     */
    public function saveFile(FileContract $file)
    {
        return $file->save();
    }

    /**
     * @inheritdoc
     */
    public function getFile($id)
    {
        return File::find($id);
    }

    /**
     * @inheritdoc
     */
    public function deleteFile($id)
    {
        $file = $this->getFile($id);

        if ($file === null) {
            return false;
        }

        $file->delete();

        return true;
    }

    /**
     * @inheritdoc
     */
    public function idExists($id)
    {
        return $this->getFile($id) !== null;
    }
}
