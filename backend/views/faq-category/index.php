<?php

use backend\assets\CategoryAsset;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;
use \yii\bootstrap\Collapse;
use \yii\bootstrap\Tabs;
use yii\bootstrap\ButtonGroup;
use yii\bootstrap\Button;
use common\models\FaqCategory;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\FaqCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'FAQ Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faq-category-index">

    <div class="page-header">
        <h1><?= Html::encode( $this->title ) ?></h1>
    </div>
    
    <?php
        /*
        echo Collapse::widget([
		'items' => [
			// equivalent to the above
			[
				'label' => 'Search',
				'content' => $this->render('_search', ['model' => $searchModel]) ,
				// open its content by default
				//'contentOptions' => ['class' => 'in']
			],
		]
	]);
        */
	?>
    <p>
        <?= Html::a('Create Faq Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    /*
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'parent_id',
            'name',
            'slug',
            'description:ntext',
            //'image',
            //'meta_title',
            //'meta_keywords',
            //'meta_description',
            //'position',
            //'is_featured',
            //'is_active',
            //'created_at',
            //'update_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    */ ?>

    <div class="row">
        <div class="col-md-3">

            <div aria-label="Justified button group" role="group" class="btn-group btn-group-justified">
                <a role="button" class="btn btn-default" href="<?php echo Yii::$app->urlManager->createUrl(['/categories']); ?>"><i class="glyphicon glyphicon-plus"></i> Root category</a>
				
				<?php if(Yii::$app->request->getQueryParam('parent_id')!=""): ?>
                    <a role="button" class="btn btn-default disabled" href="javascript:void(0)"><i class="glyphicon glyphicon-plus"></i> Subcategory</a>
				<?php else: ?>
                    <a role="button" class="btn btn-default" href="<?php echo Yii::$app->urlManager->createUrl(['/categories','parent_id'=>Yii::$app->request->getQueryParam('id')]); ?>"><i class="glyphicon glyphicon-plus"></i> Subcategory</a>
				<?php endif; ?>
            </div>

            <div class="clearfix">&nbsp;</div>

            <div id="yimd-categories-jstree">
				<?php
				$current_category = Yii::$app->request->getQueryParam('id');
				?>
				<?php echo FaqCategory::createTreeList($parent_id=NULL, $current_category ); ?>
            </div>

        </div>
        <div class="col-md-9">
			
			<?php echo $this->render('_alert'); ?>

            <div class="categories-form tab-content" style="min-height:400px;">
				
				<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

                <nav class="navbar navbar-default navbar-static">
                    <div class="container-fluid">
                        <div class="navbar-header">
						<span class="navbar-brand">
							<?php if( $parentCategory ): ?>
								<?php echo FaqCategory::printEditPath(Html::getAttributeValue( $parentCategory,'id' ) ); ?> - New Subcategory
							<?php else: ?>
								<?php if($model->id!=""): ?>
									<?php echo FaqCategory::printEditPath(Html::getAttributeValue($model,'id')); ?> - Update category information
								<?php else: ?>
                                    New Root Category
								<?php endif; ?>
							<?php endif; ?>
						</span>
                        </div>
                        <div class="pull-right" style="margin-top:8px">
							<?= Html::submitButton('<i class="glyphicon glyphicon-floppy-disk"></i> Save Category', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        </div>
                    </div>
                </nav>
				
				
				<?php
				$tabItems = [];
				if($model->id!=''){
					$tabItems[] = [
						'label' => 'View',
						'content' => $this->render("_view",['model'=>$model,'form'=>$form]),
						'active' => true,
						'visible'=>($model->id=='') ? false : true
					];
				}
				
				$tabItems[] = [
					'label' => 'General information',
					'content' => $this->render("_form_general",['model'=>$model,'form'=>$form]),
				];
				$tabItems[] = [
					'label' => 'Category image',
					'content' => $this->render("_form_image",['model'=>$model,'form'=>$form]),
				];
				$tabItems[] = [
					'label' => 'Meta information (SEO)',
					'content' => $this->render("_form_seo",['model'=>$model,'form'=>$form]),
				];
				
				if($model->id!=''){
					$tabItems[] = [
						'label' => '<i class="glyphicon glyphicon-trash"></i> Delete',
						'url' => Yii::$app->urlManager->createUrl(['categories/categories/delete','id'=>$model->id]),
						'linkOptions' => ['onClick'=>'return confirm("Are you sure you want to delete this category?");']
					];
				}
				
				
				echo Tabs::widget([
					'items' => $tabItems,
					'encodeLabels'=>false
				]);
				?>
				
				<?php ActiveForm::end(); ?>

            </div>

        </div>
    </div>
    
</div>

<?php
$this->registerJs('
jQuery(document).ready(function(){
	jQuery("#yimd-categories-jstree").jstree();
	jQuery("#yimd-categories-jstree").bind(
		"select_node.jstree", function(evt, data){
			url = data.node.a_attr.href;
			window.location.href = url;
		}
	);
	jQuery("#categories-slug").slugify("#categories-name");
});', \yii\web\View::POS_READY);
?>