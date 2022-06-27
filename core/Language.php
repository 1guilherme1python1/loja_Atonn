<?php
class Language {

	private $l; // guarda a linguagem inicial 
	private $ini; // guarda o dicionário


	public function __construct() {

		global $config;
		$this->l = $config['default_lang'];

		if(!empty($_SESSION['lang']) && file_exists('lang/'.$_SESSION['lang'].'.ini')) {
			$this->l = $_SESSION['lang'];
		}

		$this->ini = parse_ini_file('lang/'.$this->l.'.ini'); // carrega um arquivo ini e passa para um array;
	}

	public function get($word, $return = false) {
		$text = $word;

		if(isset($this->ini[$word])) {
			$text = $this->ini[$word];
		}

		if($return) {
			return $text;
		} else {
			echo $text;
		}

	}

}