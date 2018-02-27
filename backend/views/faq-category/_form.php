<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\FaqCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="faq-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'parent_id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'position')->textInput() ?>
    
	<?= $form->field($model, 'is_featured')
             ->dropDownList( $model->faqCategoryIsFeaturedList,
		        [ 'prompt' => 'Please Choose One' ] ) ?>
    
	<?= $form->field($model, 'is_active')
			 ->dropDownList( $model->faqCategoryIsActiveList,
				 [ 'prompt' => 'Please Choose One' ] ) ?>

    <div class="form-group">
		<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update',
			[ 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary' ] ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
