<?php
namespace sswikicrawler;

class WikiCrawlerTest extends \PHPUnit_Framework_TestCase
{
	public function testGetText(){
		$html = '<!DOCTYPE html>
			<html>
			<head>
			</head>
			<body>
				<div id="mw-content-text">
					<table class="infobox vcard" >
					<tr>
					<td>Rest</td>
					</tr>
					</table>
					<p>text</p>
				</div>
			</body>
			</html>
		';
		
		$c = new WikiCrawler($html);
		$info = $c->getText();
		
		$this->assertEquals("text", trim($info));
		
		return $info;
	}
	
	public function testGetCardInfo(){
		$html = '<!DOCTYPE html>
			<html>
			<head>
			</head>
			<body>
				<div id="mw-content-text">
					<table class="infobox vcard" >
					<tr>
					<td>Rest</td>
					</tr>
					</table>
					<p>text</p>
				</div>
			</body>
			</html>
		';
	
		$c = new WikiCrawler($html);
		$info = $c->getCardInfo();
	
		$this->assertEquals("Rest", trim($info));
	
		return $info;
	}
	
	public function testGetClearText(){
		$words = ' Rest rest íščřďťň is best 123';
		$c = new WikiCrawler('');
		$text = $c->getClearText($words);
	
		$this->assertEquals("rest rest iscrdtn is best 123", $text);
		
		return $text;
	}
	
	/**
	 * @depends testGetClearText
	 */
	public function testGetUniqueWords($text){
		$c = new WikiCrawler('');
		$array = $c->getUniqueWords($text);

		$this->assertEquals(array('rest','iscrdtn','is','best','123'), $array);
	}
	
}
