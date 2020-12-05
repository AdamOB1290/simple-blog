<?php 
 session_start();

 if(isset($_SESSION['username'])){
     header('Content-type: application/json');
     echo json_encode($_SESSION);
 } else {
     echo 'unauthenticated';
 }

 ?>