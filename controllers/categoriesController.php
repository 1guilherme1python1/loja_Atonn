<?php
class categoriesController extends controller {

    public function index(){
        header("Location: ".BASE_URL);
    }

    public function enter($id){
        $dados = [];

        $store = new Store();
        $categories = new Categories();
        $products = new Products();
        $f = new Filters();

        $dados = $store->getTemplateData();

        $currentPage = 1;
        $offset = 0;
        $limit = 3;

        $dados['category_name'] = $categories->getCategoryName($id);

        $dados['sidebar'] = true;


        if(!empty($dados['category_name'])){

            $dados['category_filter'] = $categories->getCategoryTree($id);

            $filters = ['category'=>$id];

            $dados['list'] = $products->getList($offset, $limit, $filters);
            $dados['itemTotal'] = $products->getTotal($filters);
            $dados['numberOfPages'] = ceil($dados['itemTotal']/$limit);
            $dados['currentPage'] = $currentPage;

            $dados['categories'] = $categories->getList();
            $dados['id_category'] = $id;


            //sibebar----------------------//
            $filters = [];
            if(!empty($_GET['filter']) && is_array($_GET['filter'])){
            $filters = $_GET['filter'];
            }
            $dados['filters'] = $f->getFilters($filters);

            //-----------------------------//
        
            $this->loadTemplate('categories', $dados);
        } else {
            header("Location: ".BASE_URL);
        }
    }
}