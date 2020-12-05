<?php

//add_comment.php

require('masterFile.php');

$error = '';
$comment_user_ID = '';
$comment_content = '';
$articleID=1;


if(empty($_POST["user_ID"]))
{
 $error .= '<p class="text-danger">Login is required</p>';
}
else
{
 $comment_user_ID = $_POST["user_ID"];
}

if(empty($_POST["updated_comment"]))
{
 $error .= '<p class="text-danger">Comment is required</p>';
 
}
else
{
 $comment_content = $_POST["updated_comment"];
}
if($error == '')
{
   $sql = "UPDATE comments SET comment_content=? WHERE comment_ID=?";
   $req = $conn->prepare($sql);
   $req->execute(array($_POST["updated_comment"], $_POST["comment_ID"]));
 $error = '<label class="text-success">Comment Edited</label>';
}

$data = array(
 'error'  => $error
);

echo json_encode($data);

?>