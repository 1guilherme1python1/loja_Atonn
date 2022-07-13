<?php
class Products extends Model{

    public function getAvailableOptions($filters = []){
        $groups = [];
        $ids = [];

        $where = $this->buildWhere($filters);

        $sql = $this->db->prepare("SELECT
            id, options
        FROM 
            products
        WHERE ".implode(' AND ',$where)."
        ");

        $this->bindWhere($filters, $sql);
        $sql->execute();

        if($sql->rowCount()>0){
            $sql = $sql->fetchAll(PDO::FETCH_ASSOC);;
            foreach($sql as $product){
                // echo '<pre>';
                // print_r($product['options']);

                $ops = explode(",", $product['options']);
                $ids[] = $product['id'];
                foreach($ops as $op){
                    if(!in_array($op, $groups)){
                        $groups[] = $op;
                    }
                }
            }
        }
        $options = $this->getAvailableValuesFromOptions($groups, $ids);
        return $options;
    }

    public function getSaleCount($filters = []){
        $where = $this->buildWhere($filters);

        $where[] = 'sale = "1"';

        $sql = $this->db->prepare("SELECT
            COUNT(*) as c
        FROM 
            products
        WHERE ".implode(' AND ',$where)."
        ");

        $this->bindWhere($filters, $sql);
        $sql->execute();

        if($sql->rowCount()>0){
            $sql = $sql->fetch(PDO::FETCH_ASSOC);;
            return $sql['c'];
        } else {
            return '0';
        }
    }

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
        if(!empty($filters['brand'])){
            $where[] = "id_brand IN ('".implode("','", $filters['brand'])."')";
        }
        if(!empty($filters['star'])){
            $where[] = "rating IN ('".implode("','", $filters['star'])."')";
        }
        if(!empty($filters['sale'])){
            $where[] = "sale='1'";
        }
        if(!empty($filters['options'])){
            $where[] = "id IN (select id_product from products_options where products_options.p_value IN ('".implode("','", $filters['options'])."'))";
        }
        if(!empty($filters['searchTerm'])){
            $where[] = "name LIKE :searchTerm";
        }
        return $where;
    }
    private function bindWhere($filters, &$sql){
        if(!empty($filters['category'])){
            $sql->bindValue(":id_category", $filters['category']);
        }
        if(!empty($filters['searchTerm'])){
            $sql->bindValue(":searchTerm", '%'.$filters['searchTerm'].'%');
        }
    }
    private function getAvailableValuesFromOptions($groups, $ids){
        $array = [];
        $options = new Options();
        foreach($groups as $op){
            $array[$op] = [
                'name' => $options->getName($op),
                'options' => [

                ] 
            ];
        }
        $sql = $this->db->query("SELECT 
            id ,p_value, id_option, COUNT(id_option) as c
        FROM
            products_options
        WHERE 
            id_option IN ('".implode("','", $groups)."') 
                AND
            id_product IN ('".implode("','", $ids)."')
        GROUP BY p_value ORDER BY id_option
        ");
        if($sql->rowCount()>0){
            $sql = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach($sql as $ops){
                $array[$ops['id_option']]['options'][] = [
                    'value'=>$ops['p_value'],
                    'count'=>$ops['c'],
                    'id'=>$ops['id_option']
                ];
            }
        }
        return $array;
    }
    public function getProductInfo($id){
        $array = [];

        $sql = $this->db->query("SELECT 
            *, 
        (select 
            brands.name 
        from 
            brands 
        where 
            brands.id = products.id_brand) as brand_name
        FROM 
            products 
        WHERE 
            id='$id'");

        if($sql->rowCount()>0){
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            $array[] = $row;
        }

        return $array;
    }
    public function getOptionsByProductId($id){
        $options = [];

        //ETAPA 1 - egar os nome das Opções;
        $sql = $this->db->prepare("SELECT options FROM products WHERE id=:id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount()>0){
            $options = $sql->fetch(PDO::FETCH_ASSOC);
            $options = $options['options'];

            if(!empty($options)){
                $sql = $this->db->query("SELECT * FROM options WHERE id IN (".$options.")");
                $options = $sql->fetchAll(PDO::FETCH_ASSOC);
            }
            //ETAPA 2 - Pegar os valores da opções
            $sql = $this->db->prepare("SELECT * FROM products_options WHERE id_product = :id");
            $sql->bindValue(':id', $id);
            $sql->execute();

            $options_values = [];

            if($sql->rowCount()>0){
                foreach($sql->fetchAll(PDO::FETCH_ASSOC) as $op){
                    $options_values[$op['id_option']] = $op['p_value'];
                }
            }

            //ETAPA 3 - juntar tudo em unico array
            foreach($options as $opKey=>$opvalue){
                if(isset($options_values[$opvalue['id']])){
                    $options[$opKey]['value'] = $options_values[$opvalue['id']];
                } else {
                    $options[$opKey]['value'] = '';
                }
            }
        }
        
        return $options;
    }
} 