<?php


if(isset($_POST['submit_update_password'])){
    require '../API/db.php';

    $customerId = $_POST['customerId'];
    $password = $_POST['password'];
    $passwordRepeat = $_POST['passwordRepeat'];

    if (empty($password) || empty($passwordRepeat)){

    header("Location: ../update.php?error=emptypassword");
    exit();
    } else if($password !== $passwordRepeat){
        header("Location: ../update.php?error=passwordCheck");
        exit();
    } else {

        $sql = "UPDATE customer SET Password = ?
            WHERE CustomerId = ?";
        $stmt = mysqli_stmt_init($dbConn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../update.php?error=sqlerror");
            exit();
        } else {

            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

            mysqli_stmt_bind_param($stmt, "si", $hashedPwd, $customerId);
            mysqli_stmt_execute($stmt);
                        // session_start();
                        // $_SESSION['userId'] = $_POST['customerId'];
                        // $_SESSION['userMail'] = $_POST['mail'];
                        // $_SESSION['f_name'] = $_POST['firstName'];
                        // $_SESSION['l_name'] = $_POST['lastName'];
                        // $_SESSION['company'] = $_POST['company'];
                        // $_SESSION['address'] = $_POST['address'];
                        // $_SESSION['city'] = $_POST['city'];
                        // $_SESSION['state'] = $_POST['state'];
                        // $_SESSION['country'] = $_POST['country'];
                        // $_SESSION['postal'] = $_POST['postalCode'];
                        // $_SESSION['phone'] = $_POST['phoneNumber'];
                        // $_SESSION['fax'] = $_POST['fax'];
            header("Location: ../update.php?update=success");
            exit();
        }
    }
    



} else {
    header("Location: ../signup.php");
    exit();
}