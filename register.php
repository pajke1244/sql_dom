<?php 
require_once "functions.php";
$msg="";
if (isset($_POST['register'])) {
	$username=$_POST['username'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$c_password=$_POST['c_password'];

	if ($password != $c_password) {
		$msg= "Please Check your password";
	}else{

		$sql="SELECT * FROM users where email = '$email'";
		$stmt=sqlsrv_query($conn,$sql, array(), array("Scrollable" => 'static' ));
		$brojac=sqlsrv_num_rows($stmt);
		if ($brojac===0) {
			//$hash=password_hash($password, PASSWORD_BCRYPT);
			$query="INSERT INTO users (name,email,password,role) values ('$username' , '$email' , '$password','user') ";
			$stmt1=sqlsrv_query($conn,$query);
			if ($stmt1) {
			$msg= "Uspesno ste se registrovali";
			}else{
				$msg= "NeUspesno ste se registrovali";
			}
			
			// redirect("register.php");
		}else{
			$msg="Postoji korisnik sa istim emailom";
			// redirect("register.php");
		}

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
	
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-2"></div>
			<div class="col-lg-6 col-md-8 login-box">
				<div class="col-lg-12 login-key">
					<i class="fa fa-key" aria-hidden="true"></i>
				</div>
				<div class="col-lg-12 login-title">
					REGISTER
					<h1 style="color: white">	
						<?php 

					if (isset($msg)) {
						echo $msg;
					}
					?>

				</h1>
			</div>

			<div class="col-lg-12 login-form">
				<div class="col-lg-12 login-form">
					<form method="post" action="register.php">
						<div class="form-group">
							<label class="form-control-label">USERNAME</label>
							<input type="text" class="form-control" name="username">
						</div>
						<div class="form-group">
							<label class="form-control-label">EMAIL</label>
							<input type="email" class="form-control" name="email">
						</div>
						<div class="form-group">
							<label class="form-control-label">PASSWORD</label>
							<input type="password" name="password" class="form-control">
						</div>
						<div class="form-group">
							<label class="form-control-label">CONFIRM PASSWORD</label>
							<input type="password" name="c_password" class="form-control">
						</div>

						<div class="col-lg-12 loginbttm">
							<div class="col-lg-6 login-btm login-text">									
							</div>
							<div class="col-lg-6 login-btm login-button">
								<button type="submit" class="btn btn-outline-primary" name="register">REGISTER</button>
							</div>
						</div>
					</form>
				</div>
			</div>

		</div>
	</div>





</body>
</html>