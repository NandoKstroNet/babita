<?php
namespace Controllers;

use Core\Controller;
use Core\View;
use Core\DataBase;
use Helpers\Data;
use Helpers\Encrypt;

class Testes
{

	public $db;
	
	public function __construct()
	{
		$this->db = DataBase::get();
	}
	
    public function index()
    {
    	$data = array('data 1', 'data 2');
    	
        View::render('header');
        View::render('home', $data);
        View::render('footer');
    }

    public function info()
    {
    	phpinfo();
    }
    
 
    
	public function mail(){
		
// 		$group['isSMTP'] = true;
// 		$group['smtpAuth'] = true;
// 		$group['isHTML'] = false;
// 		$group['smtpSecure'] = 'tls';
// 		$group['host'] = 'smtp.gmail.com';
// 		$group['port'] = 587;
// 		$group['user'] = 'fabio23gt@gmail.com';
// 		$group['pass'] = 'secret';
		
		$assunto = "BF1 - Teste inscrição";
		$mensagem = "Mensagem teste Babita Framework 1 (ÁÂÀÄÇ$!@&%)";
		$from = array('mail' => 'iema@ma.ip.tv', 'name' => 'Babita Framework 1');
		$destino = array(
			"aangelomarinho@gmail.com, Adriano Marinho",
			"fabio23gt@gmail.com, Fábio Assunção"
		);
		
		$mail = new \Helpers\PhpMailer\Mail();
		$mail->go($assunto, $mensagem, $from, $destino);
		
	}
}