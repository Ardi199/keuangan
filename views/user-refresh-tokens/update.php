<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\UserRefreshTokens $model */

$this->title = 'Update User Refresh Tokens: ' . $model->user_refresh_tokenID;
$this->params['breadcrumbs'][] = ['label' => 'User Refresh Tokens', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user_refresh_tokenID, 'url' => ['view', 'user_refresh_tokenID' => $model->user_refresh_tokenID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-refresh-tokens-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
