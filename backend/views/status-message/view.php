<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\StatusMessage */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Status Messages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="status-message-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'controller',
            'action',
            'name',
            'subject',
            'body',
            'description',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
