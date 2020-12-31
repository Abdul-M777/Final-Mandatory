<?php


if(isset($_POST['submit_update'])){
    require '../API/db.php';

    $customerId = $_POST['customerId'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['mail'];
    $company = $_POST['company'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $postalCode = $_POST['postalCode'];
    $phone = $_POST['phoneNumber'];
    $fax = $_POST['fax'];

    if (empty($firstName) || empty($lastName) ||empty($address) ||empty($city) || empty($state) ||empty($country) ||empty($postalCode) ||empty($email)){

        header("Location: ../update.php?error=emptyfields&first=".$firstName."&last=".$lastName."&address=".$address."&city=".$city
    ."&state=".$state."&country=".$country."&postal=".$postalCode."&phone=".$phone."&mail=".$email);
    exit();
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location: ../update.php?error=invalidmail&first=".$firstName."&last=".$lastName."&address=".$address."&city=".$city
        ."&state=".$state."&country=".$country."&postal=".$postalCode."&phone=".$phone);
        exit();
    
    }  else {

    $sql = "UPDATE customer SET FirstName = ?, LastName = ?, Email = ?, Company = ?, Address = ?, City = ?, State = ?, Country = ?, PostalCode = ?, Phone = ?, Fax = ?
        WHERE CustomerId = ?";
    $stmt = mysqli_stmt_init($dbConn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../update.php?error=sqlerror");
        exit();
    } else {

        mysqli_stmt_bind_param($stmt, "ssssssssiiii", $firstName, $lastName, $email, $company, $address, $city, $state, $country, $postalCode, $phone, $fax, $customerId);
        mysqli_stmt_execute($stmt);
                    session_start();
                    $_SESSION['userId'] = $_POST['customerId'];
                    $_SESSION['userMail'] = $_POST['mail'];
                    $_SESSION['f_name'] = $_POST['firstName'];
                    $_SESSION['l_name'] = $_POST['lastName'];
                    $_SESSION['company'] = $_POST['company'];
                    $_SESSION['address'] = $_POST['address'];
                    $_SESSION['city'] = $_POST['city'];
                    $_SESSION['state'] = $_POST['state'];
                    $_SESSION['country'] = $_POST['country'];
                    $_SESSION['postal'] = $_POST['postalCode'];
                    $_SESSION['phone'] = $_POST['phoneNumber'];
                    $_SESSION['fax'] = $_POST['fax'];
        header("Location: ../update.php?update=success");
        exit();
    }
}



} else {
    header("Location: ../signup.php");
    exit();
}