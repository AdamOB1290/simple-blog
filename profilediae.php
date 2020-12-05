<?php
require("masterFile.php");    

// if (!isset($_SESSION["Connected-UserID"])) {
//     echo "YOU ARE NOT CONNECTED";
//     echo $_SESSION["Connected-UserID"];

//     // header("Location:LoginFMA.php");
//     }else {
//     echo "YOU ARE CONNECTED";
//     echo $_SESSION["Connected-UserID"];

// }

$pfp="Icon\iconfinder-pfp.svg";

if (isset($_POST["submitPFP"])){
    $file = $_FILES["filePFP"];
    $fileName = $_FILES["filePFP"]["name"];
    $fileTmpName = $_FILES["filePFP"]["tmp_name"];
    $fileSize = $_FILES["filePFP"]["size"];
    $fileError = $_FILES["filePFP"]["error"];
    $fileType = $_FILES["filePFP"]["type"];

    $fileExtention= explode(".", $fileName);
    $LowerCasedActualExt= strtolower(end($fileExtention));
    $allowed= array("jpg","jpeg","svg","png","pdf",);

    if (in_array($LowerCasedActualExt, $allowed)) {
        if($fileError === 0) {
            if ($fileSize < 1000000) {
                $fileNewName = uniqid("", true).".".$LowerCasedActualExt;
                $fileDestination ="Uploads/".$fileNewName;
                move_uploaded_file($fileTmpName,$fileDestination);
                header("Location: ProfileFMA.php?uploadsucess");
                
            } else {
                echo "your file is too big !";
            }
        } else {
            echo "there was an error uploading the file";
        }
    } else {
        echo "u got a shit filetype in there... change it";
    }


}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.16.0/css/mdb.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="ProfileCSS.css">
    <title>F.M.A</title>
</head>

<body>
    

<header class="row">
    

    <div class="row col-md-12 h-100">
        <div class="coverdiv col-md-12">
            <a href="#" class="btn btn-sm btn-light float-right"><span class="glyphicon glyphicon-picture"></span> Change cover</a>
        </div>
        <!-- <div class="row">
            <div class="col-sm-10"><h1>User name</h1></div>
            <div class="col-sm-2"><a href="/users" class="pull-right"><img title="profile image" class="img-circle img-responsive" src="http://www.gravatar.com/avatar/28fd20ccec6865e2d5f0e1f4446eb7bf?s=100"></a></div>
        </div> -->
    </div>


</header>
<main>

    <!-- Modal -->
    <div id="uploadModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">            
                <form method='post' action='' enctype="multipart/form-data">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">File upload form</h4>
                    </div> 
                    <div class="modal-body d-flex justify-content-center">
                        <!-- Form -->
                    
                        Select file :<input type="file" name="filePFP" onchange="previewImage(event)" id='file' class="text-center center-block file-upload form-control" accept="image/*"><br>
                        <!-- Preview-->
                        <div id="preview" class="d-flex justify-content-center">
                            <p>PFP preview :</p>
                            <img src="" width="0" height="0" id="modal-img-preview">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" name="submitPFP" value="Upload image" id='submit_upload' class="btn btn-info">                                                 
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container mx-md-0 mw-100">

        <div class="row">

            <div class="col-md-3 pr-5">
                <div class="row">
                    <form method="POST" action="?" enctype="multipart/form-data">
                        <div class="pfpparentdiv">
                            <div class="text-center pfpdiv">
                                <img src="<?php echo $pfp;?>" class="pfp avatar">                                    
                                <i class="fas fa-camera" data-toggle="modal" data-target="#uploadModal"></i>                                        
                            </div>
                        </div>
                    </form> 
                </div>
                <div class="nav flex-column nav-pills mt-5 pt-4" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="true"><i class="fas fa-user-circle"></i> Profile</a>
                    <a class="nav-link" id="v-pills-change-password-tab" data-toggle="pill" href="#v-pills-change-password" role="tab" aria-controls="v-pills-change-password" aria-selected="false"><i class="fas fa-lock-open"></i> Change Password</a>
                    <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false"><i class="fas fa-cog"></i> Settings</a>
                    <a class="nav-link" id="v-pills-logout-tab" data-toggle="pill" href="#v-pills-logout" role="tab" aria-controls="v-pills-logout" aria-selected="false"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>

            </div>

            <div class="col-md-9 tab-content mt-5 p-0" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">                                    
                    
                    <button id="toggleEditProfile" class="text-center btn btn-sm editbutn"><i class="far fa-edit"></i> Edit</button>
                    <button id="confirmeditID" class="text-center btn btn-sm confirmedit mt-2"><i class="fas fa-check"></i></button>
                    <button id="canceleditID" class="d-flex justify-content-center align-items-center text-center btn btn-sm canceledit mt-2"><i class="fas fa-times"></i></button>

                    <form class="form" action="\#" method="post" id="registrationForm">
                        <!-- input -->
                        <div class="d-inline-block profile-div-form mr-2">
                            <div class="d-flex">
                                <div class="d-flex align-items-center font-weight-bolder finput-title enableEdit">First name :</div>
                                <div class="md-form input-with-pre-icon profile-input-forms mx-0">
                                    <i class="fas fa-id-badge input-prefix enableEdit"></i>
                                    <input type="text" id="First-name" class="form-control inputToDisable" disabled>
                                    <label for="First-name" class="pl-2">First name </label>
                                </div>
                            </div>
                        </div>
                        <!-- input -->
                        <div class="d-inline-block profile-div-form">
                            <div class="d-flex">
                                <div class="d-flex align-items-center font-weight-bolder finput-title enableEdit">Last name :</div>
                                <div class="md-form input-with-pre-icon profile-input-forms mx-0">
                                    <i class="fas fa-id-card input-prefix enableEdit"></i>
                                    <input type="text" id="Last-name" class="form-control inputToDisable" disabled>
                                    <label for="Last-name" class="pl-2">Last name </label>
                                </div>
                            </div>
                        </div>
                        <!-- input -->
                        <div class="d-inline-block profile-div-form mr-2">
                            <div class="d-flex">
                                <div class="d-flex align-items-center font-weight-bolder finput-title enableEdit">Username :</div>
                                <div class="md-form input-with-pre-icon profile-input-forms mx-0">
                                    <i class="fas fa-user input-prefix enableEdit"></i>  
                                    <input type="text" id="prefixInside" class="form-control inputToDisable" disabled>
                                    <label for="prefixInside" class="pl-2">Username </label>
                                </div>
                            </div>
                        </div>
                        <!-- input -->
                        <div class="d-inline-block profile-div-form">
                            <div class="d-flex">
                                <div class="d-flex align-items-center font-weight-bolder mr-3 enableEdit">Age :</div>
                                <div class="md-form input-with-pre-icon profile-input-forms mx-0">
                                    <i class="fas fa-birthday-cake input-prefix enableEdit"></i>
                                    <input type="number" id="Age" class="form-control inputToDisable" disabled>
                                    <label for="Age" class="pl-2">Age </label>
                                </div>
                            </div>
                        </div>
                        <!-- input -->
                        <div class="d-flex profile-div-form w-75">
                            <div class="d-flex align-items-center font-weight-bolder finput-title enableEdit">Adress :</div>
                            <div class="md-form input-with-pre-icon w-100 profile-input-forms mx-0">
                                <i class="fas fa-map-marker-alt input-prefix enableEdit"></i>
                                <input type="text" id="Adress" class="form-control inputToDisable" disabled>
                                <label for="Adress" class="pl-2">Adress </label>
                            </div>
                        </div>
                        <!-- input -->
                        <div class="d-flex profile-div-form w-75">
                            <div class="d-flex align-items-center font-weight-bolder finput-title enableEdit">Email :</div>
                            <div class="md-form input-with-pre-icon w-100 profile-input-forms mx-0">
                                <i class="fas fa-envelope input-prefix enableEdit"></i>
                                <input type="email" id="Input-Email" class="form-control inputToDisable validate mb-2" disabled>
                                <label for="Input-Email" data-error="wrong" data-success="right" class="pl-2">Email</label>
                            </div>
                        
                        </div> 
                    </form> 
                             
                </div>

                <div class="tab-pane fade" id="v-pills-change-password" role="tabpanel" aria-labelledby="v-pills-change-password-tab">
                                       
                    <form action="/password" method="post" class="mr-5 mb-0 pr-5 d-flex flex-column align-items-center">            
                        <!-- input -->
                        <div class="md-form w-50 m-0">
                            <i class="fas fa-unlock-alt prefix"></i>
                            <input type="password" id="Old-Password" class="form-control validate">
                            <label for="Old-Password" data-error="wrong" data-success="right">Old Password</label>
                            <span id="Icon-field" class="toggle-password position-absolute"><i id="EYEICON1" class="fa fa-fw fa-eye EYEICON"></i></span>
                        </div>
                        <!-- input -->
                        <div class="md-form w-50 m-0">
                            <i class="fas fa-lock prefix"></i>
                            <input type="password" id="New-Password" class="form-control validate">
                            <label for="New-Password" data-error="wrong" data-success="right">New Password</label>
                            <span id="Icon-field" class="toggle-password position-absolute"><i id="EYEICON2" class="fa fa-fw fa-eye EYEICON"></i></span>
                        </div>
                        <!-- input -->
                        <div class="md-form w-50 m-0">
                            <i class="fas fa-lock prefix"></i>
                            <input type="password" id="Confirm-Password" class="form-control validate">
                            <label for="Confirm-Password" data-error="wrong" data-success="right">Confirm Password</label>
                            <span id="Icon-field" class="toggle-password position-absolute"><i id="EYEICON3" class="fa fa-fw fa-eye EYEICON"></i></span>
                        </div>
                    </form>
                    
                    <div class="d-flex w-100 justify-content-center ml-5">
                        <button id="confirmeditID" class="text-center btn btn-sm edit-pass"><i class="fas fa-check"></i> Confirm</button>
                        <!-- <button id="canceleditID" class="text-center btn btn-sm cancel-pass mt-2"><i class="fas fa-times"></i> Cancel</button>            -->
                    </div>

                </div>

                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                    <div class="card m-3">
                        <div class="card-header py-1 px-2">
                            <h3 class="card-title m-0">Notification</h3>
                        </div>
                        <div class="card-body p-2">
                            <div class="badge badge-success">allowed</div>
                        </div>
                    </div>
                    <div class="card m-3">
                        <div class="card-header py-1 px-2">
                            <h3 class="card-title m-0">Newsletter</h3>
                        </div>
                        <div class="card-body p-2">
                            <div class="badge badge-secondary">Monthly</div>
                        </div>
                    </div>
                    <div class="card mx-3 mt-3 mb-0">
                        <div class="card-header py-1 px-2">
                            <h3 class="card-title m-0">Admin</h3>

                        </div>
                        <div class="card-body p-2">
                            <div class="badge badge-warning">yes</div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="v-pills-logout" role="tabpanel" aria-labelledby="v-pills-logout-tab">
                    <div class="card m-0">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold">Confirm Logout</h3>
                        </div>
                        <div class="card-body">
                            Do you really want to logout ?  
                            <a  href="#/" class="badge badge-success"><span >   Yes   </span></a>    
                            <a href="#/" class="badge badge-danger"> <span >  No   </span></a>
                        </div>
                        <form id="logout-form" action="#" method="POST" style="display: none;">
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

<footer>

</footer>
<!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.16.0/js/mdb.min.js"></script>


<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script type="text/javascript">

var toggleButton = [document.getElementsByClassName('toggle-button')[0], document.getElementsByClassName('toggle-button')[1]];
var navbarLinks = [document.getElementsByClassName('navbar-links')[0], document.getElementsByClassName('navbar-links')[1]];
var myStickyNavDiv = document.getElementById("stickyNavbar");
var myHeaderNavdiv = document.getElementById("HEADERNavbar");
var myNavBars = [myStickyNavDiv, myHeaderNavdiv];
var brandHeadActive = [document.getElementsByClassName('BrandFMA')[0], document.getElementsByClassName('BrandFMA')[1]];



toggleButton.forEach(element => {
    element.addEventListener('click', () => {
    toggleButton.forEach(item => {
        item.classList.toggle('open');
    });
    navbarLinks.forEach(item => {
        item.classList.toggle('active');
    });
    myNavBars.forEach(item => {
        item.classList.toggle('padding-border-botom');
    });
    brandHeadActive.forEach(item => {
    item.classList.toggle('BrandHeadActive');
    });
});
});

// SHOW STICKY NAVBAR

var myScrollFunc = function() {
  var y = window.scrollY;
  if (y >= 450) {
    myStickyNavDiv.classList.remove("hidesticky");
    myStickyNavDiv.classList.add("showsticky");
    // myStickyNavDiv.className = "MasterContainer stickyMenu showsticky";
  } else {
    myStickyNavDiv.classList.remove("showsticky");
    myStickyNavDiv.classList.add("hidesticky");
    // myStickyNavDiv.className = "MasterContainer stickyMenu hidesticky";
  }
};

window.addEventListener("scroll", myScrollFunc);

// PREVIEW IMAGE

function previewImage(event){
    var previewdImage = document.getElementById("modal-img-preview");
    previewdImage.src = URL.createObjectURL(event.target.files[0]);
    previewdImage.width = "200";
    previewdImage.height = "200";
}

// EDITPROFILE
var toggleEditInputBtn = document.getElementById("toggleEditProfile");
var EnableEditTxtStyle = document.querySelectorAll(".enableEdit");
var inputDisableToggle = document.querySelectorAll('.inputToDisable');

toggleEditInputBtn.addEventListener('click', () => {
    toggleEditInputBtn.classList.toggle('editbutn');
    toggleEditInputBtn.classList.toggle('editbutntoggled');
    inputDisableToggle.forEach(item => {
    if (toggleEditInputBtn.classList.contains("editbutn")) {
        item.setAttribute("disabled","");
    } else {
        item.removeAttribute("disabled","");
    }
    });
    EnableEditTxtStyle.forEach(item => {
        item.classList.toggle("enableEdit");
        item.classList.toggle("text-edit-style");

    });

});

// SHOW PASSWORD
var passOldVis = document.getElementById("Old-Password");
var passNewVis = document.getElementById("New-Password");
var passConfirmVis = document.getElementById("Confirm-Password");
var eyeIcon1 = document.getElementById("EYEICON1");
var eyeIcon2 = document.getElementById("EYEICON2");
var eyeIcon3 = document.getElementById("EYEICON3");

eyeIcon1.addEventListener('click', () => {

  if (passOldVis.type === "password") {
    passOldVis.type = "text";
    eyeIcon1.classList.remove("fa-eye");
    eyeIcon1.classList.add("fa-eye-slash");
    eyeIcon1.classList.add("eye-icon-gray");
  } else {
    passOldVis.type = "password";
    eyeIcon1.classList.remove("fa-eye-slash");
    eyeIcon1.classList.remove("eye-icon-gray");
    eyeIcon1.classList.add("fa-eye");
  }
});

eyeIcon2.addEventListener('click', () => {

    if (passNewVis.type === "password") {
    passNewVis.type = "text";
    eyeIcon2.classList.remove("fa-eye");
    eyeIcon2.classList.add("fa-eye-slash");
    eyeIcon2.classList.add("eye-icon-gray");
    } else {
    passNewVis.type = "password";
    eyeIcon2.classList.remove("fa-eye-slash");
    eyeIcon2.classList.remove("eye-icon-gray");
    eyeIcon2.classList.add("fa-eye");
    }
});

eyeIcon3.addEventListener('click', () => {

    if (passConfirmVis.type === "password") {
    passConfirmVis.type = "text";
    eyeIcon3.classList.remove("fa-eye");
    eyeIcon3.classList.add("fa-eye-slash");
    eyeIcon3.classList.add("eye-icon-gray");
    } else {
    passConfirmVis.type = "password";
    eyeIcon3.classList.remove("fa-eye-slash");
    eyeIcon3.classList.remove("eye-icon-gray");
    eyeIcon3.classList.add("fa-eye");
    }
});


</script>
</body>
</html>