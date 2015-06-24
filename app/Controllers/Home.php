<?php
namespace Controllers;

use Core\Controller;

class Home extends Controller
{

    public function index()
    {

    	$data = array('data 1', 'data 2');
    	
        $this->view->render('header');
        $this->view->render('home', $data);
        $this->view->render('footer');
    }

    
    public function teste($param)
    {

    	$this->view->output($param, 'json');

    }
}