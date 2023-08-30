<?php

use app\models\DataPengguna;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;

$this->title = 'Data Pengguna';

$columns = [
            ['class' => 'yii\grid\SerialColumn'],
            'USERNAME',
            'PASSWORD',
            [
                'attribute' => 'NAMA_PENGGUNA'
            ],
            [
                'attribute' => 'STATUS_USER',
                'value' => function($model){
                    return $model->STATUS_USER == '1' ? 'Aktif' : 'Tidak Aktif';
                }
            ],
            [
                'attribute' => 'JENIS_USER',
                'value' => function($model){
                    return $model->JENIS_USER == '0' ? 'Admin' : 'Pengguna';
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, DataPengguna $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'ID_PENGGUNA' => $model->ID_PENGGUNA]);
                }
            ]
        ];
?>
<div class="data-pengguna-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'id' => 'setfont',
        'filterModel' => $searchModel,
        'panel' => [
            'heading' => Html::encode($this->title),
            'before' =>Html::a('<i class="glyphicon glyphicon-plus"></i> Create', ['create'], ['class' => 'btn btn-primary'])
        ],
        'columns' => $columns
    ]); ?>


</div>
