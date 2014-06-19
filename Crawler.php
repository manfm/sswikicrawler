<?php


class Crawler
{

	function getInfo($html){

		/*
		$doc = new DomDocument();
		try{
			$doc->loadXml($html);
		}catch (exception $e){Log::exception($e);}
	*/
	
		/*
		$html = tidy_repair_string($html,array(
				'output-xml' => true
		), 'utf8');
		*/
/*
		$html = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $html);
		$html = preg_replace('#<noscript(.*?)>(.*?)</noscript>#is', '', $html);
		$html = preg_replace('#<style(.*?)>(.*?)</style>#is', '', $html);
		$html = preg_replace('#<meta(.*?)/>#is', '', $html);
		$html = preg_replace('#<link(.*?)/>#is', '', $html);
		//$html = preg_replace('#<img(.*?)/>#is', '', $html);
		$html = preg_replace('#id='.PHP_EOL.'"(.*?)"#is', '', $html);
		$html = preg_replace('#id="(.*?)"#is', '', $html);
		$html = str_replace(PHP_EOL, '', $html);
		*/
		//echo($html);

		
		$doc = new DomDocument();
		try{
			$doc->loadHtml($html);
		}catch (exception $e){Log::exception($e);}
		//echo $html;
	
	//var_dump($doc);
		$xpath = new DomXPath($doc);
		$table = $xpath->query('//table[@class="infobox vcard"]');
		//var_dump($table);exit();
		// Now query the document:
		foreach ($table as $node) {
			
			$card = $node->textContent;
			break;
		}
		
		return $card;
		
		var_dump($card);exit;
		$data = array();
		
		//TODO check xml doc
		foreach ($shops as $shop) {
			
			$eshop = array();
			$eshop['product'] = $product['name'];
			foreach($shop->childNodes as $col)
			{
				$cat = $col->getAttribute('class');
				if($cat == 'pr')
				{
					$eshop['price'] = $col->firstChild->firstChild->textContent;
					$eshop['price'] = $text = preg_replace("/[^0-9]/", '', $eshop['price']);
				}
				
				else if($cat == 'buy' OR $cat == 'buy-g')
				{
					$n = $col->lastChild->firstChild;
					$eshop['url'] = $n->getAttribute('href');
					$eshop['shop'] = utf8_decode($n->textContent);
				}
			}
			
			if($eshop['price'] < $product['price'])
				$data[] = $eshop;
	
		}
	
		return $data;
	}
	
	function getClearWords($text) {
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
