<?php
include_once("header.php");

if(isset($_POST["submit_bill"])){
    require "API/db.php";

    $customerId = $_SESSION["userId"];
    $billingAddress = $_POST["address"];
    $billingCity = $_POST["city"];
    $billingState = $_POST["state"];
    $bilingCountry = $_POST["country"];
    $billingPostal = $_POST["postalCode"];
    $total = $_SESSION["total"];
    $time = date("Y-m-d h:i:s");

    if(empty($billingAddress) || empty($billingCity) || empty($billingState) || empty($bilingCountry) || empty($billingPostal) || empty($customerId)){

        echo '<script>alert("There is an error please check if you have filled all the fields");</script>';
    exit();
    } else {
        $sql = "INSERT INTO invoice(CustomerId, InvoiceDate, BillingAddress, BillingCity, BillingState, BillingCountry, BillingPostalCode, Total)
        VALUES(?,?,?,?,?,?,?,?)";
        $stmt = mysqli_stmt_init($dbConn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo '<script>alert("There is a problem, please try again later");</script>';
            exit();
        } else {


            mysqli_stmt_bind_param($stmt, "issssssd", $customerId, $time, $billingAddress, $billingCity, $billingState, $bilingCountry, $billingPostal, $total);
            mysqli_stmt_execute($stmt);
            header("Location: track_c.php");
            unset($_SESSION["shopping_cart"]);
            unset($_SESSION["total"]);
            exit();
        }
    }



}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing Information</title>
</head>
<body>

<div id="billDiv" class="userDiv">
    <form action="billing.php" id="billingInfoForm" method="POST">
      <fieldset>
        <legend>Billing Information</legend>
        <input type="text" placeholder="Company" value="<?php echo $_SESSION['company'];?>"  name="company" id="company">
        <input type="text" placeholder="Address" value="<?php echo $_SESSION['address'];?>" name="address" id="address">
        <br>
        <input type="text" placeholder="City" value="<?php echo $_SESSION['city'];?>" name="city" id="city">
        <input type="text" placeholder="State" value="<?php echo $_SESSION['state'];?>" name="state" id="state">
        <br>
        <input type="text" placeholder="Country" value="<?php echo $_SESSION['country'];?>" name="country" id="country">
        <input type="text" placeholder="Postal Code" value="<?php echo $_SESSION['postal'];?>" name="postalCode" id="postalCode">
        <br>
        <input type="hidden" name="customerId" id="customerId" value=<?php echo $_SESSION['userId'];?>>
        <input type="submit" id="billInfo" value="Buy" name="submit_bill">
        <br>
      </fieldset>
    </form>
    


</body>
</html>