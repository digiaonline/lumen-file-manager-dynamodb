<?php namespace Nord\Lumen\FileManager\DynamoDB;

use Nord\Lumen\FileManager\Contracts\FileFactory as FileFactoryContract;
use Nord\Lumen\FileManager\Contracts\FileManager;
use Nord\Lumen\FileManager\DynamoDB\Models\File;

class FileFactory implements FileFactoryContract
{

    /**
     * @var string Full namespace of class to use when creating files
     */
    protected $fileClass;

    /**
     * FileFactory constructor
     *
     * @param string $fileClass
     */
    public function __construct($fileClass)
    {
        $this->setFileClass($fileClass);
    }

    /**
     * @inheritdoc
     */
    public function createFile($id, $name, $extension, $path, $mimeType, $byteSize, $data, $disk)
    {
        $class = $this->getFileClass();
        /** @var File $file */
        $file = new $class([
            'name'      => $name,
            'extension' => $extension,
            'path'      => $path,
            'mimeType'  => $mimeType,
            'byteSize'  => $byteSize,
            'data'      => $data,
            'disk'      => $disk,
        ]);

        $file->setId($id);

        return $file;
    }

    /**
     * @return string
     */
    protected function getFileClass()
    {
        return $this->fileClass;
    }

    /**
     * @param string $fileClass
     */
    protected function setFileClass($fileClass)
    {
        $this->fileClass = $fileClass;
    }
}
