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
    
 
    
    public function teste($param)
    {

    	print "testes...";
 
    }
}