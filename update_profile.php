<?php


require('masterFile.php');

$status = '';
$address = '';
$email = '';


if(!empty($_POST["address"]))
{
 $address= $_POST["address"];

 $sql = "UPDATE user SET address=? WHERE user_ID=?";
   $req = $conn->prepare($sql);
   $req->execute(array($_POST["address"], $_POST["user_ID"]));
 $status .= '<label class="text-success">Address updated</label>';
}

if(!empty($_POST["email"]))
{
 $email=$_POST["email"];
 
 $sql = "UPDATE user SET email=? WHERE user_ID=?";
   $req = $conn->prepare($sql);
   $req->execute(array($_POST["email"], $_POST["user_ID"]));
 $status .= '<label class="text-success">Email updated</label>';
}

   


$data = array(
 'status'  => $status
);

echo json_encode($data);

?>