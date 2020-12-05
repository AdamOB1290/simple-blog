<?php 
session_start();

require('masterFile.php');

if(isset($_POST['do_login']))
{
    $req=$conn->prepare("SELECT * from user WHERE username = ? AND password = ?");
    $req->execute(array($_POST['username'], $_POST['password']));
    $data = $req->fetch();
    if ($req->rowCount() == 1) {
        $_SESSION["username"]=$_POST['username'];
        $_SESSION["user_ID"]=$data['user_ID'];
        $_SESSION["status"]="success";
        $_SESSION["role"]=$data['role'];
        $_SESSION["email"]=$data['email'];
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
        <div id="nav_filer"></div>
        <div id="signedIn" style="display:none"><?php signedIn(); ?></div>
        <div id="signedOut" style="display:none"><?php signedOut(); ?></div>
        
    </header>

    <main class='twentyMargin'>
        <article>
            <h1 class='mb-5'>TV Show Ranking :</h1>
            <section>
                <h2>1. Breaking Bad</h2>
                <a target="_blank" href="https://www.imdb.com/title/tt0903747/?pf_rd_m=A2FGELUUNOQJNL&pf_rd_p=12230b0e-0e00-43ed-9e59-8d5353703cce&pf_rd_r=3YFSPB8YDQFBJRDS80SG&pf_rd_s=center-1&pf_rd_t=15506&pf_rd_i=toptv&ref_=chttvtp_tt_4"><img class="ranking" loading='lazy' src="breakingbad.jpg" alt=""></a>
                <p>A high school chemistry teacher diagnosed with inoperable lung cancer turns to manufacturing and selling methamphetamine in order to secure his family's future.</p>
            </section>

            <section>
                <h2>2. Game Of Thrones</h2>
                <a target="_blank" href="https://www.imdb.com/title/tt0944947/?ref_=nv_sr_srsg_0"><img class="ranking" loading='lazy' src="gameofthrones1.jpg" alt=""></a>
                <p>Nine noble families fight for control over the lands of Westeros, while an ancient enemy returns after being dormant for millennia.</p>
            </section>

            <section>
                <h2>3. Narcos</h2>
                <a target="_blank" href="https://www.imdb.com/title/tt2707408/?ref_=nv_sr_srsg_0"><img class="ranking" loading='lazy' src="narcos.jpg" alt=""></a>
                <p>A chronicled look at the criminal exploits of Colombian drug lord Pablo Escobar, as well as the many other drug kingpins who plagued the country through the years.</p>
            </section>

            <section>
                <h2>4. Gomorrah</h2>
                <a target="_blank" href="https://www.imdb.com/title/tt2049116/?ref_=fn_al_tt_1"><img class="ranking" loading='lazy' src="gomorrah.jpg" alt=""></a>
                <p>Ciro disregards tradition in his attempt to become the next boss of his crime syndicate. The internal power struggle puts him and his entire family's life at risk.</p>
            </section>

            <section>
                <h2>5. The Shield</h2>
                <a target="_blank" href="https://www.imdb.com/title/tt0286486/?ref_=nv_sr_srsg_0"><img class="ranking" loading='lazy' src="theshield.jpg" alt=""></a>
                <p>Follows the lives and cases of a dirty Los Angeles Police Department cop and the unit under his command.</p>
            </section>


            <!-- <section>
                <h2></h2>
                <a target="_blank" href=""><img class="ranking" src="" alt=""></a>
                <p></p>
            </section> -->

        </article>

        <article>
            <!-- Comment section -->
            <div id='comment-margin'>

                <!-- comments section -->
                <div style="display: none;" id="text-area" class=" comments-section">
                    <!-- comment form -->
                    <form class="clearfix comment_form0" action="" method="post" id="comment_form" onsubmit='return post_reply(0);'>
                        <h4 class='gray'>Post a comment:</h4>
                        <span id="comment_message"></span>
                        <input type="hidden" class="parentID" value="0" name="parent_ID">
                        <input type="hidden" class="userID" value="" name="user_ID">
                        <input type="hidden" id="articleID" value="1" name="article_ID">
                        <textarea id="comment_content" type="text" name="comment_content" cols="40" rows="5" class="comment_text form-control" placeholder="What are your thoughts ?"></textarea>
                        <input type="submit" id="submit_comment" value="Submit comment" name="submitComment">
                    </form>
                    <span id='empty_comment' class='text-danger'></span>
                </div>

                
                    <div id="links" class=' links'>
                        <p style="padding-bottom:10px; margin-bottom: 0px;">To leave a comment, please <a data-toggle='modal' data-dismiss='modal' data-target='#exampleModal' href='#'> Sign In</a> .</p> 
                        <p style="padding-top:10px; margin-top:0px;">Don't have an account? <a id='signIn' href='#' data-toggle='modal' data-dismiss='modal' data-target='#exampleModal2'> Sign Up</a> .</p> 
                         
                    </div>
                

                <div>

                    <!-- Display total number of comments on this post  -->
                    <p class='gray'><span id="comment_count">0</span> Comment(s)</p>
                    <hr>
                    <!-- comments wrapper -->
                    <div id="comments-wrapper">
                        <div id="comment_section" class="comment clearfix">
                                   
                             

                        </div>
                    </div>
                    <!-- // comments wrapper -->
                </div>
                <!-- // comments section -->
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
    load_comment();

    function do_logout(){
        
        $.ajax({
            url:'logout.php',
            method:'POST',
            success:function(){
                load_comment();
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
                    $("#nav_filer").css({"display":"none"});
                    $("#error").css({"display":"none"});
                    $("#usernameLogout").html("You are currently logged in with :  "+data.username);
                    $("#text-area").css({"display":"block"});
                    $("#links").css({"display":"none"});
                    $(".userID").val(data.user_ID);
                    $('.comment_buttons').css({'display':'inline-block'});
                    if (data.data.role=='admin') {
                        $('.to_show').css({'display':'inline-block'});
                        $('.to_report').css({'display':'none'});
                    } else if ( data.data.role =='user'){
                        $('.comment_buttons').each( function(){
                            var userID = $(this).find('#user_comment_ID').val();

                            if(data.user_ID==userID){
                                $(this).find('.to_show').css({'display':'inline-block'});
                                $(this).find('.to_report').css({'display':'none'});
                            }else{
                                $(this).find('.to_show').css({'display':'none'});
                            }

                        })
                    } 
                    $('.comment_deleted').each(function(){
                        if ($(this).val()==1) {
                            $(this).parent().css({'display':'none'});
                        }
                    })
                    
                    
                } else {
                        $('.comment_buttons').css({'display':'none'});
                        $('.to_show').css({'display':'none'});
                        $("#signedIn").css({"display":"none"});
                        $("#signedOut").css({"display":"block"});
                        $("#nav_filer").css({"display":"none"});
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
                    load_comment();
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

    function load_comment() {
            $.ajax({
            url:"fetch_comment_tvshow.php",
            method:"POST",
            success:function(data)
            {
                check_session();
                $('#comment_section').html(data);
                
                comment_count=0;
                $('.comment-details').each(function(){
                    comment_count++;
                })
                $('#comment_count').html(comment_count);
                
                $('.comment_buttons').each( function(){
                    var user_role = $(this).find('#user_role').val();

                    if(user_role=='admin'){
                        $(this).siblings('.admin_tag').html('admin');
                        $(this).siblings('.comment-name').css({'backgroundColor':'orange'})
                    } else {
                        $(this).siblings('.admin_tag').html('');
                    }
                })
                load_unseen_notification();
            }
            })
    }

    function post_reply(commentID){
        event.preventDefault();
        var form_data = $('.comment_form'+commentID).serialize();
        $.ajax({
            url:"add_comment_tvshow.php",
            method:"POST",
            data:form_data,
            dataType:"JSON",
            success:function(data)
            {
                if(data.error != '')
                {
                    $('.comment_form'+commentID)[0].reset();
                    $('#comment_message').html(data.error);
                    load_comment();
                }
            }
        })
    }

    function do_delete(commentID){
        event.preventDefault();
        var form_data = $('.delete'+commentID).serialize();
        $.ajax({
            url:"delete_comment.php",
            method:"POST",
            data:form_data,
            dataType:"JSON",
            success:function(data)
            {
                if(data.error != '')
                {
                    $("#exampleModal").modal("hide");
                    $(".modal-backdrop").css({"height":"0%", "width":"0%"});
                    $(".modal-open").css({"overflow":"visible"});
                    $('#comment_message').html(data.error);
                    load_comment();
                }
            }
        })
    }

    function do_update(commentID) {
            event.preventDefault();
        var form_data = $('.update'+commentID).serialize();
        $.ajax({
            url:"edit_comment_tvshow.php",
            method:"POST",
            data:form_data,
            dataType:"JSON",
            success:function(data)
            {
                if(data.error != '')
                {
                    $("#exampleModal").modal("hide");
                    $(".modal-backdrop").css({"height":"0%", "width":"0%"});
                    $(".modal-open").css({"overflow":"visible"});
                    $('#comment_message').html(data.error);
                    load_comment();
                    
                }
            }
        })
    }

    function do_report(commentID){
        event.preventDefault();
        var form_data = $('.report'+commentID).serialize();
        $.ajax({
            url:"report_comment.php",
            method:"POST",
            data:form_data,
            dataType:"JSON",
            success:function(data)
            {  
            
            $(".modal").removeAttr("style").hide();
            $(".modal-backdrop").css({"height":"0%", "width":"0%"});
            $(".modal-open").css({"overflow":"visible"});
            alert(data);
            
            }
        })
    }

    function load_unseen_notification(){
        $.ajax({
            url:"fetch_notifications.php",
            method:"POST",
            dataType:"JSON",
            success:function(data){
                console.log('notif', data);
                load_unseen_report(data.notification);
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

    function load_unseen_report(parameter){
        $.ajax({
            
            url:"fetch_report.php",
            method:"POST",
            dataType:"JSON",
            
            success:function(data){
                console.log('report',data);
                var notif= parameter+data.notification;
                $('#notifications').html(notif);

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

    $(document).ready(function() {
        <?php if (isset($_GET['comment_ID'])) {?>
        var commentId = <?php echo $_GET['comment_ID']?>;
        setTimeout(function(){
            $('#'+commentId).addClass("highlight");
        setTimeout(function () {
            $('#'+commentId).removeClass('highlight');
        }, 5000);

            
            $('html, body').animate({scrollTop:$('#'+commentId).position().top - $(window).height()/2 + ($('#'+commentId).height()/2)}, 'slow');
        }, 500);        
        <?php } ?>
    });
    </script>

</body>

</html>