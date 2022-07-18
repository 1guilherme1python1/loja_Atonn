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

        try {
            $sessionCode = \PagSeguro\Services\Session::create(
                \PagSeguro\Configuration\Configure::getAccountCredentials()
            );
            $dados['sessionCode'] = $sessionCode->getResult();
        } catch (Exception$e) {
            echo "ERROR: ".$e->getMessage();
            exit;
        }

        $this->loadTemplate('cart_pagseguro', $dados);
    }
    
}