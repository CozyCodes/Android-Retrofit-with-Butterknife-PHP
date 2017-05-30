<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	include 'connection.php';
	userRegister();
}

function userRegister(){
	
	global $connect;
	
	$username = $_POST["username"];
	$password = md5($_POST["password"]);
	$firstname = $_POST["firstname"];
	$lastname = $_POST["lastname"];
			

			
	$check ="SELECT * FROM users WHERE username='$username'";

	 $ck = mysqli_query($connect,$check);
	 $json  = array();
	 $i=0;
	 $data = mysqli_fetch_array($ck, MYSQLI_NUM);
     if($data[0] > 0) { 
			 
		 $json['data'][$i]['res_msg'] = 'user already exists';

}else{
		$newuser ="INSERT INTO users(username, password, firstname, lastname) values('$username', '$password', '$firstname', '$lastname') ";
	if(mysqli_query($connect, $newuser)){
	     $json['data'][$i]['res_msg']="user registration successful";
		    $json['data'][$i]['res_code']=1;
	}
			
	else{
		   $json['data'][$i]['res_msg'] = 'user registration failed';
		   $json['data'][$i]['res_code'] = 0; 
	   }
	 
	 
}
	
	header('Content-Type: application/json');
	 // echo json_encode(array("locator"=>$json));
	  echo json_encode($json);
	 mysqli_close($connect);
}




?>