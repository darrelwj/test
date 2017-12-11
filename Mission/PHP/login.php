<?php

include "connection.php";

if(isset($_POST["submit"])){
	
	$user = $_POST['usernamelogin'];
	$pass = $_POST['passwordlogin'];
	
	$sqlget = "SELECT * FROM user WHERE Name=:nid";
	$q = $connection->prepare($sqlget);
	$q->bindParam(':nid',$user);
	$q->execute(array(':nid'=>$user));
	
	if ($pass1 = $q->fetch(PDO::FETCH_ASSOC)){
		extract($pass1);
		$hash = $pass1["Password"];
		
		$id = "1";
		$sqlgettok = "SELECT token FROM token WHERE User_ID=:uid";
		$qtok = $connection->prepare($sqlgettok);
		$qtok->bindParam(':uid',$id);
		$qtok->execute(array(':uid'=>$id));
		$tok = $qtok->fetch(PDO::FETCH_ASSOC);
		extract($tok);	
		$mtoken = $tok["token"];
		
		$plus = $pass.$mtoken;
		
		if (password_verify($plus, $hash)) { //time can be set in future with css
			$dateout = $pass1["Dateout"];
			date_default_timezone_set('Asia/Kuala_Lumpur');
			$timenow = date("Y-m-d H:i");
			
			if ($timenow < $dateout){
				echo "Access Granted";
			}else{
				echo "Access Denied";
			}
		}else{
			echo "Access Denied";
		}
	}else{
		echo "Access Denied";
	}
}

?>