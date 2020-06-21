<?php


namespace grozzzny\admin\components\images\widget\controllers;


use grozzzny\admin\components\images\AdminImages;
use grozzzny\admin\helpers\Image;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;

class AdminImagesController extends Controller
{
    public $error = null;

    public function behaviors()
    {
        return [
            [
                'class' => 'yii\filters\ContentNegotiator',
                'formats' => [
                    'application/json' => Response::FORMAT_JSON
                ],
            ],
        ];
    }

    public function actionUpload($key, $item_id)
    {
        $success = null;

        /** @var AdminImages $model */
        $model = Yii::$container->get(AdminImages::class);

        $model->key = $key;
        $model->item_id = $item_id;

        $model->file = UploadedFile::getInstance($model, 'file');

//        if($model->file && $model->validate(['file'])) {
            $model->file = Image::upload($model->file, 'photos', 1900);

            if ($model->file) {

                if ($model->save()) {
                    $success = [
                        'message' => Yii::t('app', 'Photo uploaded'),
                        'photo' => [
                            'id' => $model->primaryKey,
                            'image' => $model->file,
                            'thumb' => Image::thumb($model->file, 120, 90),
                            'description' => ''
                        ]
                    ];
                } else {
                    $this->error = Yii::t('app', 'Create error. {0}', $model->formatErrors());
                    @unlink(Yii::getAlias('@webroot') . str_replace(Url::base(true), '', $model->file));
                }
            } else {
                $this->error = Yii::t('app', 'File upload error. Check uploads folder for write permissions');
            }
//        } else{
//            $this->error = Yii::t('app', 'File is incorrect');
//        }

        return $this->formatResponse($success);
    }

    public function removeImage()
    {

    }

    /**
     * Formats response depending on request type (ajax or not)
     * @param string $success
     * @param bool $back go back or refresh
     * @return mixed $result array if request is ajax.
     */
    public function formatResponse($success = '', $back = true)
    {
        if(Yii::$app->request->isAjax){
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            if($this->error){
                return ['result' => 'error', 'error' => $this->error];
            } else {
                $response = ['result' => 'success'];
                if($success) {
                    if(is_array($success)){
                        $response = array_merge(['result' => 'success'], $success);
                    } else {
                        $response = array_merge(['result' => 'success'], ['message' => $success]);
                    }
                }
                return $response;
            }
        }
        else{
            if($this->error){
                $this->flash('error', $this->error);
            } else {
                if(is_array($success) && isset($success['message'])){
                    $this->flash('success', $success['message']);
                }
                elseif(is_string($success)){
                    $this->flash('success', $success);
                }
            }
            return $back ? $this->back() : $this->refresh();
        }
    }

    /**
     * Write in sessions alert messages
     * @param string $type error or success
     * @param string $message alert body
     */
    public function flash($type, $message)
    {
        Yii::$app->getSession()->setFlash($type=='error'?'danger':$type, $message);
    }

    public function back()
    {
        return $this->redirect(Yii::$app->request->referrer);
    }
}