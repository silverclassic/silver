<?php

class Login extends Controller {

    function __construct() {
        parent::__construct();
        if (Session::get('loggedIn')) {
            header('location: '.HTTP_SERVER);
            exit;
        }
    }

    function index() {
        $this->view->render('login/index',TRUE);//no Include header footer
    }

    function run() {
        $this->model->run();
    }

}