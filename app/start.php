<?php

define('ROOT_PATH'  		, __DIR__.'/..');
define('VENDOR_PATH'		, __DIR__.'/../vendor');
define('APP_PATH'   		, __DIR__.'/../app');
define('CONTROLLERS_PATH'   , __DIR__.'/../app/Controllers');
define('MODELS_PATH'   		, __DIR__.'/../app/Models');
define('VIEWS_PATH'   		, __DIR__.'/../app/Views');
define('MODULE_PATH'		, __DIR__.'/../app/modules');
define('ASSETS_PATH'		, __DIR__.'/../assets');
define('CSS_PATH'			, __DIR__.'/../assets/css');
define('JS_PATH'			, __DIR__.'/../assets/js');
define('IMG_PATH'			, __DIR__.'/../assets/img');

require VENDOR_PATH.'/autoload.php';

new Core\Config();