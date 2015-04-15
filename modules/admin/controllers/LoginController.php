<?php

namespace app\modules\admin\controllers;

use Yii;
use app\core\back\BaseBackController;
use app\models\LoginForm;

class LoginController extends BaseBackController
{

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'backColor' => 0xFFFFFF,

                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'testLimit'=>999,
                'maxLength'=>3,       // 最多生成几个字符
                'minLength'=>3,       // 最少生成几个字符
            ],
        ];
    }
    public function actionIndex()
    {
//        Yii::$container->set('yii\captcha\CaptchaValidator', [
//            'captchaAction' => 'admin/login/captcha'
//        ]);

        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(\Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('index', [
                'model' => $model,
            ]);
        }
    }


}
