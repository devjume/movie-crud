<?php
include TEMPLATES_DIR.'head.php';
include MODULES_DIR.'/inc/authorization.php';

$uname = filter_input(INPUT_POST, "username");
$pw = filter_input(INPUT_POST, "password");

if(!isset($_SESSION["username"]) && isset($uname)){

    try {
        login($uname, $pw);
        header("Location: index.php");
        exit;
    } catch (Exception $e) {
        echo '<div class="alert alert-danger" role="alert">'.$e->getMessage().'</div>';
    }
   
}

    if(!isset($_SESSION["usename"])){
?>
<div class="container">
    <div class="row">
        <div class="col-4 offset-2">
            <h3>Kirjaudu sisään</h3>
            <form action="login.php" method="post" class="">
                <label for="username" class="m-1">Käyttäjänimi:</label><br>
                <input type="text" name="username" id="username" class="m-1"><br>
                <label for="password" class="m-1">Salasana:</label><br>
                <input type="password" name="password" id="password" class="m-1"><br>
                <input type="submit" class="btn btn-primary m-1" value="Kirjaudu sisään">
             </form>
        </div>
        <div class="col-4">
            <?php include 'person.php'; ?>
        </div>
    </div>
</div>

<?php } 
include TEMPLATES_DIR.'foot.php'; ?>