<?php
class searchController extends controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $dados = array();

        $products = new Products();
        $categories = new Categories();
        $f = new Filters();

        if(isset($_GET['s']) && !empty($_GET['s'])){

            $searchTerm = $_GET['s'];
            $category = $_GET['category'];

            $currentPage = 1;
            $offset = 0;
            $limit = 6;

            $filters = [];
            if(!empty($_GET['filter']) && is_array($_GET['filter'])){
                $filters = $_GET['filter'];
            }

            $filters['searchTerm'] = $searchTerm;
            $filters['category'] = $category;


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

            $dados['searchTerm'] = $searchTerm;
            $dados['category'] = $category;
            

            $this->loadTemplate('search', $dados);
        } else {
            header("Location: ".BASE_URL);
        }
    }

}