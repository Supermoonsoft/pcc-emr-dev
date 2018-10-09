<?php

$dev_theme = require __DIR__ . '/dev-theme.php';
$modules = require './../modules/add_modules.php';

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'pcc',
    'language' => 'th_TH',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'modules' => $modules,
    'components' => [
        'view' => $dev_theme,
        'session' => [
            'timeout' => 60 * 60 * 24, // 24 hrs
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'paCbdkWxIi3_odWw-p_WkZmEdDyXBK7j',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            //'identityClass' => 'app\models\User',// old
            'identityClass' => 'dektrium\user\models\User',
            'enableAutoLogin' => true,
        ],
        'authManager' => [
            'class' => 'dektrium\rbac\components\DbManager',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'thaiFormatter' => [
            'class' => 'dixonsatit\thaiYearFormatter\ThaiYearFormatter',
        ],
    /*
      'urlManager' => [
      'enablePrettyUrl' => true,
      'showScriptName' => false,
      'rules' => [
      ],
      ],
     */
    ],
//    'as access' => [
//        'class' => 'mdm\admin\components\AccessControl',
//        'allowActions' => [
//            //'*',
//            'site/*',
//            // 'user/*',
//             'users/security/login',
//             //'admin/*',
//             //'rbac/*',            
//             'gii/*',
//             'grid/*',
//             'doctorworkbench/*',
//             'queuemanage/*',
//             'emr/*',
//             'lab/*',
//             'queuemanage/*',
//             'emr/*',
//             'appointment/*',
//             'drug/*',
//             'printout/*',
//             'questionare/*',
//             'report/*',
//             'stock/*',
//             'treatment/*',
//             'cc/*',
//             'chiefcomplaint/*',
//             'patientexit/*',
//             'setsession',
//            // 'gridview/export/download'
//        ]
//    ], // inam
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
            // uncomment the following to add your IP if you are not connecting from localhost.
            //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
            // uncomment the following to add your IP if you are not connecting from localhost.
            //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
