<?php
class Cart extends Model{
    public function getList(){
        $array = [];

        $products = new Products();

        $cart = $_SESSION['cart'];

        foreach($cart as $id => $qt){

            $info = $products->getInfo($id);

            $array[] = [
                'id' => $id,
                'name' => $info['name'],
                'qt' => $qt,
                'price' => $info['price'],
                'image' => $info['images']
            ];
        }
        return $array;
    } 
    public function getSubtotal(){
        $list = $this->getList();

        $subtotal = 0;

        foreach($list as $item){
            $subtotal = (floatval($item['price']) * intval($item['qt']));
        }
        return $subtotal;
    }
}