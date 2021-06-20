<?php 
	session_start();

	if( !isset($_SESSION["login"]) ){
		header("Location: login.php");
		exit;
	}
	require 'functions.php';
	$id = $_GET["id"];


	if (dikembalikan($id)>0){
			echo "
				<script>
					alert('Buku berhasil dikembalikan');
					document.location.href = 'peminjaman.php';
				</script>
			";
		}else{
			echo "<script>
					alert('buku tidak berhasil dikembalikan');
					document.location.href = 'peminjaman.php';
				</script>";
		}
?>