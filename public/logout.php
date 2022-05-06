<?php
    include TEMPLATES_DIR.'head.php';
    include MODULES_DIR.'/inc/authorization.php';

    if(isset($_SESSION["username"])){
        logout();
        header("Location: index.php");
    }else{
        echo '<div class="alert alert-success" role="alert">Olet kirjautunut ulos!</div>';
    }

    include TEMPLATES_DIR.'foot.php.';
?>