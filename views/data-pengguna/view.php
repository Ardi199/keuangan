<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\DataPengguna $model */

$this->title = $model->ID_PENGGUNA;
$this->params['breadcrumbs'][] = ['label' => 'Data Penggunas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="data-pengguna-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'ID_PENGGUNA' => $model->ID_PENGGUNA], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'ID_PENGGUNA' => $model->ID_PENGGUNA], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ID_PENGGUNA',
            'USERNAME',
            'PASSWORD',
            'STATUS_USER',
            'JENIS_USER',
        ],
    ]) ?>

</div>
