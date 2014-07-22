<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
//This line overrides the php.ini file as on some servers, the ini does not seem to take effect
ini_alter('date.timezone', 'UTC');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'theme' => 'classic',
    'name' => 'My Sommelier',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'ext.YiiMailer.YiiMailer',
		'ext.MyFormatter.*',
    ),
    'modules' => array(
        // api module implements a RESTFul API into the sommolier system
        'api' => array(
            'class' => 'application.modules.api.ApiModule',
            // optional configuration:        
            'lastUpdateAttribute' => 'update_dt', // DATETIME field that contains last update time of active record
            'format' => 'json', // only json is supported so far 
            'authModelClass' => 'FrAuthModel', // override this class to change authentication behavior
            'myAuthenticatedModelClass' => 'ApiAccess', // active record that used for login
            'myAuthenticatedModelPasswordField' => 'api_key_secret',
        ),
        // uncomment the following to enable the Gii tool
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'fodder',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
    ),
    // application components
    'components' => array(
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        // phpCurl library
        'curl' => array(
            'class' => 'application.extensions.curl.Curl',
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'rules' => array(
                // custom actions in resource controller
                array('api/<controller>/<action>', 'pattern' => 'api/<controller:\w+>/<action:\w+>/<id:\d+>'),
                // crud for resource controller
                array('api/<controller>/<action>', 'pattern' => 'api/<controller:\w+>/<action:\w+>'),
                // everything else goes to the default controller
                array('api/default/<action>', 'pattern' => 'api/<action:\w+>'),
                // Standard rules for application
                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            ),        
        ),
        // uncomment the following to use a MySQL database
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=sommelier',
            'emulatePrepare' => true,
            'username' => 'jim',
            'password' => 'fodder',
            'charset' => 'utf8',
            'tablePrefix' => 'tbl_',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'info',
					'filter' => array(
						'class' => 'CLogFilter',
						'logVars' => array(),
						'logUser' => FALSE,
						'prefixSession' => TRUE,
						'prefixUser' => TRUE,
					),
					'logFile' => 'application_info.log',
					'maxlogFiles' => 10,
                ),
            ),
        ),
        'cache'=>array(
            'class'=>'system.caching.CFileCache',
		),   
        'mobileDetect' => array(
            'class' => 'ext.MobileDetect.MobileDetect'
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@krethweb.org',
        'defaultImageFile' => 'label_image_00000.jpg',
        'user_roles' => array(
                            'GUEST'=>'Guest',
                            'CELLAR_USER'=>'Cellar User',
                            'CELLAR_ADMIN'=>'Cellar Admin',
                            'SITE_ADMIN'=>'Site Admin',
                        ),
        'user_status' => array(
                            'A'=>'Active',
                            'S'=>'Suspended',
                            'T'=>'Terminated',
                        ),
        'bottle_sizes' => array(
                            '750ml'=>'750ml',
                            '375ml'=>'375ml',
                            '500ml'=>'500ml',
                            'Pony'=>'Pony',
                            'Magnum'=>'Magnum',
                            'Marie-Jean'=>'Marie-Jean',
                            'Double Mag'=>'Double Mag',
                            'Jeroboam'=>'Jeroboam',
                            'Reboboam'=>'Reboboam',
                            'Imperial'=>'Imperial',
                            'Methuselah'=>'Methuselah',
                            'Salmanazar'=>'Salmanazar',
                            'Balthazar'=>'Balthazar',
                            'Nebuchadnezzar'=>'Nebuchadnezzar',
                            'Soverign'=>'Soverign',
                        ),
    ),
);