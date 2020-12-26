<?php

require_once 'db.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	
	$data = json_decode(file_get_contents("php://input", true));
	$name =  mysqli_real_escape_string($dbConn, $data->name);
	$sql = "INSERT INTO artist(Name) VALUES(?)";
	// dbQuery($sql);
	$stmt = mysqli_stmt_init($dbConn);
	if(!mysqli_stmt_prepare($stmt,$sql)){
		echo json_encode(array('status'=>'SQL Error'));
	} else {
		mysqli_stmt_bind_param($stmt, 's', $name);
		mysqli_stmt_execute($stmt);
		echo json_encode(array('status'=>'Artist created'));
	}

} else if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['id'])) {
	$sql = "DELETE FROM artist WHERE ArtistId = " . mysqli_real_escape_string($dbConn, $_GET['id']);
	dbQuery($sql);
	echo json_encode(array('status'=>'artist deleted'));

} else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
	// get posted data
	$data = json_decode(file_get_contents("php://input", true));
	$name =  mysqli_real_escape_string($dbConn, $data->name);
	$sql = "UPDATE artist SET Name = ? WHERE ArtistId = " . $data->id;
	// dbQuery($sql);
	$stmt = mysqli_stmt_init($dbConn);
	if(!mysqli_stmt_prepare($stmt,$sql)){
			echo json_encode(array('status'=>'SQL Error'));
		} else {
			mysqli_stmt_bind_param($stmt, 's', $name);
			mysqli_stmt_execute($stmt);
			echo json_encode(array('status'=>'Artist Updated'));
		}

} else if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
	$sql = "SELECT * FROM artist WHERE ArtistId = " . mysqli_real_escape_string($dbConn, $_GET['id']) . " LIMIT 1";
	$result = dbQuery($sql);
	
	$row = dbFetchAssoc($result);
	
	echo json_encode($row);
} else {
	 $result_per_page = 50;

	$sql = "SELECT * FROM artist";
	$results = dbQuery($sql);
	$number_of_results = mysqli_num_rows($results);
	
	$rows = array();
	
	while($row = mysqli_fetch_array($results)) {
		$rows[] = $row;
	}

	$number_of_pages = ceil($number_of_results/$result_per_page);
	

	// for ($page=1;$page<=$number_of_pages;$page++) {
	// 	echo '<a href="../artist.php?page=' . $page .'">'. $page .'</a> ';
	// }

	echo json_encode($rows);

}

