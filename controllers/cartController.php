<?php
class cartController extends controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $dados = array();
        
        $products = new Products();
        $store = new Store();

        $dados = $store->getTemplateData();


        $this->loadTemplate('cart', $dados);
    }
    public function add(){
        if(!empty($_POST['id_product'])){
            $id = intval($_POST['id_product']);
            $qt = intval($_POST['qt_product']);
        }
        echo $id;
        echo "qt= ".$qt;
    }

}