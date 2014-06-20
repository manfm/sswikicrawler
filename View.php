<?php 
abstract class View
{
	protected $config;
	
	public function __construct($config = array()){
		$this->config = $config;
	}
	
	abstract public function render($template, $data);
} 