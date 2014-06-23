<?php
/*
 * extends SimpleCache
 */
namespace sswikicrawler;

class SimpleCacheRedirect extends \SimpleCache
{
	//Helper function for retrieving data from url
	function do_curl($url)
	{
		if(function_exists("curl_init")){
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
			
			//extended
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			
			$content = curl_exec($ch);
			curl_close($ch);
			return $content;
		} else {
			return file_get_contents($url);
		}
	}
}

?>
