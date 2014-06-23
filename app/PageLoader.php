<?php
namespace sswikicrawler;

class PageLoader
{
	protected static $page;
	
	/**
	 * @param string $url
	 * @return string WEB page HTML
	 */
	public static function loadUrl($url) {
		//$cache = new \SimpleCache();
		$cache = new SimpleCacheRedirect();
		
		self::$page = $cache->get_data($url,$url);
		return self::$page;
	}
	
}
