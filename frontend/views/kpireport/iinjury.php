<?php
/* @var $this yii\web\View */

use yii\bootstrap\Html;
use kartik\widgets\DatePicker;
//use kartik\grid\GridView;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;

echo Breadcrumbs::widget([
    'itemTemplate' => "<li><i>{link}</i></li>\n", // template for all links
    'links' => [
            [
            'label' => 'การเกิดอุบัติเหตุ',
        //'url' => ['post-category/view'],
        //'template' => "<li><b>{link}</b></li>\n", // template for this link only
        ],
        'บาดเจ็บ'
    ],
]);
?>

<div class="body-content">

    

    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <div class="pull-left"><span style="font-weight: bold;" class="btn btn-info btn-flat"><h4><i class="fa fa-bookmark"></i>&nbsp;&nbsp;จำนวนการเกิดอุบัติเหตุแล้วมีการบาดเจ็บ</h4></span></div>
                    <div  class="pull-right">
                        <div>
                            <?php
                               if($rep_year=='2016'){
                                  $b1='btn btn-primary';
                                  $b2='btn btn-success';
                                  $b3='btn btn-success';
                               } else if ($rep_year=='2017'){
                                  $b1='btn btn-success';
                                  $b2='btn btn-primary';
                                  $b3='btn btn-success'; 
                               }else{
                                  $b1='btn btn-success';
                                  $b2='btn btn-success';
                                  $b3='btn btn-primary';  
                               }
                            ?>
                            <div class="btn-group pull-right" role="group">
                                <a style="font-weight: bold;" class="<?=$b1?>" href="<?= Url::to(['kpireport/iinjury', 'rep_year' => '2016']) ?>">2559</a>
                                <a style="font-weight: bold;" class="<?=$b2?>" href="<?= Url::to(['kpireport/iinjury', 'rep_year' => '2017']) ?>">2560</a>
                                <a style="font-weight: bold;" class="<?=$b3?>" href="<?= Url::to(['kpireport/iinjury', 'rep_year' => '2018']) ?>">2561</a>
                            </div>
                            <div class="pull-right">
                                <button style="font-weight: bold; margin-right: 5px;" class="btn btn-success" data-widget="collapse" data-toggle="tooltip" title="แสดง/ซ่อน ข้อมูล"><i class="fa fa-calendar"></i>&nbsp;&nbsp;ปีงบประมาณ</button>
                            </div>
                        </div>
                        <div>
                            <div class="pull-right" style="margin-top:5px;">ประมวลผลล่าสุด : </div>
                        </div>
                    </div>

                   
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">


                    <?php
                    $gridColumns = [
                            ['class' => 'kartik\grid\SerialColumn'],
                            [
                            'attribute' => 'HOSPCODE',
                            'label' => 'Hospcode',
                            //'pageSummary' => 'รวมทั้งหมด',
                            //'contentOptions' => ['class' => 'text-center'],
                            'headerOptions' => ['class' => 'text-center']
                        ],
                            [
                            'attribute' => 'hosname',
                            'label' => 'ชื่อสถานบริการ',
                            'pageSummary' => 'รวมทั้งหมด'
                        ],
                            [
                            'attribute' => 'Age0_4',
                            'label' => '0-4 ปี',
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'Age5_9',
                            'label' => '5-9 ปี',
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'Age10_14',
                            'label' => '10-14 ปี',
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'Age15_24',
                            'label' => '15-24 ปี',
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'Age25_34',
                            'label' => '25-34 ปี',
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'Age35_44',
                            'label' => '35-44 ปี',
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'Age45_54',
                            'label' => '45-54 ปี',
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'Age55_64',
                            'label' => '55-64 ปี',
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'Age65Up',
                            'label' => 'มากกว่า 65 ปี',
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'total',
                            'label' => 'รวมทั้งหมด',
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            
                    ];

                    echo '<div class="col-md-12" align="right" >';
                    echo ExportMenu::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => $gridColumns
                    ]);
                    echo '</div>';
                    echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        //'filterModel' => $searchModel,
                        'autoXlFormat' => true,
                        'export' => [
                            'fontAwesome' => true,
                            'showConfirmAlert' => false,
                            'target' => GridView::TARGET_BLANK
                        ],
                        'responsive' => true,
                        'hover' => true,
                        'columns' => $gridColumns,
                        'resizableColumns' => true,
                        'resizeStorageKey' => Yii::$app->user->id . '-' . date("m"),
                        //'floatHeader' => true,
                        //'floatHeaderOptions' => ['scrollingTop' => '100'],
                        'pjax' => true,
                        'pjaxSettings' => [
                            'neverTimeout' => true,
                        //'beforeGrid' => 'My fancy content before.',
                        //'afterGrid' => 'My fancy content after.',
                        ],
                        'showPageSummary' => true,
                            // 'pageSummary' => \app\components\PTotal::pageTotal($dataProvider->models,'price'),
                    ]);
                    ?>






                </div>

            </div>

        </div>

    </div>
</div>