<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\helpers\PermissionHelpers;

/* @var $this yii\web\View */
/* @var $model common\models\Profile */

$this->title = $model->user->username . "'s Profile";
$this->params['breadcrumbs'][] = ['label' => 'Profile', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
	
		<?php if( Yii::$app->user->can('updateUserProfile', [ 'profile'=>$model ] ) )
		{ ?>
			<?= Html::a('Update', [ 'update', 'id' => $model->id ], [ 'class' => 'btn btn-primary' ] ) ?>
			<?= Html::a('Delete', [ 'delete', 'id' => $model->id ], [
			'class' => 'btn btn-danger',
			'data' => [
				'confirm' => 'Are you sure you want to delete this item?',
				'method' => 'post',
			],
		]) ?>
			<?php
		} ?>
        <?php
		//if( PermissionHelpers::userMustBeOwner( 'profile', $model->id ) )
		//{ ?>
			<?php //echo  Html::a( 'Update', [ 'update', 'id' => $model->id ], [ 'class' => 'btn btn-primary' ] ) ?>
			<?php
		//} ?>
    
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'user_id',
            'user.username',
            'first_name',
            'last_name',
            'birthdate',
            'gender.gender_name',
            //'created_at',
            //'updated_at',
        ],
    ]) ?>

</div>
