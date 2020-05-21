<?php session_start(); ?>
<?php
	require 'files/connection.php';
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		if(isset($_POST['res_further_submit']) && isset($_POST['res_name'])  && isset($_POST['res_number']) && isset($_POST['res_city']) ){

	        $res_name = $_POST['res_name'];
	        $res_email = $_SESSION['email_api'];
	        $res_number = $_POST['res_number'];
            $res_city = $_POST['res_city'];
            $res_password = $_POST['res_password'];
            $hashrespassword = md5($res_password);

	        
			$flag=0;
			if (!preg_match("/^[a-zA-Z ]*$/",$res_city)) {
				$flag=1;
				echo "error occured:Please enter valid restaurant city<br>";
				header( "refresh:2; url=res_further_signup.php" );
			  }

			  if (!preg_match("/^[0-9]+$/",$res_number)) {
				  $flag=1;
				echo "error occured:Please enter valid restaurant number<br>";
				header( "refresh:2; url=res_further_signup.php" );
              } 
              
              if($flag==0){
                $sql="select * from restaurants where res_name='$res_name' or res_number='$res_number'";
                $result=$conn->query($sql);
                $count = mysqli_num_rows($result);
  //echo  mysqli_error($conn);
  //print_r($result);
                if($count==0) {

                    $sql="Update restaurants set res_name='$res_name' where res_email='$res_email'";
                    $result=mysqli_query($conn,$sql);
                    $sql="Update restaurants set res_password='$hashrespassword' where res_email='$res_email'";
                    $result=mysqli_query($conn,$sql);

    //  echo  mysqli_error($conn);
    //print_r($result);
                        $sql="Update restaurants set res_number='$res_number' where res_email='$res_email'";
                        $result=mysqli_query($conn,$sql);

                        $sql="Update restaurants set res_city='$res_city' where res_email='$res_email'";
                        $result=mysqli_query($conn,$sql);
                        if($result){
                                      echo "Sign-up Complete redirected to Signin page ";
                                      header( "refresh:2; url=restaurant-login.php");
                                      }
                                else{
                                    echo "Sorry error occured.Please try again later.";
                                }
                  
                          }                    
                          else {
                                  echo "Sorry.Entered Credentials Already Exists<br>";
                                  header( "refresh:2; url=res_further_signup.php" );
                              }
                          }
			 
            }
    }
?>