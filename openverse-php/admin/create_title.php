<?php
$title = 'Create Title';
require_once '../../inc/connect.php';
require_once '../../inc/htm.php'; openHead();
if($signed_in){
if($_SESSION['user_rank']>2){
if($_SERVER['REQUEST_METHOD'] != 'POST') {
    //the form hasn't been posted yet, display it
    echo '<div class="post-list-outline center"><form method="post"><br>
        Title name: <input name="name"><br>
        Title type: <input name="type"><br>
        Title banner URL: <input name="banner"><br>
        Title icon URL: <input name="icon"><br>
        Title genre: <select name="genre"><option value="Wii U Games">Wii U Games</option><option value="3DS Games">3DS Games</option><option value="Wii U Games・3DS Games">Wii U/3DS Games</option><option value="Virtual Console">Virtual Console</option><option value="General Community">General Community</option><option value="Special Community">Special Community</option></select><br>
        Title platform: <select name="platform"><option value="1">N/A</option><option value="1">Wii U</option><option value="2">3DS</option><option value="3">Wii U/3DS</option></select><br>
        <input type="submit" value="Create Title" />
     </form><br></div>';
} else {
    //the form has been posted, so save it
    $sql = "INSERT INTO titles(title_name,title_type,title_banner,title_icon, title_genre,title_platform) VALUES('" . mysqli_real_escape_string($link,$_POST['name']) . "','" . mysqli_real_escape_string($link,$_POST['type']) . "','" . mysqli_real_escape_string($link,$_POST['banner']) . "','" . mysqli_real_escape_string($link,$_POST['icon']) . "','" . mysqli_real_escape_string($link,$_POST['genre']) . "','" .
mysqli_real_escape_string($link,$_POST['platform']) . "')";
    $result = mysqli_query($link, $sql);
    if(!$result)
    {
        //something went wrong, display the error
        echo 'Error: ' . mysqli_errno($link);
    }
    else
    {
        echo 'New title successfully added.';
    }
}
} else {
http_response_code(403);
echo '<div class="no-content"><p>You\'re not authorized to view this page.</p></div>';
}
} else {
http_response_code(401);
echo '<div class="no-content"><p>You must be signed in to access this page.</p></div>';
}
openFoot();