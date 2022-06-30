<?php
class Products extends Model{

    public function getList($offset = 0, $limit=3){

        $array = array();

        $sql = $this->db->query("SELECT *,
        (select 
            brands.name 
        from 
            brands 
        where 
            brands.id = products.id_brand) as brand_name,
        (select
            categories.name
        from 
            categories
        where
            categories.id = products.id_category) as category_name
        FROM 
            products
        LIMIT
            $offset, $limit");
        if($sql->rowCount()>0){
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);

            $brands = new Brands();

            foreach($array as $key => $item){
                // $array[$key]['brand_name'] = $brands->getNameById($item['id_brand']);
                $array[$key]['products_images'] = $this->getProductsImagesById($item['id']);
            }
        }
        return $array;
    }
    public function getProductsImagesById($id){
        $array = [];
        $sql = $this->db->query("SELECT url from products_images WHERE id_product = '$id'");
        if($sql->rowCount()>0){
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $array;
        }
        return $array;
    }
    public function getTotal(){
        $sql = $this->db->query("SELECT COUNT(*) AS c FROM products");
        $total = $sql->fetch();

        return $total['c'];
    }
}