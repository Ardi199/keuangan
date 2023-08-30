<?php

namespace app\controllers;

use app\models\Hutang;
use app\models\HutangSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use Yii;
use yii\filters\AccessControl;

/**
 * HutangController implements the CRUD actions for Hutang model.
 */
class HutangController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index', 'create', 'update', 'approval', 'approve'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'create', 'update', 'approval', 'approve'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Hutang models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new Hutang();
        $searchModel = new HutangSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Hutang models.
     *
     * @return string
     */
    public function actionApproval()
    {
        $model = new Hutang();
        $searchModel = new HutangSearch();
        $searchModel->isApprove = '1';
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('approval', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionApprove($id)
    {
        $model = $this->findModel($id);
        $model->STATUS = 'Sudah di Bayar';
        $model->UPDATED_AT = date('Y-m-d h:i:s');
        if ($model->save()) :
            Yii::$app->session->setFlash('sukses', "Berhasil Approve Hutang ID: " . $model->ID . " berhasil");
        endif;
        return $this->redirect(['approval']);
    }

    /**
     * Displays a single Hutang model.
     * @param int $ID ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Hutang model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Hutang();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->ID = $model->id;
                $model->CREATED_AT = date('Y-m-d h:i:s');
                $model->BUKTI = $this->setFile($model, 'BUKTI');
                if ($model->save()) :
                    Yii::$app->session->setFlash('sukses', "Berhasil Buat Hutang ID: " . $model->ID . " berhasil");
                else :
                    Yii::$app->session->setFlash('error', "Buat Hutang ID: " . $model->ID . " tidak berhasil : " . $model->getErrors());
                endif;
                return $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Hutang model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $ID ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->BUKTI = $this->setFile($model, 'BUKTI');
            $model->save();
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Hutang model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $ID ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->BUKTI = $this->deleteFile($model->BUKTI);
        $model->delete();
        Yii::$app->session->setFlash('sukses', "Berhasil Hapus Hutang ID: " . $model->ID . " berhasil");

        return $this->redirect(['index']);
    }

    /**
     * Finds the Hutang model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $ID ID
     * @return Hutang the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Hutang::findOne(['ID' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Finds the Frc model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Frc the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function setFile($model, $attr)
    {
        $model->$attr = UploadedFile::getInstance($model, $attr);
        if (isset($model->$attr->name)) :
            $model->$attr->name = $attr . '-' . $model->ID . '.' . $model->$attr->extension;
            return $this->saveFile($model, $attr);
        else :
            $modelOld = Hutang::findOne($model->ID);
            if (isset($modelOld->$attr)) :
                return $modelOld->$attr;
            else :
                return null;
            endif;
        endif;
    }
    /**
     * Finds the Frc model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Frc the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function saveFile($model, $attr)
    {
        $path = Yii::getAlias('@webroot') . '/files/hutang/';
        $model->$attr->saveAs($path . $model->$attr->name);
        return $model->$attr->name;
    }

    /**
     * Finds the Frc model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Frc the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function deleteFile($file)
    {
        $path = Yii::getAlias('@webroot') . '/files/hutang/';
        if (!empty($file) and $file != "") :
            if (file_exists($path . $file)) :
                return unlink($path . $file);
            else :
                return false;
            endif;
        else :
            return false;
        endif;
    }

    protected function setFileOld($model, $attr, $old)
    {
        $model->$attr = UploadedFile::getInstance($model, $attr);
        if (isset($model->$attr->name)) :
            $model->$attr->name = $attr . '-' . $model->ID . '.' . $model->$attr->extension;
            return $this->saveFile($model, $attr);
        elseif ($model->isNewRecord) :
            $model->$attr = $model->peg->$old->URL;
            copy('/files/hutang/' . $model->$attr, $model->$attr);
            return $model->$attr;
        else :
            $modelOld = Hutang::findOne($model->ID);
            return $modelOld->$attr;
        endif;
    }
}
