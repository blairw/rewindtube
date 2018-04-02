<?php
	// connect to mysql
	include ('../../secret/db-MysqlAccess.php');

	if (isset($_GET['v_key'])) {
		// only continue if id is set and it is an int
		$selectedId = $_GET['v_key'];
	} else {
		// send them to the index page whatever it may be
		header('Location: .././');
	}

	if (isset($selectedId)) {
		
		$res = $mysqli->query("
			SELECT
				v.*, c.title as channel_title	
			FROM rwt_video v
				LEFT JOIN rwt_channel c on c.channel_id = v.channel_id
			WHERE v.v_key = '".$selectedId."'
			LIMIT 1
		");
		
		$arr = array();
		while ($row = $res->fetch_assoc()) {
			array_push($arr, $row);
		}
		$res->close();
		$mysqli->close();
		
		header('Content-type: application/json');
		echo json_encode($arr[0], JSON_PRETTY_PRINT);

	}
?>
