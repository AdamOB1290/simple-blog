<?php session_start();

//report_comment.php

require('masterFile.php');

$comment_ID= $_POST['comment_ID'];
$article_ID= $_POST['article_id'];
$reporter= $_SESSION['user_ID'];

 $query = " INSERT INTO report (reporter_ID, comment_ID, article_ID) VALUES (?,?,?)";
 $statement = $conn->prepare($query);
 $statement->execute(array($reporter, $comment_ID, $article_ID));

 $data = 'Comment Reported Successfully';


echo json_encode($data);

?>