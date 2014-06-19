<?php 
require 'vendor/autoload.php';

require 'crawler.php';

$configs = include('config.php');


//$_GET['searchvalue'] = 'Rest';
$searchvalue = $_GET['searchvalue'];

$cache = new SimpleCache();
$data = $cache->get_data($searchvalue, $configs['host'].$searchvalue);
//echo strip_tags($data);
//var_dump($data);

$c = new Crawler();
$info = $c->getInfo($data);

$response = array();
$response['query'] = $searchvalue;
$response['text'] = $info;
//$response['text'] = mb_convert_encoding($info, 'HTML-ENTITIES', "UTF-8");

$info = $c->getClearWords($info); 
$response['words_orig'] = count(explode(" ",$info));
$response['words'] = count(array_unique(explode(" ",$info)));

//var_dump($response);

$m = new Mustache_Engine(array(
    'loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__) . '/views'),
));
echo $m->render('template', $response);