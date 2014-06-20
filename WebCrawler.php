<?php


class WikiCrawler
{
	protected $html;

	public function __construct($html)
	{
		$this->html = $html;
	}
	
	public function getClearWords($text) {
		$text = utf8_decode($text);
		$text = str_replace("?", "", $text);
		//var_dump($text);
		$text = mb_strtolower($text, "UTF-8"); 
		//$text = preg_replace('~[^\\pL0-9_]+~u', ' ', $text);
		$text = trim(preg_replace('/\s+/', ' ', $text));
		$text = iconv("utf-8", "us-ascii//TRANSLIT", $text);
		//$text = strtolower($text);
		
		$text = preg_replace('~[^-a-z0-9_]+~', ' ', $text);
		//var_dump($text);
		return $text;
	}
	
}
