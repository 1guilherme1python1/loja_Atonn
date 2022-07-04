<?php
class Brands extends Model {
    public function getList(){
        $array = [];

        $sql = $this->db->query("SELECT * FROM brands");
        if($sql->rowCount()>0){
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $array;
    }

    public function getNameById($id){
        $sql = $this->db->query("SELECT name FROM brands WHERE id='$id'");
        if($sql->rowCount()>0){
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            return $data['name'];
        }
        return '';
    }
}