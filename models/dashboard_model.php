<?php

class Dashboard_Model extends Model {

    function __construct() {
        parent::__construct();
    }
    
    function insertCategoryItem($id, $value){
        return $this->db->insert('category',array(
            'parent'=>$id,
            'name'=>$value));
    }
    function updateCategoryItem($id, $value){
        return $this->db->update('category',array('name'=>$value), "id='".$id."'");
    }
    
    function deleteCategoryItem($id){ 
        return $this->db->delete('category', "id = $id");
    }
    
    function getCategoryListProduct($id){ 
        return $this->db->select('select * from product where `categoryID`=:categoryID', array('categoryID'=>$id));
    }

}