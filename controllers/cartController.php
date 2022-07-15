<?php
class cartController extends controller {


    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $dados = array();
        
        $products = new Products();
        $store = new Store();
        $cart = new Cart();

        if(!isset($_SESSION['cart']) || (isset($_SESSION['cart']) && count($_SESSION['cart'])==0)){
            header("Location: ".BASE_URL);
            exit;
        }
        $dados = $store->getTemplateData();

        $dados['products'] = $cart->getList();

        $this->loadTemplate('cart', $dados);
    }
    public function add(){
        if(!empty($_POST['id_product'])){
            $id = intval($_POST['id_product']);
            $qt = intval($_POST['qt_product']);
        }
        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'] = [];
        }
        if(isset($_SESSION['cart'][$id])){
            $_SESSION['cart'][$id] += $qt;
        } else{
        $_SESSION['cart'][$id] = $qt;
        }

        header("Location: ".BASE_URL."cart");
        exit;
    }
    public function remove($id){
        if(isset($_SESSION['cart'][$id])){
            unset($_SESSION['cart'][$id]);
            // $_SESSION['cart']
        }
        header("Location: ".BASE_URL."cart");
    }
    public function subtraction($id){
        if(isset($_SESSION['cart'][$id])){
            $_SESSION['cart'][$id] -= 1;   
        }
        header("Location: ".BASE_URL."cart");
        exit;
    }
}