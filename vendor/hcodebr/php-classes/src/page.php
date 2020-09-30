<?php

namespace Src;

//chama o namespace do Rain tpl
use Rain\Tpl;

//criar classe page
class Page{

	private $tpl;
	private $defaults = [
	"header"=> true,
	"footer"=> true,
	"data"=>[]
	];
	private $options = [];


	//criar um metodo construtor
	//cabecalho
	public function __construct($opts = array(), $tpl_dir = "/views/"){

		$this->options = array_merge($this->defaults, $opts);

		$config = array(
					
					"tpl_dir"       => $_SERVER["DOCUMENT_ROOT"].$tpl_dir,
					"cache_dir"     => $_SERVER["DOCUMENT_ROOT"]."/views-cache/",
					"debug"         => false, // set to false to improve the speed
				   );

		Tpl::configure($config);

		$this->tpl = new Tpl;

		$this->setData($this->options["data"]);

		if ($this->options["header"] === true) $this->tpl->draw("header");

	}

	private function setData ($data = array()){

		foreach ($data as $key => $value) {
			$this->tpl->assign($key, $value);
		}

	}

	//corpo do site
	public function setTpl($name, $data = array(),$returnHTML = false ){

		$this->setData($data);
		return $this->tpl->draw($name, $returnHTML);

	}

	//criar metodo destrutor
	//rodapé
	public function __destruct(){

		if ($this->options["footer"] === true)$this->tpl->draw("footer");

	}
}

?>