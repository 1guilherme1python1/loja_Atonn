<?php
class Products extends Model{

    public function getListOfStars($filters = []){
        $array = [];

        $where = $this->buildWhere($filters);

        $sql = $this->db->prepare("SELECT 
            rating, COUNT(id) as c 
        FROM 
            products 
        WHERE ".implode(' AND ',$where)." 
            GROUP BY rating");

        $this->bindWhere($filters, $sql);

        $sql->execute();

        if($sql->rowCount()>0){
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $array;
    }

    public function getMaxPrice($filters = []){
        $where = $this->buildWhere($filters);

        $sql = $this->db->prepare("SELECT
            price
        FROM 
            products
        WHERE ".implode(' AND ',$where)."
            ORDER BY price DESC
        LIMIT 1 
        ");

        $this->bindWhere($filters, $sql);
        $sql->execute();

        if($sql->rowCount()>0){
            $sql = $sql->fetch(PDO::FETCH_ASSOC);;
            return $sql['price'];
        } else {
            return '0';
        }
    }

    public function getList($offset = 0, $limit=3, $filters=[]){

        $array = array();

        $where = $this->buildWhere($filters);

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

        $this->bindWhere($filters, $sql);

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

        $where = $this->buildWhere($filters);

        $sql = $this->db->prepare("SELECT
            COUNT(*) AS c 
        FROM
            products
        WHERE ".implode(' AND ', $where)."");

        $this->bindWhere($filters, $sql);

        $sql->execute();
        $total = $sql->fetch();
        
        return $total['c'];
    }
    public function getListOfBrands($filters = []){
        $array = [];

        $where = $this->buildWhere($filters);

        $sql = $this->db->prepare("SELECT 
            id_brand, COUNT(id) as c 
        FROM 
            products 
        WHERE ".implode(' AND ',$where)." 
            GROUP BY id_brand");

        $this->bindWhere($filters, $sql);

        $sql->execute();

        if($sql->rowCount()>0){
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $array;
    }
    private function buildWhere($filters){
        $where = [
            '1=1'
        ];
        if(!empty($filters['category'])){
            $where[] = "id_category = :id_category";
        }
        return $where;
    }
    private function bindWhere($filters, &$sql){
        if(!empty($filters['category'])){
            $sql->bindValue(":id_category", $filters['category']);
        }
    }
} 