<?php namespace Nord\Lumen\FileManager\DynamoDB\Models;

use Carbon\Carbon;
use Nord\Lumen\DynamoDb\Contracts\DynamoDbClientInterface;
use Nord\Lumen\DynamoDb\Domain\Model\DynamoDbModel;
use Nord\Lumen\FileManager\Contracts\File as FileContract;
use Nord\Lumen\FileManager\Facades\FileManager;

/**
 * Class File.
 *
 * @package Nord\Lumen\FileManager\DynamoDB
 *
 * @property string $id
 * @property string $name
 * @property string $extension
 * @property string $path
 * @property string $mimeType
 * @property int    $byteSize
 * @property array  $data
 * @property string $disk
 * @property Carbon $savedAt
 */
class File extends DynamoDbModel implements FileContract
{

    /**
     * @inheritdoc
     */
    protected $primaryKey = 'id';

    /**
     * @inheritdoc
     */
    protected $fillable = [
        'name',
        'extension',
        'path',
        'mimeType',
        'byteSize',
        'data',
        'disk',
    ];

    /**
     * @inheritdoc
     */
    protected $guarded = [
        'id',
        'savedAt',
    ];

    /**
     * File constructor.
     *
     * @param array                        $attributes
     * @param DynamoDbClientInterface|null $dynamoDb
     */
    public function __construct(array $attributes = [], DynamoDbClientInterface $dynamoDb = null)
    {
        parent::__construct($attributes, $dynamoDb);
    }

    /**
     * @inheritdoc
     */
    public function save(array $options = [])
    {
        $this->setAttribute('savedAt', Carbon::now()->getTimestamp());

        return parent::save();
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->getKey();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @return string
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * @return int
     */
    public function getByteSize()
    {
        return $this->byteSize;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return string
     */
    public function getDisk()
    {
        return $this->disk;
    }

    /**
     * @return Carbon
     */
    public function getSavedAt()
    {
        return $this->savedAt;
    }

    /**
     * @return string
     */
    public function getSavedAtAsTimestamp()
    {
        return $this->getSavedAt()->getTimestamp();
    }

    /**
     * @return string
     */
    public function getFilename()
    {
        return $this->name . '-' . $this->getKey() . '.' . $this->extension;
    }

    /**
     * @inheritdoc
     */
    public function getFilePath()
    {
        return $this->getPath() . $this->getFilename();
    }

    /**
     * @inheritdoc
     */
    public function getUrl(array $options = [])
    {
        return FileManager::getFileUrl($this, $options);
    }

    /**
     * @return string
     */
    private function getPath()
    {
        return isset( $this->path ) ? $this->path . '/' : '';
    }

    /**
     * @inheritdoc
     */
    public function toArray()
    {
        $attributes = parent::toArray();
        $attributes['url'] = $this->getUrl();
        return $attributes;
    }
}
