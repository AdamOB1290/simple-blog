<?php session_start();

require('masterFile.php');

if (isset($_POST['submitPFP'])) {
    $file = $_FILES['filePFP'];
    $fileName = $_FILES['filePFP']['name'];
    $fileTmpName = $_FILES['filePFP']['tmp_name'];
    $fileSize = $_FILES['filePFP']['size'];
    $fileError = $_FILES['filePFP']['error'];
    $fileType = $_FILES['filePFP']['type'];

    $fileExt = explode('.',$fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg','jpeg','png');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError===0) {
            if ($fileSize < 1000000) {
                $fileNameNew = uniqid('', true).'.'.$fileActualExt;
                $fileDestination = 'uploads/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);

                if(isset($_SESSION['user_ID'])){
                    $sql = "UPDATE user SET image=? WHERE user_ID=?";
                    $req = $conn->prepare($sql);
                    $req->execute(array($fileNameNew, $_SESSION["user_ID"]));
                } else {
                    echo '0';
                }

                header('location: profilePHP.php');
            } else {
                $message = "Your file is too big !";
                echo "<script type='text/javascript'>alert('$message');window.location.href='profilePHP.php';</script>";
                
            }
        } else {
            $message = "The was an error uploading your file !";
            echo "<script type='text/javascript'>alert('$message');window.location.href='profilePHP.php';</script>";
            
        }
    } else {
        $message = "You cannot upload files of this type !";
        echo "<script type='text/javascript'>alert('$message');window.location.href='profilePHP.php';</script>";
        
    }
}