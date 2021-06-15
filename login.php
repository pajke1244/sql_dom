<?php 
//ukljucujem sesiju
session_start();
require_once "config.php";
$message="";
$role="";
if (isset($_POST['login'])) {

	$email=$_POST['email'];
	$password=$_POST['password'];

	$query="SELECT * FROM users where email = '$email' and password ='$password' ";
	$result=sqlsrv_query($conn,$query, array(), array("Scrollable" => 'static' ));
	if (sqlsrv_num_rows($result)>0) {
		while ($row=sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {
			if ($row['role']== "admin") {
				$_SESSION['admin_user']=$row["name"];
				$_SESSION['role']=$row['role'];
				header("Location: admin/index.php");
			}else{
				$_SESSION['user_login']=$row["name"];
				$_SESSION['role']=$row['role'];
				header("Location: user/index.php");
			}
		}

	}else{

		header("Location: index.php");
		$message="Invalid username or password";
	}

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
	<link rel="stylesheet" href="css/css.css">
	<title>Document</title>

</head>
<body>
	
	<div class="container"style="margin-top: 200px;">
		<div class="row">
			<div class="col-lg-3 col-md-2"></div>
			<div class="col-lg-6 col-md-8 login-box">
				<div class="col-lg-12 login-key">
					<i class="fa fa-key" aria-hidden="true"></i>
				</div>
				<div class="col-lg-12 login-title" >
					LOGIN
				</div>

				<div class="col-lg-12 login-form" >
					<div class="col-lg-12 login-form" >
						<form method="post" action="login.php" >
							<div class="form-group">
								<label class="form-control-label" style="font-size: 12px ">EMAIL</label>
								<input type="email" class="form-control" name="email">
							</div>
							<div class="form-group">
								<label class="form-control-label" style="font-size: 12px">PASSWORD</label>
								<input type="password" name="password" class="form-control">
							</div>

							<div class="col-lg-12 loginbttm">							
								<p style="color:white"><?php 

								if (isset($message)) {
									echo $message;
								}

								?></p>						
								<div class="col-lg-6 login-btm login-button">
									<button type="submit" class="btn btn-outline-primary" style="margin-right: 250px;" name="login">LOGIN</button>
								</div>
							</div>
						</form>
					</div>
				</div>			
			</div>
		</div>
	</div>
</body>
</html>