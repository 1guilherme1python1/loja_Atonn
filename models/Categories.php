<?php
class Categories extends Model{
    public function getList(){
        $array = [];
            $sql = $this->db->query("SELECT * FROM categories ORDER BY sub DESC");
            if($sql->rowCount()>0){
                foreach($sql->fetchAll(PDO::FETCH_ASSOC) as $item){
                    $item['subs'] = [];
                    $array[$item['id']] = $item;
                }
                while ($this->stillNeed($array)){
                    $this->CategoryOrganized($array);
                }
            }
        return $array;
    } 

    public function getCategoryName($id){
        $sql=$this->db->query("SELECT name FROM categories WHERE id='$id'");
        if($sql->rowCount()>0){
            $data = $sql->fetch(PDO::FETCH_ASSOC);
        }
        return $data['name'];
    }

    private function CategoryOrganized(&$array){
        foreach($array as $id=>$item){
            if(isset($array[$item['sub']])){
                $array[$item['sub']]['subs'][$item['id']] = $item;
                unset($array[$id]);
                break;
            }
        }
    }

    private function stillNeed($array){
        foreach($array as $item){
            if(!empty($item['sub'])){
                return true;
            }
        }
        return false;
    }

    public function getCategoryTree($id){
        $array = array();

        $children = true;

        while($children){

            $sql = $this->db->query("SELECT * FROM categories WHERE id='$id'");
            if($sql->rowCount()>0){
                $sql = $sql->fetch(PDO::FETCH_ASSOC);
                $array[] = $sql;
                // print_r($array);
                if(!empty($sql['sub'])){
                    // print_r($sql['sub']);
                    $id = $sql['sub'];
                } else {
                    $children = false;
                }
            }
        }
        $array = array_reverse($array);
        return $array;
    }
}