<?php
/*
 * This file is part of the YiiModules.com
 *
 * (c) Yii2 modules open source project are hosted on <http://github.com/yiimodules/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
use common\models\FaqCategory;

?>
	
	<div class="clearfix">&nbsp;</div>

<?= $form->field( $model, 'image')->fileInput() ?>

<?php
if( $model->id != "" )
{
	echo FaqCategory::getImage( $model->id,'medium', [ 'class' => 'thumbnail' ] );
}
?>