<?php session_start();

require('masterFile.php');

$user_ID= $_SESSION['user_ID'];

$query = "SELECT * FROM comments NATURAL JOIN user  NATURAL JOIN article ORDER BY comment_id";
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
      $output .= '
      <li class="notifications">
      <input type="hidden" name="notif_status" class="notif_status" value="'.$row["comment_status"].'">
      <a class="subA notifs" href="'.$row["title"].'?comment_ID='.$row["comment_ID"].'">
      <span class="notif_top"><strong>'.$row["username"].'</strong> replied to your comment :</span>
      <br>
      <span class="notif_bottom">" <small><em>'.$row["comment_content"].' </em></small>"</span>
      <br>
      <span class="notif_date"> '.$row["comment_created_at"].' </span>
      </a>
      </li>
      ';
    }
    
  }

  
  
}


$data = array(
  'notification' => $output
);
echo json_encode($data);

?>