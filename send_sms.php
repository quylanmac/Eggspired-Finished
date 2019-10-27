<?php
require __DIR__ . '/vendor/autoload.php';
use Twilio\Rest\Client;

// Your Account SID and Auth Token from twilio.com/console
$account_sid = 'AC88d060753a3e8366feaa5092e71e4334';
$auth_token = '82aabc2128b7da0ac2ccf31e64a33b70';
// In production, these should be environment variables. E.g.:
// $auth_token = $_ENV["TWILIO_AUTH_TOKEN"]


// A Twilio number you own with SMS capabilities
$twilio_number = "+12052240114";

//Setting up mysql database
define('DB_NAME', 'csv_db');
        define('DB_USER', 'root');
        define('DB_PASSWORD', '');
        define('DB_HOST', 'localhost');
        $link=mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if(!$link){
            die('Could not connect:' . mysqli_connect_error());
        }
        $db_selected = mysqli_select_db ( $link,DB_NAME);
        if(!$db_selected){
            die('Can\'t use' . DB_NAME . ':' . mysqli_connect_error() );
        }

		
		$currentTime = new DateTime();
		$test=$currentTime->format('Y-m-d H:i:s');

		$tomorrowTime = new DateTime();
		$tomorrowTime->modify('+1 day');
		$test2=$tomorrowTime->format('Y-m-d H:i:s');
		$checker="SELECT * FROM bag";
		if ($result=mysqli_query($link,$checker)) {
			while($wholeRow=$result->fetch_assoc()) {
				if ($test <= $wholeRow["expiration"] AND $test2 >= $wholeRow["expiration"]) {
						if (isset($wholeRow["item_name"])) {
							$newVar = $wholeRow["item_name"];
						}
					
									$client = new Client($account_sid, $auth_token);
					$client->messages->create(
					// Where to send a text message (your cell phone?)
					'+19518187739',
					array(
					'from' => $twilio_number,
					'body' => "Hello! Your $newVar is/are expiring in less than 1 day! Do not forget about them! Reduce, Reuse, Recycle if possible!"
						)
						);
				}
			}
			/*$expire = $wholeRow[expiration];
			$item=$wholeRow["item_name"];
			$rows=mysqli_num_rows($result);
				if($rows>0) { 
					$client = new Client($account_sid, $auth_token);
					$client->messages->create(
					// Where to send a text message (your cell phone?)
					'+19518187739',
					array(
					'from' => $twilio_number,
					'body' => 'Hello! Your are expiring in 1 day!
						Do not forget about them!'
				)
			);						
		}*/
}


