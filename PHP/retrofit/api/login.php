<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	include 'connection.php';
	userLogin();
}

function userLogin(){
	
	global $connect;
	
	$username = $_POST["username"];
	$password = md5($_POST["password"]);
	
	$login = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
	
	$result = mysqli_query($connect,$login);
	$json  = array();
 $i=0;
	if($result && mysqli_affected_rows($connect)>0){

		$number_of_rows = mysqli_num_rows($result); 
		
		
		if($number_of_rows > 0) {
       
		$json['data'][$i]['res_msg']="login success";
		$json['data'][$i]['res_code']=1;
		
		 while ($row = mysqli_fetch_assoc($result)) {

			$json['data'][$i]['id']=$row['u_id'];
    $json['data'][$i]['username']=$row['username'];
	$json['data'][$i]['firstname']=$row['firstname'];
	$json['data'][$i]['lastname']=$row['lastname'];

			
		} 
				
 	 
	}
	}

	else if(mysqli_affected_rows($connect) == 0){
		$json['data'][$i]['res_msg'] = 'login failed';
		$json['data'][$i]['res_code'] = 0;
	}
	
	
	header('Content-Type: application/json');
	 // echo json_encode(array("locator"=>$json));
	 echo json_encode($json);
	 mysqli_close($connect);
}





?>