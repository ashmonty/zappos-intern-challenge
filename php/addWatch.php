


<?php








	require 'database.php';
	session_start();
	
	$product_id = $_POST['product_id'];
	$style_id = $_POST['style_id'];
	$item_name = $_POST['item_name'];

	$o_price = substr($_POST['original_price'], 1);

	$c_price = substr($_POST['current_price'],1);
	$i_url = $_POST['thumbnail_URL'];
	$p_url = $_POST['zappos_link'];

	//insert values from form into the table
	$stmt = $mysqli->prepare("insert into watches (user_id, sku, orig_price, current_price, style_id, item_name, image_url, zappos_url, email) values (?, ?, ?, ?, ?, ?, ?, ?, ?)");
	//$stmt = $mysqli->prepare("insert into watches (user_id, sku) values (?, ? )");

	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	
	$stmt->bind_param('iiddissss', $_SESSION['user_id'], $product_id, $o_price, $c_price, $style_id, $item_name, $i_url, $p_url, $_SESSION['user_email']);  
 

	//$stmt->bind_param('ii', $_SESSION['user_id'], $product_id);  
 
 
	$stmt->execute();
 
	$stmt->close();

	header('Location: '.'./watchList.php');


?>

