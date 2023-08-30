<?php

use app\models\Hutang;
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

Modal::begin([
    'id' => 'modaluploadhutang',
    'size' => 'modal-md',
    'header' => '<h4 id="header">Create</h4>',
    'headerOptions' => ['class' => 'default-modal'],
]);
echo $this->render('create', [
    'model' => $model,
]);
Modal::end();

Modal::begin([
    'id' => 'modalfiledownload',
    'size' => 'modal-xs',
    'options' => ['tabindex' => false],
    'header' => Html::a('<span class="glyphicon glyphicon-download"></span>' . ' Download', ['#'], ['class' => 'btn btn-primary', 'data-pjax' => 0, 'title' => 'Download file', 'id' => 'urlmodaldownload', 'target' => '_blank']),
    'headerOptions' => ['class' => 'default-modal'],
    'bodyOptions' => ['class' => 'modal-body body-file'],
]);
echo '<embed src="#" frameborder="1" style="width:100%;min-height:500px;" id="imgmodaldownload">';
Modal::end();

$this->title = 'Hutang';

$columns =
    [
        [
            'class' => 'kartik\grid\ActionColumn',
            'template' => '{approve}',
            'noWrap' => true,
            'buttons' => [
                'approve' => function ($url, $model, $key) {
                    return Html::a(
                        '<i class="glyphicon glyphicon-ok"></i>',
                        ['/hutang/approve', 'id' => $model->ID],
                        [
                            'type' => 'button',
                            'title'=>Yii::t('app', 'Approval'), 
                            'class' => 'btn btn-xs btn-primary',
                            'data-confirm' => "Apakah yakin data ingin di Approve?"
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
            'format'=>['decimal',2],
            'pageSummary' => true,
        ],
        [
            'attribute' => 'CREATED_AT',
            'label' => 'Tanggal',
            'headerOptions' => ['style' => 'text-align:center;'],
            'filterType' => GridView::FILTER_DATE,
            'filterWidgetOptions' => [
                'options' => ['id' => 'WAKTU_MASUK-absen'],
                'type' => DatePicker::TYPE_INPUT,
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'autoclose' => true,
                    'todayHighlight' => true,
                ],
            ],
            'format' => 'raw',
            'value' => function ($model) {
                return substr($model->CREATED_AT, 0, 10);
            },
        ],
        [
            'attribute' => 'STATUS',
            'headerOptions' => ['style' => 'text-align:center;'],
            'mergeHeader' => true
        ],
        [
            'attribute' => 'BUKTI',
            'mergeHeader' => true,
            'headerOptions' => ['style' => 'text-align:center;'],
            'contentOptions' => ['style' => 'text-align:center;'],
            'format' => 'raw',
            'value' => function ($model) {
                return Html::a(
                    '<span class="glyphicon glyphicon-folder-open"></span>',
                    '#',
                    [
                        'type' => 'button',
                        'class' => 'btn btn-xs btn-primary',
                        'data-toggle' => 'modal',
                        'data-target' => '#modalfiledownload',
                        'data-whatever' => 'files/hutang/' . $model->BUKTI
                    ]
                );
            },
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
        ],
        'toolbar' =>
        [
        ],
        'columns' => $columns,
        'showPageSummary' => true
    ]); ?>

</div>