<?php 
	session_start();

	if( !isset($_SESSION["login"]) ){
		header("Location: login.php");
		exit;
	}
	require "functions.php";

	if (isset($_POST["submit"])){

		//query insert

		if (tambahAnggota($_POST) > 0 ){
			echo "
				<script>
					alert('Data berhasil Ditambahkan');
					document.location.href = 'anggota.php';
				</script>
			";
		}else{
			echo "<script>
					alert('Data tidak berhasil Ditambahkan');
					document.location.href = 'anggota.php';
				</script>";
		}
}
	require 'template/header.php'
?>

<main>
<a href="anggota.php" class="btn-utama">beranda</a>
	<h1 class="judul2">Tambah data anggota</h1>

	<form action="" method="post" enctype="multipart/form-data">
		<ul class="list-form">
			<li>
				<label for="nama">Nama lengkap<br></label>
				<input type="text" name="nama" id="nama" required placeholder="Masukkan nama lengkap">
			</li>
			<li>
				<label>Jenis kelamin<br></label>
				<input type="radio" id="laki-laki" name="jeniskelamin" value="Laki-laki" class="radio">
				<label for="laki-laki">Laki-laki</label><br>
				<input type="radio" id="perempuan" name="jeniskelamin" value="Perempuan" class="radio">
				<label for="perempuan">Perempuan</label><br>
			</li>
			<li>
				<label for="telp">No Telepon<br></label>
				<input type="text" name="telp" id="telp" required placeholder="Masukkan no telepon">
			</li>
			<li>
				<label for="pekerjaan">Pekerjaan<br></label>
				<input type="text" name="pekerjaan" id="pekerjaan" required placeholder="Masukkan pekerjaan">
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