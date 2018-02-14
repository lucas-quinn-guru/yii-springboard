<?php
/* @var $this \yii\web\View */
$this->params['sidebar'] = [
	[
		'label' => 'Assignments',
		'url' => ['assignment/index'],
	],
	[
		'label' => 'Roles',
		'url' => ['role/index'],
	],
	[
		'label' => 'Permissions',
		'url' => ['permission/index'],
	],
	[
		'label' => 'Routes',
		'url' => ['route/index'],
	],
	[
		'label' => 'Rules',
		'url' => ['rule/index'],
	],
];