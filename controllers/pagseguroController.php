<?php
class pagseguroController extends controller {


    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $dados = array();
        
        $store = new Store();
        $cart = new Cart();
      
        $dados = $store->getTemplateData();

        $this->loadTemplate('cart_pagseguro', $dados);
    }
    
}