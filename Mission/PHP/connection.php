<?php

$DB_host = "localhost";
$DB_user = "root";
$DB_password = "";
$DB_name = "mission";

try{
	$connection=new PDO("mysql:host=$DB_host;dbname=$DB_name",$DB_user.$DB_password);
	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<br>"; 
	}
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>