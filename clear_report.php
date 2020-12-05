<?php session_start();

require('masterFile.php');

$sql = "UPDATE report SET report_status=? WHERE report_ID=?";
   $req = $conn->prepare($sql);
   $req->execute(array($_POST["status"], $_POST["id"]));

echo json_encode('success');
?>