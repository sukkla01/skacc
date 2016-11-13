<?php
/* @var $this yii\web\View */

use yii\bootstrap\Html;
use kartik\widgets\DatePicker;
//use kartik\grid\GridView;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use yii\widgets\Breadcrumbs;

echo Breadcrumbs::widget([
    'itemTemplate' => "<li><i>{link}</i></li>\n", // template for all links
    'links' => [
            [
            'label' => 'ระบบรายงาน',
        //'url' => ['post-category/view'],
        //'template' => "<li><b>{link}</b></li>\n", // template for this link only
        ],
        'ระบบรายงานใหม่'
    ],
]);
?>

<div class="body-content">

    

    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <div class="pull-left"><span style="font-weight: bold;" class="btn btn-info btn-flat"><h4><i class="fa fa-bookmark"></i>&nbsp;&nbsp;จำนวนการเกิดอุบัติเหตุแล้ว Admit</h4></span></div>
                    <div  class="pull-right">
                        <div>
                            <div class="btn-group pull-right" role="group">
                                <a style="font-weight: bold;" class="btn btn-success" href="/r2dc/web/moph/index?rep_year=2015">2559</a>
                                <a style="font-weight: bold;" class="btn  btn-primary" href="/r2dc/web/moph/index?rep_year=2016">2560</a>
                                <a style="font-weight: bold;" class="btn btn-success" href="/r2dc/web/moph/index?rep_year=2017">2561</a>
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
                            'attribute' => 'd1',
                            'label' => '1.อุบัติเหตุจากการขนส่ง',
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'd2',
                            'label' => '2.1 พลัด ตก หกล้ม',
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'd3',
                            'label' => '2.2 แรงเชิงกลวัตถุ',
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'd4',
                            'label' => '2.3 แรงเชิงกลสัตว์ คน',
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'd5',
                            'label' => '2.4 ตกน้ำ จมน้ำ',
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'd6',
                            'label' => '2.5 คุกคามการหายใจ',
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'd7',
                            'label' => '2.6 ไฟฟ้า รังสี',
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'd8',
                            'label' => '2.7 ควันไฟ เปลวไฟ',
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'd9',
                            'label' => '2.8 ความร้อน ของร้อน',
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'd10',
                            'label' => '2.9 พิษจากสัตว์ พืช',
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'd11',
                            'label' => '2.10 พลังงานธรรมชาติ',
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'd12',
                            'label' => '2.11 พิษ',
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'd13',
                            'label' => '2.12 ออกแรงเกิน',
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'd14',
                            'label' => '2.13 ไม่ทราบแน่ชัด',
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'd15',
                            'label' => '3.ทำร้ายตนเอง',
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'd16',
                            'label' => '4.ถูกทำร้ายร่างกาย',
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'd17',
                            'label' => '5.บาดเจ็บโดยไม่ทราบเจตนา',
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'd18',
                            'label' => '7.กฏหมายหรือสงคราม',
                            'hAlign' => 'right',
                            'pageSummary' => true,
                            'pageSummaryOptions' => ['id' => 'total_sum'],
                        ],
                            [
                            'attribute' => 'd19',
                            'label' => '8.ไม่ทราบสาเหตุ เจตนา',
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