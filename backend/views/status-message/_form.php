<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\StatusMessage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="status-message-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'controller')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'action')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'body')-> textArea(['maxlength' => 2025, 'rows' =>12]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
