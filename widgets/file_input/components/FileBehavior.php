<?php


namespace grozzzny\admin\widgets\file_input\components;


use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class FileBehavior extends Behavior
{
    /**
     * @var ActiveRecord
     */
    public $owner;

    public $fileAttribute;

    public $uploadPath = '/uploads';

    public function events()
    {
        if(empty(Yii::$app->request) || !Yii::$app->request->isPost) return [];

        return [
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'beforeValidate',
            ActiveRecord::EVENT_AFTER_VALIDATE => 'afterValidate',
            ActiveRecord::EVENT_BEFORE_DELETE => 'deleteFile',
        ];
    }

    public function beforeValidate()
    {
        $file = UploadedFile::getInstance($this->owner, $this->fileAttribute);

        if(empty($file)){
            $this->owner->{$this->fileAttribute} = $this->owner->getOldAttribute($this->fileAttribute);
        } else {
            $this->owner->{$this->fileAttribute} = $file;
            $this->deleteFile();
        }
    }

    public function afterValidate()
    {
        /**
         * @var UploadedFile $file
         */
        $file = $this->owner->{$this->fileAttribute};

        if('object' != gettype($file)) return;

        $nameFile = self::generateFileName($file);

        $path = $this->uploadPath . DIRECTORY_SEPARATOR . $nameFile;

        FileHelper::createDirectory(Yii::getAlias('@webroot' . $this->uploadPath));

        if($file->type == 'image/jpeg') self::orientation($file);

        $file->saveAs(Yii::getAlias('@webroot' . $path));

        $this->owner->{$this->fileAttribute} = Yii::getAlias('@web' . $path);
    }

    public static function generateFileName(UploadedFile $file)
    {
        $prefix = substr(uniqid(md5(rand()), true), 0, 10);
        return $file->baseName . '-' . $prefix . '.' . $file->extension;
    }

    public static function orientation(&$file)
    {
        /** @var UploadedFile $file */
        try {
            $resource = imagecreatefromjpeg($file->tempName);
            $exif = exif_read_data($file->tempName, 0, true);
        } catch (\Exception $ex) {
            return;
        }

        if( false === empty($exif['IFD0']['Orientation'] ) ) {
            switch( $exif['IFD0']['Orientation'] ) {
                case 8:
                    $resource = imagerotate($resource, 90, 0 );
                    break;
                case 3:
                    $resource = imagerotate($resource,180,0);
                    break;
                case 6:
                    $resource = imagerotate($resource,-90,0);
                    break;
            }
        }

        imagejpeg($resource, $file->tempName);
    }

    public function deleteFile()
    {
        $oldAttributeValue = $this->owner->getOldAttribute($this->fileAttribute);
        $attributeValue = $this->owner->{$this->fileAttribute};

        $value = 'object' == gettype($attributeValue) ? $oldAttributeValue : $attributeValue;

        if(empty($value) || !file_exists(Yii::getAlias('@webroot' . $value))) return;

        FileHelper::unlink(Yii::getAlias('@webroot' . $value));
    }
}