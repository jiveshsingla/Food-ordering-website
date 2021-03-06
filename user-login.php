<!DOCTYPE html>
<html>
<head>
	<title>SpiceShuttle</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="jumbotron">
	<nav class="navbar navbar-inverse navbar-fixed-top">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="index.php"><button class="btn btn-danger navbar-btn">SpiceShuttle</button> </a>
	    </div>
	    <!--	<div class="nav navbar-nav navbar-right">
	      <a href="restaurant-signup.php"><button class="btn btn-danger navbar-btn"> Ally With Us</button></a>&nbsp
			<a href="user-signup.php"><button class="btn btn-danger navbar-btn">Sign Up &nbsp<span class="glyphicon glyphicon-user"></span> </button></a>
	        <a href="user-login.php"><button class="btn btn-danger navbar-btn">Sign In &nbsp<span class="glyphicon glyphicon-log-in"></span> </button></a>
		</div> -->
		</div>
		</nav>
		</div>
	
	<div class="container col-md-6 col-md-offset-3">
		<form action="files/authenticate.php" method="post">	
		  <div class="form-group">
		    <label>Email<b>*</b></label>
		    <input type="email" class="form-control" id="email" name="email" required/>
		  </div>
		  <div class="form-group">
		    <label>Password<b>*</b></label>
		    <input type="password" class="form-control" id="password" name="password" required/>
		  </div>
		  <input type="submit" name="user_signin" class="btn btn-success" value="Sign in">
		   <span>Don't have account? <a class="text-danger" href="user-signup.php">Sign up</a></span>
		</form>
	</div>	
</body>
</html>