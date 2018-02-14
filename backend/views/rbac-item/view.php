<?php
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\DetailView;
use backend\assets\RbacAsset;

RbacAsset::register( $this );

/* @var $this yii\web\View */
/* @var $model backend\models\rbac\AuthItemModel */

$labels = $this->context->getLabels();
$this->title = $labels['Item'] . ' : ' . $model->name;
$this->params['breadcrumbs'][] = [ 'label' =>  $labels['Items'], 'url' => ['index'] ];
$this->params['breadcrumbs'][] = $model->name;
$this->render('/layouts/_sidebar');
?>
<div class="auth-item-view">
	<h1><?php echo Html::encode($this->title); ?></h1>
	<p>
		<?php echo Html::a( 'Update', ['update', 'id' => $model->name], [ 'class' => 'btn btn-primary' ] ); ?>
		<?php echo Html::a( 'Delete', ['delete', 'id' => $model->name], [
			'class' => 'btn btn-danger',
			'data-confirm' => 'Are you sure to delete this item?' ,
			'data-method' => 'post',
		]); ?>
		<?= Html::a( 'Create', [ 'create' ], [ 'class' => 'btn btn-success' ] ); ?>
	</p>
	<div class="row">
		<div class="col-sm-12">
			<?php echo DetailView::widget([
				'model' => $model,
				'attributes' => [
					'name',
					'description:ntext',
					'ruleName',
					'data:ntext',
				],
			]); ?>
		</div>
	</div>
	<?php echo $this->render('../_dualListBox', [
		'opts' => Json::htmlEncode([
			'items' => $model->getItems(),
		]),
		'assignUrl' => ['assign', 'id' => $model->name],
		'removeUrl' => ['remove', 'id' => $model->name],
	]); ?>
</div>