<?php

use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this \yii\web\View */
/* @var $gridViewColumns array */
/* @var $dataProvider \yii\data\ArrayDataProvider */
/* @var $searchModel backend\models\rbac\search\AssignmentSearch */

$this->title = 'Assignments';
$this->params['breadcrumbs'][] = $this->title;
$this->render('/layouts/_sidebar');
?>
<div class="assignment-index">
	
	<h1><?php echo Html::encode($this->title); ?></h1>
	
	<?php Pjax::begin(['timeout' => 5000]); ?>
	
	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => ArrayHelper::merge($gridViewColumns, [
			[
				'class' => 'yii\grid\ActionColumn',
				'template' => '{view}',
			],
		]),
	]); ?>
	
	<?php Pjax::end(); ?>
</div>