<?php
session_start();

if(!isset($_SESSION["cserf"])){
    $_SESSION["cserf"] = bin2hex(random_bytes(32));
}

if(isset($_SESSION["admin"])){
    header("Location: index.php");
}

if(isset($_POST["token"])){
    if($_POST["token"] != $_SESSION["cserf"]){
        return;
    } else {
        if(isset($_POST["email"])){
            require_once("db/user.php");

            $email = $_POST["email"];
            $password = $_POST["password"];

            $customer = new User();

            $result = $customer->C_login($email, $password);
            $verified = $result[0];

            if($verified){
                $cserf_token = bin2hex(random_bytes(32));

                $_SESSION["admin"] = $result[1];
                $_SESSION["cserf"] = $cserf_token;
                $_SESSION["customerId"] = $customer->customerId;
                $_SESSION["email"] = $email;
                $_SESSION["firstName"] = $customer->firstName;
                $_SESSION["lastName"] = $customer->lastName;
                $_SESSION["email"] = $customer->email;
                $_SESSION["company"] = $customer->company;
                $_SESSION["address"] = $customer->address;
                $_SESSION["city"] = $customer->city;
                $_SESSION["state"] = $customer->state;
                $_SESSION["country"] = $customer->country;
                $_SESSION["postalCode"] = $customer->postalCode;
                $_SESSION["phone"] = $customer->phone;
                $_SESSION["fax"] = $customer->fax;

                header("Location: index.php");

            }
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Sign in</title>
</head>
<body>

<?php include_once "header.php" ?>

<div>
    <h1>Sign In</h1>
    <form action="login.php" id="signInForm" method="POST">
        <div>
            <input type="email" name="email" id="emailSignIn" placeholder="Email" required>
        </div>
        <div>
            <input type="password" placeholder="Password" name="password" id="passwordSignIn" required>
        </div>
        <input type="hidden" name="token" value=<?=$_SESSION["cserf"]?>>
        <div>
            <button type="submit" id="btnSignIn">Sign In</button>
        </div>
    </form>
</div>
    <?php include_once "footer.php" ?>
</body>
</html>