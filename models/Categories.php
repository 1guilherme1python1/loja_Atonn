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
}