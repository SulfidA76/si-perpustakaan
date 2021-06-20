<?php 
	session_start();

	if( !isset($_SESSION["login"]) ){
		header("Location: login.php");
		exit;
	}

	require 'functions.php';

	$bukus = query("SELECT * FROM buku ORDER BY judul");

	if ( isset($_POST["cari"]) ){
		$bukus = cari($_POST["keyword"]);
	}

	require 'template/header.php'

?>

	<main>
		<h1>Daftar Buku</h1>

		<a href="tambah.php" class="btn-utama">Tambah Data Buku</a>
		<br><br>

		<!-- SEARCH -->

		<form action="" method="post" >

			<input type="text" name="keyword" size ="33" autofocus placeholder="Masukkan keyword pencarian" autocomplete="off" id="keyword" class="search">
			<button type="submit" name="cari" id="tombol-cari">Cari</button>

			<img src="img/loader.gif" class="loader" id="loader">

		</form>
		<br>
		
		<div class="container" id="container">
			
			<?php foreach($bukus as $buku) : ?>
				<div class="card card-shadow">
					<div class="cover">
						<img src="img/<?= $buku["cover"]; ?>" alt="">
					</div>
					<div class="content">
						<h4><?= cekPanjangText($buku["judul"]);?></h4>
						<p><?= cekPanjangText($buku["penulis"]); ?></p>
						<p><?= $buku["tahunterbit"];  ?> - <?= $buku["jenis"];  ?></p>
						<button class="button" id="modalBtn" onclick="modal(<?= $buku['id'];  ?>)">Selengkapnya</button>
						
					</div>
				</div>
				
			<?php endforeach; ?>

			
		</div>
	</main>
			<div id="simpleModal" class="modal">
					<div class="modal-content">
						<div class="modal-header">
							<span class="closeBtn">&times;</span>
							<h2>Deskripsi buku</h2>
						</div>
						<div id="container-modal"></div>
						
					</div>
				</div>

<?php 
	require 'template/footer.php'
?>

