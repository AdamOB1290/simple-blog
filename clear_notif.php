<?php session_start();

require('masterFile.php');

$user_ID= $_SESSION['user_ID'];

$query = "SELECT * FROM comments NATURAL JOIN user  NATURAL JOIN article WHERE comment_status=1 ORDER BY comment_id";
$req = $conn->prepare($query);
$req->execute();
$output = '';
$result = $req->fetchAll();

foreach($result as $row) {
  if ($row['parent_comment_ID'] != 0) {
    $parent_comment_ID = $row['parent_comment_ID'];

    $request = "SELECT user_ID FROM comments WHERE comment_ID=?";
    $sql = $conn->prepare($request);
    $sql->execute(array($parent_comment_ID));
    $matched_user_ID = $sql->fetch();

    if ($user_ID==$matched_user_ID['user_ID']) {
        $sqlquery = "UPDATE comments SET comment_status=0 WHERE comment_ID=? ORDER BY comment_id";
        $demand = $conn->prepare($sqlquery);
        $demand->execute(array($row['comment_ID']));
    }
    
  }
  
}

echo 'success';