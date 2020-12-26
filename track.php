<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="js/jquery-3.5.1.js"></script>
    <script src="js/track.js"></script>
    <title>Track</title>
</head>
<body>
<?php include_once("header.php") ?>
<h2>Tracks</h2>
	
	<h3>Add a New Track</h3>
	<!-- <div class="input-group">
		<label>Track Name</label>
		<input type="text" id="name" name="name" value="">
	</div>
	<div class="input-group">
		<button class="btn" type="button" id="addNew">Save</button>
    </div> -->
    <label for="">Name</label>
    <br>
    <input type="text" name='name' placeholder="Name" id="name">
    <br>
    <!-- <input type="number" name='album_Id' placeholder="Album Id" id="album_Id"> -->
    <label for="">Album</label>
    <br>
    <select name="albums" id="albumDrowpdownCreate">

    </select>
    <br>
    <!-- <input type="number" name='mediaType_Id' placeholder="MediaType Id" id="mediaType_Id"> -->
    <label for="">MediaType</label>
    <br>
    <select name="mediaType_Id" id="mediaType_Id">
      <option value="1">MPEG audio file</option>
      <option value="2">Protected AAC audio file</option>
      <option value="3">Protected MPEG-4 video file</option>
      <option value="4">Purchased AAC audio file</option>
      <option value="5">ACC audio file</option>
    </select>
    <br>
    <!-- <input type="number" name='genre_Id' placeholder="Genre Id" id="genre_Id"> -->
    <label for="">Genre</label>
    <br>
    <select name="genre_Id" id="genre_Id">
      <option value="1">Rock</option>
      <option value="2">Jazz</option>
      <option value="3">Metal</option>
      <option value="4">Alternative & Punk</option>
      <option value="5">Rock And Roll</option>
      <option value="6">Blues</option>
      <option value="7">Latin</option>
      <option value="8">Reggae</option>
      <option value="9">Pop</option>
      <option value="10">Soundtrack</option>
      <option value="11">Bossa Nova</option>
      <option value="12">Easy Listening</option>
      <option value="13">Heavy Metal</option>
      <option value="14">R&B/Soul</option>
      <option value="15">Electronica/Dance</option>
      <option value="16">World</option>
      <option value="17">Hip Hop/Rap</option>
      <option value="18">Science Fiction</option>
      <option value="19">TV Shows</option>
      <option value="20">Sci Fi & Fantasy</option>
      <option value="21">Drama</option>
      <option value="22">Comedy</option>
      <option value="23">Alternative</option>
      <option value="24">Classical</option>
      <option value="25">Opera</option>

    </select>
    <br>
    <label for="">Composer</label>
    <br>
    <input type="text" name='composer' placeholder="Composer" id="composer">
    <br>
    <label for="">Minutes</label>
    <br>
    <input type="number" name='milliseconds' placeholder="Minute" id="milliseconds">
    <br>
    <label for="">Bytes</label>
    <br>
    <input type="text" name='bytes' placeholder="Bytes" id="bytes">
    <br>
    <label for="">Price</label>
    <br>
    <input type="number" name='unitPrice' placeholder="Price" id="price">
    <br>
    <div class="input-group">
		<button class="btn" type="button" id="addNew">Save</button>
    </div>
	

	<table class="table_id">
		<tr>
			<th>Id</th>
            <th>Name</th>
			<th>Composer</th>
      <th>Price</th>
      <th>MediaType</th>
			<th>Genre</th>
			<th>Actions</th>
		</tr>
	</table>
	<?php include_once("footer.php") ?>

</body>
</html>