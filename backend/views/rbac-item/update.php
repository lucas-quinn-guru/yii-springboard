<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\rbac\AuthItemModel */

$context = $this->context;
$labels = $this->context->getLabels();

$this->title = 'Update ' . $labels['Item'] . ' : ' . $model->name;
$this->params['breadcrumbs'][] = [ 'label' =>  $labels[ 'Items' ], 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = [ 'label' => $model->name, 'url' => ['view', 'id' => $model->name ] ];
$this->params['breadcrumbs'][] = 'Update';
$this->render('/layouts/_sidebar');
?>
<div class="auth-item-update">
	<h1><?= Html::encode( $this->title ); ?></h1>
	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>
</div>