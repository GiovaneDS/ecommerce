<?php

namespace Hcode;

//chama o namespace do Rain tpl
use Rain\Tpl;

//criar classe page
class Page{

	private $tpl;
	private $defaults = [	
	"data"=>[]
	];
	private $options = [];


	//criar um metodo construtor
	//cabecalho
	public function __construct($opts = array()){

		$this->options = array_merge($this->defaults, $opts);

		$config = array(
					
					"tpl_dir"       => $_SERVER["DOCUMENT_ROOT"]."/views/",
					"cache_dir"     => $_SERVER["DOCUMENT_ROOT"]."/views-cache/",
					"debug"         => false, // set to false to improve the speed
				   );

		Tpl::configure($config);

		$this->tpl = new Tpl;

		$this->setData($this->options["data"]);

		$this->tpl->draw("header");

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

		$this->tpl->draw("footer");

	}
}

?>