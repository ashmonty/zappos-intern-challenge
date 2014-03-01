
<?php



	require 'database.php';
	session_start();
	
	
		$stmt = $mysqli->prepare("DELETE FROM watches WHERE watch_id='".$_POST['watch_id']. "'");
		if(!$stmt){
			printf("Query Prep Failed: %s\n", $mysqli->error);
			exit;
		}
		 
		$stmt->execute();
		 
		$stmt->close();
		
		header('Location: '.'./watchList.php');


?>

