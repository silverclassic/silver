<?php

class UserManage extends Controller {

    function __construct() {
        parent::__construct();

        if (!Session::get('loggedIn') ||
                Session::get('role') != 'owner') {
            Session::destroy();
            header('location: '.HTTP_SERVER);
            exit;
        }

        $this->view->css = array('http://www.jeasyui.com/easyui/themes/default/easyui.css',
            'http://www.jeasyui.com/easyui/themes/icon.css',
            HTTP_SERVER . 'views/usermanage/css/style.css');
    }

    function index() {
        $this->view->userList = $this->model->getUserList();
        $this->view->render('usermanage/index');
    }

    function get_users() {
        return $this->model->get_users();
    }

    function save_user() {
        return $this->insert();
    }

    function insert() {
        $data = array();
        $data['name'] = $_POST['name'];
        $data['password'] = $_POST['password'];
        $data['role'] = $_POST['role'];

        // $TODO: Do your error checking!        
        $result = $this->model->insert($data);
        if ($result) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => 'Some errors occured.'));
        }
        //header('location: ' . HTTP_SERVER . 'usermanage');
    }

    function delete($id) {
        $this->model->delete($id);
        header('location: ' . HTTP_SERVER . 'usermanage');
    }

    function edit($id) {
        
    }

}