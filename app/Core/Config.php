<?php
namespace Core;

use Helpers\Session;

class Config
{
    public function __construct()
    {
        //turn on output buffering
        ob_start();

        //set default controller and method for legacy calls
        define('DEFAULT_CONTROLLER', 'welcome');
        define('DEFAULT_METHOD', 'index');

        //set the default template
        define('TEMPLATE', 'default');

        //database details ONLY NEEDED IF USING A DATABASE
        if( in_array( $_SERVER['REMOTE_ADDR'], array( '127.0.0.1', '::1' )) ){
        	
	        define('DB_TYPE', 'mysql');
	        define('DB_HOST', 'localhost');
	        define('DB_NAME', 'sgama');
	        define('DB_USER', 'root');
	        define('DB_PASS', '123456');
	        define('PREFIX', 'bab_');
	        
	        //site address
	        define('DIR', 'http://localhost/babita');
        
        }else{
        
	        define('DB_TYPE', 'mysql');
	        define('DB_HOST', 'localhost');
	        define('DB_NAME', 'sgama');
	        define('DB_USER', 'root');
	        define('DB_PASS', '123456');
	        define('PREFIX', 'bab_');
	        
	        //site address
	        define('DIR', 'http://localhost/babita');
        
        }

        //set prefix for sessions
        define('SESSION_PREFIX', 'bab');
        
        define('DATETIME_INSERT', 'datetime_insert');
        define('DATETIME_UPDATE', 'datetime_update');
        define('CHAVE_ENCRYPT', '20fe687d58d6295cd94ba4f4ffe4bab4');

        //optionall create a constant for the name of the site
        define('SITETITLE', 'Babita Framework V1');

        //optionall set a site email address
        define('SITEEMAIL', 'fabio@fabioassuncao.com.br');

        //turn on custom error handling
        set_exception_handler('Core\Logger::ExceptionHandler');
        set_error_handler('Core\Logger::ErrorHandler');

        //set timezone
        date_default_timezone_set('America/Sao_Paulo');

        //start sessions
        Session::init();
    }
}
