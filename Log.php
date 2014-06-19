<?php


class Log
{

	public static function exception($exception){
		echo $exception->getMessage();
	}
	
}
