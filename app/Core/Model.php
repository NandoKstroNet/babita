<?php
namespace Core;

use Core\DataBase;

/*
 * model - the base model
 *
 * @version 2.2
 * @date June 27, 2014
 * @date updated May 18 2015
 */

abstract class Model
{
    /**
     * hold the database connection
     * @var object
     */
    public $db;

    /**
     * create a new instance of the database helper
     */
    public function __construct()
    {
        //connect to PDO here.
        $this->db = DataBase::get();

    }
}
