<?php session_start();

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
            <h1 class='mb-5'>Anime Ranking :</h1>
            <section>
                <h2>1. One Punch Man</h2>
                <a target="_blank" href="https://myanimelist.net/anime/30276/One_Punch_Man?q=one%20punch"><img class="ranking" loading='lazy' id="king" src="king.jpg" alt=""></a>
                <p><br> The seemingly ordinary and unimpressive Saitama has a rather unique hobby: being a hero. In order to pursue his childhood dream, he trained relentlessly for three years—and lost all of his hair in the process. Now, Saitama is incredibly powerful, so much so that no enemy is able to defeat him in battle. In fact, all it takes to defeat evildoers with just one punch has led to an unexpected problem—he is no longer able to enjoy the thrill of battling and has become quite bored. <br> <br>

                    This all changes with the arrival of Genos, a 19-year-old cyborg, who wishes to be Saitama's disciple after seeing what he is capable of. Genos proposes that the two join the Hero Association in order to become certified heroes that will be recognized for their positive contributions to society, and Saitama, shocked that no one knows who he is, quickly agrees. And thus begins the story of One Punch Man, an action-comedy that follows an eccentric individual who longs to fight strong enemies that can hopefully give him the excitement he once felt and just maybe, he'll become popular in the process.</p>
            </section>

            <section>
                <h2>2. Overlord</h2>
                <a target="_blank" href="https://myanimelist.net/anime/29803/Overlord?q=overlord"><img class="ranking" loading='lazy' src="overlord.png" alt=""></a>
                <p><br> The final hour of the popular virtual reality game Yggdrasil has come. However, Momonga, a powerful wizard and master of the dark guild Ainz Ooal Gown, decides to spend his last few moments in the game as the servers begin to shut down. To his surprise, despite the clock having struck midnight, Momonga is still fully conscious as his character and, moreover, the non-player characters appear to have developed personalities of their own! <br> <br>

                    Confronted with this abnormal situation, Momonga commands his loyal servants to help him investigate and take control of this new world, with the hopes of figuring out what has caused this development and if there may be others in the same predicament.</p>
            </section>

            <section>
                <h2>3. Hunter X Hunter</h2>
                <a target="_blank" href="https://myanimelist.net/anime/11061/Hunter_x_Hunter_2011?q=hunter"><img class="ranking" loading='lazy' src="hxh.jpg" alt=""></a>
                <p><br> Hunter x Hunter is set in a world where Hunters exist to perform all manner of dangerous tasks like capturing criminals and bravely searching for lost treasures in uncharted territories. Twelve-year-old Gon Freecss is determined to become the best Hunter possible in hopes of finding his father, who was a Hunter himself and had long ago abandoned his young son. However, Gon soon realizes the path to achieving his goals is far more challenging than he could have ever imagined. <br> <br>

                    Along the way to becoming an official Hunter, Gon befriends the lively doctor-in-training Leorio, vengeful Kurapika, and rebellious ex-assassin Killua. To attain their own goals and desires, together the four of them take the Hunter Exam, notorious for its low success rate and high probability of death. Throughout their journey, Gon and his friends embark on an adventure that puts them through many hardships and struggles. They will meet a plethora of monsters, creatures, and characters—all while learning what being a Hunter truly means.</p>
            </section>

            <section>
                <h2>4. Death Note</h2>
                <a target="_blank" href="https://myanimelist.net/anime/1535/Death_Note"><img class="ranking" loading='lazy' src="deathnote.jpg" alt=""></a>
                <p><br> A shinigami, as a god of death, can kill any person—provided they see their victim's face and write their victim's name in a notebook called a Death Note. One day, Ryuk, bored by the shinigami lifestyle and interested in seeing how a human would use a Death Note, drops one into the human realm. <br> <br>

                    High school student and prodigy Light Yagami stumbles upon the Death Note and—since he deplores the state of the world—tests the deadly notebook by writing a criminal's name in it. When the criminal dies immediately following his experiment with the Death Note, Light is greatly surprised and quickly recognizes how devastating the power that has fallen into his hands could be. <br> <br>

                    With this divine capability, Light decides to extinguish all criminals in order to build a new world where crime does not exist and people worship him as a god. Police, however, quickly discover that a serial killer is targeting criminals and, consequently, try to apprehend the culprit. To do this, the Japanese investigators count on the assistance of the best detective in the world: a young and eccentric man known only by the name of L.</p>
            </section>

            <section>
                <h2>5. Vinland Saga</h2>
                <a target="_blank" href="https://myanimelist.net/anime/37521/Vinland_Saga?q=vinland%20saga"><img class="ranking" loading='lazy' src="vinlandsaga.jpg" alt=""></a>
                <p><br> Young Thorfinn grew up listening to the stories of old sailors that had traveled the ocean and reached the place of legend, Vinland. It's said to be warm and fertile, a place where there would be no need for fighting—not at all like the frozen village in Iceland where he was born, and certainly not like his current life as a mercenary. War is his home now. Though his father once told him, "You have no enemies, nobody does. There is nobody who it's okay to hurt," as he grew, Thorfinn knew that nothing was further from the truth. <br> <br>

                    The war between England and the Danes grows worse with each passing year. Death has become commonplace, and the viking mercenaries are loving every moment of it. Allying with either side will cause a massive swing in the balance of power, and the vikings are happy to make names for themselves and take any spoils they earn along the way. Among the chaos, Thorfinn must take his revenge and kill the man who murdered his father, Askeladd. The only paradise for the vikings, it seems, is the era of war and death that rages on.</p>
            </section>


            <!-- <section>
                <h2></h2>
                <a target="_blank" href=""><img class="ranking" src="" alt=""></a>
                <p><br> </p>
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
                        <input type="hidden" id="articleID" value="2" name="article_ID">
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
    var comment_count= 0;
        
    load_comment();

    

    function do_logout(){
        
        $.ajax({
            url:'logout.php',
            method:'POST',
            success:function(){
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
            url:"fetch_comment_anime.php",
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
            url:"add_comment_anime.php",
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