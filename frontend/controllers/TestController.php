<?php

namespace frontend\controllers;
use Yii;
use yii\data\ArrayDataProvider;
class TestController extends \yii\web\Controller
{
    public function actionIndex()
    {
         $connection = Yii::$app->db2;
            $data = $connection->CreateCommand('select * from test')->queryAll();
        $dataProvider = new ArrayDataProvider([
            'allModels' => $data,
        ]);

        return $this->render('index');
    }

}
