<?php

class Home_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function getProductData($cateID = 0) {
        if ($cateID == 0) {
            return $this->db->select('select * from `product` order by `hot` desc limit 9');
        } else {
            return $this->db->select('select * from product where `categoryID`=:categoryID', array('categoryID'=>$cateID));
        }
    }
    
    public function getProduct($pID){
        return $this->db->select('select * from `product` where `id`=:pID', array('pID'=>$pID));
    }


    public function getCateChild($cateID){
        return $this->db->select('select * from `category` where `parent`=:cateID',array('cateID'=>$cateID));
    }
    
    public function getCateName($cateID){
        return $this->db->select('select name from `category` where `id`=:cateID',array('cateID'=>$cateID));
    }

}