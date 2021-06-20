<?php 
	session_start();

	if( !isset($_SESSION["login"]) ){
		header("Location: login.php");
		exit;
	}
require "functions.php";

$id = $_GET["id"];

$buku= query("SELECT * FROM buku WHERE id=$id")[0];


if (isset($_POST["submit"])){

	
	if (ubah($_POST) > 0 ){
		echo "
			<script>
				alert('Data berhasil Diubah');
				document.location.href = 'buku.php';
			</script>
		";
	}else{
		echo "<script>
				alert('Data tidak berhasil Diubah');
				document.location.href = 'buku.php';
			</script>";
	}
}
require 'template/header.php'

?>
<main>

	<a href="buku.php" class="btn-utama">beranda</a>
		<h1 class="judul2">Ubah data buku</h1>
	
		<form action="" method="post" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?= $buku["id"]; ?>">
			<input type="hidden" name="coverLama" value="<?= $buku["cover"]; ?>">
			<ul class="list-form">
				<li>
					<label for="judul"> Judul<br></label>
					<input type="text" name="judul" id="judul" required value="<?= $buku["judul"]; ?>">
				</li>
				<li>
					<label for="penulis">Penulis<br></label>
					<input type="text" name="penulis" id="penulis" required value="<?= $buku["penulis"]; ?>">
				</li>
				<li>
					<label for="penerbit">Penerbit<br></label>
					<input type="text" name="penerbit" id="penerbit" required value="<?= $buku["penerbit"]; ?>">
				</li>
				<li>
					<label for="tahunterbit">Tahun terbit<br></label>
					<input type="text" name="tahunterbit" id="tahunterbit" required value="<?= $buku["tahunterbit"]; ?>">
				</li>
				<li>
					<label for="jenis">Jenis<br></label>
					<input type="text" name="jenis" id="jenis" required value="<?= $buku["jenis"]; ?>">
				</li>
				<li>
					<label for="deskripsi">Deskripsi<br></label>
					<textarea name="deskripsi" id="deskripsi" cols="100" rows="10" ><?= $buku["Deskripsi"]; ?></textarea>
					
				</li>
				<li>
					<label for="cover">Cover<br></label> <br>
					<img src="img/<?= $buku["cover"]; ?>" width="100px"><br>
					<input type="file" name="cover" id="cover">
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