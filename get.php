<?php

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

var_dump($_POST);
$temp=$_POST['item'];
//$sql="INSERT INTO bag (item_name, boolean) values ('$temp','0')";
//if(!mysqli_query($link, $sql)) {
//		die('Error: ' . mysqli_error($link) );
//}
$checker="SELECT * FROM catalog
			WHERE foodname='$temp'";
if ($result=mysqli_query($link,$checker)) {
	//finds row and then takes its expiration value
	$row=$result->fetch_assoc();
	$until = $row["expiration"];
}
//$date will be in the amount of days until expiration

var_dump($until);
$date=date_create(NULL, timezone_open("America/Los_Angeles")); 
  
var_dump($date);
$date=date_add($date, date_interval_create_from_date_string($until." days")); 
  
var_dump($date);

$endTime = date_format($date, "Y/m/d H:i:s"); 
//expiration date is stored into bag table
$cry = mysqli_query($link,"INSERT INTO bag (item_name,expiration) values ('$temp','$endTime')");
mysqli_close($link);


// find in table for that food
 // calculate now + days old (if you wanna use package maybe carbon)
 
// insert into items table of that food 
