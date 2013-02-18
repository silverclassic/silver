<?php

class Home extends Controller {

    function __construct() {
        parent::__construct();

        $this->view->css = array(HTTP_SERVER . 'views/home/style.css');
    }

    function index() {
        $this->view->productData = $this->model->getProductData();
        $this->view->render('home/index');
    }

    public function category($cateID) {        
        $cate = $this->model->getCateChild($cateID);
        if (empty($cate)) {// this category is a leaf
            $this->view->productCate1 = array(
                "data" => $this->model->getProductData($cateID),
                "name" => $this->model->getCateName($cateID)[0]["name"],
                "id"=>$cateID);
            
        } else {//this cateogry is a tree
            $this->view->productCate2 = array();
            foreach ($cate as $cateItem) {
                array_push($this->view->productCate2, array(
                    "data" => $this->model->getProductData($cateItem["id"]),
                    "name" => $cateItem["name"],
                    "id"=>$cateItem["id"]));
            }
        }
        $this->index();
    }
    public function product($pID){
        $this->view->singleProductData=$this->model->getProduct($pID)[0];
        $this->index();
    }

}