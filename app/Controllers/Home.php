<?php
namespace Controllers;

use Core\View;
use Core\Controller;

use Helpers\Assets;

class Home extends Controller
{

    public function index()
    {
    	
        View::render('header');
        View::render('home', $data);
        View::render('footer');
    }
    
    public function post($param)
    {
    	 
    	View::render('header');
        View::render('form_post', $data);
        View::render('footer');
    
    }
    
    public function teste($param)
    {
    	
    	View::output($param, 'json');

    }
}