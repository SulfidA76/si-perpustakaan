<?php 
	session_start();

	if( !isset($_SESSION["login"]) ){
		header("Location: login.php");
		exit;
	}
	require 'functions.php';
	$id = $_GET["id"];


	if (hapus($id)>0){
			echo "
				<script>
					alert('Data berhasil Dihapus');
					document.location.href = 'buku.php';
				</script>
			";
		}else{
			echo "<script>
					alert('Data tidak berhasil Dihapus, kosogkan peminjaman terlebih dahulu');
					document.location.href = 'buku.php';
				</script>";
		}
?>