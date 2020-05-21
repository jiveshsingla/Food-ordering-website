<?php
include('config.php');
$login_button = '';
if(isset($_GET["code"]))
{
 $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
 if(!isset($token['error']))
 {
  $google_client->setAccessToken($token['access_token']);

  $_SESSION['access_token'] = $token['access_token'];

  $google_service = new Google_Service_Oauth2($google_client);
 
  $data = $google_service->userinfo->get();
 
  if(!empty($data['given_name']))
  {
   $_SESSION['user_first_name'] = $data['given_name'];
  }

  if(!empty($data['family_name']))
  {
   $_SESSION['user_last_name'] = $data['family_name'];
  }

  if(!empty($data['email']))
  {
   $_SESSION['user_email_address'] = $data['email'];
  }

  if(!empty($data['gender']))
  {
   $_SESSION['user_gender'] = $data['gender'];
  }

  if(!empty($data['picture']))
  {
   $_SESSION['user_image'] = $data['picture'];
  }
 }
}

if(!isset($_SESSION['access_token']))
{

 $login_button = '<a href="'.$google_client->createAuthUrl().'">Signup With Google</a>';
}

?>

<html>
 <head>
  <title>PHP Login using Google Account</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script> 
  <style>
  h1 {
  text-align: center;
  text-transform: uppercase;
  color: #4CAF50;
}
body {
  	background-image: url("backgrnd.jpg");
  	background-repeat: no-repeat;
	  background-size: 2000px 1000px;
}
  </style>
 </head>
 <body>
  <div class="container">
   <div class="panel panel-default">
   <h1>Choose An Option To Sign In</h1>
    <br><br>
   <?php
   require 'files/connection.php';
   if($login_button == '')
   {
     $_SESSION['email_api']=$_SESSION['user_email_address'];
     $res_email=$_SESSION['user_email_address'];

      $sql="select * from restaurants where res_email='$res_email' ";
	  $result=$conn->query($sql);
	  $count = mysqli_num_rows($result);
      if($count==0){

     	$sql="insert into restaurants (res_email) values ('$res_email')";
        $result=$conn->query($sql);
        if($result)
        header( "refresh:2; url=res_further_signup.php");
        else
        {
        	echo "There is an internet distruption.Please Try Again!";
            header( "refresh:2; url=res_signup_option.php");
        }
     }
     else
     {
         echo "Restaurant email already registered.";
     	header( "refresh:2; url=logout.php");
     }
}

   echo '<center><button class="btn btn-danger">'.$login_button . '</button></center><br><br>';
   ?>
   <center><a href="restaurant-signup.php"><button class="btn btn-danger"> Signup Without Google</button></h3></center>
   </div>
  </div>
 </body>
</html>