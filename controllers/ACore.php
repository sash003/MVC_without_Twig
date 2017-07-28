<?php
namespace controllers;

abstract class ACore{
	
	protected $m;
  protected $loader;
  protected $twig;

	public function __construct(){
		$this->m = new \models\Model();
  }
	
}
