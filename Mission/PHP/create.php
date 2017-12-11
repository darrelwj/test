<?php

include "connection.php";

$randtoken = mt_rand(10000,100000);

$id ="1";

$sqlgettok = "SELECT token FROM token WHERE User_ID=:uid";
$qtok = $connection->prepare($sqlgettok);
$qtok->bindParam(':uid',$id);
$qtok->execute(array(':uid'=>$id));
$tok = $qtok->fetch(PDO::FETCH_ASSOC);
extract($tok);
$token1 = $tok["token"];

$plus = $randtoken.$token1;
$hash = password_hash($plus, PASSWORD_DEFAULT);

date_default_timezone_set('Asia/Kuala_Lumpur');
$time = date("Y-m-d H:i");
$dt = DateTime::createFromFormat('Y-m-d H:i', $time);
$dt->add(new DateInterval('PT30M'));
$dtout = $dt->format('Y-m-d H:i');

$sqlupdate = "UPDATE user SET Password = '".$hash."', Dateout = '".$dtout."' WHERE User_ID = '".$id."'";
$connection->query($sqlupdate);

echo $randtoken;

$msg = "Your Password will expired on" .$dtout. "\nPassword: " .$randtoken;

?>