<?php


namespace grozzzny\admin\controllers;


use grozzzny\admin\components\images\widget\ImagesWidget;
use grozzzny\admin\helpers\Image;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\UploadedFile;

class UploadController extends Controller
{
    public $enableCsrfValidation = false;

    public $dir = 'editor';

    public function actionIndex()
    {
        $file = UploadedFile::getInstanceByName('file');

        if($file) {
            $file = Image::upload($file, $this->dir, ImagesWidget::PHOTO_MAX_WIDTH);
            return json_encode(['location' => $file]);
        }

        throw new ForbiddenHttpException();
    }
}
