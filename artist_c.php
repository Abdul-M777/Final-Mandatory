<?php
require 'header.php';
require 'API/db.php';
?>

<body>
<h2 class="artist_c_header">Artists</h2>
<div id="searchDiv">
<form action="artist_c.php" method="POST">

<input type="text" name="search_artist" placeholder="Search">
<input type="submit" value="search">
</form>
</div>
<?php
if(isset($_POST['search_artist'])){
    $searchq = $_POST['search_artist'];
    $searchq = preg_replace("#[^0-9a-z]#i","",$searchq);

    $query = "SELECT * FROM artist WHERE Name Like '%$searchq%'";
    $result = mysqli_query($dbConn, $query);
    $count = mysqli_num_rows($result);
    if($count > 0){
        echo "<h3 id=names_h3".">Names</h3>";
        while($row = mysqli_fetch_array($result)){
            ?>
                <h5 id="names_h5"><?php echo $row["Name"];?></h5>
            <?php
        }
    }
}
require 'footer.php';
    ?>

    

</body>
</html>