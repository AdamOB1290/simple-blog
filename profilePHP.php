<?php session_start();

require("masterFile.php");    

if (!isset($_SESSION["user_ID"])) {
    header("blogHome.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link href='blog.css' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans+Condensed:wght@400;500;900&display=swap" rel="stylesheet">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.3.1/css/all.css' integrity='sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU' crossorigin='anonymous'>
    <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' integrity='sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh' crossorigin='anonymous'>
    <script src='//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <title>Profile</title>
</head>

<body>
    <header>
        <span id="signedIn"><?php signedIn(); ?></span>
        
    </header>
    <main id="profileMargin">
        <article id='profileArticle'>
        <!-- Modal -->
        <div id="uploadModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content card">            
                    <form method='post' action='upload.php' enctype="multipart/form-data">
                        <div class="modal-header">
                            <h2 class="modal-title" style="text-align:center;" id="signin">Profile Image Upload</h2>
                        </div> 
                        <div class="modal-body">
                            <!-- Form -->
                        
                            <div class="d-flex justify-content-center mt-2 mb-0"><p class='pt-1'>Select file :</p> <input type="file" name="filePFP" onchange="previewImage(event)" id='file' class="text-center center-block file-upload form-control" accept="image/*"></div><br> 
                            <!-- Preview-->
                            <div id="preview" class="d-flex justify-content-center mt-0">
                                
                                <img src="" width="0" height="0" id="modal-img-preview">
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" name="submitPFP" value="Upload image" id='submit_upload' class="btn upload_btn">                                                 
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="container mx-md-0 mw-100">

            <div class="row">

                <div class="col-md-3 ">
                    <div class="row">
                        <form method="POST" action="?" enctype="multipart/form-data">
                            <div class="pfpparentdiv">
                                <div style='color:white;' class="text-center pfpdiv">
                                    <img src="uploads/pfp_icon.png" class="pfp">                                    
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
                        
                        <button id="toggleEditProfile" onclick="enable()" style='color:white;' class="text-center btn btn-sm editbutn red_background"><i class="far fa-edit"></i> Edit</button>
                        <button id="canceleditID" onclick="cancel()" style='color:white;' class="d-flex justify-content-center align-items-center text-center btn btn-sm canceledit mt-2"><i class="fas fa-times"></i></button>

                        <form class="form" action="" method="post" id="registrationForm" onsubmit="return do_update();">
                        <input type="hidden" name="user_ID" value="<?php echo $_SESSION['user_ID']; ?>">
                            <button id="confirmeditID" type="submit" name="update" style='color:white;' class="text-center btn btn-sm confirmedit mt-2"><i class="fas fa-check"></i></button>
                            <!-- input -->
                            <div class="d-inline-block profile-div-form mr-2">
                                <div class="d-flex">
                                    <i class="d-flex align-items-center fas fa-id-badge input-prefix enableEdit"><div class="ml-1 font-weight-bolder finput-title enableEdit">First name :</div></i>
                                    <div class="md-form input-with-pre-icon profile-input-forms mx-0">
                                        <input type="text" id="first-name" class="form-control inputToDisable d-flex align-items-center" placeholder="First Name" disabled>
                                    </div>
                                </div>
                            </div>
                            <!-- input -->
                            <div class="d-inline-block profile-div-form">
                                <div class="d-flex">
                                    <i class="d-flex align-items-center fas fa-id-card input-prefix enableEdit"><div class="ml-1 font-weight-bolder finput-title enableEdit">Last name :</div></i>
                                    <div class="md-form input-with-pre-icon profile-input-forms mx-0">
                                        <input type="text" id="last-name" class="form-control inputToDisable" placeholder="Last name" disabled>
                                    </div>
                                </div>
                            </div>
                            <!-- input -->
                            <div class="d-inline-block profile-div-form mr-2">
                                <div class="d-flex">
                                    <i class="d-flex align-items-center fas fa-user input-prefix enableEdit"><div class="ml-1 font-weight-bolder finput-title enableEdit">Username :</div></i> 
                                    <div class="md-form input-with-pre-icon profile-input-forms mx-0">
                                        <input type="text" id="username" class="form-control inputToDisable" placeholder="Username" disabled>
                                    </div>
                                </div>
                            </div>
                            <!-- input -->
                            <div class="d-inline-block profile-div-form">
                                <div class="d-flex">
                                    <i class="d-flex align-items-center fas fa-birthday-cake input-prefix enableEdit"><div class="ml-2 font-weight-bolder enableEdit">Age :</div></i>
                                    <div class="md-form input-with-pre-icon profile-input-forms mx-0">
                                        <input type="number" id="age" class="form-control inputToDisable" placeholder="Age" disabled>
                                    </div>
                                </div>
                            </div>
                            <!-- input -->
                            <div class="d-flex profile-div-form w-75">
                                <i class="d-flex align-items-center fas fa-map-marker-alt input-prefix enableEdit"><div class="font-weight-bolder finput-title enableEdit" id="address">Address :</div></i>
                                <div class="md-form input-with-pre-icon w-100 profile-input-forms mx-0">
                                    <input type="text" id="Address" name="address" class="form-control inputToDisable" placeholder="Address" disabled>
                                </div>
                            </div>
                            <!-- input -->
                            <div class="d-flex profile-div-form w-75">
                                <i class="d-flex align-items-center fas fa-envelope input-prefix enableEdit"><div class="font-weight-bolder finput-title enableEdit" id="email">Email :</div></i>
                                <div class="md-form input-with-pre-icon w-100 profile-input-forms mx-0">
                                    <input type="email" id="Email" name="email" class="form-control inputToDisable validate mb-2" placeholder="Email" disabled>
                                </div>
                            
                            </div> 
                        </form> 
                                
                    </div>

                    <div class="tab-pane fade" id="v-pills-change-password" role="tabpanel" aria-labelledby="v-pills-change-password-tab">
                                        
                        <form action="" id='update_password' onsubmit='return update_password();' method="post" class="d-flex flex-column align-items-center">     
                        <span id="pass_update_error"></span>    
                        <button type='button' onmousedown='show_pass()' onmouseup='show_pass()' id="Icon-field" class="toggle-password"> <div id='show_pass'>Show</div>  <i id="EYEICON" class="fa fa-fw fa-eye EYEICON"></i></button>  
                            <!-- input -->
                            <div class="md-form w-50 m-0">
                                <input type="password" id="Old-Password" name='old_pass' class="form-control validate pass">
                                <i class="fas fa-unlock-alt prefix enableEdit"><label for="Old-Password" data-error="wrong" data-success="right" class="ml-2 font-weight-bolder enableEdit">Old Password</label></i>
                            </div>
                            <!-- input -->
                            <div class="md-form w-50 m-0">
                                <input type="password" id="New-Password" name='new_pass' class="form-control validate pass">
                                <i class="fas fa-lock prefix enableEdit"><label for="New-Password" data-error="wrong" data-success="right" class="ml-2 font-weight-bolder enableEdit">New Password</label></i>
                            </div>
                            <!-- input -->
                            <div class="md-form w-50 m-0">
                                
                                <input type="password" id="Confirm-Password" name='confirmed_pass' class="form-control validate pass">
                                <i class="fas fa-lock prefix enableEdit"><label for="Confirm-Password" data-error="wrong" data-success="right" class="ml-2 font-weight-bolder enableEdit">Confirm New Password</label></i>
                            </div>
                            <div class="d-flex w-100 justify-content-center ml-5">
                            <input type="hidden" name="user_ID" value="<?php echo $_SESSION['user_ID']; ?>">
                            <button type='submit' class="text-center red_background btn btn-sm edit-pass mt-3 mr-5 mb-3"><i class="fas fa-check"></i> Update Password</button>
                            <!-- <button id="canceleditID" class="text-center btn btn-sm cancel-pass mt-2"><i class="fas fa-times"></i> Cancel</button>            -->
                            </div>
                        </form>
                        
                        

                    </div>

                    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                        <div class="settings">
                            <div class="card-header py-1 px-2">
                                <h3 class="card-title m-0">Notification</h3>
                            </div>
                            <div class="card-body p-2">
                                <div class="badge" style="background-color:green">allowed</div>
                            </div>
                        </div>
                        <div class="settings">
                            <div class="card-header py-1 px-2">
                                <h3 class="card-title m-0">Newsletter</h3>
                            </div>
                            <div class="card-body p-2">
                                <div class="badge badge-secondary">Monthly</div>
                            </div>
                        </div>
                        <div class="settings">
                            <div class="card-header py-1 px-2">
                                <h3 class="card-title m-0 p-2">Account Permission:</h3>

                            </div>
                            <div class="card-body p-2">
                                <div id="admin_badge" class="badge"></div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="v-pills-logout" role="tabpanel" aria-labelledby="v-pills-logout-tab">
                        <div class="settings mt-5">
                            <div class="card-header">
                                <h3 class="card-title font-weight-bold">Confirm Logout</h3>
                            </div>
                            
                            <form id="logout-form" action="" method="POST" onsubmit='return do_logout();'>
                                <div class="card-body">
                                    Do you really want to logout ?  
                                    <input type='submit' class="badge badge-success mr-2" name='logout' value='Yes'>
                                    <a href="profilePHP.php" class="badge badge-danger ml-2"> <span >  No   </span></a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        </article>

        <!-- sign out -->
        <div>
            <div class='loginCard modal fade' id='exampleModal3'>
                <div class='d-flex justify-content-center h-100 modal-dialog'>
                    <div class='card modal-content'>
                        <div class='card-header modal-header'>
                            <h2 class='modal-title' id='signin'>Are you sure you want to sign out ?</h2>
                        </div>
                        <div class='card-body modal-body'>
                            <p id="usernameLogout" style='color:white;'></p>
                        </div>
                        <div class='card-footer modal-footer'>
                            <div class='d-flex justify-content-center links'>
                                <form action='' method='post' onsubmit='return do_logout();'>
                                    <input id='signOut' type='submit' name='logout' value='Log out'>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

<footer>

</footer>

<script>
    check_session();
    function check_session(){
        $.ajax({
            url:'refresh_profile.php',
            method:'POST',
            success:function(data){
                if(data!== '0') {
                    $("#usernameLogout").html("You are currently logged in with :  "+data.data.username);
                    $('#first-name').attr('placeholder', data.data.first_name);
                    $('#last-name').attr('placeholder', data.data.last_name);
                    $('#username').attr('placeholder', data.data.username);
                    $('#age').attr('placeholder', data.data.age);
                    $('#Address').attr('placeholder', data.data.address);
                    $('#Email').attr('placeholder', data.data.email);
                    var imgSrc = 'uploads/'+data.data.image;
                    $('.pfp').attr('src', imgSrc);
                    if(data.data.role=='admin'){
                        $('#admin_badge').css({'backgroundColor':'Orange', 'padding':'5px 10px', 'fontSize':'15px'});
                        $('#admin_badge').html('Admin');
                        
                    }else{
                        $('#admin_badge').css({'backgroundColor':'Green', 'padding':'5px 10px', 'fontSize':'15px'});
                        $('#admin_badge').html(' User ');
                    }
                    
                } else{
                    alert("Failed to load profile information.");
                    window.location.replace('blogHome.php');
                }
            }
        });
    }

    function do_logout(){
        
        $.ajax({
            url:'logout.php',
            method:'POST',
            success:function(){
                window.location.replace("blogHome.php");

            }
        });
    }

    function enable(){
        // document.getElementById("first-name").disabled = false;
        // document.getElementById("last-name").disabled = false;
        // document.getElementById("username").disabled = false;
        // document.getElementById("age").disabled = false;
        document.getElementById("Address").disabled = false;
        $("#Address").attr('placeholder','');
        document.getElementById("Email").disabled = false;
        $("#Email").attr('placeholder','');
        document.getElementById("toggleEditProfile").style.display='none';
    }

    function cancel(){
        // document.getElementById("first-name").disabled = true;
        // document.getElementById("last-name").disabled = true;
        // document.getElementById("username").disabled = true;
        // document.getElementById("age").disabled = true;
        document.getElementById("Address").disabled = true;
        document.getElementById("Email").disabled = true;
        document.getElementById("toggleEditProfile").style.display='inline-block';
        check_session();
    }

    function do_update() {
            event.preventDefault();
        var form_data = $('#registrationForm').serialize();
        $.ajax({
            url:"update_profile.php",
            method:"POST",
            data:form_data,
            dataType:"JSON",
            success:function(success)
            {
                $('#Address').val('');
                $('#Email').val('');
                cancel();
            }
        })
    }

    function previewImage(event){
        var previewdImage = document.getElementById("modal-img-preview");
        previewdImage.src = URL.createObjectURL(event.target.files[0]);
        previewdImage.width = "200";
        previewdImage.height = "200";
    }

    function update_password() {
            event.preventDefault();
        var form_data = $('#update_password').serialize();
        $.ajax({
            url:"update_password.php",
            method:"POST",
            data:form_data,
            dataType:"JSON",
            success:function(success)
            {
                $('#pass_update_error').html(success.error);
                $('#Old-Password').val('');
                $('#New-Password').val('');
                $('#Confirm-Password').val('');
            }
        })
    }

    function show_pass() {
        $('.pass').each(function(){
            $type=$(this).attr('type');
        if ($type === "password") {
            $(this).attr('type','text');
        } else {
            $(this).attr('type','password');
        }
        })
    }

    
</script>

</body>
</html>