<?php 
//fetch_comment.php

require('masterFile.php');

$query = "
SELECT * FROM comments NATURAL JOIN user
WHERE parent_comment_ID = '0' and article_ID = '3'
ORDER BY comment_id DESC 
";

$statement = $conn->prepare($query);

$statement->execute();

$result = $statement->fetchAll();
$output = '';
foreach($result as $row)
{
 $output .= "
    <div id='".$row['comment_ID']."' class='comment-details'>
            <img src='uploads/".$row['image']."' class='profile_pic'>
            <span class='comment-name'>".$row['first_name']."</span>
            <span class='admin_tag text-success'></span>
            <span class='gray comment-date'>".$row['comment_created_at']."</span>
            <p class='comment_content'>".$row['comment_content']."</p>
            <form class='comment_buttons replyAlign comment_form".$row['comment_ID']."' action='' method='post'>
                <input type='hidden' id='comment_deleted' class='comment_deleted' value='".$row['comment_deleted']."'>
                <input type='hidden' id='user_role' value='".$row['role']."'>
                <input type='hidden' id='user_comment_ID' value='".$row['user_ID']."'>
                <button type='button' data-toggle='collapse' data-target='#replyComment".$row['comment_ID']."' class='commentMenu gray reply-btn' name='reply_comment' id='reply'><i id='commentIcon' class='gray fa fa-comment-alt'></i>Reply</button>
                <button type='button' data-toggle='modal' data-target='#update".$row['comment_ID']."' name='update' class=' to_show commentMenu gray reply-btn'>Edit</button>
                <button type='button' name='delete' class=' to_show commentMenu gray reply-btn' data-toggle='modal' data-target='#delete".$row['comment_ID']."'>Delete</button>
                <button type='button' name='report_comment' class='to_report commentMenu gray reply-btn' data-toggle='modal' data-target='#report".$row['comment_ID']."'>Report</button>
            </form>
        </div>

        <!-- Comment reply form -->
        <div style='margin-top:0;' id='replyComment".$row['comment_ID']."' class='collapse reply-section'>
            <form class='clearfix sendReply comment_form".$row['comment_ID']."' action='' method='post' onsubmit='return post_reply(".$row['comment_ID'].")' >
                <input type='hidden' class='parentID' name='parent_ID' value='".$row['comment_ID']."'>
                <input type='hidden' class='userID' value='' name='user_ID'>
                <textarea  type='text' name='comment_content' cols='20' rows='3' class='reply_content comment_text form-control' placeholder='What are your thoughts ?'></textarea>
                <input type='submit' class='btn login_btn send_reply".$row['comment_ID']."' value='Reply' name='submitReply'>
            </form>
            <span id='empty_comment' class='text-danger'></span>
        </div>

        <!-- Comment Modal delete -->
        <div class=' loginCard modal fade' id='delete".$row['comment_ID']."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
            <div class='modal-dialog' role='document'>
                <div class='card modal-content'>
                    <div class='marginButton modal-header'>
                        <h5 class='modal-title' id='exampleModalLabel'>Are you sure you want to delete your comment ?</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    <form method='post' action='' class='delete".$row['comment_ID']."' onsubmit='return do_delete(".$row['comment_ID'].")'>
                        <input type='hidden' value='".$row['comment_ID']."' name='comment_ID'>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancel</button>
                        <input type='submit' class='btn login_btn' value='Delete' name='delete_comment'>

                    </form>
                </div>
            </div>
        </div>

        <!-- Comment Modal report -->
        <div class=' loginCard modal fade' id='report".$row['comment_ID']."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
            <div class='modal-dialog' role='document'>
                <div class='card modal-content'>
                    <div class='marginButton modal-header'>
                        <h5 class='modal-title' id='exampleModalLabel'>Are you sure you want to report this comment ?</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    <form method='post' action='' class='report".$row['comment_ID']."' onsubmit='return do_report(".$row['comment_ID'].")'>
                        <input type='hidden' value='".$row['comment_ID']."' name='comment_ID'>
                        <input type='hidden' id='article_id' name='article_id' value='3'>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancel</button>
                        <input type='submit' class='btn login_btn' value='Report' name='report_comment'>

                    </form>
                </div>
            </div>
        </div>

        <!-- Comment Modal modify -->
        <div class=' loginCard modal fade' id='update".$row['comment_ID']."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
            <div class='modal-dialog' role='document'>
                <div class='card modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title' id='exampleModalLabel'>Edit your comment :</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    <form class='update".$row['comment_ID']."' method='post' action='' onsubmit='return do_update(".$row['comment_ID'].");'>
                        <div class='modal-body'>

                            <input id='updated_comment' class='comment_text' type='text' value='".$row['comment_content']." ' name='updated_comment'>

                        </div>
                        <div class='modal-footer'>
                            <input type='hidden' class='userID' value='' name='user_ID'>
                            <input type='hidden' id='get_comment_ID' name='getComment' value='commentID". $row['comment_ID'] ."'>
                            <input type='hidden' id='commentID". $row['comment_ID'] ."' value='".$row['comment_ID']."' name='comment_ID'>
                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancel</button>
                            <input type='submit' class='btn login_btn' value='Update' name='updateComment'>
                        </div>
                    </form>
                </div>
        </div>
    </div>
 ";
 $output .= get_reply_comment($conn, $row["comment_ID"]);
}

echo $output;

function get_reply_comment($conn, $parent_id = 0, $marginleft = 0)
{
 $query = "
 SELECT * FROM comments NATURAL JOIN user WHERE parent_comment_ID = '".$parent_id."'
 ";
 $output = '';
 $statement = $conn->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $count = $statement->rowCount();
 if($parent_id == 0)
 {
  $marginleft = 0;
 }
 else
 {
  $marginleft = $marginleft + 20;
 }
 if($count > 0)
 {
  foreach($result as $row)
  {
   $output .= "
  <div> 
    <div id='".$row['comment_ID']."' class='comment-details' style='border-left:".$marginleft."px solid rgb(56, 56, 56)'>
            <img src='uploads/".$row['image']."' class='profile_pic'>
            <span class='comment-name'>".$row['first_name']."</span>
            <span class='admin_tag text-success'></span>
            <span class='gray comment-date'>".$row['comment_created_at']."</span>
            <p class='comment_content'>".$row['comment_content']."</p>
            <form class='comment_buttons replyAlign comment_form".$row['comment_ID']."' action='' method='post'>
                <input type='hidden' id='comment_deleted' class='comment_deleted' value='".$row['comment_deleted']."'>
                <input type='hidden' id='user_role' value='".$row['role']."'>
                <input type='hidden' id='user_comment_ID' value='".$row['user_ID']."'>
                <button type='button' data-toggle='collapse' data-target='#replyComment".$row['comment_ID']."' class='commentMenu gray reply-btn' name='reply_comment' id='reply'><i id='commentIcon' class='gray fa fa-comment-alt'></i>Reply</button>
                <button type='button' data-toggle='modal' data-target='#update".$row['comment_ID']."' name='update' class='to_show commentMenu gray reply-btn'>Edit</button>
                <button type='button' name='delete' class='to_show commentMenu gray reply-btn' data-toggle='modal' data-target='#delete".$row['comment_ID']."'>Delete</button>
                <button type='button' name='report_comment' class='to_report commentMenu gray reply-btn' data-toggle='modal' data-target='#report".$row['comment_ID']."'>Report</button>
            </form>
        </div>

        <!-- Comment reply form -->
        <div style='margin-top:0;' id='replyComment".$row['comment_ID']."' class='collapse reply-section'>
            <form class='clearfix sendReply comment_form".$row['comment_ID']."' action='' method='post' onsubmit='return post_reply(".$row['comment_ID'].")'>
                <input type='hidden' class='parentID' name='parent_ID' value='". $row['comment_ID'] ."'>
                <input type='hidden' class='userID' value='' name='user_ID'>
                <textarea type='text' name='comment_content' cols='20' rows='3' class='reply_content comment_text form-control' placeholder='What are your thoughts ?'></textarea>
                <input type='submit' class='btn login_btn send_reply".$row['comment_ID']."' value='Reply' name='submitReply'>
            </form>
            <span id='empty_comment' class='text-danger'></span>
        </div>

        <!-- Comment Modal delete -->
        <div class=' loginCard modal fade' id='delete".$row['comment_ID']."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
            <div class='modal-dialog' role='document'>
                <div class='card modal-content'>
                    <div class='marginButton modal-header'>
                        <h5 class='modal-title' id='exampleModalLabel'>Are you sure you want to delete your comment ?</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    <form method='post' action='' class='delete".$row['comment_ID']."' onsubmit='return do_delete(".$row['comment_ID'].")'>
                        <input type='hidden' value='".$row['comment_ID']."' name='comment_ID'>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancel</button>
                        <input type='submit' class='btn login_btn' value='Delete' name='delete_comment'>

                    </form>
                </div>
            </div>
        </div>

        <!-- Comment Modal report -->
        <div class=' loginCard modal fade' id='report".$row['comment_ID']."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
            <div class='modal-dialog' role='document'>
                <div class='card modal-content'>
                    <div class='marginButton modal-header'>
                        <h5 class='modal-title' id='exampleModalLabel'>Are you sure you want to report this comment ?</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    <form method='post' action='' class='report".$row['comment_ID']."' onsubmit='return do_report(".$row['comment_ID'].")'>
                        <input type='hidden' value='".$row['comment_ID']."' name='comment_ID'>
                        <input type='hidden' id='article_id' name='article_id' value='3'>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancel</button>
                        <input type='submit' class='btn login_btn' value='Report' name='report_comment'>

                    </form>
                </div>
            </div>
        </div>

        <!-- Comment Modal modify -->
        <div class=' loginCard modal fade' id='update".$row['comment_ID']."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
            <div class='modal-dialog' role='document'>
                <div class='card modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title' id='exampleModalLabel'>Edit your comment :</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    <form class='update".$row['comment_ID']."' method='post' action='' onsubmit='return do_update(".$row['comment_ID'].");'>
                        <div class='modal-body'>

                            <input id='updated_comment' class='comment_text' type='text' value='".$row['comment_content']." ' name='updated_comment'>

                        </div>
                        <div class='modal-footer'>
                            <input type='hidden' class='userID' value='' name='user_ID'>
                            <input type='hidden' id='get_comment_ID' name='getComment' value='commentID". $row['comment_ID'] ."'>
                            <input type='hidden' id='commentID". $row['comment_ID'] ."' value='".$row['comment_ID']."' name='comment_ID'>
                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancel</button>
                            <input type='submit' class='btn login_btn' value='Update' name='updateComment'>
                        </div>
                    </form>
                </div>
        </div>
</div>
 ";
   $output .= get_reply_comment($conn, $row["comment_ID"], $marginleft);
  }
 }
 return $output;
}


?>