<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="js/jquery-3.5.1.js"></script>
    <script src="js/artist.js"></script>
    <title>Artist</title>
</head>
<body>
<?php include_once("header.php") ?>
<h2>Artists</h2>
	
	<h3>Add a New Artist</h3>
	<div class="input-group">
		<label>Artist Name</label>
		<input type="text" id="name" name="artist_name" value="">
		<div class="input-group">
		<button class="btn" type="submit" id="addNew" name="artist_submit">Save</button>

		
	</div>
	</div>
	<div id="searchDiv">
		<input type="text" id="searchArtist" placeholder="Name">
		<button id="btnSearch">Search</button>
		</div>
	

	<table class="table_id">
		<tr>
			<th>Id</th>
			<th>Name</th>
			<th>Actions</th>
		</tr>
	</table>
	<?php include_once("footer.php") ?>

</body>
</html>