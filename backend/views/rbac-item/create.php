<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\rbac\AuthItemModel */

$labels = $this->context->getLabels();

$this->title = 'Create ' . $labels[ 'Item' ];
$this->params['breadcrumbs'][] = [ 'label' => $labels[ 'Items' ], 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = $this->title;
$this->render('/layouts/_sidebar');
?>
<div class="auth-item-create">
	<h1><?php echo Html::encode($this->title); ?></h1>
	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>
</div>