<?php

namespace app\controllers;

use app\models\Rekap;
use app\models\RekapSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RekapController implements the CRUD actions for Rekap model.
 */
class RekapController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index', 'create', 'update'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'create', 'update'],
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
     * Lists all Rekap models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new Rekap();
        $searchModel = new RekapSearch();
        $searchModel->TANGGAL = date('Y-m-d');
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Rekap models.
     *
     * @return string
     */
    public function actionIndexBulanan()
    {
        $model = new Rekap();
        $searchModel = new RekapSearch();
        $searchModel->gaji = '1';
        $searchModel->TANGGAL = date('Y-m');
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index_bulanan', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Rekap model.
     * @param int $ID ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($ID)
    {
        return $this->render('view', [
            'model' => $this->findModel($ID),
        ]);
    }

    /**
     * Creates a new Rekap model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Rekap();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->TANGGAL = $this->request->post()['Rekap']['TANGGAL'];
                $model->CREATED_AT = date('Y-m-d h:i:s');
                $model->HARI = date('l');
                if ($model->save()) :
                    Yii::$app->session->setFlash('sukses', "Berhasil Buat Pengeluaran ID: " . $model->ID . " berhasil");
                else :
                    Yii::$app->session->setFlash('error', "Buat Pengeluaran ID: " . $model->ID . " tidak berhasil : " . $model->getErrors());
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
     * Updates an existing Rekap model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $ID ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->UPDATED_AT = date('Y-m-d h:i:s');
            if ($model->save()) :
                Yii::$app->session->setFlash('sukses', "Berhasil Ubah Pengeluaran ID: " . $model->ID . " berhasil");
            else :
                Yii::$app->session->setFlash('error', "Ubah Pengeluaran ID: " . $model->ID . " tidak berhasil : " . $model->getErrors());
            endif;
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Rekap model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $ID ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();
        Yii::$app->session->setFlash('sukses', "Berhasil Hapus Pengeluaran ID: " . $model->ID . " berhasil");

        return $this->redirect(['index']);
    }

    /**
     * Finds the Rekap model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $ID ID
     * @return Rekap the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rekap::findOne(['ID' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
