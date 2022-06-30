<?php
class homeController extends controller {

	private $user;

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $dados = array();

        $currentPage = 1;
        $offset = 0;
        $limit = 3;

        if(!empty($_GET['p'])){
            $currentPage = $_GET['p'];
        }
        
        $offset = ($currentPage * $limit) - $limit;

        $products = new Products();
        $categories = new Categories();

        $dados['list'] = $products->getList($offset,$limit);
        $dados['itemTotal'] = $products->getTotal();
        $dados['numberOfPages'] = ceil($dados['itemTotal']/$limit);
        $dados['currentPage'] = $currentPage;

        $dados['categories'] = $categories->getList(); 

        $this->loadTemplate('home', $dados);
    }

}