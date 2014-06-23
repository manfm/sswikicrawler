<?php 
use \sswikicrawler;

//composer autoload
require_once 'vendor/autoload.php';

//$_GET['searchvalue'] = 'Rest';
//prepare URL
$searchvalue = $_GET['searchvalue'];
$url = \sswikicrawler\Config::getValue('host').urlencode($searchvalue);

//load page
$c = new \sswikicrawler\WikiCrawler(\sswikicrawler\PageLoader::loadUrl($url));

$response = array();
$response['query'] = $searchvalue;

//get summary card
$info = $c->getCardInfo();

//get first paragraph
if(!$info)
	$info = $c->getText();

//if page is crawlable
if($info){
	$response['text'] = $info;
	
	//count unique words in text
	$cleaninfo = $c->getClearText($info); 
	$response['words'] = count($c->getUniqueWords($cleaninfo));
} else {
	//error
	$response['text'] = "Query not found (".$url.")";
	$response['words'] = 0;
}

//call template, pass data
try{
	$m = new \sswikicrawler\MustacheView();
	echo $m->render('template', $response);
}catch(Exception $e){\sswikicrawler\Log::exception($e);}