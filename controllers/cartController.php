<?php
class cartController extends controller {


    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $dados = array();
        
        $store = new Store();
        $cart = new Cart();
        $cep = '';
        $shipping = [];

        if(!empty($_POST['cep'])){
            $cep = intval($_POST['cep']);
            $shipping = $cart->shippingCalculate($cep);

            $_SESSION['shipping'] = $shipping;
        }

        if(!empty($_SESSION['shipping'])){
            $shipping = $_SESSION['shipping'];
        }

        if(!isset($_SESSION['cart']) || (isset($_SESSION['cart']) && count($_SESSION['cart'])==0)){
            header("Location: ".BASE_URL);
            exit;
        }
        $dados = $store->getTemplateData();

        //------correios-------//
        $dados['shipping'] = $shipping;
        //--------------------//


        $dados['products'] = $cart->getList();
        

        $this->loadTemplate('cart', $dados);
    }
    public function add(){
        unset($_SESSION['shipping']);

        if(!empty($_POST['id_product'])){
            $id = intval($_POST['id_product']);
            $qt = intval($_POST['qt_product']);
        }
        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'] = [];
        }
        if(isset($_SESSION['cart'][$id])){
            $_SESSION['cart'][$id] += $qt;
        } else {
        $_SESSION['cart'][$id] = $qt;
        }

        header("Location: ".BASE_URL."cart");
        exit;
    }
    public function remove($id){
        unset($_SESSION['shipping']);

        if(isset($_SESSION['cart'][$id])){
            unset($_SESSION['cart'][$id]);
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
    public function payment_redirect(){
        if(!empty($_POST['payment_type'])){
            $payment_type = $_POST['payment_type'];

            switch($payment_type){
                case 'checkout_transparent':
                    header("Location: ".BASE_URL."pagseguro");
                    exit;
                break;
            }
        }

        header("Location: ".BASE_URL."cart");
        exit;
    }
}