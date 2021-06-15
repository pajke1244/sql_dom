<!DOCTYPE html>
<html>
<head>
	<style>

		body{
			background-image: url("pozadina.jpg");
			background-repeat: no-repeat;
			 background-size: cover;
		}

		.container { 
			margin-top: 290px;
			height: 200px;
			position: relative;
		}

		.center {
			margin: 0;
			position: absolute;
			top: 50%;
			left: 50%;
			-ms-transform: translate(-50%, -50%);
			transform: translate(-50%, -50%);
		}

		.button {
			padding: 15px 25px;
			font-size: 24px;
			text-align: center;
			cursor: pointer;
			outline: none;
			color: #fff;
			background-color:#455CF6;
			border: none;
			border-radius: 15px;
			box-shadow: 0 9px #999;
		}

		.button:hover {background-color: #6699ff}

		.button:active {
			background-color: #6699ff;
			box-shadow: 0 5px #666;
			transform: translateY(4px);
		}

		a{
			text-decoration: none;
		}

		h2{
			text-align: center;
			color: #6699FF;
		}

	}
</style>
</head>
<body>
	<div class="container">
		<div class="center">
			<form method="post" action="index.php">
				<h2>Welcome</h2>
				<a href="login_1.php" class="button">Login</a>
				<a href="register_1.php" class="button">Register</a>				
			</form>
		</div> 
	</div>
	<?php 

	if (isset($_POST['bla'])) {

		echo "<h1>STEFAN JE CAR</h1>";
	}

	?>
</body>
</html>
