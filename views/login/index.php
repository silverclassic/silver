<!DOCTYPE HTML>
<html>
    <head>
        <title>Test</title>
        <link rel="stylesheet" href="<?php echo HTTP_SERVER; ?>assets/css/default.css">
        <link rel="stylesheet" href="<?php echo HTTP_SERVER; ?>assets/css/reset.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <?php
        if (isset($this->js)) {
            foreach ($this->js as $js) {
                echo '<script src="' . HTTP_SERVER . 'views/' . $js . '"></script>';
            }
        }
        ?>
    </head>

    <form class="box login" action="login/run" method="post">
        <fieldset class="boxBody">
            <label>Username</label>
            <input type="text" tabindex="1" placeholder="PremiumPixel" required="" name="username">
            <label><a href="#" class="rLink" tabindex="5">Forget your password?</a>Password</label>
            <input type="password" tabindex="2" required="" name="password">
        </fieldset>
        <footer>
            <label><input type="checkbox" tabindex="3">Keep me logged in</label>
            <input type="submit" class="btnLogin" value="Login" tabindex="4">
        </footer>
    </form>
    <footer id="main">
        <a href="http://wwww.cssjunction.com">Simple Login Form (HTML5/CSS3 Coded) by CSS Junction</a> | <a href="http://www.premiumpixels.com">PSD by Premium Pixels</a>
    </footer>
</body>
</html>
