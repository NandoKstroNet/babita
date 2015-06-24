<?php

require_once "app/start.php";

use \Core\Router;
use \Core\View;

//Invoca controller Home e executa o método index
Router::any('/', 'Controllers\\Home@index');

//Invoca controller Home e executa o método teste
Router::get('/home/(:all)', function($data) {
	Router::invokeObject("Controllers\\Home@{$data}");
});



//Verbo HTTP para requisições GET
Router::get('/get', function() {
	print 'GET <3';
});

//Verbo HTTP para requisições POST
Router::post('/post', function() {
	print 'POST! <3';
	
	View::output($_POST, 'text');
	
	
});

//Verbo HTTP para requisições PUT
Router::put('/put', function() {
	print 'PUT <3';
});

//Verbo HTTP para requisições DELETE
Router::delete('/delete', function() {
	print 'DELETE <3';
});


//Callback error
Router::error(function() {
 	print '404 :: Not Found';
});

Router::run();