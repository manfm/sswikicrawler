<?php 
require_once 'vendor/autoload.php';
$configs = include('config.php');

require_once 'WikiCrawler.php';
require_once 'MustacheView.php';


//$_GET['searchvalue'] = 'Rest';
$searchvalue = $_GET['searchvalue'];

$c = new WikiCrawler();
$info = $c->getCardInfo(PageLoader::loadUrl($configs['host'].$searchvalue));

$response = array();
$response['query'] = $searchvalue;
//$response['text'] = $info;
$response['text'] = mb_convert_encoding($info, 'HTML-ENTITIES', "UTF-8");

$info = $c->getClearWords($info); 
$response['words_orig'] = count(explode(" ",$info));
$response['words'] = count(array_unique(explode(" ",$info)));

//var_dump($response);

$m = new MustacheView();
echo $m->render('template', $response);