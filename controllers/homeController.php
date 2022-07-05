<?php
class homeController extends controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $dados = array();

        $products = new Products();
        $categories = new Categories();
        $f = new Filters();

        $currentPage = 1;
        $offset = 0;
        $limit = 6;

        $filters = [];

        if(!empty($_GET['p'])){
            $currentPage = $_GET['p'];
        }
        
        $offset = ($currentPage * $limit) - $limit;
         
        $dados['list'] = $products->getList($offset,$limit);
        $dados['itemTotal'] = $products->getTotal();
        $dados['numberOfPages'] = ceil($dados['itemTotal']/$limit);
        $dados['currentPage'] = $currentPage;

        $dados['filters'] = $f->getFilters($filters);

        $dados['maxslider'] = $dados['filters']['maxslider'];

        $dados['categories'] = $categories->getList(); 

        $this->loadTemplate('home', $dados);
    }

}