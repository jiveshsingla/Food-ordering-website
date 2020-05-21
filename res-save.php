<?php session_start(); ?>
<?php
	require 'connection.php';
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		if(isset($_POST['res_submit']) && isset($_POST['res_name']) && isset($_POST['res_email']) && isset($_POST['res_number']) && isset($_POST['res_city']) && isset($_POST['res_password'])){

	        $res_name = $_POST['res_name'];
	        $res_email = $_POST['res_email'];
	        $res_number = $_POST['res_number'];
	        $res_city = $_POST['res_city'];
	        $res_password = $_POST['res_password'];
			$hashrespassword = md5($res_password);

			$validation_code = rand (1000, 100000);
			$_SESSION['global_res_email']=$res_email;
			$flag=0;
			if (!preg_match("/^[a-zA-Z ]*$/",$res_city)) {
				$flag=1;
				echo "error occured:Please enter valid restaurant city<br>";
				header( "refresh:1; url=../restaurant-signup.php" );
			  }

			  if (!preg_match("/^[0-9]+$/",$res_number)) {
				  $flag=1;
				echo "error occured:Please enter valid restaurant number<br>";
				header( "refresh:2; url=../restaurant-signup.php" );
			  } 
			  
			  $flag1=0;
			  $sql="select * from restaurants where res_name='$res_name' or res_email='$res_email' or res_number='$res_number'";
			  $result=$conn->query($sql);
			  $count = mysqli_num_rows($result);
			  if($count==0) {
				if($flag!=1){
				$sql="insert into restaurants (res_name, res_email, res_number, res_city, res_password,res_validation) values ('$res_name', '$res_email', '$res_number', '$res_city', '$hashrespassword','$validation_code')";
					$result=$conn->query($sql);
					if($result){
		    	     	//$receiver_email =$res_email;
						$subject = "Email for your Account Verification";
						$body = "Please Enter the validation code to to be able to register with SpiceShuttle.\nYor verification code is : $validation_code";
						$headers = "From: SpiceShuttle@gmail.com";
					if (mail($res_email, $subject, $body,$headers)) { //Returns the hash value of the address parameter,false on failure
							echo "Verification code has been sent to your email successfully";
							echo "Please enter your OTP in the check box given below";
								$flag1=1;}                            
						else {
								echo "Sorry error occured.Account verification not successful";
								$sql = "delete from restaurants where res_email='$res_email'";
								$result=mysqli_query($conn,$sql);
								if($result)
								header( "refresh:2; url=../restaurant-signup.php" );
							}
						}
					}
				}
				else{
					echo "error occured:Restaurant with the entered credentials already exists.Please enter unique credentials";
					header( "refresh:2; url=../restaurant-signup.php" );}
			}
		}
?>
<?php
if($flag1==1)
{?>
<html><head>
<title>SpiceShuttle</title>
</head>
<body>
   <form action="rest-validation.php" method="post">    
	<label>PLEASE ENTER VALIDATION CODE: <label>
	<input type="number" name="verificationcode">
    <input type="submit" name='verify' value="CHECK">
</form>
</body></html>
<?php }?>