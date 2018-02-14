<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\helpers\PermissionHelpers;

use yii\helpers\Json;
use backend\assets\RbacAsset;

RbacAsset::register( $this );

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->username;

$show_this_nav = PermissionHelpers::requireMinimumRole( 'SuperUser' );

$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode( $this->title ) ?></h1>

    <p>
		<?php if( !Yii::$app->user->isGuest && $show_this_nav ) { ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		<?php } ?>
		<?php if( !Yii::$app->user->isGuest && $show_this_nav ) { ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
		<?php } ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
			['attribute'=>'profileLink', 'format'=>'raw'],
            //'username',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            'email:email',
            'roleName',
            'statusName',
            'userTypeName',
            'created_at',
            'updated_at',
			'id',
        ],
    ]) ?>

    <h3>Roles and Permissions</h3>
	<?php echo $this->render('../_dualListBox', [
		'opts' => Json::htmlEncode([
			'items' => $permissionModel->getItems(),
		]),
		'assignUrl' => ['assign', 'id' => $permissionModel->userId],
		'removeUrl' => ['remove', 'id' => $permissionModel->userId],
	]); ?>

</div>
