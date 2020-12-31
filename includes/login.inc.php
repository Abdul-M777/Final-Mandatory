<?php

if (isset($_POST['login-submit'])){

    require '../API/db.php';

    $mail = $_POST['mail'];
    $password = $_POST['pwd'];

    if(empty($mail) || empty($password)){
        header("Location: ../login.php?error=emptyfields");
        exit();
    } else {
        $sql = "SELECT * FROM customer WHERE Email=?;";
        $stmt = mysqli_stmt_init($dbConn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../login.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $mail);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)){
                $pwdCheck = password_verify($password, $row['Password']);
                if($pwdCheck == false){
                    header("Location: ../login.php?error=wrongpwd");
                    exit();
                } else if ($pwdCheck == true){

                    session_start();
                    $_SESSION['userId'] = $row['CustomerId'];
                    $_SESSION['userMail'] = $row['Email'];
                    $_SESSION['f_name'] = $row['FirstName'];
                    $_SESSION['l_name'] = $row['LastName'];
                    $_SESSION['company'] = $row['Company'];
                    $_SESSION['address'] = $row['Address'];
                    $_SESSION['city'] = $row['City'];
                    $_SESSION['state'] = $row['State'];
                    $_SESSION['country'] = $row['Country'];
                    $_SESSION['postal'] = $row['PostalCode'];
                    $_SESSION['phone'] = $row['Phone'];
                    $_SESSION['fax'] = $row['Fax'];
                    header("Location: ../update.php?login=success");
                    exit();

                } else {
                    header("Location: ../index.php?error=wrongpwd");
                    exit();
                }


            } else {
                header("Location: ../index.php?error=nouser");
                exit();
            }    
        }
    }

} else {
    header("Location: ../index.php");
    exit();
}