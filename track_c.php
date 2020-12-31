<?php
require 'API/db.php';
require 'header.php';


if(isset($_POST["add_to_cart"])){
    if(isset($_SESSION["shopping_cart"])){

        $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
        if(!in_array($_GET["id"], $item_array_id)){

            $count = count($_SESSION["shopping_cart"]);
            $item_array = array(
            'item_id' => $_GET["id"],
            'item_name' => $_POST["hidden_name"],
            'item_price' => $_POST["hidden_price"],
            'item_quantity' => $_POST['quantity']
            );
            $_SESSION["shopping_cart"][$count] = $item_array;
            echo '<script>window.location="track_c.php"</script>';
            
        } else {
            echo '<script>alert("Item Already Added")</script>';
            echo '<script>window.location="track_c.php"</script>';
        }

    }else {
        $item_array = array(
            'item_id' => $_GET["id"],
            'item_name' => $_POST["hidden_name"],
            'item_price' => $_POST["hidden_price"],
            'item_quantity' => $_POST['quantity']
        );
        $_SESSION["shopping_cart"][0] = $item_array;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Tracks</title>
</head>
<body>
<h2 id="track_c_header">Tracks</h2>
<div id="searchDiv">
<form action="track_c.php" method="POST">

<input type="text" name="search" placeholder="Search">
<input type="submit" value="search">
</form>
</div>
<?php
if(isset($_POST['search'])){
    $searchq = $_POST['search'];
    $searchq = preg_replace("#[^0-9a-z]#i","",$searchq);

    $query = "SELECT * FROM track WHERE NAME LIKE '%$searchq%' LIMIT 100";
    $result = mysqli_query($dbConn, $query);
    $count = mysqli_num_rows($result);
    if($count > 0){
        while($row = mysqli_fetch_array($result)){
            ?>
            <div class="col-md-4">
            <form method="POST" action="track_c.php?action=add&id=<?php echo $row["TrackId"]; ?>">
            <div class="track_c_table_div">
                <table id="track_c_table">
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Action</th>
                    <tr>
                   <td><?php echo $row["Name"];?></td>
                
                <td>
                <?php echo $row["UnitPrice"];?>
                </td>
                    
                <td><input type="text" name="quantity" class="form-control" value="1"></td>
                <input type="hidden" name="hidden_id" value=<?php echo $_SESSION['userId'];?>>
                <input type="hidden" name="hidden_name" value="<?php echo $row["Name"];?>">
                <input type="hidden" name="hidden_price" value="<?php echo $row['UnitPrice'];?>">
                <td><input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart"></td>
                    </tr>
                
                </table>
                
            </div>
        
            </form>

            </div>
            
            <?php
        }
    }
}

require "footer.php";
    ?>

    
    
</body>
</html>