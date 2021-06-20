<?php 
	session_start();

	if( !isset($_SESSION["login"]) ){
		header("Location: login.php");
		exit;
	}
	require 'functions.php';
	$id = $_GET["id"];


	if (perpanjang($id)>0){
			echo "
				<script>
					alert('Masa peminjaman berhasil diperpanjang');
					document.location.href = 'peminjaman.php';
				</script>
			";
		}else{
			echo "<script>
					alert('Masa peminjaman tidak berhasil diperpanjang');
					document.location.href = 'peminjaman.php';
				</script>";
		}
?>