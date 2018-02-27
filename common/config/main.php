<?php
return [
	'language'=>'en', // english
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
	'modules' => [
		'redactor' => [
			'class' => 'yii\redactor\RedactorModule',
		],
		'rbac' => [
			'class' => 'yii2mod\rbac\Module',
		],
		'gridview' =>  [
			'class' => '\kartik\grid\Module'
			// enter optional module parameters below - only if you need to
			// use your own export download action or custom translation
			// message source
			// 'downloadAction' => 'gridview/export/download',
			// 'i18n' => []
		],
		'social' => [
			// the module class
			'class' => 'kartik\social\Module',
			
			// the global settings for the disqus widget
			'disqus' => [
				'settings' => ['shortname' => 'DISQUS_SHORTNAME'] // default settings
			],
			
			// the global settings for the facebook plugins widget
			'facebook' => [
				'appId' => '1339131572857692',
				'secret' => '1ca598a7c8a3aa829370934875285406',
			],
			
			// the global settings for the google plugins widget
			'google' => [
				'clientId' => 'GOOGLE_API_CLIENT_ID',
				'pageId' => 'GOOGLE_PLUS_PAGE_ID',
				'profileId' => 'GOOGLE_PLUS_PROFILE_ID',
			],
			
			// the global settings for the google analytic plugin widget
			'googleAnalytics' => [
				'id' => 'TRACKING_ID',
				'domain' => 'TRACKING_DOMAIN',
			],
			
			// the global settings for the twitter plugin widget
			'twitter' => [
				'screenName' => 'TWITTER_SCREEN_NAME'
			],
		],
	],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
		'authManager' => [
			'class' => 'yii\rbac\DbManager',
			'defaultRoles' => ['guest', 'user'],
		],
    ],
];
