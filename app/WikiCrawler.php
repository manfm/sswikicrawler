<?php
namespace sswikicrawler;

class WikiCrawler extends WebCrawler
{
	protected $vcardclass = "infobox vcard";
	protected $textid = "mw-content-text";
	
	/* (non-PHPdoc)
	 * @see \sswikicrawler\WebCrawler::getText()
	 * 
	 */
	public function getText(){
		return $this->getContentInfo();
	}
	
	/**
	 * Get summary vCard from page
	 * @param string $html
	 * @return string
	 */
	public function getCardInfo($html = null){
		if(!$html)
			$html = $this->html;

		try{
			$doc = $this->getDocument();
		}catch (exception $e){Log::exception($e);}

		$xpath = new \DomXPath($doc);
		$table = $xpath->query('//table[@class="'.$this->vcardclass.'"]');

		$card = '';
		foreach ($table as $node) {
			$card = $node->textContent;
			break;
		}
		
		return $card;
	}
	
	/**
	 * Get first paragraphs from text on page
	 * @param string $html
	 * @return string
	 */
	public function getContentInfo($html = null){
		if(!$html)
			$html = $this->html;
		
		try{
			$doc = $this->getDocument();
		}catch (exception $e){Log::exception($e);}
		
		$xpath = new \DomXPath($doc);
		$table = $xpath->query('//div[@id="'.$this->textid.'"]/p');
		
		$paragraph = '';
		foreach ($table as $node) {
			$paragraph .= $node->textContent;
			if(strlen($paragraph) > \sswikicrawler\Config::getValue('infotextlen'))
				break;
		}

		return $paragraph;
	}
	
}
