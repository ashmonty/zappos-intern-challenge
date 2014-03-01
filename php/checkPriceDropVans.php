<?php

// this file is to be run using cron 

require 'database.php';



$stmt = $mysqli->prepare("SELECT watch_id, user_id, sku, orig_price, style_id, notify_sent, item_name, zappos_url, email FROM watches");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }


$stmt->execute();

$watch_ids_to_update = array();
//bind results of query to the following parameters
 
$stmt->bind_result( $watch_id, $user_id, $sku, $orig_price, $style_id, $notify_sent, $item_name, $zappos_url, $user_email);


while($stmt->fetch()){

        if ($notify_sent == 'no') {

            //$response = "";
            //$apiKey = "a73121520492f88dc3d33daf2103d7574f1a3166";

            //$url = "http://api.zappos.com/Search?term=".$sku."&key=".$apiKey;
            //$obj = json_decode(file_get_contents(url), true);

            $obj = json_decode(file_get_contents('vansSearch.txt'), true);
            for($i=0; $i<count($obj['results']); $i++) {
                if($obj['results'][$i]["styleId"] == $style_id && $obj['results'][$i]["productId"] == $sku) {
                   $eightyPercent = (80 / 100);
                   //current price from json
                   $jsonPrice = substr($obj['results'][$i]["price"], 1);
                   //compare current json price to .8 * orig_price (from DB).
                   if($jsonPrice <= ($orig_price * $eightyPercent)) {
                            // The message
                        $message = "Hi! I have good news! The ".$item_name." you subscribed to has decreased in 
                        price from $".$orig_price." to $".$jsonPrice.". If you would like to purchase this item 
                        now, follow this link: ".$zappos_url." . Thanks for using Price Notify!";

                        $sub = "Price Notifier - New Sale Item!";

                        // In case any of our lines are larger than 70 characters, we should use wordwrap()
                        $message = wordwrap($message, 70);

                        // Send



                        if( mail($user_email, $sub, $message)) {
                            echo"<br>sent email!<br>";
                        } else {
                            echo"<br> mail not sent :( <br>";
                        }
                        array_push($watch_ids_to_update, $watch_id);


                }


            }

        }
    } 
}
$stmt->close();

//make sure to send it only once per price change.

foreach($watch_ids_to_update as $new_watch_id) {

    $stmt = $mysqli->prepare("UPDATE watches SET notify_sent=? WHERE watch_id = ?");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
        $yes = 'yes';

       $stmt->bind_param('si', $yes, $new_watch_id);
         
        $stmt->execute();

        $stmt->close();
        echo"set to yes for: ".$new_watch_id;
}







?>