<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\FaqCategory */

$this->title = $model->name;
$this->params[ 'breadcrumbs' ][] = [ 'label' => 'FAQ Categories', 'url' => [ 'index' ] ];
$this->params[ 'breadcrumbs' ][] = $this->title;
?>
<div class="faq-category-view">

    <h1>FAQ Category: <?= Html::encode($this->title) ?></h1>

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
			'name',
			'weight',
			[
                'attribute' => 'is_featured',
                'format' => 'boolean'
            ],
        ],
    ]) ?>

</div>
