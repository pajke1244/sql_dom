<?php 
session_start();
require_once "../config.php";
if (isset($_SESSION['role'])) {

	if ($_SESSION['role'] != 'admin') {

		header("Location: ../user/index.php");
	}
}else{
	header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Admin panel</title>

	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="css/sb-admin.css" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<body>

	<div id="wrapper">

		<!-- Navigation -->
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.html">SB Admin</a>
			</div>
			<!-- Top Menu Items -->
			<ul class="nav navbar-right top-nav">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>  <?php echo $_SESSION['admin_user'] ?>  <b class="caret"></b></a>                    
					<ul class="dropdown-menu">
						<li class="divider"></li>
						<li>
							<a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
						</li>
					</ul>
				</li>
			</ul>
			<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav side-nav">
					<li>
						<a href="view_all_users.php"><i class="fa fa-fw fa-dashboard"></i> Users</a>
					</li>

					<li>                
					</ul>
				</div>
				<!-- /.navbar-collapse -->
			</nav>
			<!-- /.navbar-collapse -->
		</nav>
		<div id="page-wrapper">

			<div class="container-fluid">

				<!-- Page Heading -->
				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">
							All Users                          
						</h1>
						<form action="" method="post">
							<table class="table table-bordered table-hover">
								<thead>
									<tr>										
										<th>Id</th>
										<th>Name</th>
										<th>Email</th>								
										<th>Role</th>							
										<th>Team leader</th>
										<th>Employee</th>
										<th>Delete</th>								
									</tr>
								</thead>
								<tbody>
									<?php 
									$query="SELECT * from users";
									$select_users=sqlsrv_query($conn,$query, array(), array("Scrollable" => 'static' ));
									while ($row=sqlsrv_fetch_array( $select_users, SQLSRV_FETCH_ASSOC)) {
										$user_id=$row['id'];										
										$user_name=$row['name'];									
										$user_email=$row['email'];
										$user_password=$row['password'];
										$user_role=$row['role'];
										echo "<tr>";
										?>
										<?php
										echo "<td>{$user_id}</td>";
										echo "<td>{$user_name}</td>";
										echo "<td>{$user_email}</td>";
										echo "<td>{$user_role}</td>";										
										echo "<td><a href='view_all_users.php?admin_id={$user_id}'>admin</a></td>";
										echo "<td><a href='view_all_users.php?user_id={$user_id}'>user</a></td>";
										echo "<td><a href='view_all_users.php?delete={$user_id}'>Delete</a></td>";				
										echo "</tr>";

									}					
									?>						
								</tbody>
							</table>


						</div>
					</div>
					<!-- /.row -->

				</div>
				<!-- /.container-fluid -->

			</div>
			<!-- /#page-wrapper -->

		</div>
		<!-- /#wrapper -->

		<!-- jQuery -->
		<script src="js/jquery.js"></script>

		<!-- Bootstrap Core JavaScript -->
		<script src="js/bootstrap.min.js"></script>

	</body>

	</html>

	<?php 

	//unpprove funkcija
	if (isset($_GET['user_id'])) {
		$user_role=$_GET['user_id'];
		$query=" UPDATE  users set role = 'user' where id=$user_role ";
		$query_user=sqlsrv_query($conn,$query, array(), array("Scrollable" => 'static' ));
		header("Location: view_all_users.php");

	}

// //approve funkcija

	if (isset($_GET['admin_id'])) {
		$admin_role=$_GET['admin_id'];
		$query=" UPDATE  users set role = 'admin' where id=$admin_role ";
		$query_user=sqlsrv_query($conn,$query, array(), array("Scrollable" => 'static' ));
		header("Location: view_all_users.php");

	}

// //delete funkcija
	if (isset($_GET['delete'])) {
		$the_delete_user=$_GET['delete'];
		$query="DELETE from users where id=$the_delete_user ";
		$delete=sqlsrv_query($conn,$query, array(), array("Scrollable" => 'static' ));
		header("Location: view_all_users.php");

	}



	?>
