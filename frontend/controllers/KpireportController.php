<?php

namespace frontend\controllers;
use Yii;

class KpireportController extends \yii\web\Controller {

    public function actionIndex() {
        return $this->render('index');
    }
    
    public function actionIadmit() {
        //$this->permitRole([1, 3]);
        if(isset($_GET['rep_year'])) {
           $rep_year = $_GET['rep_year'];
        }else{
            $rep_year=date('Y');
        }
        $date1 = ($rep_year-1).'1001';
        $date2 = $rep_year.'0930';
        
        
        $sql = "SELECT p.HOSPCODE,chospital.hosname,
                sum(CASE WHEN timestampdiff(year,p.BIRTH,curdate()) BETWEEN 0 and 4  THEN '1' ELSE '0' END) AS Age0_4,
                sum(CASE WHEN timestampdiff(year,p.BIRTH,curdate()) BETWEEN 5 and 9  THEN '1' ELSE '0' END) AS Age5_9,
                sum(CASE WHEN timestampdiff(year,p.BIRTH,curdate()) BETWEEN 10 and 14  THEN '1' ELSE '0' END) AS Age10_14,
                sum(CASE WHEN timestampdiff(year,p.BIRTH,curdate()) BETWEEN 15 and 24  THEN '1' ELSE '0' END) AS Age15_24,
                sum(CASE WHEN timestampdiff(year,p.BIRTH,curdate()) BETWEEN 25 and 34  THEN '1' ELSE '0' END) AS Age25_34,
                sum(CASE WHEN timestampdiff(year,p.BIRTH,curdate()) BETWEEN 35 and 44  THEN '1' ELSE '0' END) AS Age35_44,
                sum(CASE WHEN timestampdiff(year,p.BIRTH,curdate()) BETWEEN 45 and 54  THEN '1' ELSE '0' END) AS Age45_54,
                sum(CASE WHEN timestampdiff(year,p.BIRTH,curdate()) BETWEEN 55 and 64  THEN '1' ELSE '0' END) AS Age55_64,
                sum(CASE WHEN timestampdiff(year,p.BIRTH,curdate()) >= 65 THEN '1' ELSE '0' END) AS Age65Up,
                sum(CASE WHEN timestampdiff(year,p.BIRTH,curdate()) >= 0  THEN '1' ELSE '0' END) AS total

                FROM person p
                LEFT JOIN chospital ON p.HOSPCODE = chospital.hoscode
                LEFT JOIN admission s on s.HOSPCODE=p.HOSPCODE and s.PID=p.PID
                LEFT JOIN diagnosis_ipd d on d.HOSPCODE=s.HOSPCODE and d.PID=s.PID and d.AN=s.AN
                where s.DATETIME_DISCH BETWEEN '$date1' AND '$date2'
                AND left(d.DIAGCODE,3) BETWEEN 'V01' AND 'V99'
                AND p.DISCHARGE = '9' 
                group by p.HOSPCODE";
        try {
            $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => [
                'pageSize' => 50
            ],
        ]);
        return $this->render('iadmit', ['dataProvider' => $dataProvider,'rep_year'=>$rep_year]);
    }
    
    public function actionIinjury() {
        //$this->permitRole([1, 3]);
        if(isset($_GET['rep_year'])) {
           $rep_year = $_GET['rep_year'];
        }else{
            $rep_year=date('Y');
        }
        $date1 = ($rep_year-1).'1001';
        $date2 = $rep_year.'0930';
        
        $sql = "SELECT p.HOSPCODE,chospital.hosname,
                sum(CASE WHEN timestampdiff(year,p.BIRTH,curdate()) BETWEEN 0 and 4  THEN 1 ELSE 0 END) AS Age0_4,
                sum(CASE WHEN timestampdiff(year,p.BIRTH,curdate()) BETWEEN 5 and 9  THEN 1 ELSE 0 END) AS Age5_9,
                sum(CASE WHEN timestampdiff(year,p.BIRTH,curdate()) BETWEEN 10 and 14  THEN 1 ELSE 0 END) AS Age10_14,
                sum(CASE WHEN timestampdiff(year,p.BIRTH,curdate()) BETWEEN 15 and 24  THEN 1 ELSE 0 END) AS Age15_24,
                sum(CASE WHEN timestampdiff(year,p.BIRTH,curdate()) BETWEEN 25 and 34  THEN 1 ELSE 0 END) AS Age25_34,
                sum(CASE WHEN timestampdiff(year,p.BIRTH,curdate()) BETWEEN 35 and 44  THEN 1 ELSE 0 END) AS Age35_44,
                sum(CASE WHEN timestampdiff(year,p.BIRTH,curdate()) BETWEEN 45 and 54  THEN 1 ELSE 0 END) AS Age45_54,
                sum(CASE WHEN timestampdiff(year,p.BIRTH,curdate()) BETWEEN 55 and 64  THEN 1 ELSE 0 END) AS Age55_64,
                sum(CASE WHEN timestampdiff(year,p.BIRTH,curdate()) >= 65 THEN 1 ELSE 0 END) AS Age65Up,
                sum(CASE WHEN timestampdiff(year,p.BIRTH,curdate()) > 0  THEN '1' ELSE '0' END) AS total

                FROM person p
                LEFT JOIN chospital ON p.HOSPCODE = chospital.hoscode
                LEFT JOIN service s on s.HOSPCODE=p.HOSPCODE and s.PID=p.PID
                LEFT JOIN diagnosis_opd d on d.HOSPCODE=s.HOSPCODE and d.PID=s.PID and d.SEQ=s.SEQ
                where s.DATE_SERV BETWEEN '20151001' AND '20151031'
                AND left(d.DIAGCODE,3) BETWEEN 'V01' AND 'V99'
                AND p.DISCHARGE = '9' 
                group by p.HOSPCODE";
        try {
            $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => [
                'pageSize' => 50
            ],
        ]);
        return $this->render('iinjury', ['dataProvider' => $dataProvider,'rep_year'=>$rep_year]);
    }
    public function actionIdeath() {
        //$this->permitRole([1, 3]);
        if(isset($_GET['rep_year'])) {
           $rep_year = $_GET['rep_year'];
        }else{
            $rep_year=date('Y');
        }
        $date1 = ($rep_year-1).'1001';
        $date2 = $rep_year.'0930';
        
        $sql = "SELECT p.HOSPCODE,chospital.hosname,
                sum(CASE WHEN timestampdiff(year,p.BIRTH,curdate()) BETWEEN 0 and 4  THEN 1 ELSE 0 END) AS Age0_4,
                sum(CASE WHEN timestampdiff(year,p.BIRTH,curdate()) BETWEEN 5 and 9  THEN 1 ELSE 0 END) AS Age5_9,
                sum(CASE WHEN timestampdiff(year,p.BIRTH,curdate()) BETWEEN 10 and 14  THEN 1 ELSE 0 END) AS Age10_14,
                sum(CASE WHEN timestampdiff(year,p.BIRTH,curdate()) BETWEEN 15 and 24  THEN 1 ELSE 0 END) AS Age15_24,
                sum(CASE WHEN timestampdiff(year,p.BIRTH,curdate()) BETWEEN 25 and 34  THEN 1 ELSE 0 END) AS Age25_34,
                sum(CASE WHEN timestampdiff(year,p.BIRTH,curdate()) BETWEEN 35 and 44  THEN 1 ELSE 0 END) AS Age35_44,
                sum(CASE WHEN timestampdiff(year,p.BIRTH,curdate()) BETWEEN 45 and 54  THEN 1 ELSE 0 END) AS Age45_54,
                sum(CASE WHEN timestampdiff(year,p.BIRTH,curdate()) BETWEEN 55 and 64  THEN 1 ELSE 0 END) AS Age55_64,
                sum(CASE WHEN timestampdiff(year,p.BIRTH,curdate()) >= 65 THEN 1 ELSE 0 END) AS Age65Up,
                sum(CASE WHEN timestampdiff(year,p.BIRTH,curdate()) > 0  THEN '1' ELSE '0' END) AS total

                FROM person p
                LEFT JOIN chospital ON p.HOSPCODE = chospital.hoscode
                LEFT JOIN death d on d.HOSPCODE=p.HOSPCODE and d.PID=p.PID
                where d.DDEATH BETWEEN '20151001' AND '20160930'
                AND (left(d.CDEATH_A,3) BETWEEN 'V01' AND 'V99' OR
                                 left(d.CDEATH_B,3) BETWEEN 'V01' AND 'V99' OR
                                 left(d.CDEATH_C,3) BETWEEN 'V01' AND 'V99' OR
                                 left(d.CDEATH_D,3) BETWEEN 'V01' AND 'V99' OR
                                 left(d.ODISEASE,3) BETWEEN 'V01' AND 'V99' OR
                                 left(d.CDEATH,3) BETWEEN 'V01' AND 'V99' )
                AND p.DISCHARGE = '9' 
                group by p.HOSPCODE";
        try {
            $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => [
                'pageSize' => 50
            ],
        ]);
        return $this->render('ideath', ['dataProvider' => $dataProvider,'rep_year'=>$rep_year]);
    }
    
    public function actionVdeath() {
        //$this->permitRole([1, 3]);
        if(isset($_GET['rep_year'])) {
           $rep_year = $_GET['rep_year'];
        }else{
            $rep_year=date('Y');
        }
        $date1 = ($rep_year-1).'1001';
        $date2 = $rep_year.'0930';
        
        $sql = "SELECT p.HOSPCODE,chospital.hosname,
sum(CASE WHEN 
(left(d.CDEATH_A,3) BETWEEN  'V70' AND 'V79' OR
		 left(d.CDEATH_B,3) BETWEEN  'V70' AND 'V79' OR
		 left(d.CDEATH_C,3) BETWEEN 'V70' AND 'V79' OR
		 left(d.CDEATH_D,3) BETWEEN 'V70' AND 'V79' OR
		 left(d.ODISEASE,3) BETWEEN  'V70' AND 'V79' OR
		 left(d.CDEATH,3) BETWEEN  'V70' AND 'V79' )  THEN '1' ELSE '0' END) AS Bus,
sum(CASE WHEN (left(d.CDEATH_A,3) BETWEEN  'V60' AND 'V69' OR
		 left(d.CDEATH_B,3) BETWEEN  'V60' AND 'V69' OR
		 left(d.CDEATH_C,3) BETWEEN 'V60' AND 'V69' OR
		 left(d.CDEATH_D,3) BETWEEN 'V60' AND 'V69' OR
		 left(d.ODISEASE,3) BETWEEN  'V60' AND 'V69' OR
		 left(d.CDEATH,3) BETWEEN  'V60' AND 'V69') THEN '1' ELSE '0' END) AS Truck,
sum(CASE WHEN (left(d.CDEATH_A,3) BETWEEN  'V40' AND 'V49' OR
		 left(d.CDEATH_B,3) BETWEEN  'V40' AND 'V49' OR
		 left(d.CDEATH_C,3) BETWEEN 'V40' AND 'V49' OR
		 left(d.CDEATH_D,3) BETWEEN 'V40' AND 'V49' OR
		 left(d.ODISEASE,3) BETWEEN 'V40' AND 'V49' OR
		 left(d.CDEATH,3) BETWEEN  'V40' AND 'V49') THEN '1' ELSE '0' END) AS Car,
sum(CASE WHEN (left(d.CDEATH_A,3) BETWEEN  'V50' AND 'V59' OR
		 left(d.CDEATH_B,3) BETWEEN  'V50' AND 'V59' OR
		 left(d.CDEATH_C,3) BETWEEN 'V50' AND 'V59' OR
		 left(d.CDEATH_D,3) BETWEEN 'V50' AND 'V59' OR
		 left(d.ODISEASE,3) BETWEEN 'V50' AND 'V59' OR
		 left(d.CDEATH,3) BETWEEN  'V50' AND 'V59')  THEN '1' ELSE '0' END) AS PickUp,
sum(CASE WHEN (left(d.CDEATH_A,3) BETWEEN  'V20' AND 'V29' OR
		 left(d.CDEATH_B,3) BETWEEN  'V20' AND 'V29' OR
		 left(d.CDEATH_C,3) BETWEEN 'V20' AND 'V29' OR
		 left(d.CDEATH_D,3) BETWEEN 'V20' AND 'V29' OR
		 left(d.ODISEASE,3) BETWEEN 'V20' AND 'V29' OR
		 left(d.CDEATH,3) BETWEEN  'V20' AND 'V29') THEN '1' ELSE '0' END) AS Motorcycle,
sum(CASE WHEN 
(left(d.CDEATH_A,3) BETWEEN 'V10' AND 'V19'  OR
		 left(d.CDEATH_B,3) BETWEEN 'V10' AND 'V19' OR
		 left(d.CDEATH_C,3) BETWEEN 'V10' AND 'V19' OR
		 left(d.CDEATH_D,3) BETWEEN 'V10' AND 'V19' OR
		 left(d.ODISEASE,3) BETWEEN 'V10' AND 'V19' OR
		 left(d.CDEATH,3) BETWEEN  'V10' AND 'V19') THEN '1' ELSE '0' END) AS Bicycle,
sum(CASE WHEN (left(d.CDEATH_A,3) BETWEEN 'V84' AND 'V84' OR
		 left(d.CDEATH_B,3) BETWEEN 'V84' AND 'V84' OR
		 left(d.CDEATH_C,3) BETWEEN 'V84' AND 'V84' OR
		 left(d.CDEATH_D,3) BETWEEN 'V84' AND 'V84' OR
		 left(d.ODISEASE,3) BETWEEN 'V84' AND 'V84' OR
		 left(d.CDEATH,3) BETWEEN  'V84' AND 'V84') THEN '1' ELSE '0' END) AS Agri_Vehicle,
sum(CASE WHEN (left(d.CDEATH_A,3) BETWEEN 'V30' AND 'V39' OR
		 left(d.CDEATH_B,3) BETWEEN 'V30' AND 'V39' OR
		 left(d.CDEATH_C,3) BETWEEN 'V30' AND 'V39' OR
		 left(d.CDEATH_D,3) BETWEEN 'V30' AND 'V39' OR
		 left(d.ODISEASE,3) BETWEEN 'V30' AND 'V39' OR
		 left(d.CDEATH,3) BETWEEN  'V30' AND 'V39') THEN '1' ELSE '0' END) AS Tricycle,
sum(CASE WHEN (left(d.CDEATH_A,3) BETWEEN 'V09' AND 'V09' OR
		 left(d.CDEATH_B,3) BETWEEN 'V09' AND 'V09' OR
		 left(d.CDEATH_C,3) BETWEEN 'V09' AND 'V09' OR
		 left(d.CDEATH_D,3) BETWEEN 'V09' AND 'V09' OR
		 left(d.ODISEASE,3) BETWEEN 'V09' AND 'V09' OR
		 left(d.CDEATH,3) BETWEEN 'V09' AND 'V09') THEN '1' ELSE '0' END) AS Fall_Vehicle,
sum(CASE WHEN (left(d.CDEATH_A,3) BETWEEN 'V80' AND 'V89'  OR
		 left(d.CDEATH_B,3) BETWEEN 'V80' AND 'V89'  OR
		 left(d.CDEATH_C,3) BETWEEN 'V80' AND 'V89' OR
		 left(d.CDEATH_D,3) BETWEEN 'V80' AND 'V89'  OR
		 left(d.ODISEASE,3) BETWEEN 'V80' AND 'V89' OR
		 left(d.CDEATH,3) BETWEEN 'V80' AND 'V89' )  THEN '1' ELSE '0' END) AS Other

FROM person p
LEFT JOIN chospital ON p.HOSPCODE = chospital.hoscode
LEFT JOIN death d on d.HOSPCODE=p.HOSPCODE and d.PID=p.PID
where d.DDEATH BETWEEN '$date1' AND '$date2'
AND p.DISCHARGE = '9' 
group by p.HOSPCODE";
        try {
            $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => [
                'pageSize' => 50
            ],
        ]);
        return $this->render('vdeath', ['dataProvider' => $dataProvider,'rep_year'=>$rep_year]);
    }
    
     public function actionVinjury() {
        //$this->permitRole([1, 3]);
        if(isset($_GET['rep_year'])) {
           $rep_year = $_GET['rep_year'];
        }else{
            $rep_year=date('Y');
        }
        $date1 = ($rep_year-1).'1001';
        $date2 = $rep_year.'0930';
        
        $sql = "SELECT p.HOSPCODE,chospital.hosname,
sum(CASE WHEN left(d.DIAGCODE,3) BETWEEN 'V70' AND 'V79'  THEN '1' ELSE '0' END) AS Bus,
sum(CASE WHEN left(d.DIAGCODE,3) BETWEEN 'V60' AND 'V69'  THEN '1' ELSE '0' END) AS Truck,
sum(CASE WHEN left(d.DIAGCODE,3) BETWEEN 'V40' AND 'V49'  THEN '1' ELSE '0' END) AS Car,
sum(CASE WHEN left(d.DIAGCODE,3) BETWEEN 'V50' AND 'V59'  THEN '1' ELSE '0' END) AS PickUp,
sum(CASE WHEN left(d.DIAGCODE,3) BETWEEN 'V20' AND 'V29'  THEN '1' ELSE '0' END) AS Motorcycle,
sum(CASE WHEN left(d.DIAGCODE,3) BETWEEN 'V10' AND 'V19'  THEN '1' ELSE '0' END) AS Bicycle,
sum(CASE WHEN left(d.DIAGCODE,3) BETWEEN 'V84' AND 'V84'  THEN '1' ELSE '0' END) AS Agri_Vehicle,
sum(CASE WHEN left(d.DIAGCODE,3) BETWEEN 'V30' AND 'V39'  THEN '1' ELSE '0' END) AS Tricycle,
sum(CASE WHEN left(d.DIAGCODE,3) BETWEEN 'V09' AND 'V09'  THEN '1' ELSE '0' END) AS Fall_Vehicle,
sum(CASE WHEN left(d.DIAGCODE,3) BETWEEN 'V80' AND 'V89'  THEN '1' ELSE '0' END) AS Other


FROM person p
LEFT JOIN chospital ON p.HOSPCODE = chospital.hoscode
LEFT JOIN service s on s.HOSPCODE=p.HOSPCODE and s.PID=p.PID
LEFT JOIN diagnosis_opd d on d.HOSPCODE=s.HOSPCODE and d.PID=s.PID and d.SEQ=s.SEQ
where s.DATE_SERV BETWEEN '$date1' AND '$date2'
AND p.DISCHARGE = '9' 
group by p.HOSPCODE";
        try {
            $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => [
                'pageSize' => 50
            ],
        ]);
        return $this->render('vinjury', ['dataProvider' => $dataProvider,'rep_year'=>$rep_year]);
    }
    

    public function actionCausedeath() {
          if(isset($_GET['rep_year'])) {
           $rep_year = $_GET['rep_year'];
        }else{
            $rep_year=date('Y');
        }
        $date1 = ($rep_year-1).'1001';
        $date2 = $rep_year.'0930';

        $sql = "SELECT p.HOSPCODE,chospital.hosname,
sum(CASE WHEN (left(d.CDEATH_A,3) BETWEEN 'V01' AND 'V89' OR
		 left(d.CDEATH_B,3) BETWEEN 'V01' AND 'V89' OR
		 left(d.CDEATH_C,3) BETWEEN 'V01' AND 'V89' OR
		 left(d.CDEATH_D,3) BETWEEN 'V01' AND 'V89' OR
		 left(d.ODISEASE,3) BETWEEN 'V01' AND 'V89' OR
		 left(d.CDEATH,3) BETWEEN 'V01' AND 'V89' )  THEN 1 ELSE 0 END) AS d1,
sum(CASE WHEN (left(d.CDEATH_A,3) BETWEEN 'W00' AND 'W19' OR
		 left(d.CDEATH_B,3) BETWEEN 'W00' AND 'W19' OR
		 left(d.CDEATH_C,3) BETWEEN 'W00' AND 'W19' OR
		 left(d.CDEATH_D,3) BETWEEN 'W00' AND 'W19' OR
		 left(d.ODISEASE,3) BETWEEN 'W00' AND 'W19' OR
		 left(d.CDEATH,3) BETWEEN 'W00' AND 'W19' ) THEN 1 ELSE 0 END) AS d2,
sum(CASE WHEN (left(d.CDEATH_A,3) BETWEEN 'W20' AND 'W49' OR
		 left(d.CDEATH_B,3) BETWEEN 'W20' AND 'W49' OR
		 left(d.CDEATH_C,3) BETWEEN 'W20' AND 'W49' OR
		 left(d.CDEATH_D,3) BETWEEN 'W20' AND 'W49' OR
		 left(d.ODISEASE,3) BETWEEN 'W20' AND 'W49' OR
		 left(d.CDEATH,3) BETWEEN 'W20' AND 'W49' ) THEN 1 ELSE 0 END) AS d3,
sum(CASE WHEN (left(d.CDEATH_A,3) BETWEEN 'W50' AND 'W64' OR
		 left(d.CDEATH_B,3) BETWEEN 'W50' AND 'W64' OR
		 left(d.CDEATH_C,3) BETWEEN 'W50' AND 'W64' OR
		 left(d.CDEATH_D,3) BETWEEN 'W50' AND 'W64' OR
		 left(d.ODISEASE,3) BETWEEN 'W50' AND 'W64' OR
		 left(d.CDEATH,3) BETWEEN 'W50' AND 'W64' ) THEN 1 ELSE 0 END) AS d4,
sum(CASE WHEN (left(d.CDEATH_A,3) BETWEEN 'W65' AND 'W74' OR
		 left(d.CDEATH_B,3) BETWEEN 'W65' AND 'W74' OR
		 left(d.CDEATH_C,3) BETWEEN 'W65' AND 'W74' OR
		 left(d.CDEATH_D,3) BETWEEN 'W65' AND 'W74' OR
		 left(d.ODISEASE,3) BETWEEN 'W65' AND 'W74' OR
		 left(d.CDEATH,3) BETWEEN 'W65' AND 'W74' ) THEN 1 ELSE 0 END) AS d5,
sum(CASE WHEN (left(d.CDEATH_A,3) BETWEEN 'W75' AND 'W84' OR
		 left(d.CDEATH_B,3) BETWEEN 'W75' AND 'W84' OR
		 left(d.CDEATH_C,3) BETWEEN 'W75' AND 'W84' OR
		 left(d.CDEATH_D,3) BETWEEN 'W75' AND 'W84' OR
		 left(d.ODISEASE,3) BETWEEN 'W75' AND 'W84' OR
		 left(d.CDEATH,3) BETWEEN 'W75' AND 'W84' ) THEN 1 ELSE 0 END) AS d6,
sum(CASE WHEN (left(d.CDEATH_A,3) BETWEEN 'W85' AND 'W99' OR
		 left(d.CDEATH_B,3) BETWEEN 'W85' AND 'W99' OR
		 left(d.CDEATH_C,3) BETWEEN 'W85' AND 'W99' OR
		 left(d.CDEATH_D,3) BETWEEN 'W85' AND 'W99' OR
		 left(d.ODISEASE,3) BETWEEN 'W85' AND 'W99' OR
		 left(d.CDEATH,3) BETWEEN 'W85' AND 'W99' ) THEN 1 ELSE 0 END) AS d7,
sum(CASE WHEN (left(d.CDEATH_A,3) BETWEEN 'X00' AND 'X09' OR
		 left(d.CDEATH_B,3) BETWEEN 'X00' AND 'X09' OR
		 left(d.CDEATH_C,3) BETWEEN 'X00' AND 'X09' OR
		 left(d.CDEATH_D,3) BETWEEN 'X00' AND 'X09' OR
		 left(d.ODISEASE,3) BETWEEN 'X00' AND 'X09' OR
		 left(d.CDEATH,3) BETWEEN 'X00' AND 'X09' ) THEN 1 ELSE 0 END) AS d8,
sum(CASE WHEN (left(d.CDEATH_A,3) BETWEEN 'X10' AND 'X19' OR
		 left(d.CDEATH_B,3) BETWEEN 'X10' AND 'X19' OR
		 left(d.CDEATH_C,3) BETWEEN 'X10' AND 'X19' OR
		 left(d.CDEATH_D,3) BETWEEN 'X10' AND 'X19' OR
		 left(d.ODISEASE,3) BETWEEN 'X10' AND 'X19' OR
		 left(d.CDEATH,3) BETWEEN 'X10' AND 'X19' ) THEN 1 ELSE 0 END) AS d9,
sum(CASE WHEN (left(d.CDEATH_A,3) BETWEEN 'X20' AND 'X29' OR
		 left(d.CDEATH_B,3) BETWEEN 'X20' AND 'X29' OR
		 left(d.CDEATH_C,3) BETWEEN 'X20' AND 'X29' OR
		 left(d.CDEATH_D,3) BETWEEN 'X20' AND 'X29' OR
		 left(d.ODISEASE,3) BETWEEN 'X20' AND 'X29' OR
		 left(d.CDEATH,3) BETWEEN 'X20' AND 'X29'  ) THEN 1 ELSE 0 END) AS d10,
sum(CASE WHEN (left(d.CDEATH_A,3) BETWEEN 'X30' AND 'X39' OR
		 left(d.CDEATH_B,3) BETWEEN 'X30' AND 'X39' OR
		 left(d.CDEATH_C,3) BETWEEN 'X30' AND 'X39' OR
		 left(d.CDEATH_D,3) BETWEEN 'X30' AND 'X39' OR
		 left(d.ODISEASE,3) BETWEEN 'X30' AND 'X39' OR
		 left(d.CDEATH,3) BETWEEN 'X30' AND 'X39' ) THEN 1 ELSE 0 END) AS d11,
sum(CASE WHEN (left(d.CDEATH_A,3) BETWEEN 'X40' AND 'X49' OR
		 left(d.CDEATH_B,3) BETWEEN 'X40' AND 'X49' OR
		 left(d.CDEATH_C,3) BETWEEN 'X40' AND 'X49' OR
		 left(d.CDEATH_D,3) BETWEEN 'X40' AND 'X49' OR
		 left(d.ODISEASE,3) BETWEEN 'X40' AND 'X49' OR
		 left(d.CDEATH,3) BETWEEN 'X40' AND 'X49' ) THEN 1 ELSE 0 END) AS d12,
sum(CASE WHEN (left(d.CDEATH_A,3) BETWEEN 'X50' AND 'X57' OR
		 left(d.CDEATH_B,3) BETWEEN 'X50' AND 'X57' OR
		 left(d.CDEATH_C,3) BETWEEN 'X50' AND 'X57' OR
		 left(d.CDEATH_D,3) BETWEEN 'X50' AND 'X57' OR
		 left(d.ODISEASE,3) BETWEEN 'X50' AND 'X57' OR
		 left(d.CDEATH,3) BETWEEN 'X50' AND 'X57' ) THEN 1 ELSE 0 END) AS d13,
sum(CASE WHEN (left(d.CDEATH_A,3) BETWEEN 'X58' AND 'X58' OR
		 left(d.CDEATH_B,3) BETWEEN 'X58' AND 'X58' OR
		 left(d.CDEATH_C,3) BETWEEN 'X58' AND 'X58' OR
		 left(d.CDEATH_D,3) BETWEEN 'X58' AND 'X58' OR
		 left(d.ODISEASE,3) BETWEEN 'X58' AND 'X58' OR
		 left(d.CDEATH,3) BETWEEN 'X58' AND 'X58' ) THEN 1 ELSE 0 END) AS d14,
sum(CASE WHEN (left(d.CDEATH_A,3) BETWEEN 'X60' AND 'X84' OR
		 left(d.CDEATH_B,3) BETWEEN 'X60' AND 'X84' OR
		 left(d.CDEATH_C,3) BETWEEN 'X60' AND 'X84' OR
		 left(d.CDEATH_D,3) BETWEEN 'X60' AND 'X84' OR
		 left(d.ODISEASE,3) BETWEEN 'X60' AND 'X84' OR
		 left(d.CDEATH,3) BETWEEN 'X60' AND 'X84' ) THEN 1 ELSE 0 END) AS d15,
sum(CASE WHEN (left(d.CDEATH_A,3) BETWEEN 'X85' AND 'Y09' OR
		 left(d.CDEATH_B,3) BETWEEN 'X85' AND 'Y09' OR
		 left(d.CDEATH_C,3) BETWEEN 'X85' AND 'Y09' OR
		 left(d.CDEATH_D,3) BETWEEN 'X85' AND 'Y09' OR
		 left(d.ODISEASE,3) BETWEEN 'X85' AND 'Y09' OR
		 left(d.CDEATH,3) BETWEEN 'X85' AND 'Y09' ) THEN 1 ELSE 0 END) AS d16,
sum(CASE WHEN (left(d.CDEATH_A,3) BETWEEN 'Y10' AND 'Y33' OR
		 left(d.CDEATH_B,3) BETWEEN 'Y10' AND 'Y33' OR
		 left(d.CDEATH_C,3) BETWEEN 'Y10' AND 'Y33' OR
		 left(d.CDEATH_D,3) BETWEEN 'Y10' AND 'Y33' OR
		 left(d.ODISEASE,3) BETWEEN 'Y10' AND 'Y33' OR
		 left(d.CDEATH,3) BETWEEN 'Y10' AND 'Y33' ) THEN 1 ELSE 0 END) AS d17,
sum(CASE WHEN (left(d.CDEATH_A,3) BETWEEN 'Y35' AND 'Y36' OR
		 left(d.CDEATH_B,3) BETWEEN 'Y35' AND 'Y36' OR
		 left(d.CDEATH_C,3) BETWEEN 'Y35' AND 'Y36' OR
		 left(d.CDEATH_D,3) BETWEEN 'Y35' AND 'Y36' OR
		 left(d.ODISEASE,3) BETWEEN 'Y35' AND 'Y36' OR
		 left(d.CDEATH,3) BETWEEN 'Y35' AND 'Y36' ) THEN 1 ELSE 0 END) AS d18,
sum(CASE WHEN (left(d.CDEATH_A,3) BETWEEN 'Y34' AND 'Y34' OR
		 left(d.CDEATH_B,3) BETWEEN 'Y34' AND 'Y34'  OR
		 left(d.CDEATH_C,3) BETWEEN 'Y34' AND 'Y34'  OR
		 left(d.CDEATH_D,3) BETWEEN 'Y34' AND 'Y34'  OR
		 left(d.ODISEASE,3) BETWEEN 'Y34' AND 'Y34'  OR
		 left(d.CDEATH,3) BETWEEN 'Y34' AND 'Y34' ) THEN 1 ELSE 0 END) AS d19

FROM person p
LEFT JOIN chospital ON p.HOSPCODE = chospital.hoscode
LEFT JOIN death d on d.HOSPCODE=p.HOSPCODE and d.PID=p.PID
where d.DDEATH BETWEEN '$date1' AND '$date2'
AND p.DISCHARGE = '9' 
group by p.HOSPCODE ";
        try {
            $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => [
                'pageSize' => 50
            ],
        ]);
        return $this->render('causedeath', ['dataProvider' => $dataProvider,'rep_year'=>$rep_year]);
    }
    
     public function actionCauseinjury() {
          if(isset($_GET['rep_year'])) {
           $rep_year = $_GET['rep_year'];
        }else{
            $rep_year=date('Y');
        }
        $date1 = ($rep_year-1).'1001';
        $date2 = $rep_year.'0930';

        $sql = " SELECT p.HOSPCODE,chospital.hosname,
sum(CASE WHEN left(d.DIAGCODE,3) BETWEEN 'V01' AND 'V89'  THEN '1' ELSE '0' END) AS d1,
sum(CASE WHEN left(d.DIAGCODE,3) BETWEEN 'W00' AND 'W19'  THEN '1' ELSE '0' END) AS d2,
sum(CASE WHEN left(d.DIAGCODE,3) BETWEEN 'W20' AND 'W49'  THEN '1' ELSE '0' END) AS d3,
sum(CASE WHEN left(d.DIAGCODE,3) BETWEEN 'W50' AND 'W64'  THEN '1' ELSE '0' END) AS d4,
sum(CASE WHEN left(d.DIAGCODE,3) BETWEEN 'W65' AND 'W74'  THEN '1' ELSE '0' END) AS d5,
sum(CASE WHEN left(d.DIAGCODE,3) BETWEEN 'W75' AND 'W84'  THEN '1' ELSE '0' END) AS d6,
sum(CASE WHEN left(d.DIAGCODE,3) BETWEEN 'W85' AND 'W99'  THEN '1' ELSE '0' END) AS d7,
sum(CASE WHEN left(d.DIAGCODE,3) BETWEEN 'X00' AND 'X09'  THEN '1' ELSE '0' END) AS d8,
sum(CASE WHEN left(d.DIAGCODE,3) BETWEEN 'X10' AND 'X19'  THEN '1' ELSE '0' END) AS d9,
sum(CASE WHEN left(d.DIAGCODE,3) BETWEEN 'X20' AND 'X29'  THEN '1' ELSE '0' END) AS d10,
sum(CASE WHEN left(d.DIAGCODE,3) BETWEEN 'X30' AND 'X39'  THEN '1' ELSE '0' END) AS d11,
sum(CASE WHEN left(d.DIAGCODE,3) BETWEEN 'X40' AND 'X49'  THEN '1' ELSE '0' END) AS d12,
sum(CASE WHEN left(d.DIAGCODE,3) BETWEEN 'X50' AND 'X57'  THEN '1' ELSE '0' END) AS d13,
sum(CASE WHEN left(d.DIAGCODE,3) BETWEEN 'X58' AND 'X59'  THEN '1' ELSE '0' END) AS d14,
sum(CASE WHEN left(d.DIAGCODE,3) BETWEEN 'X60' AND 'X84'  THEN '1' ELSE '0' END) AS d15,
sum(CASE WHEN left(d.DIAGCODE,3) BETWEEN 'X85' AND 'Y09'  THEN '1' ELSE '0' END) AS d16,
sum(CASE WHEN left(d.DIAGCODE,3) BETWEEN 'Y10' AND 'Y33'  THEN '1' ELSE '0' END) AS d17,
sum(CASE WHEN left(d.DIAGCODE,3) BETWEEN 'Y35' AND 'Y36'  THEN '1' ELSE '0' END) AS d18,
sum(CASE WHEN left(d.DIAGCODE,3) BETWEEN 'Y34' AND 'Y34'  THEN '1' ELSE '0' END) AS d19

FROM person p
LEFT JOIN chospital ON p.HOSPCODE = chospital.hoscode
LEFT JOIN service s on s.HOSPCODE=p.HOSPCODE and s.PID=p.PID
LEFT JOIN diagnosis_opd d on d.HOSPCODE=s.HOSPCODE and d.PID=s.PID and d.SEQ=s.SEQ
where s.DATE_SERV BETWEEN '$date1' AND '$date2'
AND p.DISCHARGE = '9' 
group by p.HOSPCODE ";
        try {
            $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => [
                'pageSize' => 50
            ],
        ]);
        return $this->render('causeinjury', ['dataProvider' => $dataProvider,'rep_year'=>$rep_year]);
    }

}
