<?php

use app\models\Hutang;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
use kartik\date\DatePicker;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;

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
            'template' => '{update} {delete}',
            'noWrap' => true,
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    return Html::a(
                        '<i class="glyphicon glyphicon-edit"></i>',
                        ['/hutang/update', 'id' => $model->ID],
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
                        ['/hutang/delete', 'id' => $model->ID, 'data-method'=>"post"],
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
            'value' => function ($model) {
                return number_format($model->NOMINAL,2,',','.');
            },
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
            'filter' => ArrayHelper::map(Hutang::find()->all(), 'STATUS', 'STATUS'),
            'filterType' => GridView::FILTER_SELECT2,
            'filterWidgetOptions' => [
                'options' => ['prompt' => 'Status ...'],
                'pluginOptions' => [
                    'allowClear' => true,
                    'width'=>'resolve'
                ],
            ],
        ],
        [
            'attribute' => 'BUKTI',
            'mergeHeader' => true,
            'headerOptions' => ['style' => 'text-align:center;'],
            'contentOptions' => ['style' => 'text-align:center;'],
            'format' => 'raw',
            'value' => function ($model) {
                return Html::a(
                    '<span class="glyphicon glyphicon-picture"></span>',
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
            'before' => Html::a(
                '<i class="fa fa-plus"> Create</i>',
                [
                    'create'
                ],
                [
                    'class' => 'btn btn-primary',
                    'id' => 'createHutang',
                    'data-toggle' => 'modal',
                    'data-target' => '#modaluploadhutang',
                ]
            )
        ],
        'columns' => $columns,
        'showPageSummary' => true,
        'rowOptions' => function($model){
            if($model->STATUS == 'Belum di Bayar'):
                return ['class' => 'danger'];
            elseif($model->STATUS == 'Sudah di Bayar'):
                return ['class' => 'success'];
            endif;
        }
    ]); ?>

</div>