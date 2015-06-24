<?php

namespace Core;

/**
 * @method static Router get(string $route, Callable $callback)
 * @method static Router post(string $route, Callable $callback)
 * @method static Router put(string $route, Callable $callback)
 * @method static Router delete(string $route, Callable $callback)
 * @method static Router options(string $route, Callable $callback)
 * @method static Router head(string $route, Callable $callback)
 */
class Router {

    //Alfabeto params rotas
    public static $letters = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');

    // Fallback for auto dispatching feature.
    public static $fallback = false;

    // If true - do not process other routes when match is found
    public static $halts = true;

    // Set routes, methods and etc.
    public static $routes = array();
    public static $methods = array();
    public static $callbacks = array();
    public static $error_callback;

    // Set route patterns
    public static $patterns = array(
        ':any' => '[^/]+',
        ':num' => '[0-9]+',
        ':all' => '.*'
    );

    /**
     * Defines a route w/ callback and method
     *
     * @param   string $method
     * @param   array @params
     */
    public static function __callstatic($method, $params){

        $uri = dirname($_SERVER['PHP_SELF']).'/'.$params[0];
        $callback = $params[1];

        array_push(self::$routes, $uri);
        array_push(self::$methods, strtoupper($method));
        array_push(self::$callbacks, $callback);
    }

    public static function getUrl(){
         return "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
     }
     

    /**
     * Deprecated
     * 
     * @param  string com a area especifica de uma parte url
     * @return function callback
     * Ex.: 
     *      Router::position() -> Return array;
     *      Router::position(int) -> Return array ints;
     *      Router::position(1) -> Return sring position route;
     *      Router::position(a) -> Return sring position route;
     *      Router::position(a, 'app') -> Return boolen;
     *      Router::position(a, 'app', fn callback) -> Return sring position route;
     */

    public static function position(){
        $args = func_get_args();

        if(isset($args[0])){
            $args[0] = is_string($args[0]) ? strtoupper($args[0]) : $args[0];
        }

        $path_info = explode('/', ltrim( $_SERVER['QUERY_STRING'], '/' ));
        $route = array();

        for ($i = 0; $i < count($path_info); $i++){
            $route[$i] = $path_info[$i];
        }

       //Exibir apenas array com indices numericos
       if(count($args) == 1 && $args[0] == 'NUMBERS'){
	       	return $route;
        }
        
        for ($i = 0; $i < count($path_info); $i++){
            if(count(self::$letters) == $i){
                break;
            }

            $letter = self::$letters[$i];
            $route[$letter] = $path_info[$i];
        }


        switch (count($args)) {
            case 1:
            	
                return isset($route[$args[0]]) ? $route[$args[0]] : null ;
                break;

            case 2:
                return $args[1] == $route[$args[0]] ? true : false;
                break;

            case 3:
                return $args[1] == $route[$args[0]] ? $args[2]() : null;
                break;
             
            default:
                return $route;
                break;

         }

    }

    /**
     * Defines callback if route is not found
     * @param   string $callback
     */
    public static function error($callback){
    	self::$error_callback = $callback;
    }

    /**
     * Don't load any further routes on match
     * @param  boolean $flag 
     */
    public static function haltOnMatch($flag = true){
        self::$halts = $flag;
    }

    /**
     * Call object and instantiate
     *
     * @param  object $callback 
     * @param  array $matched  array of matched parameters
     * @param  string $msg      
     */
    public static function invokeObject($callback, $matched = null, $msg = null){

        //grab all parts based on a / separator and collect the last index of the array
        $params = explode('/',$callback);
        $first = array_shift($params);

        //grab the controller name and method call
        $segments = explode('@',$first);

        //instanitate controller with optional msg (used for error_callback)
        
        $path = explode('\\',$segments[0]);
        
        foreach ($path as $k => $v){
        	$path[$k] = ucfirst($path[$k]);
        }
        
        $path = implode('\\', $path);
        $method = $segments[1];
        
        $controller = new $path($msg);       

       if($matched == null){

            //call method
            if( method_exists($controller, $method) ){
            	$controller->$method($params);
            }else{
            	 self::invokeObject('Core\\Error@index');
            }

        } else {

            //call method and pass in array keys as params
            call_user_func_array(array($controller, $method), $matched);
        
        }
    }

    /**
     * autoDispatch by Volter9
     * Ability to call controllers in their controller/model/param way
     */
    public static function autoRun() {

        $uri = parse_url($_SERVER['QUERY_STRING'], PHP_URL_PATH);
        $uri = trim($uri, ' /');
        $parts = explode('/', $uri);

        $controller = $uri !== ''      && isset($parts[0])  ? $parts[0] : DEFAULT_CONTROLLER;
        $method     = $uri !== ''      && isset($parts[1])  ? $parts[1] : DEFAULT_METHOD;
        $args       = is_array($parts) && count($parts) > 2 ? array_slice($parts, 2) : array(); 

        $char_position = strpos($controller,'&');
        if ($char_position > 0 ) {
            $ctp = explode('&', $controller);
            $controller = $ctp[0];
        }

        $char_position2 = strpos($method,'&');
        if ($char_position2 > 0 ) {
            $ctp = explode('&', $method);
            $method = $ctp[0];
        }

        if ($args != null) {
            $char_position3 = strpos($args[0],'&');
            if ($char_position3 > 0 ) {
                $ctp = explode('&', $yes);
                $args[0] = $ctp[0];
            }
        }

        // Check for file
        if (!file_exists('app/Controllers/' . $controller . '.php')) {
            return false;
        }

        $controller = '\Controllers\\' . $controller;
        $c = new $controller;

        if (method_exists($c, $method)) {
            
            $c->$method($args);
            //found method so stop
            return true;

        }

        return false;
    }

    /**
     * Runs the callback for the given request
     */
    public static function run(){

        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];  

        $searches = array_keys(static::$patterns);
        $replaces = array_values(static::$patterns);

        self::$routes = str_replace('//','/',self::$routes);   

        $found_route = false;

        // parse query parameters
        {
            $query = '';
            $q_arr = array();
            if(strpos($uri, '&') > 0) {
                $query = substr($uri, strpos($uri, '&') + 1);
                $uri = substr($uri, 0, strpos($uri, '&'));
                $q_arr = explode('&', $query);
                foreach($q_arr as $q) {
                    $qobj = explode('=', $q);
                    $q_arr[] = array($qobj[0] => $qobj[1]);
                    if(!isset($_GET[$qobj[0]]))
                    {
                        $_GET[$qobj[0]] = $qobj[1];
                    }
                }
            }
        }

        // check if route is defined without regex
        if (in_array($uri, self::$routes)) {
            $route_pos = array_keys(self::$routes, $uri);

            // foreach route position
            foreach ($route_pos as $route) {

                if (self::$methods[$route] == $method || self::$methods[$route] == 'ANY') {
                    $found_route = true;

                    //if route is not an object 
                    if(!is_object(self::$callbacks[$route])){

                        //call object controller and method
                        self::invokeObject(self::$callbacks[$route]);
                        if (self::$halts) return;

                    } else { 

                        //call closure
                        call_user_func(self::$callbacks[$route]);
                        if (self::$halts) return;

                    }
                }

            }
            // end foreach

        } else {

            // check if defined with regex
            $pos = 0;

            // foreach routes
            foreach (self::$routes as $route) {

                $route = str_replace('//','/',$route);

                if (strpos($route, ':') !== false) {
                    $route = str_replace($searches, $replaces, $route);
                }

                if (preg_match('#^' . $route . '$#', $uri, $matched)) {

                    if (self::$methods[$pos] == $method || self::$methods[$pos] == 'ANY') {
                        $found_route = true; 

                        //remove $matched[0] as [1] is the first parameter.
                        array_shift($matched);

                        if(!is_object(self::$callbacks[$pos])){

                            //call object controller and method
                            self::invokeObject(self::$callbacks[$pos],$matched);
                            if (self::$halts) return;

                        } else {

                            //call closure
                            call_user_func_array(self::$callbacks[$pos], $matched);
                            if (self::$halts) return;

                        }

                    }
                }
                $pos++;
            }
            // end foreach
        }

        if (self::$fallback) {
            //call the auto dispatch method
            $found_route = self::autoRun();
        }

        // run the error callback if the route was not found
        if (!$found_route) {
            if (!self::$error_callback) {
                self::$error_callback = function() {
                   self::invokeObject('Core\\Error@index');
                };
            } 

            if(!is_object(self::$error_callback)){

                //call object controller and method
                self::invokeObject(self::$error_callback,null,'No routes found.');
                if (self::$halts) return;

            } else {

                call_user_func(self::$error_callback); 
                if (self::$halts) return;

            }

        }

    }
}
