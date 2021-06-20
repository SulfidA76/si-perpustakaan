<?php 
	session_start();

	if( !isset($_SESSION["login"]) ){
		header("Location: login.php");
		exit;
	}
require "functions.php";

$id = $_GET["id"];

$anggota= query("SELECT * FROM anggota WHERE id=$id")[0];

if (isset($_POST["submit"])){

	
	if (ubahAnggota($_POST) > 0 ){
		echo "
			<script>
				alert('Data berhasil Diubah');
				document.location.href = 'anggota.php';
			</script>
		";
	}else{
		echo "<script>
				alert('Data tidak berhasil Diubah');
				document.location.href = 'anggota.php';
			</script>";
	}
}
require 'template/header.php'

?>
<main>

	<a href="anggota.php" class="btn-utama">beranda</a>
		<h1 class="judul2">Ubah data Anggota</h1>


	<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?= $anggota["id"]; ?>">
		<ul class="list-form">
			<li>
				<label for="nama">Nama lengkap<br></label>
				<input type="text" name="nama" id="nama" required value="<?= $anggota["nama"]; ?>">
			</li>
			<li>
				<label>Jenis kelamin<br></label>
				<input type="radio" id="laki-laki" name="jeniskelamin" value="Laki-laki" class="radio" <?php if ($anggota['jeniskelamin']=='Laki-laki') echo 'checked'?>>
				<label for="laki-laki">Laki-laki</label><br>
				<input type="radio" id="perempuan" name="jeniskelamin" value="Perempuan" class="radio" <?php if ($anggota['jeniskelamin']=='Perempuan') echo 'checked'?>>
				<label for="perempuan">Perempuan</label><br>
			</li>
			<li>
				<label for="telp">No Telepon<br></label>
				<input type="text" name="telp" id="telp" required value="<?= $anggota["telp"]; ?>">
			</li>
			<li>
				<label for="pekerjaan">Pekerjaan<br></label>
				<input type="text" name="pekerjaan" id="pekerjaan" required value="<?= $anggota["pekerjaan"]; ?>">
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