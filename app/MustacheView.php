<?php
namespace sswikicrawler;
 
class MustacheView extends View
{
	
	public function __construct($config = array()){
		
		$this->config = array(
				'loader' => new \Mustache_Loader_FilesystemLoader(dirname(__FILE__) . '/../views'),
		);
		
		if($config && is_array($config))
			foreach($config as $key=>$value)
				$this->config[$key] = $value;
		
	}
	
	/* (non-PHPdoc)
	 * @see \sswikicrawler\View::render()
	 * 
	 * @param string $template
     * @param mixed  $context  (default: array())
	 * 
	 * @return string Rendered template
	 */
	public function render($template, $data){
		$m = new \Mustache_Engine($this->config);
		
		return $m->render($template, $data);
	}
} 