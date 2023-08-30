<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\DataPengguna $model */

$this->title = 'Update Data Pengguna: ' . $model->ID_PENGGUNA;
$this->params['breadcrumbs'][] = ['label' => 'Data Penggunas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_PENGGUNA, 'url' => ['view', 'ID_PENGGUNA' => $model->ID_PENGGUNA]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="data-pengguna-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
