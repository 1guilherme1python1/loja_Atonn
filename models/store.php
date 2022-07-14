<?php
class Store extends Model{
    public function getTemplateData(){

        $dados = [];

        $products = new Products();
        $categories = new Categories();

        $dados['categories'] = $categories->getList(); 

        $dados['widget_featured1'] = $products->getList(0, 5, ['featured'=>'1'], true);
        $dados['widget_featured2'] = $products->getList(0, 3, ['featured'=>'1'], true);
        $dados['widget_sale'] = $products->getList(0, 5, ['sale'=>'1'], true);
        $dados['widget_torated'] = $products->getList(0, 5, ['toprated'=>'1'], false);

        return $dados;
    }
}