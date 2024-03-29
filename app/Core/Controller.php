<?php
namespace Core;

use Core\View;

/*
 * controller - base controller
 *
*/

abstract class Controller
{
    /**
     * view variable to use the view class
     * @var string
     */
    public $view;

    /**
     * on run make an instance of the config class and view class
     */
    public function __construct()
    {
        //initialise the views object
        $this->view = new View();

    }
}
