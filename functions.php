<?php require_once "config.php" ?>

<?php 
session_start();
ob_start();
//helper function/funkcija za setovanje poruka
function set_message($msg){
	if (!empty($msg)) {
		$_SESSION['message']=$msg;
	}else{
		$msg="";
	}
}

//funkcija za prikaz poruka

function display_message(){
	if (isset($_SESSION['message'])) {
		echo $_SESSION['message'];
		unset($_SESSION['message']);
	}
}

//funkcija za redirekciju

function redirect($location){
	return header("Location: $location");
}

//funckija za kveri

function query($sql){
	global $connection;
	return sqlsrv_query($connection,$sql);
}

//funkcija za proveru kverija

function confirm($result){
	global $connection;
	if (!$result) {
		die("QUERY FAILED ");
	}
}

//funkcija za sigurnije logovanje

function escape_string($string){
	global $connection;
	return sqlsrv_real_escape_string($connection,$string);
}

//funkcija za fetch

function fetch_array($result){
	return mysqli_fetch_array($result);
}

//pomocna funkcija za ispis
function ispis(){
	echo "<pre>";
	echo "HELLO";
	echo "</pre>";
}

?>