<?php
class Store extends Model{
    public function getTemplateData(){

        $dados = [];

        $products = new Products();
        $categories = new Categories();
        $cart = new Cart();

        $dados['categories'] = $categories->getList(); 

        $dados['widget_featured1'] = $products->getList(0, 5, ['featured'=>'1'], true);
        $dados['widget_featured2'] = $products->getList(0, 3, ['featured'=>'1'], true);
        $dados['widget_sale'] = $products->getList(0, 5, ['sale'=>'1'], true);
        $dados['widget_torated'] = $products->getList(0, 5, ['toprated'=>'1'], false);

        if(isset($_SESSION['cart'])){
            $qt = 0;
            foreach($_SESSION['cart'] as $item){
                $qt += intval($item);
            }
            $dados['cart_qt'] = $qt;
        } else {
            $dados['cart_qt'] = 0;
        }
        $dados['cart_sub'] = $cart->getSubtotal();

        return $dados;
    }
}