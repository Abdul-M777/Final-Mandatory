<?php
if(isset($_POST['signup-submit'])){
    require "../API/db.php";

    $firstName = $_POST['f_name'];
    $lastName = $_POST['l_name'];
    $company = $_POST['company'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $postalCode = $_POST['postal'];
    $phone = $_POST['phone'];
    $fax = $_POST['fax'];
    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];


    if(empty($firstName) || empty($lastName) ||empty($address) ||empty($city) ||
    empty($state) ||empty($country) ||empty($postalCode) ||empty($email) ||empty($password) ||empty($passwordRepeat)){

        header("Location: ../signup.php?error=emptyfields&first=".$firstName."&last=".$lastName."&address=".$address."&city=".$city
    ."&state=".$state."&country=".$country."&postal=".$postalCode."&phone=".$phone."&mail=".$email);
    exit();
    }

    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location: ../signup.php?error=invalidmail&first=".$firstName."&last=".$lastName."&address=".$address."&city=".$city
        ."&state=".$state."&country=".$country."&postal=".$postalCode."&phone=".$phone);
        exit();
    
    } else if($password !== $passwordRepeat){
        header("Location: ../signup.php?error=passwordCheck&first=".$firstName."&last=".$lastName."&address=".$address."&city=".$city
        ."&state=".$state."&country=".$country."&postal=".$postalCode."&phone=".$phone."&mail=".$email);
        exit();
    }else{

        $sql = "SELECT Email FROM customer WHERE Email=?";
        $stmt = mysqli_stmt_init($dbConn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../signup.php?error=sqlerror");
        exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if($resultCheck > 0){
                header("Location: ../signup.php?error=usertaken");
                exit();
            } else {

            $sql = "INSERT INTO customer(FirstName, LastName, Password, Company, Address, City, State, Country, PostalCode, Phone, Fax, Email)
            VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
            $stmt = mysqli_stmt_init($dbConn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: ../signup.php?error=sqlerror");
                exit();
            } else {
                $hashedPwd = password_hash($password, PASSWORD_DEFAULT);


                mysqli_stmt_bind_param($stmt, "ssssssssiiis", $firstName, $lastName, $hashedPwd, $company, $address, $city, $state, $country, $postalCode, $phone, $fax, $email);
                mysqli_stmt_execute($stmt);
                header("Location: ../signup.php?signup=success");
                exit();
            }
            }
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($dbConn);
} else {
    header("Location: ../signup.php");
    exit();
}