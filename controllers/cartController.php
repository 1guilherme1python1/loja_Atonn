<?php
class homeController extends controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $dados = array();
        

        $products = new Products();
        $f = new Filters();
        $store = new Store();

        $dados = $store->getTemplateData();


        $this->loadTemplate('cart', $dados);
    }

}