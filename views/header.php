<!doctype html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
        <title>Test</title>        
        <link rel="stylesheet" href="<?php echo HTTP_SERVER; ?>assets/css/default.css">
        <?php
        if (isset($this->js)) {
            foreach ($this->js as $js) {
                echo '<script type="text/javascript" src="' . $js . '"></script>';
            }
        }
        if (isset($this->css)) {
            foreach ($this->css as $css) {
                echo '<link rel="stylesheet" type="text/css" href="' . $css . '">';
            }
        }
        ?>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    </head>
    <body>
        <div id="wrapper">
            <div id="header">
                <div id="banner">
                    Welcome to my site!
                </div>
                <div id="headerNav">
                    <?php
                    if (Session::get('loggedIn')) {
                        echo '<a href="' . HTTP_SERVER . 'home">Home</a>';                    
                        if (Session::get('role') == 'owner') {
                            echo '<a href="' . HTTP_SERVER . 'dashboard">Dashboard</a>';
                            echo '<a href="' . HTTP_SERVER . 'usermanage">Users</a>';
                        }
                        if (Session::get('role') == 'admin') {
                            echo '<a href="' . HTTP_SERVER . 'dashboard">Dashboard</a>';
                        }
                        echo '<a href="' . HTTP_SERVER . 'dashboard/logout">Logout</a>';
                    } else {
                        echo '<a href="' . HTTP_SERVER . 'home">Home</a>';
                        echo '<a href="' . HTTP_SERVER . 'login">Login</a>';
                    }
                    ?>
                </div>
            </div>
            <div id="contentWrapper">