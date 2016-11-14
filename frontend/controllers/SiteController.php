<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        //---- death --------
         $sql = "SELECT p.HOSPCODE,chospital.hosname,COUNT(p.cid) AS tcount
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
                AND p.DISCHARGE = '9'  AND hostype IN('06','07')
                group by p.HOSPCODE ORDER BY d.hospcode";
        $connection = Yii::$app->db2;
        $data = $connection->createCommand($sql)
                ->queryAll();

        for ($i = 0; $i < sizeof($data); $i++) {
            $hosname[] = $data[$i]['hosname'];
            $tcount[] = $data[$i]['tcount'] * 1;
            //$m2[] = $data[$i]['m2'] * 1;
        }
        
        // -------- accident -----
        $sqla = "SELECT a.HOSPCODE ,c.hosname,COUNT(a.seq) AS tcount
                FROM accident a
                LEFT JOIN chospital c ON a.HOSPCODE = c.hoscode
                LEFT JOIN person p on a.HOSPCODE=p.HOSPCODE and a.PID=p.PID
                WHERE datetime_serv BETWEEN '20151001' AND '20160930' AND hostype IN('06','07')
                      AND p.DISCHARGE = '9' 
                GROUP BY hoscode  ORDER BY a.hospcode";
        $connection = Yii::$app->db2;
        $dataa = $connection->createCommand($sqla)
                ->queryAll();

        for ($i = 0; $i < sizeof($dataa); $i++) {
            $hosnamea[] = $dataa[$i]['hosname'];
            $tcounta[] = $dataa[$i]['tcount'] * 1;
            //$m2[] = $data[$i]['m2'] * 1;
        }
        return $this->render('index',['hosname'=>$hosname,'tcount'=>$tcount,'hosnamea'=>$hosnamea,'tcounta'=>$tcounta]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
