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

        
        $dados['filters_select'] = $filters;

        $dados['sidebar'] = true;

        $this->loadTemplate('home', $dados);
    }

}