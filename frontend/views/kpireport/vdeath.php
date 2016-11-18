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
            'label' => 'ประเภทการเกิดอุบัติเหตุ',
        //'url' => ['post-category/view'],
        //'template' => "<li><b>{link}</b></li>\n", // template for this link only
        ],
        'เสียชีวิต'
    ],
]);
?>
<?php if($flash==1){ ?>
<div class="row">
    <div class="col-md-6">
        <div class="callout callout-info">
            <h4>ประมวลผลระหว่างวันที่ <?php echo $date1.' ถึง '.$date2; ?></h4>

        </div>
    </div>
</div>
<?php } ?>

<div class="body-content">
    <div class="row" id="sql" style="display: none">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-body">



                    <?= Html::beginForm(); ?>
                    <i class="fa fa-calendar"></i>&nbsp;&nbsp;
                    ประมวลข้อมูลระหว่าง :
                    <?php
                    echo yii\jui\DatePicker::widget([
                        'name' => 'date1',
                        'value' => $date1,
                        'language' => 'th',
                        'dateFormat' => 'yyyy-MM-dd',
                        'clientOptions' => [
                            'changeMonth' => true,
                            'changeYear' => true,
                        ],
                    ]);
                    ?>

                    ถึง


                    <?php
                    echo yii\jui\DatePicker::widget([
                        'name' => 'date2',
                        'value' => $date2,
                        'language' => 'th',
                        'dateFormat' => 'yyyy-MM-dd',
                        'clientOptions' => [
                            'changeMonth' => true,
                            'changeYear' => true,
                        ]
                    ]);
                    ?>

                    &nbsp;&nbsp;<button class='btn btn-danger'>ประมวลผล</button>

                    <?= Html::endForm(); ?>



                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <div class="pull-left"><span style="font-weight: bold;" class="btn btn-danger btn-flat"><h4><i class="fa fa-bookmark"></i>&nbsp;&nbsp;จำนวนการตาย จำแนกตามประเภทการเกิดอุบัติเหตุ</h4></span></div>
                    &nbsp;&nbsp;<a style="font-weight: bold;" class="btn btn-success" id="btn_sql"><h4><i class="fa fa-calendar"></i>&nbsp;&nbsp;รายงานตามวันที่</h4></a>
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
                                <a style="font-weight: bold;" class="<?=$b1?>" href="<?= Url::to(['kpireport/vdeath', 'rep_year' => '2016']) ?>">2559</a>
                                <a style="font-weight: bold;" class="<?=$b2?>" href="<?= Url::to(['kpireport/vdeath', 'rep_year' => '2017']) ?>">2560</a>
                                <a style="font-weight: bold;" class="<?=$b3?>" href="<?= Url::to(['kpireport/vdeath', 'rep_year' => '2018']) ?>">2561</a>
                            </div>
                            <div class="pull-right">
                                <button style="font-weight: bold; margin-right: 5px;" class="btn btn-success" data-widget="collapse" data-toggle="tooltip" title="แสดง/ซ่อน ข้อมูล"><i class="fa fa-calendar"></i>&nbsp;&nbsp;ปีงบประมาณ</button>
                            </div>
                        </div>
                        <div>
                            <div class="pull-right" style="margin-top:5px;">ประมวลผลล่าสุด : <?=$rep_year ?></div>
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
                        'attribute' => 'Bus',
                        'label' => 'รถยนต์โดยสาร',
                        'hAlign' => 'right',
                        'pageSummary' => true,
                        'pageSummaryOptions' => ['id' => 'total_sum'],
                    ],
                        [
                        'attribute' => 'Truck',
                        'label' => 'รถบรรทุก',
                        'hAlign' => 'right',
                        'pageSummary' => true,
                        'pageSummaryOptions' => ['id' => 'total_sum'],
                    ],
                        [
                        'attribute' => 'Car',
                        'label' => 'รถเก๋ง',
                        'hAlign' => 'right',
                        'pageSummary' => true,
                        'pageSummaryOptions' => ['id' => 'total_sum'],
                    ],
                        [
                        'attribute' => 'PickUp',
                        'label' => 'รถปิคอัพ',
                        'hAlign' => 'right',
                        'pageSummary' => true,
                        'pageSummaryOptions' => ['id' => 'total_sum'],
                    ],
                        [
                        'attribute' => 'Motorcycle',
                        'label' => 'รถจักรยานยนต์',
                        'hAlign' => 'right',
                        'pageSummary' => true,
                        'pageSummaryOptions' => ['id' => 'total_sum'],
                    ],
                        [
                        'attribute' => 'Bicycle',
                        'label' => 'รถจักรยาน',
                        'hAlign' => 'right',
                        'pageSummary' => true,
                        'pageSummaryOptions' => ['id' => 'total_sum'],
                    ],
                        [
                        'attribute' => 'Agri_Vehicle',
                        'label' => 'รถที่ใช้ในการเกษตร',
                        'hAlign' => 'right',
                        'pageSummary' => true,
                        'pageSummaryOptions' => ['id' => 'total_sum'],
                    ],
                        [
                        'attribute' => 'Tricycle',
                        'label' => 'รถสามล้อ',
                        'hAlign' => 'right',
                        'pageSummary' => true,
                        'pageSummaryOptions' => ['id' => 'total_sum'],
                    ],
                        [
                        'attribute' => 'Fall_Vehicle',
                        'label' => 'ตกรถ',
                        'hAlign' => 'right',
                        'pageSummary' => true,
                        'pageSummaryOptions' => ['id' => 'total_sum'],
                    ],
                        [
                        'attribute' => 'Other',
                        'label' => 'อื่นๆ',
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
<?php
$script = <<< JS
$(function(){
    $("label[title='Show all data']").hide();
});
        
$('#btn_sql').on('click', function(e) {
    
   $('#sql').toggle();
});
JS;
$this->registerJs($script);
?>