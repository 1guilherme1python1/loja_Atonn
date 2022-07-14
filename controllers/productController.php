<?php

class productController extends controller{
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        header("Location: ".BASE_URL);
    }
    public function open($id){
        $dados = array();

        $store = new Store();


        $products = new Products();
        $categories = new Categories();
        $f = new Filters();
        $filters = [];

        $info = $products->getProductInfo($id);

        $dados = $store->getTemplateData();

        if(count($info)>0){

            $dados['filters'] = $f->getFilters($filters);
            $dados['categories'] = $categories->getList();
            
            $dados['filters_selected'] = [];

            $dados['info'] = $info[0];
            $dados['info_images'] = $products->getProductsImagesById($id);
            $dados['products_options'] = $products->getOptionsByProductId($id);

            $dados['products_rates'] = $products->getRates($id, 5);

            // $dados = $store->getTemplateData();
                
            $this->loadTemplate('product', $dados);

        } else {
            header('Location: '.BASE_URL);
        }
    } 
    

}