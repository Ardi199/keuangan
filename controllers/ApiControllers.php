<?php
namespace app\controllers;
use app\models\Rekap;

class ApiController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $res['value'] = 0;
        $res['message'] = 'request not found!!!';
        return $res;
    }

    public function actionRekapIndex()
    {
        print_r(Yii::$app->request);die;
        if ($request->isPost) {
            $data = $request->post(); // Menerima data dari POST request
            
            // Lakukan validasi data
            if(isset($data['name']) && isset($data['email'])) {

                
                return ['message' => 'Data has been successfully created.', 'data' => $data];
            } else {
                return ['error' => 'Missing required parameters.'];
            }
        } else {
            return ['error' => 'Invalid request method.'];
        }
    }
}
?>