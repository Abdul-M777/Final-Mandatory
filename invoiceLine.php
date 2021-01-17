<?php
session_start();
if(isset($_SESSION["invoice"])){
    require "API/db.php";

    $invoiceId = $_SESSION['invoice'];


    foreach ($_SESSION["shopping_cart"] as $keys => $values){
        $TrackId = $values['item_id'];
        $price = $values['item_price'];
        $quantity = $values['item_quantity'];

        $sql = "INSERT INTO invoiceline(InvoiceId, TrackId, UnitPrice, Quantity)
        VALUES(?,?,?,?)";
        $stmt = mysqli_stmt_init($dbConn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo '<script>alert("There is a problem, please try again later");</script>';
            exit();
        } else {


            mysqli_stmt_bind_param($stmt, "iidi", $invoiceId, $TrackId, $price, $quantity);
            mysqli_stmt_execute($stmt);
        }
        unset($_SESSION["shopping_cart"][$keys]);
    }
        unset($_SESSION["shopping_cart"]);
        unset($_SESSION["total"]);
        header("Location: track_c.php");

           

        
    }

?>