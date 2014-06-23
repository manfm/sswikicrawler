<?php
namespace sswikicrawler;

abstract class WebCrawler
{
	protected $html;

	public function __construct($html){
		$this->html = $html;
	}
	
	/**
	 * get main text from page
	 */
	abstract public function getText();
	
	/**
	 * Prepare unified text
	 * @param string $text
	 * @return string
	 */
	public function getClearText($text = null){

		if(!$text)
			$text = $this->getText();
		
		$text = $this->getRidOfDiacritics($text);

		$text = trim($text);

		$text = strtolower($text);
		
		return $text;
	}
	
	/**
	 * Return unique words from text
	 * @param string $text
	 * @return array
	 */
	public function getUniqueWords($text = null){
		if(!$text)
			$text = $this->getClearText();
		
		$text = preg_replace("/\s+/", ' ', $text);
		return (array) array_values(array_unique(explode(" ",$text)));
	}
	
	/**
	 * Create DomDocument from html string
	 * @param string $html
	 * @return \DomDocument
	 */
	protected function getDocument($html = null){
		if(!$html)
			$html = $this->html;
		
		$doc = new \DomDocument();

		if(extension_loaded('mbstring'))
			$html = \mb_convert_encoding($html, 'HTML-ENTITIES', "UTF-8");
		
		$doc->loadHtml($html);
		$doc->encoding = 'utf-8';
		
		return $doc;
	}
	
	/**
	 * Replace diacritics to equivalent
	 * @param string $czechstring
	 * @return string
	 */
	protected function getRidOfDiacritics($czechstring){
		$prevodni_tabulka = Array(
				'ä'=>'a',
				'Ä'=>'A',
				'á'=>'a',
				'Á'=>'A',
				'à'=>'a',
				'À'=>'A',
				'ã'=>'a',
				'Ã'=>'A',
				'â'=>'a',
				'Â'=>'A',
				'č'=>'c',
				'Č'=>'C',
				'ć'=>'c',
				'Ć'=>'C',
				'ď'=>'d',
				'Ď'=>'D',
				'ě'=>'e',
				'Ě'=>'E',
				'é'=>'e',
				'É'=>'E',
				'ë'=>'e',
				'Ë'=>'E',
				'è'=>'e',
				'È'=>'E',
				'ê'=>'e',
				'Ê'=>'E',
				'í'=>'i',
				'Í'=>'I',
				'ï'=>'i',
				'Ï'=>'I',
				'ì'=>'i',
				'Ì'=>'I',
				'î'=>'i',
				'Î'=>'I',
				'ľ'=>'l',
				'Ľ'=>'L',
				'ĺ'=>'l',
				'Ĺ'=>'L',
				'ń'=>'n',
				'Ń'=>'N',
				'ň'=>'n',
				'Ň'=>'N',
				'ñ'=>'n',
				'Ñ'=>'N',
				'ó'=>'o',
				'Ó'=>'O',
				'ö'=>'o',
				'Ö'=>'O',
				'ô'=>'o',
				'Ô'=>'O',
				'ò'=>'o',
				'Ò'=>'O',
				'õ'=>'o',
				'Õ'=>'O',
				'ő'=>'o',
				'Ő'=>'O',
				'ř'=>'r',
				'Ř'=>'R',
				'ŕ'=>'r',
				'Ŕ'=>'R',
				'š'=>'s',
				'Š'=>'S',
				'ś'=>'s',
				'Ś'=>'S',
				'ť'=>'t',
				'Ť'=>'T',
				'ú'=>'u',
				'Ú'=>'U',
				'ů'=>'u',
				'Ů'=>'U',
				'ü'=>'u',
				'Ü'=>'U',
				'ù'=>'u',
				'Ù'=>'U',
				'ũ'=>'u',
				'Ũ'=>'U',
				'û'=>'u',
				'Û'=>'U',
				'ý'=>'y',
				'Ý'=>'Y',
				'ž'=>'z',
				'Ž'=>'Z',
				'ź'=>'z',
				'Ź'=>'Z'
		);
		
		return strtr($czechstring, $prevodni_tabulka);
	}
	
}
