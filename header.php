<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Music store</title>
</head>

<?php
    session_start();
?>


<?php
    if(isset($_SESSION['admin'])){
    echo'<ul>
    <img src="img/fire-music.jpg" alt="music-logo">
    <li><a href="album">Albums</a></li>
    <li><a href="artist">Artists</a></li>
    <li><a href="track">Tracks</a></li>
    <h2>Music Store</h2>
    </ul>'.
    '<form action="includes/logout.inc.php" method="post" id="logout_form">
     <button type="submit" name="logout-submit">Logout</button>
    </form>';
    }else if(isset($_SESSION['userId'])){
        echo'<ul>
        <img src="img/fire-music.jpg" alt="music-logo">
        <li><a href="album_c">Albums</a></li>
        <li><a href="artist_c">Artists</a></li>
        <li><a href="track_c">Tracks</a></li>
        <li><a href="update">Profile</a></li>
        <li><a href="cart">Cart</a></li>
        <li><h2>Music Store</h2></li>
        </ul>'.
        '<form action="includes/logout.inc.php" method="post" id="logout_form">
         <button type="submit" name="logout-submit">Logout</button>
        </form>';
    }else{
        echo '
        <div class="login_header">
        <img src="img/fire-music.jpg" alt="music-logo">
        <h2>Music Store</h2>
        <form action="includes/login.inc.php" method="post" id="login_form">
        <input type="text" name="mail" id="mail" placeholder="Email...">
        <input type="password" name="pwd" id="pwd" placeholder="Password...">
        <button type="submit" name="login-submit">Login</button>
        </form>
        <a id="signup_btn" href="signup.php">Signup</a>
        <a id="admin_btn" href="admin_log.php">Admin</a>
        </div>';
    }
?>