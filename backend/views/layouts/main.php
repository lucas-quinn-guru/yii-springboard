<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use backend\assets\FontAwesomeAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use common\helpers\PermissionHelpers;

AppAsset::register( $this );
FontAwesomeAsset::register( $this );
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode( $this->title ) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php

    $is_admin = false;

    if (!Yii::$app->user->isGuest) {
	    $is_admin = PermissionHelpers::requireRole( "Admin" );


	    NavBar::begin( [
		    'brandLabel' => Yii::$app->name . " <i class=\"fa fa-plug\"></i> Admin ",
		    'brandUrl' => Yii::$app->homeUrl,
		    'options' => [
			    'class' => 'navbar-inverse navbar-fixed-top',
		    ],
	    ] );
    } else
    {
	    NavBar::begin( [
		    'brandLabel' => Yii::$app->name . " <i class=\"fa fa-plug\"></i>",
		    'brandUrl' => Yii::$app->homeUrl,
		    'options' => [
			    'class' => 'navbar-inverse navbar-fixed-top',
		    ],
	    ] );

	    $menuItems = [
		    ['label' => 'Home', 'url' => ['/site/index']],
	    ];
    }

    if( !Yii::$app->user->isGuest && $is_admin )
    {
    	$menuItems[] = [
			'label' => 'Users',
			'items' => [
				[ 'label' => 'Users', 'url' => [ 'user/index' ] ],
				[ 'label' => 'Profiles', 'url' => [ 'profile/index' ] ],
                [ 'label' => "Role and Permission Assignments", 'url'=>[ 'assignment/index' ] ],
            ]
        ];
		$menuItems[] = [
			'label' => 'RBAC',
			'items' => [
				[ 'label' => 'Roles', 'url' => [ 'role/index' ] ],
                [ 'label' => 'Permissions', 'url' => [ 'permission/index' ] ],
				[ 'label' => 'User Types', 'url' => [ 'user-type/index' ] ],
				[ 'label' => 'Statuses', 'url' => [ 'status/index' ] ]
    
			]
		];
		$menuItems[] = [
            'label' => 'Support',
            'items' => [
				[ 'label' => 'Support Requests', 'url' => [ '/content/index' ] ],
				[ 'label' => 'Status Messages', 'url' => [ '/status-message/index' ] ],
				[ 'label' => 'FAQ', 'url' => [ '/faq/index' ] ],
				[ 'label' => 'FAQ Category', 'url' => [ '/faq-category/index' ] ],
			],
        ];

    	$menuItems[] = [
            'label' => "Content",
            'items' => [
				[ 'label' => 'Content', 'url' => [ 'content/index' ] ],
	            [ 'label' => 'Status Messages', 'url' => [ '/status-message/index' ] ],
	            [ 'label' => 'FAQ', 'url' => [ '/faq/index' ] ],
	            [ 'label' => 'FAQ Category', 'url' => [ '/faq-category/index' ] ],
            ]
        ];
    }


    if( Yii::$app->user->isGuest )
    {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else
    {
	    $menuItems[] = [
			'label' => 'My Account (' . Yii::$app->user->identity->username . ')',
			'items' => [
				[ 'label'=>'Frontend', 'url'=>"http://mbarrus.marcellusrocks.com" ],
                [
					'label' => 'Logout',
					'url' => ['/site/logout'],
					'linkOptions' => ['data-method' => 'post']
				]
			]
	    ];
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
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
