<?php

require('masterFile.php');

$error = '';
$old_pass = '';
$new_pass = '';
$confirmed_pass='';


if(empty($_POST["old_pass"]))
{
 $error = '<label class="text-danger">Old Password is required</label><br>';

}
else
{
 $old_pass = $_POST["old_pass"];

 
}

if(empty($_POST["new_pass"]))
{
 $error .= '<label class="text-danger">New Password is required</label><br>';
 
}
else
{
 $new_pass = $_POST["new_pass"];

}

if(empty($_POST["confirmed_pass"]))
{
 $error .= '<label class="text-danger">Confirm the New Password</label><br>';
 
}
else
{
 $confirmed_pass = $_POST["confirmed_pass"];

}

if($error == '')
{
    $mysql = "SELECT password FROM user WHERE user_ID=?";
    $request = $conn->prepare($mysql);
    $request->execute(array($_POST["user_ID"]));
    $current_pass = $request->fetch();
    if ($current_pass['password'] == $old_pass) {
        if ($new_pass == $confirmed_pass) {
            $sql = "UPDATE user SET password=? WHERE user_ID=?";
            $req = $conn->prepare($sql);
            $req->execute(array($confirmed_pass, $_POST['user_ID']));
            $error .= '<label class="text-success">Password Updated</label>';
        } else {
            $error .= '<label class="text-danger">New Password does not match the confirmation</label><br>';
        }
        
    } else {
        $error .= '<label class="text-danger">The Old Password is incorrect</label><br>';
    }
   
}

$data = array(
 'error'  => $error
);

echo json_encode($data);

?>