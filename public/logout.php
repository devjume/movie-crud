<?php
    include TEMPLATES_DIR.'head.php';
    include MODULES_DIR.'/inc/authorization.php';

    if(isset($_SESSION["username"])){
        logout();
        header("Location: logout.php");
    }else{
        echo '<div class="alert alert-success" role="alert">Logged out!!</div>';
    }

    include TEMPLATES_DIR.'foot.php.';
?>