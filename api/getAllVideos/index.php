<?php
	// connect to mysql
	include ('../../secret/db-MysqlAccess.php');
	
	$res = $mysqli->query("
		SELECT video_id, title, url, channel_id, publish_date, v_key
		FROM rwt_video
		ORDER BY video_id ASC
	");
	
	$arr = array();
	while ($row = $res->fetch_assoc()) {
		array_push($arr, $row);
	}
	$res->close();
	$mysqli->close();
	
	header('Content-type: application/json');
	echo json_encode($arr, JSON_PRETTY_PRINT);
?>
