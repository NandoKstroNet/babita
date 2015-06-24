<?php
namespace Helpers;

use Helpers\Session;

/*
 * url Class
 */
class Url
{
	
	//Letters params rotas
	public static $letters = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');
	

    /**
     * Redirect to chosen url
     * @param  string  $url      the url to redirect to
     * @param  boolean $fullpath if true use only url in redirect instead of using DIR
     */
    public static function redirect($url = null, $fullpath = false)
    {
        if ($fullpath == false) {
            $url = DIR . $url;
        }

        header('Location: '.$url);
        exit;
    }

    /**
     * created the absolute address to the template folder
     * @return string url to template folder
     */
    public static function templatePath($custom = false)
    {
        if ($custom == true) {
            return DIR.'app/templates/'.$custom.'/';
        } else {
            return DIR.'app/templates/'.TEMPLATE.'/';
        }
    }

    /**
     * created the relative address to the template folder
     * @return string url to template folder
     */
    public static function relativeTemplatePath($admin = false)
    {
        if ($admin == false) {
            return "app/templates/".DEFAULT_TEMPLATE."/";
        } else {
            return "app/templates/".ADMIN_TEMPLATE."/";
        }
    }

    /**
     * converts plain text urls into HTML links, second argument will be
     * used as the url label <a href=''>$custom</a>
     *
     * @param  string $text   data containing the text to read
     * @param  string $custom if provided, this is used for the link label
     * @return string         returns the data with links created around urls
     */
    public static function autoLink($text, $custom = null)
    {
        $regex   = '@(http)?(s)?(://)?(([-\w]+\.)+([^\s]+)+[^,.\s])@';

        if ($custom === null) {
            $replace = '<a href="http$2://$4">$1$2$3$4</a>';
        } else {
            $replace = '<a href="http$2://$4">'.$custom.'</a>';
        }

        return preg_replace($regex, $replace, $text);
    }

    /**
     * This function converts and url segment to an safe one, for example:
     * `test name @132` will be converted to `test-name--123`
     * Basicly it works by replacing every character that isn't an letter or an number to an dash sign
     * It will also return all letters in lowercase
     *
     * @param $slug - The url slug to convert
     *
     * @return mixed|string
     */
    public static function generateSafeSlug($slug)
    {
        // transform url
        $slug = preg_replace('/[^a-zA-Z0-9]/', '-', $slug);
        $slug = strtolower(trim($slug, '-'));

        //Removing more than one dashes
        $slug = preg_replace('/\-{2,}/', '-', $slug);

        return $slug;
    }

    /**
     * Go to the previous url.
     */
    public static function previous()
    {
        header('Location: '. $_SERVER['HTTP_REFERER']);
        exit;
    }

    /**
     * get all url parts based on a / seperator
     * @return array of segments
     */
    public static function segments()
    {
        return explode('/', $_SERVER['REQUEST_URI']);
    }

    /**
     * get last item in array
     */
    public static function lastSegment($segments)
    {
        return end($segments);
    }

    /**
     * get first item in array
     */
    public static function firstSegment($segments)
    {
        return $segments[0];
    }
    
    public static function get(){
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
}
