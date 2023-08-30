<?php

use app\models\UserRefreshTokens;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\UserRefreshTokensSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'User Refresh Tokens';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-refresh-tokens-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User Refresh Tokens', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'user_refresh_tokenID',
            'urf_userID',
            'urf_token',
            'urf_ip',
            'urf_user_agent',
            //'urf_created',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, UserRefreshTokens $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'user_refresh_tokenID' => $model->user_refresh_tokenID]);
                 }
            ],
        ],
    ]); ?>


</div>
