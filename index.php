<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Music Store</title>
</head>
<?php
include_once("header.php");
?>

<body>
    <?php
session_start();
if(isset($_POST["email"]) && $_POST["email"] != ""){
    require_once("db/user.php");
    if($verified){
        header("Location: update.php");
    }
} else if (isset($_POST["logOut"])){
    session_destroy();
}

if (!isset($_SESSION["email"])){
    header("Location: login.php");
} else {
    header("Location: update.php");
}
?>
</body>
<?php
include_once("footer.php");
?>

</html>