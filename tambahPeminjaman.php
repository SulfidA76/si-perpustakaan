<?php 
	session_start();

	if( !isset($_SESSION["login"]) ){
		header("Location: login.php");
		exit;
	}
	require "functions.php";
	$bukus = query("SELECT * FROM buku");
	$anggotas = query("SELECT * FROM anggota");


	if (isset($_POST["submit"])){

		//query insert

		if (tambahPeminjaman($_POST) > 0 ){
			echo "
				<script>
					alert('Data berhasil Ditambahkan');
					document.location.href = 'peminjaman.php';
				</script>
			";
		}else{
			echo "<script>
					alert('Data tidak berhasil Ditambahkan');
					document.location.href = 'peminjaman.php';
				</script>";
		}
}
	require 'template/header.php'
?>

<main>
<a href="peminjaman.php" class="btn-utama">beranda</a>
	<h1 class="judul2">Tambah Data Buku</h1>

	<form action="" method="post" enctype="multipart/form-data">
		<ul class="list-form">
			<li>
				<label for="buku">Buku<br></label>
				<input type="text" name="buku" id="buku-peminjaman" required placeholder="Masukkan judul buku"><br>
				<select name="select-buku" id="select-buku" required></select>
			</li>
			<li>
				<label for="anggota">Anggota<br></label>
				<input type="text" name="anggota" id="anggota-peminjaman" required placeholder="Masukkan nama anggota"><br>
				<select name="select-anggota" id="select-anggota"required></select>
			</li>
			<li>
				<button type="submit" name="submit" class="button submit">Kirim</button>
			</li>
		</ul>


	</form>
</main>

<?php 
	require 'template/footer.php'
?>