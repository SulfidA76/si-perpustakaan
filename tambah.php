<?php 
	session_start();

	if( !isset($_SESSION["login"]) ){
		header("Location: login.php");
		exit;
	}
	require "functions.php";

	if (isset($_POST["submit"])){

		//query insert

		if (tambah($_POST) > 0 ){
			echo "
				<script>
					alert('Data berhasil Ditambahkan');
					document.location.href = 'buku.php';
				</script>
			";
		}else{
			echo "<script>
					alert('Data tidak berhasil Ditambahkan');
					document.location.href = 'buku.php';
				</script>";
		}
}
	require 'template/header.php'
?>

<main>
<a href="buku.php" class="btn-utama">beranda</a>
	<h1 class="judul2">Tambah Data Buku</h1>

	<form action="" method="post" enctype="multipart/form-data">
		<ul class="list-form">
			<li>
				<label for="judul"> Judul<br></label>
				<input type="text" name="judul" id="judul" required placeholder="Masukkan judul">
			</li>
			<li>
				<label for="penulis">Penulis<br></label>
				<input type="text" name="penulis" id="penulis" required placeholder="Masukkan penulis">
			</li>
			<li>
				<label for="penerbit">Penerbit<br></label>
				<input type="text" name="penerbit" id="penerbit" required placeholder="Masukkan penerbit">
			</li>
			<li>
				<label for="tahunterbit">Tahun terbit<br></label>
				<input type="text" name="tahunterbit" id="tahunterbit" placeholder="Masukkan tahun terbit(ex. 2012)">
			</li>
			<li>
				<label for="jenis">Jenis buku<br></label>
				<input type="text" name="jenis" id="jenis" placeholder="Masukkan jenis buku">
			</li>
			<li>
				<label for="deskripsi" >Deskripsi<br></label>
				<textarea name="deskripsi" id="deskripsi" cols="100" rows="10" placeholder="Masukkan deskripsi buku maksimal 1000 karakter"></textarea>
			</li>
			<li>
				<label for="cover">Cover <br></label>
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