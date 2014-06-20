<?php


class PageLoader
{
	protected static $page;
	
	public static function loadUrl($url) {
		$cache = new SimpleCache();
		self::$page = $cache->get_data($url,$url);
		return sel::$page;
	}
	
}
