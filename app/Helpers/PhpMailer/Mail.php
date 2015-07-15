<?php
namespace Helpers\PhpMailer;

/*
 * Mail Helper
 * @version 1.0
 * @date May 18 2015
 * 
 * Base: https://github.com/Synchro/PHPMailer
 */


class Mail extends PhpMailer
{

	public function __construct($group = false)
	{
		parent::__construct();
		
		$isSMTP 		= (!isset($group['isSMTP'])) 		? MAIL_IS_SMTP 		: $group['isSMTP'];
		$smtpAuth 		= (!isset($group['smtpAuth'])) 		? MAIL_SMTP_AUTH 	: $group['smtpAuth'];
		$isHTML			= (!isset($group['isHTML']))		? MAIL_IS_HTML		: $group['isHTML'];
		$charset		= (!isset($group['charset']))		? MAIL_CHARSET		: $group['charset'];
		$smtpSecure 	= (!isset($group['smtpSecure'])) 	? MAIL_SMTP_SECURE 	: $group['smtpSecure'];
		$host 			= (!isset($group['host'])) 			? MAIL_HOST 		: $group['host'];
		$port 			= (!isset($group['port'])) 			? MAIL_PORT 		: $group['port'];
		$user 			= (!isset($group['user'])) 			? MAIL_USER 		: $group['user'];
		$pass 			= (!isset($group['pass'])) 			? MAIL_PASS 		: $group['pass'];
		
		$this->isSMTP();                    	  			  // Set mailer to use SMTP
		$this->Host = $host;  								  // Specify main and backup SMTP servers
		$this->SMTPAuth = $smtpAuth;                          // Enable SMTP authentication
		$this->Username = $user;                 			  // SMTP username
		$this->Password = $pass;                              // SMTP password
		$this->SMTPSecure = $smtpSecure;                      // Enable TLS encryption, `ssl` also accepted
		$this->Port = $port;								  // TCP port to connect to
		$this->isHTML($isHTML);                               // Set email format to HTML
		$this->CharSet = $charset;
		
	}
	
    public function go($subject, $message, $from, $destination){
        
        $this->From = $from['mail'];
        $this->FromName = $from['name']; //nome remetente
        $this->Subject = $subject; //assunto
        $this->Body = $message; //mensagem
        
        foreach($destination as $dest){
        	
        	$d = explode(',', $dest);
        	$mail = $d[0];
        	$name = $d[1];
        	
        	$this->AddAddress($mail, $name);
        }
    
        return ($this->Send()) ? true : $this->ErrorInfo;
    }
}

