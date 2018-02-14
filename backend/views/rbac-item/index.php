<?php

use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ArrayDataProvider */
/* @var $searchModel backend\models\rbac\search\AuthItemSearch */

$labels = $this->context->getLabels();

$this->title =  $labels[ 'Items' ];
$this->params['breadcrumbs'][] = $this->title;
$this->render('/layouts/_sidebar');
?>
<div class="item-index">
	<h1><?php echo Html::encode($this->title); ?></h1>
	<p>
		<?php echo Html::a( 'Create ' . $labels[ 'Item' ] , [ 'create' ], [ 'class' => 'btn btn-success' ] ); ?>
	</p>
	<?php Pjax::begin( [ 'timeout' => 5000, 'enablePushState' => false ] ); ?>
	
	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			[ 'class' => 'yii\grid\SerialColumn' ],
			[
				'attribute' => 'name',
				'label' => 'Name',
			],
			[
				'attribute' => 'ruleName',
				'label' => 'Rule Name',
				'filter' => ArrayHelper::map( Yii::$app->getAuthManager()->getRules(), 'name', 'name' ),
				'filterInputOptions' => [ 'class' => 'form-control', 'prompt' => 'Select Rule' ],
			],
			[
				'attribute' => 'description',
				'format' => 'ntext',
				'label' => 'Description',
			],
			[
				'header' => 'Action',
				'class' => 'yii\grid\ActionColumn',
			],
		],
	]); ?>
	
	<?php Pjax::end(); ?>
</div>