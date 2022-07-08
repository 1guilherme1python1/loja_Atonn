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
        if(!empty($_GET['filter']) && is_array($_GET['filter'])){
            $filters = $_GET['filter'];
        }

        if(!empty($_GET['p'])){
            $currentPage = $_GET['p'];
        }
        
        $offset = ($currentPage * $limit) - $limit;
         
        $dados['list'] = $products->getList($offset,$limit, $filters);
        $dados['itemTotal'] = $products->getTotal($filters);
        $dados['numberOfPages'] = ceil($dados['itemTotal']/$limit);
        $dados['currentPage'] = $currentPage;

        $dados['filters'] = $f->getFilters($filters);

        $dados['maxslider'] = $dados['filters']['maxslider'];

        $dados['categories'] = $categories->getList(); 
        
        $dados['filters_select'] = $filters;

        $this->loadTemplate('home', $dados);
    }

}