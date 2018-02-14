<?php
use yii\helpers\Html;
use yii\helpers\Json;
use backend\assets\RbacRouteAsset;

RbacRouteAsset::register($this);

/* @var $this yii\web\View */
/* @var $routes array */

$this->title =  'Routes';
$this->params['breadcrumbs'][] = $this->title;
$this->render('/layouts/_sidebar');
?>
	<h1><?= Html::encode($this->title); ?></h1>
<?= Html::a( 'Refresh', ['refresh'], [
	'class' => 'btn btn-primary',
	'id' => 'btn-refresh',
]); ?>
<?= $this->render('../_dualListBox', [
	'opts' => Json::htmlEncode([
		'items' => $routes,
	]),
	'assignUrl' => ['assign'],
	'removeUrl' => ['remove'],
]); ?>