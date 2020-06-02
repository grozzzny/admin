<?php

namespace grozzzny\admin\modules\pages\controllers;

use grozzzny\admin\modules\text\models\AdminText;
use Yii;
use grozzzny\admin\modules\pages\models\AdminPages;
use grozzzny\admin\modules\pages\models\AdminPagesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DefaultController implements the CRUD actions for AdminPages model.
 */
class DefaultController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all AdminPages models.
     * @return mixed
     */
    public function actionIndex()
    {
        /** @var AdminPagesSearch $searchModel */
        $searchModel = Yii::$container->get(AdminPagesSearch::class);

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Creates a new AdminPages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($slug = null)
    {
        /** @var AdminPages $searchModel */
        $model = Yii::$container->get(AdminPages::class);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        if(!empty($slug)) $model->slug = $slug;

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AdminPages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id = null, $slug = null)
    {
        $model = empty($slug) ? $this->findModel($id) : $this->findModelBySlug($slug);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AdminPages model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AdminPages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AdminPages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $model = Yii::$container->get(AdminPages::class);

        if (($model = $model::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    protected function findModelBySlug($slug)
    {
        $model = Yii::$container->get(AdminPages::class);

        if (($model = $model::findOne(['slug' => $slug])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
