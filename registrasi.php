<?php 

require 'functions.php';


if ( isset($_POST["register"])){

	if (registrasi($_POST) > 0){
		echo "<script>
			alert('user baru berhasil ditambahkan');
			</script>";
			header("Location: login.php");
			exit;
	}else {
		echo mysqli_error($conn);
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Halaman Registrasi</title>
	<link rel="stylesheet" href="css/style.css">
	<style>
		label{
			display: block;
		}
	</style>
</head>
<body>
	<div class="container">
		
		<section class="login-box">
			<h1>Halaman Registrasi</h1>	
			<p>Do have an account?<a href="login.php">log in</a></p>
			<form action="" method="post">
						<input type="text" name="username" id="username" placeholder="Username" class="input_text">
					
						<input type="password" name="password" id="password" placeholder="Password" class="input_text">
					
						<input type="password" name="password2" id="password2" placeholder="Konfirmasi Password" class="input_text">
					
					<button type="submit" name="register">Registrasi</button>
				
			</form>

		</section>

	</div>
	
</body>
</html>