<?php

namespace app\controllers;

use app\models\UserRefreshTokens;
use app\models\UserRefreshTokensSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserRefreshTokensController implements the CRUD actions for UserRefreshTokens model.
 */
class UserRefreshTokensController extends Controller
{
    /**
     * @inheritDoc
     */
    // public function behaviors()
    // {
    //     return array_merge(
    //         parent::behaviors(),
    //         [
    //             'verbs' => [
    //                 'class' => VerbFilter::className(),
    //                 'actions' => [
    //                     'delete' => ['POST'],
    //                 ],
    //             ],
    //         ]
    //     );
    // }

    public function behaviors() 
    {
    	$behaviors = parent::behaviors();

		$behaviors['authenticator'] = [
			'class' => \sizeg\jwt\JwtHttpBearerAuth::class,
			'except' => [
				'login',
				'refresh-token',
				'options',
			],
		];

		return $behaviors;
	}
    private function generateJwt(\app\models\User $user) {
		$jwt = Yii::$app->jwt;
		$signer = $jwt->getSigner('HS256');
		$key = $jwt->getKey();
		$time = time();

		$jwtParams = Yii::$app->params['jwt'];

		return $jwt->getBuilder()
			->issuedBy($jwtParams['issuer'])
			->permittedFor($jwtParams['audience'])
			->identifiedBy($jwtParams['id'], true)
			->issuedAt($time)
			->expiresAt($time + $jwtParams['expire'])
			->withClaim('uid', $user->userID)
			->getToken($signer, $key);
	}

	/**
	 * @throws yii\base\Exception
	 */
	private function generateRefreshToken(\app\models\User $user, \app\models\User $impersonator = null): \app\models\UserRefreshToken {
		$refreshToken = Yii::$app->security->generateRandomString(200);

		// TODO: Don't always regenerate - you could reuse existing one if user already has one with same IP and user agent
		$userRefreshToken = new \app\models\UserRefreshToken([
			'urf_userID' => $user->id,
			'urf_token' => $refreshToken,
			'urf_ip' => Yii::$app->request->userIP,
			'urf_user_agent' => Yii::$app->request->userAgent,
			'urf_created' => gmdate('Y-m-d H:i:s'),
		]);
		if (!$userRefreshToken->save()) {
			throw new \yii\web\ServerErrorHttpException('Failed to save the refresh token: '. $userRefreshToken->getErrorSummary(true));
		}

		// Send the refresh-token to the user in a HttpOnly cookie that Javascript can never read and that's limited by path
		Yii::$app->response->cookies->add(new \yii\web\Cookie([
			'name' => 'refresh-token',
			'value' => $refreshToken,
			'httpOnly' => true,
			'sameSite' => 'none',
			'secure' => true,
			'path' => '/v1/auth/refresh-token',  //endpoint URI for renewing the JWT token using this refresh-token, or deleting refresh-token
		]));

		return $userRefreshToken;
	}
    public function actionLogin() {
		$model = new \app\models\LoginForm();
		if ($model->load(Yii::$app->request->getBodyParams()) && $model->login()) {
			$user = Yii::$app->user->identity;

			$token = $this->generateJwt($user);

			$this->generateRefreshToken($user);

			return [
				'user' => $user,
				'token' => (string) $token,
			];
		} else {
			return $model->getFirstErrors();
		}
	}
    /**
     * Lists all UserRefreshTokens models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserRefreshTokensSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserRefreshTokens model.
     * @param int $user_refresh_tokenID User Refresh Token ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($user_refresh_tokenID)
    {
        return $this->render('view', [
            'model' => $this->findModel($user_refresh_tokenID),
        ]);
    }

    /**
     * Creates a new UserRefreshTokens model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new UserRefreshTokens();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'user_refresh_tokenID' => $model->user_refresh_tokenID]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing UserRefreshTokens model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $user_refresh_tokenID User Refresh Token ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($user_refresh_tokenID)
    {
        $model = $this->findModel($user_refresh_tokenID);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'user_refresh_tokenID' => $model->user_refresh_tokenID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing UserRefreshTokens model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $user_refresh_tokenID User Refresh Token ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($user_refresh_tokenID)
    {
        $this->findModel($user_refresh_tokenID)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserRefreshTokens model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $user_refresh_tokenID User Refresh Token ID
     * @return UserRefreshTokens the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($user_refresh_tokenID)
    {
        if (($model = UserRefreshTokens::findOne(['user_refresh_tokenID' => $user_refresh_tokenID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
