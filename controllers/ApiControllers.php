<?php
namespace app\controllers;

use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;
use app\models\Rekap;

\Yii::$app->response->format = Response::FORMAT_JSON;

class ApiController extends \yii\web\Controller
{

    public function actionRekapIndex()
    {
        if ($request->isPost) {
            $data = Rekap::find()->all();
            return $data;
        } else {
            return ['error' => 'Invalid request method.'];
        }
    }
}
?>