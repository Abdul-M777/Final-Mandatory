<?php

if(isset($_POST["admin_login-submit"])){

    require '../API/db.php';

    $password = $_POST['admin_pwd'];
    $mail = $_POST['admin_mail'];


    if(empty($password)){
        header("Location: ../admin_log.php?error=emptyfields");
        exit();
    }else {
            $sql = "SELECT * FROM admin;";
            $stmt = mysqli_stmt_init($dbConn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: ../admin_log.php?error=sqlerror");
                exit();
            } else {
                // $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                // mysqli_stmt_bind_param($stmt, "s", $hashedPwd);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if($row = mysqli_fetch_assoc($result)){
                    $pwdCheck = password_verify($password, $row['Password']);
                    if($pwdCheck == false){
                        header("Location: ../admin_log.php?error=wrongpwd");
                        exit();
                    } else if ($pwdCheck == true){
    
                        session_start();
                        $_SESSION['admin'] = "Admin";
                        // $_SESSION['adminMail'] = $row['email'];
                        
                        header("Location: ../artist.php?login=success");
                        exit();
    
                    } else {
                        header("Location: ../index.php?error=wrongpwd");
                        exit();
                    }
    
    
                } else {
                    header("Location: ../admin_log.php?error=nouser");
                    exit();
                }    
            }
        }
}else{
    header("Location: ../admin_log.php");
    exit();
}


