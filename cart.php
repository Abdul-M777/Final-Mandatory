<?php

require 'API/db.php';

require_once 'header.php';

if(isset($_GET["action"])){
    if($_GET["action"] == "delete"){
        foreach ($_SESSION["shopping_cart"] as $keys => $values){
            if($values["item_id"] == $_GET["id"]){
                unset($_SESSION["shopping_cart"][$keys]);
                echo '<script>alert("Item Removed")</script>';
                echo '<script>window.location="cart.php"</script>';
            }
        }
    }
}

if(isset($_POST['buy_btn'])){
    if(empty($_SESSION["total"])){
        echo '<script>Your cart is empty</script>';
    }else{
        header("Location: billing.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
</head>
<body>
<h3>Order Details</h3>
<div class="table-responsive">
    <table class="table table-bordered">
    <tr>
        <th width="40%">Name</th>
        <th width="10%">Quantity</th>
        <th width="20%">Price</th>
        <th width="15%">Total</th>
        <th width="5%">Action</th>
    </tr>
    <?php
    if(!empty($_SESSION["shopping_cart"])){
        $total = 0;
        foreach($_SESSION["shopping_cart"] as $keys => $values){
            ?>
            <tr>
                <td><?php echo $values["item_name"]; ?></td>
                <td><?php echo $values["item_quantity"]; ?></td>
                <td><?php echo $values["item_price"]; ?></td>
                <td><?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>
                <td><a href="cart.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
            </tr>
          <?php
                $total = $total + ($values["item_quantity"] * $values["item_price"]);
                $_SESSION["total"] = number_format($total, 2);
        }
        ?>
        <tr>
            <td colspan="3">Total</td>
            <td>$ <?php echo number_format($total, 2); ?></td>
        </tr>
        <?php
    }

    ?>



    </table>

</div>

<form action="cart.php" method="POST">
    <input type="submit" value="Buy" name="buy_btn">
</form>


<?php
require_once 'footer.php';

?>
</body>
</html>