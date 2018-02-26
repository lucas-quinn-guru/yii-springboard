<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\FaqCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="faq-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field( $model, 'name' )->textInput( [ 'maxlength' => 45 ] ) ?>

    <?= $form->field( $model, 'weight' )->textInput() ?>
    
	<?= $form->field( $model, 'is_featured' )-> dropDownList( $model->faqCategoryIsFeaturedList,
		[ 'prompt' => 'Please Choose One' ] ) ?>

    <div class="form-group">
		<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update',
			['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
