<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>


    <script language="javascript" type="text/javascript">
        function Forget(){
            ShowDailog("忘记密码", 300, 200, "forget.html",'true','AntTermsBg.gif','AntTuanclose.gif','AntTermsTips.gif','d1e6fc','F6F9FF','74b1fc','74b1fc');
        }

        $(document).ready(function() {
            if ($.cookie("rmbUser") == "true") {
                $("#rmbUser").attr("checked", true);
                $("#user").val($.cookie("userName"));
                $("#pass").val($.cookie("passWord"));
            }
        });

        function saveUserInfo() {
            if($("#rmbUser").attr("checked") == true) {
                var userName = $("#user").val();
                var passWord = $("#pass").val();
                //alert(userName);
                $.cookie("rmbUser", "true", { expires: 30});
                $.cookie("userName", userName, { expires: 30});
                $.cookie("passWord", passWord, { expires: 30});
            }
            else {
                $.cookie("rmbUser", "false", { expires: -1});
                $.cookie("userName", '', { expires: -1});
                $.cookie("passWord", '', { expires: -1});
            }
        }
    </script>

<div class="login">
    <h1><?= Html::encode($this->title) ?></h1>



    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'verifyCode')->widget(\yii\captcha\Captcha::className(), [
        'captchaAction' => '/site/captcha',
        'template' => '<div class="row"><div class="col-lg-6">{input}</div><div class="col-lg-3">{image}</div></div>',
    ]) ?>
    <div class="checkbox"></div>
    <?= $form->field($model, 'rememberMe', [
        'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
    ])->checkbox() ?>
</div>
    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('登陆', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>


</div>
<?php $this->endBody() ?>
</body>
<!--[if lt IE 8]>
<script language="javascript">
    window.onload=function(){
        if (location.href.indexOf("?R=")<0)
        {
            location.href=location.href+"?R="+Math.random();
        }
    }
</script>
<![endif]-->
</html>
<?php $this->endPage() ?>
