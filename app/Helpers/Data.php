<?php
namespace Helpers;

/*
 * data Helper - common data lookup methods
 *
 * @version 1.0
 * @date March 28, 2015
 * @date May 18 2015
 */
class Data
{
	
	/**
	 * Unserialize value only if it was serialized.
	 *
	 * @since 2.0.0
	 *
	 * @param string $original Maybe unserialized original, if is needed.
	 * @return mixed Unserialized data can be any type.
	 */
	public static function unserialize( $data ) {
		$data = str_replace('[quot-22]', '"', $data);
		return unserialize( $data );
	}
	
	
	/**
	 * Serialize data, if needed.
	 *
	 * @since 2.0.5
	 *
	 * @param string|array|object $data Data that might be serialized.
	 * @return mixed A scalar data
	 */
	public static function serialize( $data ) {
		if ( is_array( $data ) || is_object( $data ) ){
			$data = serialize( $data );

			$data = str_replace('"', '[quot-22]', $data);
			
			return $data;
		}else{
			return false;
		}

	}
	
    /**
     * print_r call wrapped in pre tags
     * @param  string or array $data
     */
    public static function pr($data)
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }

    /**
     * var_dump call
     * @param  string or array $data
     */
    public static function vd($data)
    {
        var_dump($data);
    }

    /**
     * strlen call - count the lengh of the string
     * @param  string $data
     * @return string return the count
     */
    public static function sl($data)
    {
        return strlen($data);
    }

    /**
     * strtoupper - convert string to uppercase
     * @param  string $data
     * @return string
     */
    public static function sup($data)
    {
        return strtoupper($data);
    }

    /**
     * strtolower - convert string to lowercase
     * @param  string $data
     * @return string
     */
    public static function slw($data)
    {
        return strtolower($data);
    }

    /**
     * ucwords - the first letter of each word to be a capital
     * @param  string $data
     * @return string
     */
    public static function ucw($data)
    {
        return ucwords($data);
    }
}
