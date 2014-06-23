<?php
namespace sswikicrawler;

/**
 * @author Martin
 * Log errors
 */
class Log
{
	/**
	 * @param Exception $exception
	 */
	public static function exception(Exception $exception){
		echo $exception->getMessage();
	}
	
}
