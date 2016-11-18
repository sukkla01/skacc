<?php
use miloschuman\highcharts\Highcharts;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

  

    <div class="body-content">

       <div class="row">
        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header with-border">
                    <i class="fa fa-eercast"></i>
                    จำนวนการเกิดอุบัติเหตุแล้วเสียชีวิต ปีงบประมาณ 2559
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <?php
                    echo Highcharts::widget([
                        'options' => [
                            'title' => ['text' => ''],
                            'xAxis' => [
                                'categories' => $hosname
                            ],
                            'yAxis' => [
                                'title' => ['text' => 'จำนวน(คน)']
                            ],
                            'series' => [
                                    ['type' => 'column',
                                    'name' => 'โรงพยาบาล',
                                    'data' => $tcount,
                                    //'color' => '#db7093',
                                    //'shadow' => TRUE
                                    //'pointWidth' => 30
                                ],
                                   
                            //['name' => 'John', 'data' => [5, 7, 3]]
                            ]
                        ]
                    ]);
                    ?>





                </div>
                <!-- /.box-header -->

            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header with-border">
                     <i class="fa fa-spinner"></i>
                    จำนวนการเกิดอุบัติเหตุทั้งหมด ปีงบประมาณ 2559

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    
                        <?php
                    echo Highcharts::widget([
                        'options' => [
                            'title' => ['text' => ''],
                            'xAxis' => [
                                'categories' => $hosnamea
                            ],
                            'yAxis' => [
                                'title' => ['text' => 'จำนวน(คน)']
                            ],
                            'series' => [
                                    ['type' => 'column',
                                    'name' => 'โรงพยาบาล',
                                    'data' => $tcounta,
                                    'color' => '#db7093',
                                    //'shadow' => TRUE
                                    //'pointWidth' => 30
                                ],
                                   
                            //['name' => 'John', 'data' => [5, 7, 3]]
                            ]
                        ]
                    ]);
                    ?>
                </div>
                <!-- /.box-header -->

            </div>
        </div>
    </div>

    </div>
</div>
