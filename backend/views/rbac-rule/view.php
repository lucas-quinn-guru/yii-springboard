<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\rbac\BizRuleModel */

$this->title = 'Rule : ' . $model->name;
$this->params[ 'breadcrumbs'][] = [ 'label' => 'Rules', 'url' => [ 'index' ] ];
$this->params[ 'breadcrumbs'][] = $model->name;
$this->render('/layouts/_sidebar');
?>
<div class="rule-item-view">
	
	<h1><?= Html::encode( $this->title ); ?></h1>
	
	<p>
		<?= Html::a('Update', [ 'update', 'id' => $model->name ], ['class' => 'btn btn-primary'] ); ?>
		<?= Html::a('Delete', [ 'delete', 'id' => $model->name ], [
			'class' => 'btn btn-danger',
			'data-confirm' => 'Are you sure to delete this item?',
			'data-method' => 'post',
		]); ?>
	</p>
	
	<?= DetailView::widget([
		'model' => $model,
		'attributes' => [
			'name',
			'className',
		],
	]); ?>

</div>