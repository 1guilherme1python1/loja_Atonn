<?php
class Products extends Model{

    public function getList($offset = 0, $limit=3, $filters=[]){

        $array = array();

        $where = [
            '1=1'
        ];

        if(!empty($filters['category'])){
            $where[] = "id_category = :id_category";
        }

        $sql = $this->db->prepare("SELECT *,
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
        WHERE ".implode(' AND ', $where)."
        LIMIT
            $offset, $limit");

        if(!empty($filters['category'])){
            $sql->bindValue(":id_category", $filters['category']);    
        }

        $sql->execute();

        if($sql->rowCount()>0){
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);

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

    public function getTotal($filters = []){

        $Where = [
            '1=1'
        ];

        $sql = $this->db->query("SELECT
            COUNT(*) AS c 
        FROM
            products
        WHERE ".implode(' AND ', $Where)."
            ");
        $total = $sql->fetch();

        return $total['c'];
    }
}