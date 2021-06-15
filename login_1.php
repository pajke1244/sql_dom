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

		// header("Location: index.php");
		$message="Invalid username or password";
	}

}


?>
<!DOCTYPE html>
<!--www.codingflicks.com--> 
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Transparent Login Form HTML CSS</title>
	<link href="login.css" rel="stylesheet">
</head>
<body>
	<div class="form-box">
		<div class="header-text">
			Login Form
		</div>
		<form action="login_1.php" method="post">
			<input placeholder="Your Email Address" type="email" name="email" required=""> 
			<input placeholder="Your Password" type="password" name="password"> 
			<button type="submit" name="login">LOGIN</button>
		</form>
		<div class="field_error">
			<?php if (isset($message)) {
				echo $message;
			} ?>
		</div>

	</div>
</body>
</html>
