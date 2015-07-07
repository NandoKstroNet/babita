<?php
namespace Core;

use Helpers\Session;

class Config
{
    public function __construct()
    {
        //Ativa o buffer de saída
        ob_start();
        

        //Definir controller padrão e método para chamadas legados
        define('DEFAULT_CONTROLLER', 'Welcome');
        define('DEFAULT_METHOD', 'index');

        //Denifir template padrão
        define('TEMPLATE', 'default');

        define('DB_TYPE', 'mysql');
        define('DB_HOST', 'localhost');
        define('DB_NAME', 'sgama');
        define('DB_USER', 'root');
        define('DB_PASS', '123456');
        define('DB_PORT', '3306');
        define('PREFIX', 'bab_');
        define('DIR', 'http://localhost/babita');

        //Define prefixo de sessão
        define('SESSION_PREFIX', 'bab');
        
        //Define coluna datetime de inserção e atualização no banco de dados
        define('DATETIME_INSERT', 'datetime_insert');
        define('DATETIME_UPDATE', 'datetime_update');
        
        //Define chave de encriptação de dados
        define('CHAVE_ENCRYPT', '20fe687d58d6295cd94ba4f4ffe4bab4');

        //Define título do site / projeto
        define('SITETITLE', 'Babita Framework V1');

        //Email do administrador para notificação de erros no sistema
        define('SITEEMAIL', 'fabio@fabioassuncao.com.br');

        //Ativa a manipulação de erro personalizada
        set_exception_handler('Core\Logger::ExceptionHandler');
        set_error_handler('Core\Logger::ErrorHandler');

        //Define timezone
        date_default_timezone_set('America/Sao_Paulo');

        //Inicia sessões
        Session::init();
        
        //Habilita os erros em ambiente local
        ini_set('display_errors', 1);
        ini_set('log_errors', 1);
        error_reporting(E_ALL);
    }
}
