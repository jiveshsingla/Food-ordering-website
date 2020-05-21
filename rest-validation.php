<?php session_start(); ?>
<?php
    require 'connection.php';
    $res_email=$_SESSION['global_res_email'];
     $sql = "select res_validation from restaurants where res_email='$res_email'";
//echo $sql;
//echo $email;
    $result = mysqli_query($conn, $sql);
//echo  mysqli_error($conn);
//echo $result;
    while($row = mysqli_fetch_assoc($result))
        $final=($row['res_validation']);
//echo $result;
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['verify']) && isset($_POST['verificationcode'])){
        $code = $_POST['verificationcode'];
       if($final==$code)
        {
          echo "YOUR ACOOUNT IS VERIFIED";
          header( "refresh:2; url=../restaurant-login.php");
        }
        else
        {
           $sql = "delete from restaurants where res_email='$res_email'";          
           $result= mysqli_query($conn,$sql);
           if($result)
           {
               echo "your otp is wrong.Sign Up again to continue<br>";
               header( "refresh:2; url=../restaurant-signup.php");
           }
        }
    }
}
?>