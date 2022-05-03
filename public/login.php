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
    <h3>Login</h3>
    <form action="login.php" method="post" class="">
        <label for="username">Username:</label><br>
        <input type="text" name="username" id="username"><br>
        <label for="password">Password:</label><br>
        <input type="password" name="password" id="password"><br>
        <input type="submit" class="btn btn-primary" value="Log in">
    </form>


<?php } include 'person.php'; include TEMPLATES_DIR.'foot.php'; ?>