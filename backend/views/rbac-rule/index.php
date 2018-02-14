<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ArrayDataProvider */
/* @var $searchModel backend\models\rbac\search\BizRuleSearch */
$this->title = 'Rules';
$this->params['breadcrumbs'][] = $this->title;
$this->render('/layouts/_sidebar');
?>
<div class="role-index">
	
	<h1><?php echo Html::encode($this->title); ?></h1>
	
	<p>
		<?= Html::a('Create Rule', ['create'], ['class' => 'btn btn-success']); ?>
	</p>
	
	<?php Pjax::begin(['timeout' => 5000]); ?>
	
	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			[
				'attribute' => 'name',
				'label' =>  'Name',
			],
			[
				'header' => 'Action',
				'class' => 'yii\grid\ActionColumn',
			],
		],
	]);
	?>
	
	<?php Pjax::end(); ?>
</div>