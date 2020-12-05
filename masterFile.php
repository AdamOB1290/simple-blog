<?php $servername = "localhost";
$username = "root";
$password = "";

$conn = new PDO("mysql:host=$servername;dbname=blog", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



function disconnect()
{
  

// Unset all of the session variables.
$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finally, destroy the session.
session_destroy();
}

function signedOut()
{
    echo "
    <nav class='navbar navbar-nav menu'>
        <ol>
            <li class='navli item1'><a class='navA' id='logo' href='blogHome.php'><span id='ob'>OB</span> Ranking</a></li>
            <li class='navli item2'><a class='navA' href='blogHome.php'>Home</a></li>
            <li class='navli item3 dropdown'><a class='navA' class='dropdown-toggle' data-toggle='dropdown' href='#0'>Category<span class='caret'></span></a></a>
                <ul class='dropdown-menu'>
                    <li><a class='subA' href='tvshow.php'>TV SHOW</a></li>
                    <li><a class='subA' href='anime.php'>ANIME</a></li>
                    <li><a class='subA' href='manga.php'>MANGA</a></li>
                </ul>
            </li>
            <li class='navli item4'><a class='navA' href='' data-toggle='modal' data-target='#exampleModal'>Sign In</a></li>
            <li class='navli item5'><a class='navA' href='#0' data-toggle='modal' data-target='#exampleModal2'>Register</a></li>
            <li class='navli item6'><a class='navA' href='contact.php'>Contact</a></li>
        </ol>
    </nav>
    ";
}

function signedIn()
{
    echo "
    
    <nav class='navbar navbar-nav menu'>
    <ol>
    <li class='navli item1'><a class='navA' id='logo' href='blogHome.php'><span id='ob'>OB</span> Ranking</a></li>
        <li class='navli item2'><a class='navA' href='blogHome.php'>Home</a></li>
        <li class='navli item3 dropdown'><a class='navA dropdown-toggle' data-toggle='dropdown' href='#0'>Category<span class='caret'></span></a>
            <ul class='dropdown-menu'>
                <li><a class='subA' href='tvshow.php'>TV SHOW</a></li>
                <li><a class='subA' href='anime.php'>ANIME</a></li>
                <li><a class='subA' href='manga.php'>MANGA</a></li>
            </ul>
        </li>
        <li id='account' class='navli item4 dropdown'><a class='navA dropdown-toggle' data-toggle='dropdown' href='#0'>Account<span class='caret'></span></a>
            <ul class='dropdown-menu'>
                <li><a class='subA' href='profilePHP.Php'>Profile</a></li>
                <li ><a class='subA' href='' data-toggle='modal' data-target='#exampleModal3' >Sign Out</a></li>
            </ul>
        </li>
        <li onclick='clear_notif()'  class='navli item5 dropdown'>
            
            <a href='' class=' navA dropdown-toggle' data-toggle='dropdown'><span id='notif_count'></span><i id='bell' class='fa fa-bell'></i></a>
            <ul id='notifications' class='dropdown-menu'>
            </ul>
            
        </li>
        <li class='navli item6'><a class='navA' href='contact.php'>Contact</a></li>
    </ol>
    </nav>
    ";
}


?>