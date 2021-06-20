<?php 

session_start();
require 'functions.php';
//cek cookie

if( isset($_COOKIE['id']) && isset($_COOKIE['key']) ){
	$id = $_COOKIE['id'];
	$key = $_COOKIE['key'];

	//ambil username berdasarkan id
	$result = mysqli_query($conn,"SELECT * FROM user WHERE id = $id");
	$row = mysqli_fetch_assoc($result);

	//cek cookie dan username

	if ($key === hash('sha256',$row["username"])){
		$_SESSION["login"] = true;
	}

}



if (isset($_SESSION["login"])){
	header("Location: index.php");

	exit;
}



if ( isset($_POST["login"]) ){
	$username = $_POST["username"];
	$password = $_POST["password"];

	$result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

	if ( mysqli_num_rows($result) == 1){
		//cek [password]
		$row = mysqli_fetch_assoc($result);
		if ( password_verify($password, $row["password"]) ){
			//SET SESION
			$_SESSION["login"] = true;

			//cek remember me

			if( isset($_POST["remember"])){
				//buat cookie


				setcookie('id',$row['id'],time()+3600*24);
				setcookie('key',hash('sha256',$row['username']), time()+3600*24);
			}

			header("Location: index.php");
			exit;
		}
	}
	
	$error = true;

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="container">
		
		<section class="login-box">
			<h1>Login Admin</h1>

			<?php if( isset($error)): ?>
				<p style="color: red; font-style: italic;">username/password salah</p>
			<?php endif; ?>
			<p>Don't have an account?<a href="registrasi.php">sign in</a></p>

			<form action="" method="post">
			
				<input type="text" name="username" id="username" placeholder="Username" class="input_text">
				
				
				<input type="password" name="password" id="password" placeholder="Password" class="input_text">
				
				<div class="form-group">
					<input type="checkbox" name="remember" id="remember" class="remember">
					<label for="remember">Remember me</label>
				</div>
				
				<button type="submit" name="login">Login</button>
				

			</form>

		</section>

	</div>
	
</body>
</html>