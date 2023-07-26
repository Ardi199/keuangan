<?php

use app\models\Rekap;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
use kartik\date\DatePicker;
use yii\bootstrap\Modal;

if(Yii::$app->session->getFlash('sukses')):
    echo '<div class="alert alert-info" style="font-size: 11px;">';
    echo Yii::$app->session->getFlash('sukses');
    echo '</div>';
endif;
if (Yii::$app->session->hasFlash('error')) :
    echo '<div class="alert alert-danger" style="font-size: 11px;">';
    echo Yii::$app->session->getFlash('error');
    echo '</div>';
endif;

Modal::begin([
    'id'=>'modaluploadpengeluaran',
    'size'=>'modal-md',
    'header'=>'<h4 id="header">Create</h4>',
    'headerOptions' => ['class'=>'default-modal'],
    ]);
echo $this->render('create', [
    'model' => $model,
]);
Modal::end();

$this->title = 'Pengeluaran';

$columns = 
[
    [
        'class' => 'kartik\grid\ActionColumn',
        'template' => '{update} {delete}',
        'noWrap' => true,
        'buttons' => [
            'update' => function ($url, $model, $key) {
                return Html::a(
                    '<i class="glyphicon glyphicon-edit"></i>',
                    ['/rekap/update', 'id' => $model->ID],
                    [
                        'type' => 'button',
                        'title'=>Yii::t('app', 'Approval'), 
                        'class' => 'btn btn-xs btn-primary',
                    ]
                );
            },
            'delete' => function ($url, $model, $key) {
                return Html::a(
                    '<i class="glyphicon glyphicon-trash"></i>',
                    ['/rekap/delete', 'id' => $model->ID],
                    [
                        'type' => 'button',
                        'title'=>Yii::t('app', 'Approval'), 
                        'class' => 'btn btn-xs btn-primary',
                        'data-confirm' => "Apakah yakin data ingin di Hapus?"
                    ]
                );
            },
        ],
    ],
    [
        'attribute' => 'KETERANGAN',
        'headerOptions' => ['style' => 'text-align:center;'],
    ],
    [
        'attribute' => 'NOMINAL',
        'headerOptions' => ['style' => 'text-align:center;'],
        'value' => function($model){
            return number_format($model->NOMINAL,2,',','.');
        },
        'pageSummary' => true,
    ],
    [
        'attribute' => 'TANGGAL',
        'headerOptions' => ['style' => 'text-align:center;'],
        'filterType'=>GridView::FILTER_DATE,
        'filterWidgetOptions' => [
            'options' => ['id' => 'WAKTU_MASUK-absen'],
            'type' => DatePicker::TYPE_INPUT,
            'pluginOptions'=>[
                'format' => 'yyyy-mm-dd',
                'autoclose' => true,
                'todayHighlight' => true,
            ],
        ],
        // 'format'=>'raw',
        // 'value' => function ($model) {
        //     return substr($model->CREATED_AT, 0, 10);
        // },
    ],
    [
        'attribute' => 'HARI',
        'value' => 'Hari',
        'headerOptions' => ['style' => 'text-align:center;'],
    ],
];
?>

<div class="data-absensi-index box box-primary" style='overflow-x: hidden;'>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'id' => 'setfont',
        'responsive' => true,
        'responsiveWrap' => false,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'setfont-pjax-2', 'timeout' => false, 'enablePushState' => false]],
        'hover' => true,
        'condensed' => true,
        'pjaxSettings' => ['options' => ['id' => 'setfont-pjax-2']],
        'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        'persistResize' => false,
        'panel' =>
        [
            'type' => 'default',
            'heading' => Html::encode($this->title),
            'before' => Html::a('<i class="fa fa-plus"> Create</i>', ['create'], ['class' => 'btn btn-primary', 'id' => 'createPengeluaran',
            'data-toggle'=>'modal',
            'data-target'=>'#modaluploadpengeluaran',])
        ],
        'columns' => $columns,
        'showPageSummary' => true
    ]); ?>

</div>