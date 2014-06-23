<?php 
namespace sswikicrawler;

/**
 * @author Martin
 * Load config file
 */
class Config
{
	static protected $config;
	
	/**
	 * @param string $key
	 * @return string
	 */
	static function getValue($key){
		
		if(empty(self::$config))
			self::$config = include('config.php');
		
		if(isset(self::$config[$key]))
			return self::$config[$key];
		else 
			return null;
		
	}
} 