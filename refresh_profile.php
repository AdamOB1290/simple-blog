<?php 
 session_start();
require('masterFile.php');
 if(isset($_SESSION['user_ID'])){
    $sql = "SELECT * FROM user WHERE user_ID=?";
    $req = $conn->prepare($sql);
    $req->execute(array($_SESSION["user_ID"]));
    $data = $req->fetch();
    if ($req->rowCount() == 1) {
        $_SESSION["data"]=$data;
        header('Content-type: application/json');
        echo json_encode($_SESSION);
    } 
 } else {
     echo '0';
 }

 ?>