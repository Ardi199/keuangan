<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\UserRefreshTokens $model */

$this->title = 'Create User Refresh Tokens';
$this->params['breadcrumbs'][] = ['label' => 'User Refresh Tokens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-refresh-tokens-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
