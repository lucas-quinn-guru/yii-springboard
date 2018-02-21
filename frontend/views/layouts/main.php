<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use frontend\assets\FontAwesomeAsset;

AppAsset::register( $this );
FontAwesomeAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name . ' <i class="fa fa-plug"></i>',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'About', 'url' => ['/site/about']],
        ['label' => 'Contact', 'url' => ['/site/contact']],
    ];
    if (Yii::$app->user->isGuest)
    {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else
	{
		$menuItems[] = [
		        'label' => 'My Account (' . Yii::$app->user->identity->username . ')',
                'items' => [
                    [ 'label' => 'Dashboard', 'url' => [ '/account/index' ] ],
				    [ 'label' => 'Profile', 'url' => [ '/profile/view' ] ],
					[ 'label' => 'Backend',
						'url' => 'http://mbarrusbackend.marcellusrocks.com',
						'linkOptions' => [ 'target' => '_blank' ]
					],
                    [ 'label'=>'Log Out', 'url' => [ '/site/logout' ], 'linkOptions' => [ 'data-method' => 'post' ] ]
                ]
        ];
		//$menuItems[] = ;
        //$menuItems[] = '<li>'
        //    . Html::beginForm(['/site/logout'], 'post')
         //   . Html::submitButton(
         //       'Logout',
         //       ['class' => 'btn btn-link logout']
         //   )
         //   . Html::endForm()
         //   . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> 2015-<?= date('Y') ?>. All Rights Reserved.</p>

        <p class="pull-right"></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
