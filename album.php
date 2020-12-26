<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="js/jquery-3.5.1.js"></script>
    <script src="js/album.js"></script>
    <title>Album</title>
</head>
<body>
<?php include_once("header.php") ?>
<h2>Albums</h2>
	
	<h3>Add a New Album</h3>
	<div class="input-group">
		<label>Album Name</label>
        <input type="text" id="name" name="name" value="">
        <!-- <label>Artist Id</label>
		<input type="number" id="artist_id" name="artist_id" value=""> -->
		<label for="">Artist Name</label>
    <br>
    <select name="artists" id="artistDrowpdownCreate">
    </select>
	</div>
	<div class="input-group">
		<button class="btn" type="button" id="addNew">Save</button>
	</div>
	

	<table class="table_id">
		<tr>
			<th>Id</th>
			<th>Album Name</th>
			<th>Artist Name</th>
			<th>Actions</th>
		</tr>
	</table>
	<?php include_once("footer.php") ?>

</body>
</html>