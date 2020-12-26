<?php

require_once 'db.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// get posted data
	$data = json_decode(file_get_contents("php://input", true));
	$name = mysqli_real_escape_string($dbConn, $data->name);
	$album_id = mysqli_real_escape_string($dbConn, $data->album_Id);
	$mediaType_Id = mysqli_real_escape_string($dbConn, $data->mediaType_Id);
	$genre_Id = mysqli_real_escape_string($dbConn, $data->genre_Id);
	$composer = mysqli_real_escape_string($dbConn, $data->composer);
	$milliseconds = mysqli_real_escape_string($dbConn, $data->milliseconds);
	$bytes = mysqli_real_escape_string($dbConn, $data->bytes);
	$price = mysqli_real_escape_string($dbConn, $data->unitPrice);

	$minute = $milliseconds * 60000;

	
	$sql = "INSERT INTO track(Name, AlbumId, MediaTypeId, GenreId, Composer, Milliseconds, Bytes, UnitPrice)
    VALUES(?,?,?,?,?,?,?,?)";
	// dbQuery($sql);
	$stmt = mysqli_stmt_init($dbConn);
	if(!mysqli_stmt_prepare($stmt,$sql)){
		echo json_encode(array('status'=>'SQL Error'));
	} else {
		mysqli_stmt_bind_param($stmt, 'siiisdid', $name, $album_id, $mediaType_Id, $genre_Id, $composer, $minute, $bytes, $price);
		mysqli_stmt_execute($stmt);
		echo json_encode(array('status'=>'Track created'));
	}
	
} else if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['id'])) {
	$sql = "DELETE FROM track WHERE TrackId = " . mysqli_real_escape_string($dbConn, $_GET['id']);
	dbQuery($sql);
	echo json_encode(array('status'=>'Track deleted'));

} else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
	// get posted data
	$data = json_decode(file_get_contents("php://input", true));
	$name = mysqli_real_escape_string($dbConn, $data->name);
	$composer = mysqli_real_escape_string($dbConn, $data->composer);
	$price = mysqli_real_escape_string($dbConn, $data->unitPrice);
	$mediaType_Id = mysqli_real_escape_string($dbConn, $data->mediaType_Id);
	$genre_Id = mysqli_real_escape_string($dbConn, $data->genre_Id);
	
	$sql = "UPDATE track SET Name = ?, Composer = ?, UnitPrice = ?, MediaTypeId = ?, GenreId = ? WHERE TrackId = " . $data->id;
	// dbQuery($sql);
	$stmt = mysqli_stmt_init($dbConn);
	if(!mysqli_stmt_prepare($stmt,$sql)){
		echo json_encode(array('status'=>'SQL Error'));
	} else {
		mysqli_stmt_bind_param($stmt, 'ssdii', $name, $composer, $price, $mediaType_Id, $genre_Id);
		mysqli_stmt_execute($stmt);
		echo json_encode(array('status'=>'Track Updated'));
	}


} else if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
	$sql = "SELECT * FROM track WHERE TrackId = " . mysqli_real_escape_string($dbConn, $_GET['id']) . " LIMIT 1";
	$result = dbQuery($sql);
	
	$row = dbFetchAssoc($result);
	
	echo json_encode($row);
} else {
	$sql = "SELECT track.name AS trackName, album.title AS albumTitle, genre.name AS genre, track.unitPrice, track.trackId, track.composer, track.MediaTypeId
	FROM track
	LEFT JOIN album ON album.albumid=track.albumid
	LEFT JOIN genre ON genre.genreid=track.genreid";
	$results = dbQuery($sql);
	
	$rows = array();
	
	while($row = dbFetchAssoc($results)) {
		$rows[] = $row;
	}
	
	echo json_encode($rows);
}
