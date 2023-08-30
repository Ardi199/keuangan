<?php

use app\models\Rekap;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
use kartik\date\DatePicker;
use yii\bootstrap\Modal;

$this->title = 'Pengeluaran Bulanan';

$columns = 
[
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
        'attribute' => 'TANGGAL',
        'headerOptions' => ['style' => 'text-align:center;'],
        'filterType'=>GridView::FILTER_DATE,
        'filterWidgetOptions' => [
            'options' => ['id' => 'WAKTU_MASUK-absen'],
            'type' => DatePicker::TYPE_INPUT,
            'pluginOptions' => [
                'format' => 'yyyy-mm',
                'autoclose' => true,
                'startView' => 'month', // Tampilan awal widget adalah tampilan bulan
                'minViewMode' => 'months', // Hanya izinkan pemilihan bulan
            ]
        ],
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
        'columns' => $columns,
        'panel' =>
        [
            'type' => 'default',
            'heading' => Html::encode($this->title),
        ],
        'showPageSummary' => true
    ]); ?>

</div>