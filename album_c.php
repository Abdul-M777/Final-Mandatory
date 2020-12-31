<?php
require 'header.php';
require 'API/db.php';
?>

<body>
<h2 class="albums_c_header">Albums</h2>
<div id="searchDiv">
<form action="album_c.php" method="POST">

<input type="text" name="search_album" placeholder="Search">
<input type="submit" value="search">
</form>
</div>
<?php
if(isset($_POST['search_album'])){
    $searchq = $_POST['search_album'];
    $searchq = preg_replace("#[^0-9a-z]#i","",$searchq);

    $query = "SELECT artist.name, album.title, album.albumId, artist.artistId FROM album
	LEFT JOIN artist ON album.ArtistId = artist.ArtistID WHERE album.title Like '%$searchq%'";
    $result = mysqli_query($dbConn, $query);
    $count = mysqli_num_rows($result);
    if($count > 0){
        while($row = mysqli_fetch_array($result)){
            ?>
            <div class="col-md-4">
            <form method="POST" action="album_c.php?action=add&id=<?php echo $row["albumId"]; ?>">
            <div class="album_c_table_div">
                <table class="album_c_table">
                    <th>Title</th>
                    <th>Artist</th>
                    <tr>
                   <td><?php echo $row["title"];?></td>
                
                <td>
                <?php echo $row["name"];?>
                </td>
                    
                    </tr>
                
                </table>
                
            </div>
        
            </form>

            </div>
            
            <?php
        }
    }
}
require 'footer.php';
    ?>

    

</body>
</html>