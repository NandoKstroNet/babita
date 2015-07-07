<?php
namespace Controllers;

use Core\Controller;
use Core\View;

class Home extends Controller
{

    public function index()
    {

    	$data = array('data 1', 'data 2');
    	
        View::render('header');
        View::render('home', $data);
        View::render('footer');
    }

    
    public function teste($param)
    {

    	View::output($param, 'json');

    }
}