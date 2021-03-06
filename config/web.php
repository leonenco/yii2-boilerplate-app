<?php
/**
 * Main application configuration
 */
$config = [
    'id' => 'gazbond/yii2-boilerplate-app',
    'name' => 'Yii2 boilerplate app',
    'language' => 'en',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            'cookieValidationKey' => 'g689Vbq27hHu45J9ccCd4akLuZ7Olm95sg6'
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning', 'info'],
                    'logVars' => [],
                    'categories' => [
                        'yii\db\*',
                        'yii\web\HttpException:*',
                        'app'
                    ],
                ],
            ],
        ],
        'assetManager' => [
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [],
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js'=>[]
                ],
                'yii\web\JqueryAsset' => [
                    'js'=>[]
                ],
                'pendalf89\filemanager\assets\FileInputAsset' => [
                    'depends' => [
                        'app\assets\AppAsset',
                        'pendalf89\filemanager\assets\ModalAsset'
                    ]
                ],
                'pendalf89\filemanager\assets\FilemanagerAsset' => [
                    'depends' => [
                        'app\assets\AppAsset'
                    ]
                ],
                'pendalf89\filemanager\assets\ModalAsset' => [
                    'depends' => [
                        'app\assets\AppAsset'
                    ]

                ]
            ]
        ],
        'settings'=>[
            'class'=>'yii2mod\settings\components\Settings',
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    'sourceLanguage' => 'en',
                    'fileMap' => [
                    ],
                ],
            ],
        ],
        'authManager' => [
            'class' => 'dektrium\rbac\components\DbManager',
        ],
        'urlManager' => [
            'showScriptName' => false,
            'enablePrettyUrl' => true,
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => '/api/user'],
            ],
        ],
        'view' => [
            'theme' => require(__DIR__ . '/theme.php')
        ],
        'db' => require(__DIR__ . '/db.php'),
        'mailer' => require(__DIR__ . '/mail.php'),
        'jwt' => require(__DIR__ . '/jwt.php'),
    ],
    'params' => require(__DIR__ . '/params.php'),
    'modules' => require(__DIR__ . '/modules.php'),
];
if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}
$events = require(__DIR__ . '/events.php');
return $config;
