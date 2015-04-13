<?php

namespace app\modules\admin\controllers;

class LoginController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->renderPartial('index');
    }

}
