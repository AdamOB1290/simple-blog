<?php

require('masterFile.php');

$error = '';

$loggedin = '';



if (isset($_POST['login'])) {
    $req = $conn->prepare('select * from user where username = ? and password = ?');
    $req->execute(array($_POST['username'], $_POST['password']));
    $data = $req->fetch();
    if ($req->rowCount() == 1) {
        session_start();
        $_SESSION['userID'] = $data['user_ID'];
        $user_ID = $_SESSION['userID'];
        $loggedin = $_POST['username'];
    } else {
        $error = 'Access Forbiden';
    }
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

// comments


if (isset($_POST['submit_comment'])) {
    if (isset($_SESSION['userID'])) {
        $sql = 'INSERT INTO comments (post, user_ID) VALUES (?,?)';
        $request = $conn->prepare($sql);
        $request->execute(array($_POST['comment_text'], $_SESSION['userID']));
        
    }
}



if (isset($_POST['delete_comment'])) {
    $sql = 'DELETE FROM comments WHERE id=?';
    $req = $conn->prepare($sql);
    $req->execute(array($_POST['comment_ID']));
    header('Refresh:0');
}

if (isset($_POST['update_comment'])) {

    $sql = 'UPDATE comments SET post=? WHERE id=?';
    $req = $conn->prepare($sql);
    $req->execute(array($_POST['updated_comment'], $_POST['id']));
    header('Refresh:0');
}

if (isset($_POST['submit_reply'])) {

    $sql = 'INSERT INTO comments (post, user_ID, parent) VALUES (?,?,?)';
    $request = $conn->prepare($sql);
    $request->execute(array($_POST['reply_text'], $user_ID, $_POST['comment_ID']));
    header('Refresh:0');
}

function get_posts()
{
    $db = new PDO('mysql:host=localhost;dbname=blog', 'root', '');

    $pStmt = $db->query('SELECT * FROM comments NATURAL JOIN user');
    $posts = $pStmt->fetchAll(PDO::FETCH_ASSOC);
    $pStmt->closeCursor();

    // Convert flat posts array to threaded dictionary

    // Recursively find a parent in the thread, return a reference to it
    function &find_parent(&$posts, $id)
    {
        $ref = null;

        foreach ($posts as $i => $p) {
            if ($i == $id) {
                $ref = &$posts[$i];
                break;
            }

            if (isset($p['replies'])) {
                $in_replies = &find_parent($posts[$i]['replies'], $id);
                if ($in_replies) {
                    $ref = &$in_replies;
                    break;
                }
            }
        }

        return $ref;
    }


    $thread = array();
    // Run until all posts have been threaded (maybe infinite if there's a bug :)
    while (count($posts) > 0) {
        // Foreach post
        foreach ($posts as $i => $p) {
            // If the post has a parent, find a reference to it in the thread
            if (!is_null($p['parent'])) {
                $parent = &find_parent($thread, $p['parent']);
                if ($parent) {
                    // Create the replies array if it doesn't exist
                    if (!isset($parent['replies'])) {
                        $parent['replies'] = array();
                    }
                    // Append it to replies
                    $parent['replies'][$p['id']] = $p;
                    // Remove from the unsorted posts list
                    unset($posts[$i]);
                }
                // Otherwise, wait until it shows up in the thread
            } else {
                // Top-level posts can be threaded immediately
                $thread[$p['id']] = $p;
                // Remove from the unsorted posts list
                unset($posts[$i]);
            }
        }
    }
    return $thread;
}

?>



<!DOCTYPE HTML>
<html>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link href='blog.css' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css2?family=Fira+Sans+Condensed:wght@400;500;900&display=swap' rel='stylesheet'>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.3.1/css/all.css' integrity='sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU' crossorigin='anonymous'>
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' integrity='sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh' crossorigin='anonymous'>
    <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js' integrity='sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM' crossorigin='anonymous'></script>
    <script src='//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js'></script>
    <script src='//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js'></script>
    <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>


    <title>Blog</title>
</head>

<body>
    <header>

        <?php
        
        if (isset($_SESSION['userID'])) {
            signedIn();
        } else {
            signedOut();
        }
        ?>

    </header>

    <main>

        <article>
            <h1 class='mb-5'>TV Show Ranking :</h1>
            <section>
                <h2>1. Breaking Bad</h2>
                <a target='_blank' href='https://www.imdb.com/title/tt0903747/?pf_rd_m=A2FGELUUNOQJNL&pf_rd_p=12230b0e-0e00-43ed-9e59-8d5353703cce&pf_rd_r=3YFSPB8YDQFBJRDS80SG&pf_rd_s=center-1&pf_rd_t=15506&pf_rd_i=toptv&ref_=chttvtp_tt_4'><img class='ranking' src='breakingbad.jpg' alt=''></a>
                <p>A high school chemistry teacher diagnosed with inoperable lung cancer turns to manufacturing and selling methamphetamine in order to secure his family's future.</p>
            </section>

            <section>
                <h2>2. Game Of Thrones</h2>
                <a target='_blank' href='https://www.imdb.com/title/tt0944947/?ref_=nv_sr_srsg_0'><img class='ranking' src='gameofthrones1.jpg' alt=''></a>
                <p>Nine noble families fight for control over the lands of Westeros, while an ancient enemy returns after being dormant for millennia.</p>
            </section>

            <section>
                <h2>3. Narcos</h2>
                <a target='_blank' href='https://www.imdb.com/title/tt2707408/?ref_=nv_sr_srsg_0'><img class='ranking' src='narcos.jpg' alt=''></a>
                <p>A chronicled look at the criminal exploits of Colombian drug lord Pablo Escobar, as well as the many other drug kingpins who plagued the country through the years.</p>
            </section>

            <section>
                <h2>4. Gomorrah</h2>
                <a target='_blank' href='https://www.imdb.com/title/tt2049116/?ref_=fn_al_tt_1'><img class='ranking' src='gomorrah.jpg' alt=''></a>
                <p>Ciro disregards tradition in his attempt to become the next boss of his crime syndicate. The internal power struggle puts him and his entire family's life at risk.</p>
            </section>

            <section>
                <h2>5. The Shield</h2>
                <a target='_blank' href='https://www.imdb.com/title/tt0286486/?ref_=nv_sr_srsg_0'><img class='ranking' src='theshield.jpg' alt=''></a>
                <p>Follows the lives and cases of a dirty Los Angeles Police Department cop and the unit under his command.</p>
            </section>


            <!-- <section>
                <h2></h2>
                <a target='_blank' href=''><img class='ranking' src='' alt=''></a>
                <p></p>
            </section> -->

        </article>

        <article>
            <!-- Comment section -->
            <div id='comment-margin'>

                <!-- comments section -->
                <div class=' comments-section'>
                    <!-- comment form -->
                    <form class='clearfix' action='' method='post' id='comment_form'>
                        <h4 class='gray'>Post a comment:</h4>
                        <textarea type='text' name='comment_text' cols='40' rows='5' class='comment_text form-control' placeholder='What are your thoughts ?'></textarea>
                        <input type='submit' id='submit_comment' value='Submit comment' name='submit_comment'>
                    </form>
                </div>

                <div id=''>

                    <!-- Display total number of comments on this post  -->
                    <p class='gray'><span id='comments_count'>0</span> Comment(s)</p>
                    <hr>
                    <!-- comments wrapper -->
                    <div id='comments-wrapper'>
                        <div class='comment clearfix'>
                            <?php function print_posts(array $posts)
                            {
                                echo '<ul>';
                                foreach ($posts as $id => $post) { ?>
                                    <li style='list-style: none'>
                                        <div class='comment-details'>
                                            <img src='profile.png' alt='' class='profile_pic'>
                                            <span class='comment-name'><?php echo $post['first_name']; ?></span>
                                            <span class='gray comment-date'><?php echo $post['comment_created_at']; ?></span>
                                            <p><?php echo $post['post']; ?></p>
                                            <form class='replyAlign' action='' method='post'>
                                                <button type='button' data-toggle='collapse' data-target='#replyComment<?php echo $post['id']; ?>' class='commentMenu gray reply-btn' name='reply_comment' id='reply'><i id='commentIcon' class='gray fa fa-comment-alt'></i>Reply</button>
                                                <button type='button' data-toggle='modal' data-target='#update<?php echo $post['id']; ?>' name='update' class='commentMenu gray reply-btn'>Edit</button>
                                                <button type='button' name='delete' class='commentMenu gray reply-btn' data-toggle='modal' data-target='#delete<?php echo $post['id']; ?>'>Delete</button>
                                                <input type='submit' name='report_comment' value='Report' class='commentMenu gray reply-btn'>
                                            </form>
                                        </div>

                                        <!-- Comment reply form -->
                                        <div style='margin-top:0;' id='replyComment<?php echo $post['id']; ?>' class='collapse reply-section'>
                                            <form class='clearfix' action='' method='post'>
                                                <input type='hidden' name='comment_ID' value='<?php echo $post['id']; ?>'>
                                                <textarea type='text' name='reply_text' cols='20' rows='3' class='comment_text form-control' placeholder='What are your thoughts ?'></textarea>
                                                <input type='submit' id='submit_comment' value='Reply' name='submit_reply'>
                                            </form>
                                        </div>

                                        <!-- Comment Modal delete -->
                                        <div class=' loginCard modal fade' id='delete<?php echo $post['id']; ?>' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                            <div class='modal-dialog' role='document'>
                                                <div class='card modal-content'>
                                                    <div class='marginButton modal-header'>
                                                        <h5 class='modal-title' id='exampleModalLabel'>Are you sure you want to delete your comment ?</h5>
                                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                            <span aria-hidden='true'>&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method='post' action=''>
                                                        <input type='hidden' value='<?php echo $post['id']; ?>' name='comment_ID'>
                                                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancel</button>
                                                        <input type='submit' class='btn login_btn' value='Delete' name='delete_comment'>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Comment Modal modify -->
                                        <div class=' loginCard modal fade' id='update<?php echo $post['id']; ?>' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                            <div class='modal-dialog' role='document'>
                                                <div class='card modal-content'>
                                                    <div class='modal-header'>
                                                        <h5 class='modal-title' id='exampleModalLabel'>Edit your comment :</h5>
                                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                            <span aria-hidden='true'>&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method='post' action=''>
                                                        <div class='modal-body'>

                                                            <input class='comment_text' type='text' value='<?php echo $post['post']; ?> ' name='updated_comment'>

                                                        </div>
                                                        <div class='modal-footer'>
                                                            <input type='hidden' value='<?php echo $post['id']; ?>' name='id'>
                                                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancel</button>
                                                            <input type='submit' class='btn login_btn' value='Update' name='update_comment'>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                            <?php 
                                    if (isset($post['replies']) && is_array($post['replies'])) {
                                        print_posts($post['replies']);
                                    }
                                }
                                echo '</ul>';
                            }
                            print_posts(get_posts()); ?>



                            <?php ?>

                        </div>
                    </div>
                    <!-- // comments wrapper -->
                </div>
                <!-- // comments section -->
            </div>
            <!-- Javascripts -->
            <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
            <!-- Bootstrap Javascript -->
            <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>
        </article>


        <!-- sign in -->
        <div>
            <div class='loginCard modal fade' id='exampleModal'>
                <div class='d-flex justify-content-center h-100 modal-dialog'>
                    <div class='card modal-content'>
                        <div class='card-header modal-header'>
                            <h2 class='modal-title' id='signin'>Sign In</h2>
                            <span aria-hidden='true'>&times;</span>
                        </div>
                        <div class='card-body modal-body'>
                            <form action='' method='post'>
                                <div style='color:red'><?php echo $error; ?></div>
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
                                <div class='row align-items-center remember'>
                                    <input type='checkbox'>Remember Me
                                </div>
                                <div class='form-group'>
                                    <input type='submit' value='Login' class='btn float-right login_btn signin' name='login'>
                                    <button type='button' class=' float-right mr-2 btn btn-secondary' data-dismiss='modal'>Close</button>
                                </div>
                            </form>
                        </div>
                        <div class='card-footer modal-footer'>
                            <div class='d-flex justify-content-center links'>
                                Don't have an account?<a href='#' data-toggle='modal' data-dismiss='modal' data-target='#exampleModal2'>Sign Up</a>
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
                            <span aria-hidden='true'>&times;</span>
                        </div>
                        <div class='card-body modal-body'>
                            <p style='color:white;'>You are currently logged in with : <?php echo $loggedin ?></p>
                        </div>
                        <div class='card-footer modal-footer'>
                            <div class='d-flex justify-content-center links'>
                                <form action='<?php echo disconnect(); ?>' method='post'>
                                    <input type='submit' name='logout' value='Log out'>
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


</body>

</html>