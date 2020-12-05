<?php
session_start();

require('masterFile.php');

if(isset($_POST['do_login']))
{
    $req=$conn->prepare("SELECT * from user WHERE username = ? AND password = ?");
    $req->execute(array($_POST['username'], $_POST['password']));
    $data = $req->fetch();
    if ($req->rowCount() == 1) {

       $_SESSION['username']=$_POST['username'];
        $_SESSION["user_ID"]=$data['user_ID'];
        $_SESSION["status"]="success";
        $_SESSION["data"]=$data;
        header('Content-type: application/json');
        echo json_encode($_SESSION);
    } 
    exit ();
}

if (isset($_POST['register'])) {

    $sql = 'INSERT INTO user (first_name, last_name, age, address, email, username, password) 
    VALUES (?, ?, ?, ?, ?, ?, ?)';
    $req = $conn->prepare($sql);
    $req->execute(array($_POST['firstname'], $_POST['lastname'], $_POST['age'], $_POST['address'], $_POST['email'], $_POST['username'], $_POST['password']));
    header('Refresh:0');
    ?><script type='text/javascript'>
            alert('New account created successfully');
        </script>
    <?php
}
?>



<!DOCTYPE HTML>
<html>

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
     
    <title>Blog</title>
</head>

<body>
    <header>

        <span id="signedIn" style="display:none;"><?php signedIn(); ?></span>
        <span id="signedOut"><?php signedOut(); ?></span>

    </header>

    <main class='twentyMargin'>
        <article class='articleFade'>
            <h1>Welcome to OB Ranking</h1>
            <p>In this blog, all TV shows, animes and mangas I watched or read will be ranked
                based on how much I enjoyed them. <br> Feel free
                to like or comment your opinion on any of the rankings. </p>
        </article>

        <article class='articleFade'>
            <div class='pickDiv'>
                <h2 class='pick1'>Pick a category :</h2>
                <section class='pickSection pick2'><a class='pickA' href='tvshow.php'><span class='pickSpan'><img class='pickImage' loading='lazy' src='gameofthrones.jpg' alt=''></span>
                        <h3 class='pickTitle'>TV SHOW</h3>
                    </a></section>
                <section class='pickSection pick3'><a class='pickA' href='anime.php'><span class='pickSpan'><img class='pickImage' loading='lazy' src='onepunchman.jpg' alt=''></span>
                        <h3 class='pickTitle'>ANIME</h3>
                    </a></section>
                <section class='pickSection pick4'><a class='pickA' href='manga.php'><span class='pickSpan'><img class='pickImage' loading='lazy' src='vagabond.jpg' alt=''></span>
                        <h3 class='pickTitle'>MANGA</h3>
                    </a></section>
            </div>

        </article>

        <!-- sign in -->
        <div>
            <div class='loginCard modal fade' id='exampleModal'>
                <div class='d-flex justify-content-center h-100 modal-dialog'>
                    <div class='card modal-content'>
                        <div class='card-header modal-header'>
                            <h2 class='modal-title' id='signin'>Sign In</h2>
                        </div>
                        <div class='card-body modal-body'>
                            <form action='' method='post' onsubmit='return do_login();'>
                                <div class="mb-3" id="error" style='color:red; display: none;'>The username and/or password are incorrect.</div>
                                <div class='input-group form-group'>
                                    <div class='input-group-prepend'>
                                        <span class='input-group-text'><i class='fas fa-user'></i></span>
                                    </div>
                                    <input type='text' id='username' class='form-control' placeholder='username' name='username'>
                                    
                                </div>
                                <div class='input-group form-group'>
                                    <div class='input-group-prepend'>
                                        <span class='input-group-text'><i class='fas fa-key'></i></span>
                                    </div>
                                    <input type='password' id='password' class='form-control' placeholder='password' name='password'>
                                </div>
                                <div class='row align-items-center remember'>
                                    <input type='checkbox'>Remember Me
                                </div>
                                <div class='form-group'>
                                    <input type='submit' value='Login' class='btn float-right login_btn signin' name='login'>
                                    <button id="closeSignIn" type='button' class=' float-right mr-2 btn btn-secondary' data-dismiss='modal'>Close</button>
                                </div>
                            </form>
                        </div>
                        <div class='card-footer modal-footer'>
                            <div class='d-flex justify-content-center links'>
                                Don't have an account?<a id='signIn' href='#' data-toggle='modal' data-dismiss='modal' data-target='#exampleModal2'>Sign Up</a>
                            </div>
                            <div class='d-flex justify-content-center'>
                                <a href='#'>Forgot your password?</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- register -->
        <div>
            <div class='RegisterCard modal fade' id='exampleModal2'>
                <div class='d-flex justify-content-center modal-dialog'>
                    <div class='card modal-content'>
                        <div class='card-header modal-header'>
                            <h2 class='modal-title' id='signin'>Register</h2>
                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                        </div>
                        <div class='card-body modal-body'>
                            <form action='' method='post'>
                                <div class='input-group form-group'>
                                    <div class='input-group-prepend'>
                                        <span class='input-group-text'><i class='fas fa-user'></i></span>
                                    </div>
                                    <input type='text' class='form-control' placeholder='First Name' name='firstname'>

                                </div>
                                <div class='input-group form-group'>
                                    <div class='input-group-prepend'>
                                        <span class='input-group-text'><i class='fas fa-user'></i></span>
                                    </div>
                                    <input type='text' class='form-control' placeholder='Last Name' name='lastname'>

                                </div>
                                <div class='input-group form-group'>
                                    <div class='input-group-prepend'>
                                        <span class='input-group-text'><i class='fas fa-user'></i></span>
                                    </div>
                                    <input type='text' class='form-control' placeholder='Age' name='age'>

                                </div>
                                <div class='input-group form-group'>
                                    <div class='input-group-prepend'>
                                        <span class='input-group-text'><i class='fas fa-at'></i></span>
                                    </div>
                                    <input type='text' class='form-control' placeholder='Address' name='address'>

                                </div>
                                <div class='input-group form-group'>
                                    <div class='input-group-prepend'>
                                        <span class='input-group-text'><i class='fas fa-user'></i></span>
                                    </div>
                                    <input type='text' class='form-control' placeholder='Email' name='email'>

                                </div>
                                <div class='input-group form-group'>
                                    <div class='input-group-prepend'>
                                        <span class='input-group-text'><i class='fas fa-user'></i></span>
                                    </div>
                                    <input type='text' class='form-control' placeholder='username' name='username'>

                                </div>
                                <div class='input-group form-group'>
                                    <div class='input-group-prepend'>
                                        <span class='input-group-text'><i class='fas fa-key'></i></span>
                                    </div>
                                    <input type='password' class='form-control' placeholder='password' name='password'>
                                </div>
                                <div class='form-group'>
                                    <input type='submit' value='Sign Up' class='btn float-right login_btn signin' name='register'>
                                    <button type='button' class=' float-right mr-2 btn btn-secondary' data-dismiss='modal'>Close</button>
                                </div>
                            </form>
                        </div>
                        <div class='card-footer modal-footer'>
                            <div class='d-flex justify-content-center links'>
                                Already have an account?<a data-toggle='modal' data-dismiss='modal' data-target='#exampleModal' href='#'>Sign In</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
<script type="text/javascript">

        check_session();

    function do_logout(){
        
        $.ajax({
            url:'logout.php',
            method:'POST',
            success:function(){
            check_session();
            }
            
        });
    }

    function check_session(){
        $.ajax({
            url:'sessions.php',
            method:'POST',
            success:function(data){
                if(data!== 'unauthenticated') {
                    $("#signedIn").css({"display":"block"});
                    $("#signedOut").css({"display":"none"});
                    $("#error").css({"display":"none"});
                    $("#usernameLogout").html("You are currently logged in with :  "+data.username);
                    load_unseen_notification()
                } else{
                    $("#signedIn").css({"display":"none"});
                    $("#signedOut").css({"display":"block"});
                }
            }
        });
    }

    function do_login() {
            var username=$("#username").val();
            var password=$("#password").val();
            if(username!="" && password!="")
            {
            $.ajax
            ({
            type:'post',
            data:{
            do_login:"do_login",
            username:username,
            password:password
            },
            success:function(response) {
                if(response.status=="success") {
                    $("#exampleModal").modal("hide");
                    $(".modal-backdrop").css({"height":"0%", "width":"0%"});
                    check_session();
                } else {
                    $("#error").css({"display":"block"});
                }
                
            }
            });
            }

            else
            {
            alert("Please Fill All The Details");
            }

            return false;
    }
       
     function load_unseen_notification(){
        $.ajax({
            url:"fetch_notifications.php",
            method:"POST",
            dataType:"JSON",
            success:function(data){
                $('#notifications').html(data.notification);

                var notif_count = 0;
                $('.notif_status').each(function(){
                    if ($(this).val()==1) {
                        notif_count++;
                        $('#notif_count').html(notif_count);
                        $(this).parent().css({'border':'1px solid red'});
                        $('#notif_count').css({'display':'block'});
                    } else {
                        $(this).parent().css({'border':'none'});
                    }
                    
                    
                })
                load_unseen_report();
            }

        });
    }
            
    function clear_notif(){
        $.ajax({
            url:"clear_notif.php",
            method:"POST",
            success:function(data){
                $('#notif_count').css({'display':'none'});
            }
        });
    }

    function load_unseen_report(){
        $.ajax({
            
            url:"fetch_report.php",
            method:"POST",
            dataType:"JSON",
            
            success:function(data){
                $('#notifications').append(data.notification);

                var notif_count = 0;
                $('.notif_status').each(function(){
                    if ($(this).val()== 1) {
                        notif_count++;
                        $('#notif_count').html(notif_count);
                        $(this).parent().css({'border':'1px solid red'});
                        $('#notif_count').css({'display':'block'});
                    } else {
                        $(this).parent().css({'border':'none'});
                    }
                    
                    
                })
                
            }

        });
    }

    function clear_report(report_ID){
        event.preventDefault();
        $.ajax({
            url:"clear_report.php",
            method:"POST",
            data:({id:report_ID , status: 0}),
            dataType:"JSON",
            success:function(data){
                if (data=='success') {
                    alert('Report reviewed successfully.')
                    location.reload();
                }
                
            }
        });
    }

</script>


</body>

</html>