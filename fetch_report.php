<?php session_start();

require('masterFile.php');

$user_ID= $_SESSION['user_ID'];
$query = "SELECT * FROM report INNER JOIN comments ON report.comment_ID = comments.comment_ID INNER JOIN user ON report.reporter_ID = user.user_ID INNER JOIN article ON report.article_ID = article.article_ID";
$req = $conn->prepare($query);
$req->execute();
$output = '';
$result = $req->fetchAll();
foreach($result as $row) {
    if ($row['report_status']) {
    
        if ($_SESSION['data']['role']=='admin') {
            
         $output .= '
        <li id="'.$row["report_ID"].'" class="notifications">
          <input type="hidden" name="notif_status" class="notif_status" value="'.$row["report_status"].'">
          <a class="subA notifs" href="'.$row["title"].'#comment_count">
          <span class="notif_top">A comment has been reported :</span>
          <br>
          <span class="notif_bottom">" <small><em>'.$row["comment_content"].' </em></small>"</span>
          <button id="checkmark'.$row["report_ID"].'" onclick="clear_report('.$row["report_ID"].')" class="notif_check"><i class="fas fa-check"></i></button>
          <br>
          <span class="notif_date"> '.$row["reported_at"].' </span>
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

