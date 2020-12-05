<?php

//do_login.php

require('masterFile.php');


$req=$conn->prepare("SELECT * from user WHERE username = ? AND password = ?");
$req->execute(array($_POST['username'], $_POST['password']));
$data = $req->fetch();
    if ($req->rowCount() == 1) {
        
        $_SESSION["username"]=$_POST['username'];
        $_SESSION["user_ID"]=$data['user_ID'];
        $_SESSION["status"]="success";
        $_SESSION["role"]=$data["role"];
        $_SESSION["data"]=$data;
        
        header('Content-type: application/json');
        echo json_encode($_SESSION);
    } 
    
?>