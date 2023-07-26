<?php

use app\models\Pemasukan;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
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
    'id'=>'modaluploadberkasupdate',
    'size'=>'modal-md',
    'header'=>'<h4 id="header">Update</h4>',
    'headerOptions' => ['class'=>'default-modal'],
    ]);
echo $this->render('update', [
    'model' => $model,
]);
Modal::end();

Modal::begin([
    'id'=>'modaluploadberkas',
    'size'=>'modal-md',
    'header'=>'<h4 id="header">Create</h4>',
    'headerOptions' => ['class'=>'default-modal'],
    ]);
echo $this->render('create', [
    'model' => $model,
]);
Modal::end();

$this->title = 'Pemasukan';

$columns =
[
    [
        'class' => 'kartik\grid\ActionColumn',
        'template' => '{update} {delete}',
        'noWrap' => true,
        'buttons' => [
            'update' => function ($url, $model, $key) {
                return Html::a(
                    '<i class="glyphicon glyphicon-pencil"></i>',
                    ['/pemasukan/update', 'id' => $model->ID],
                    [
                        'type' => 'button',
                        'title'=>Yii::t('app', 'Approval'), 
                        'class' => 'btn btn-xs btn-primary', 
                        'id' => $model->ID  ,
                    ]
                );
            },
            'delete' => function ($url, $model, $key) {
                return Html::a(
                    '<i class="glyphicon glyphicon-trash"></i>',
                    ['/pemasukan/delete', 'id' => $model->ID],
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
        'filterType'=>GridView::FILTER_DATE,
        'filterWidgetOptions' => [
            'options' => ['id' => 'WAKTU_MASUK-absen'],
            'type' => DatePicker::TYPE_INPUT,
            'pluginOptions'=>[
                'format' => 'yyyy-mm',
                'autoclose' => true,
                'todayHighlight' => true,
                'startView' => 'month', // Tampilan awal widget adalah tampilan bulan
                'minViewMode' => 'months', // Hanya izinkan pemilihan bulan
            ],
        ],
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
            'before' => Html::a('<i class="fa fa-plus"> Create</i>', ['create'], ['class' => 'btn btn-primary', 'id' => 'createPemasukan',
            'data-toggle'=>'modal',
            'data-target'=>'#modaluploadberkas',])
        ],
        'columns' => $columns,
        'showPageSummary' => true
    ]); ?>

</div>
