<?php

namespace app\modules\admin\controllers;

use Yii;
use app\core\back\BaseBackController;
use app\models\LoginForm;

class LoginController extends BaseBackController
{
    public function actionIndex()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(\Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->renderPartial('index', [
                'model' => $model,
            ]);
        }
    }


}
