<?php

class Dashboard extends Controller {

    function __construct() {
        parent::__construct();

        if (!Session::get('loggedIn') ||
                Session::get('role') == 'default') {
            Session::destroy();
            header('location: '.HTTP_SERVER);
            exit;
        }

        $this->view->css = array(HTTP_SERVER . 'views/dashboard/style.css');
        $this->view->js = array(HTTP_SERVER . 'views/dashboard/default.js');
    }

    function index() {
        $this->view->render('dashboard/index');
    }

    function logout() {
        session::destroy();
        header('location: ../login');
        exit;
    }

    /*
     * @param int op 
     * op = 0 Delete operation
     * op = 1 Insert
     * op = 2 Update
     */

    public function category() {
        $op = $_POST['op'];
        $id = $_POST['id'];
        if ($op == 0) {
            echo json_encode($this->model->deleteCategoryItem($id));
        } elseif ($op == 1) {
            $value = $_POST['value'];
            echo json_encode($this->model->insertCategoryItem($id, $value));
        } elseif ($op == 2) {
            $value = $_POST['value'];
            echo json_encode($this->model->updateCategoryItem($id, $value));
        }
    }

    public function getCategoryListProduct() {
        $id = $_POST['id'];
        echo json_encode($this->model->getCategoryListProduct($id));
    }

}