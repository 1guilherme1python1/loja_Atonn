<?php

class Options extends Model{
    public function getName($id){
        $sql = $this->db->query("SELECT name FROM options WHERE id='$id'");
        if($sql->rowCount()>0){
            $sql = $sql->fetch(PDO::FETCH_ASSOC);
            return $sql['name'];
        }
        return '';
    }
}