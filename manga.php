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
            <h1 class='mb-5'>Manga Ranking :</h1>
            <section>
                <h2>1. Kingdom</h2>
                <a target='_blank' href='https://myanimelist.net/manga/16765/Kingdom?q=kingdom'><img class='ranking' loading='lazy' src='kingdom.jpg' alt=''></a>
                <p><br> During the Warring States period in China, Li Xin and Piao are two brother-like youngsters who dream of becoming Great Generals, despite their low status as orphaned slaves. One day, they encounter a man of nobility, who gives Piao an opportunity to undertake an important duty within the state of Qin's royal palace. Parting ways, Xin and Piao promise each other to one day become the greatest generals in the world. However, after a fierce coup d'état occurs in the palace, Xin meets with a dying Piao, whose last words spur him into action and lead him to encounter the young and soon-to-be king of Qin, Ying Zheng. <br> <br>

                    Although initially on bad terms, Xin and Zheng become comrades and start on a path filled with trials and bloodshed. Zheng's objective is to bring all the warring states under Qin, and Xin seeks to climb to the very top of the army ranks. Against a backdrop of constant tactical battle between states and great political unrest, both outside and within the palace, the two endeavor towards their monumental ambitions that will change history forever.</p>
            </section>

            <section>
                <h2>2. Breaker</h2>
                <a target='_blank' href='https://myanimelist.net/manga/8586/The_Breaker'><img class='ranking' loading='lazy' src='thebreaker.png' alt=''></a>
                <p><br> Yi 'Shioon' Shi-Woon's everyday life at Nine Dragons High School—which consists of beatings from fellow student Ho Chang and his gang—is far from ideal. But one day, a mysterious man named Han Chun Woo spots one of these beatings and instead of offering support, brands Shioon a coward for refusing to fight back, adding insult to injury. To Shioon's surprise, he finds out that Chun Woo is the new substitute English teacher at his school. <br> <br>

                    Tired of the daily abuse, Shioon decides to enroll at a martial arts academy to learn how to defend himself. On the way there, he stumbles upon Chun Woo in a predicament—cornered in an alley by a group of angry men! Provoked, Chun Woo suddenly dispatches them using martial arts techniques, which Shioon covertly records. Later, he uses this recording to blackmail Chun Woo into teaching him to defend himself. Reluctantly, Chun Woo agrees, and Shioon is soon thrust into the world of martial arts, known as Murim. However, Shioon is naive and unaware of his master's shady past and the unseen underbelly of society. How will Chun Woo manage to teach Shioon and help him survive in the world of Murim?</p>
            </section>

            <section>
                <h2>3. Vagabond</h2>
                <a target='_blank' href='https://myanimelist.net/manga/656/Vagabond'><img class='ranking' loading='lazy' src='vagabond1.jpg' alt=''></a>
                <p><br> In 16th century Japan, Shinmen Takezou is a wild, rough young man, in both his appearance and his actions. His aggressive nature has won him the collective reproach and fear of his village, leading him and his best friend, Matahachi Honiden, to run away in search of something grander than provincial life. The pair enlist in the Toyotomi army, yearning for glory—but when the Toyotomi suffer a crushing defeat at the hands of the Tokugawa Clan at the Battle of Sekigahara, the friends barely make it out alive. <br> <br>

                    After the two are separated, Shinmen returns home on a self-appointed mission to notify the Hon'iden family of Matahachi's survival. He instead finds himself a wanted criminal, framed for his friend's supposed murder based on his history of violence. Upon being captured, he is strung up on a tree and left to die. An itinerant monk, the distinguished Takuan Soho, takes pity on the 'devil child,' secretly freeing Shinmen and christening him with a new name to avoid pursuit by the authorities: Musashi Miyamoto. <br> <br>

                    Vagabond is the fictitious retelling of the life of one of Japan's most renowned swordsmen, the 'Sword Saint' Musashi Miyamoto—his rise from a swordsman with no desire other than to become 'Invincible Under the Heavens' to an enlightened warrior who slowly learns of the importance of close friends, self-reflection, and life itself.</p>
            </section>

            <section>
                <h2>4. One Piece</h2>
                <a target='_blank' href='https://myanimelist.net/manga/13/One_Piece?q=one%20piece'><img class='ranking' loading='lazy' src='one piece.jpg' alt=''></a>
                <p><br> Gol D. Roger, a man referred to as the 'Pirate King,' is set to be executed by the World Government. But just before his demise, he confirms the existence of a great treasure, One Piece, located somewhere within the vast ocean known as the Grand Line. Announcing that One Piece can be claimed by anyone worthy enough to reach it, the Pirate King is executed and the Great Age of Pirates begins. <br> <br>

                    Twenty-two years later, a young man by the name of Monkey D. Luffy is ready to embark on his own adventure, searching for One Piece and striving to become the new Pirate King. Armed with just a straw hat, a small boat, and an elastic body, he sets out on a fantastic journey to gather his own crew and a worthy ship that will take them across the Grand Line to claim the greatest status on the high seas.</p>
            </section>

            <section>
                <h2>5. Bokko</h2>
                <a target='_blank' href='https://myanimelist.net/manga/2109/Bokkou'><img class='ranking' loading='lazy' src='bokko.jpg' alt=''></a>
                <p><br> The story takes place 2300 years ago in China. The town of Ryo has requested the help of a clan called Bokk to aide them as their town is facing attack. The Bokk clan's representative, Kakuri, responds to their call for help and attempts to save Ryo from an almost inevitable defeat, from not only outer forces, but also from those who doubt him within. Is he up to the challenge?</p>
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
    var comment_count=0;

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
            url:"fetch_comment_manga.php",
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
            url:"add_comment_manga.php",
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
            data:({id:report_ID , status:0}),
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