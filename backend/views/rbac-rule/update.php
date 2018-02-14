<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\rbac\BizRuleModel */

$this->title = 'Update Rule : ' . $model->name;
$this->params['breadcrumbs'][] = [ 'label' => 'Rules', 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = [ 'label' => $model->name, 'url' => [ 'view', 'id' => $model->name ] ];
$this->params['breadcrumbs'][] =  'Update';
$this->render('/layouts/_sidebar' );
?>
<div class="rule-item-update">
	
	<h1><?php echo Html::encode($this->title); ?></h1>
	
	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>
</div>