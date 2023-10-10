<?php
namespace app\controllers;

use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;
use app\models\Rekap;
use Yii;

\Yii::$app->response->format = Response::FORMAT_JSON;

class ApiController extends \yii\web\Controller
{

    public function actionRekapIndex()
    {
        $payload = [
            'iss' => 'your_issuer', // Pengirim token
            'aud' => 'your_audience', // Penerima token
            'iat' => time(), // Waktu pembuatan token
            'exp' => time() + 3600, // Waktu kadaluwarsa token (dalam detik)
            'uid' => 100, // Data tambahan yang ingin Anda sertakan dalam token
        ];
        
        $token = Yii::$app->jwt->encode($payload);
        
        // Memverifikasi token JWT
        try {
            $decodedToken = Yii::$app->jwt->decode($token);
            // Token valid, lakukan sesuatu di sini
        } catch (\firebase\jwt\BeforeValidException $e) {
            // Token belum berlaku
        } catch (\firebase\jwt\ExpiredException $e) {
            // Token telah kadaluwarsa
        } catch (\firebase\jwt\SignatureInvalidException $e) {
            // Tanda tangan tidak valid
        }
        
        // Mendapatkan data tambahan dari token
        $uid = $decodedToken['uid'];
    }
}
