<?php 
	session_start();

	if( !isset($_SESSION["login"]) ){
		header("Location: login.php");
		exit;
	}

    require 'functions.php';
    
	$anggotas = query("SELECT * FROM anggota order by nama");

	if ( isset($_POST["cari"]) ){
		$anggotas = cari($_POST["keywordA"]);
	}

	require 'template/header.php'

?>

<main>
		<h1>Daftar Anggota Perpustakaan</h1>

		<a href="tambahAnggota.php" class="btn-utama">Tambah Data Anggota</a>
		<br><br>

		<!-- SEARCH -->

		<form action="" method="post" >

			<input type="text" name="keywordA" size ="33" autofocus placeholder="Masukkan keyword pencarian" autocomplete="off" id="keywordA" class="search">
			<button type="submit" name="cari" id="tombol-cari">Cari</button>

			<img src="img/loader.gif" class="loader" id="loader">

		</form>
		<br>
		
		<div id="container-table">

            <table class="content-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        
                        
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>No Telpon</th>
                        <th>Pekerjaan</th>
                        <th>Tanggal Bergabung</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; ?>
                    <?php foreach($anggotas as $anggota) : ?>
                        <tr>
                            <td><?= $i; ?></td>
                            
                            
                            <td><?= $anggota["nama"]; ?></td>
                            <td><?= $anggota["jeniskelamin"];  ?></td>
                            <td><?= $anggota["telp"];  ?></td>
                            <td><?= $anggota["pekerjaan"];  ?></td>
                            <td><?= date("d-m-Y",$anggota["tanggalbergabung"]);  ?></td>
                            <td>
                                <div class="aksi">
                                    <a href="ubahAnggota.php?id=<?= $anggota["id"]; ?>" class="ubah">Ubah</a> 
                                    <a href="hapusAnggota.php?id=<?= $anggota["id"]; ?>" class="hapus" onclick="return confirm('Yakin ingin menghapus data?')">Hapus</a>
                                </div>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>

            </table>

	    </div>
	</main>
<?php
    require 'template/footer.php';
?>