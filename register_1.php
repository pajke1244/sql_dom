<?php 
require_once "functions.php";
$message="";
if (isset($_POST['register'])) {
	$username=$_POST['username'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$c_password=$_POST['c_password'];

	if ($password != $c_password) {
		$message= "Please Check your password";
	}else{

		$sql="SELECT * FROM users where email = '$email'";
		$stmt=sqlsrv_query($conn,$sql, array(), array("Scrollable" => 'static' ));
		$brojac=sqlsrv_num_rows($stmt);
		if ($brojac===0) {
			//$hash=password_hash($password, PASSWORD_BCRYPT);
			$query="INSERT INTO users (name,email,password,role) values ('$username' , '$email' , '$password','user') ";
			$stmt1=sqlsrv_query($conn,$query);
			if ($stmt1) {
				$message= "Uspesno ste se registrovali";
				header("Location: login_1.php");
			}else{
				$message= "NeUspesno ste se registrovali";
			}
			
			// redirect("register.php");
		}else{
			$message="Postoji korisnik sa istim emailom";
			// redirect("register.php");
		}

	}
}
?>
<!DOCTYPE html>
<!--www.codingflicks.com--> 
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Register</title>
	<link href="login.css" rel="stylesheet">
</head>
<body>
	<div class="form-box">
		<div class="header-text">
			Register
		</div>

		<form action="register_1.php" method="post">
			<input placeholder="Your Username" type="text" name="username" required=""> 
			<input placeholder="Your Email" type="email" name="email" required=""> 
			<input placeholder="Your Password" type="password" name="password"> 
			<input placeholder="Confirm Password" type="password" name="c_password"> 
			<button type="submit" name="register">Register</button>
		</form>
		<div class="field_error">
			<?php if (isset($message)) {
				echo $message;
			} ?>
		</div>
	</div>
</body>
</html>