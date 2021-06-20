<?php 
	session_start();

	if( !isset($_SESSION["login"]) ){
		header("Location: login.php");
		exit;
	}

	require 'functions.php';
	createdata();
	$buku = query("SELECT * FROM buku ORDER BY id");
	$buku = $buku[count($buku)-1];
	$jenis = query("SELECT jenis, COUNT(jenis) AS jumlah FROM buku GROUP BY jenis ORDER BY jumlah desc, jenis");
	$peminjaman = query("SELECT s.status AS status, COUNT(p.idStatus) AS jumlah FROM statuspeminjaman s, peminjaman p WHERE s.id = p.idStatus GROUP BY p.idStatus");
	$jeniskelamin = query("SELECT  COUNT(jeniskelamin) AS jumlah FROM anggota GROUP BY jeniskelamin ORDER BY jeniskelamin");

	if ( isset($_POST["cari"]) ){
		$bukus = cari($_POST["keyword"]);
	}

	require 'template/header.php'

?>

	<main>
		<h1>Dashboard</h1>
		<h2>Anggota</h2>
		<div class="cont-anggota">
			<div class="chart-content">
				<h4>Jumlah pendaftaran anggota perhari</h4>
				<canvas id="canvas-satu"></canvas>
			</div>
			<div class="chart-content-small">
				<h4>Jumlah anggota berdasarkan jenis kelamin</h4>
				<canvas id="canvas-empat"></canvas>
				<table>
					<tr>
						<td><div class="warna warna7"></div></td>
						<td>Laki-laki</td>
						<td>: <?= $jeniskelamin[0]['jumlah']?></td>
						<td><div class="warna warna8"></div></td>
						<td>Perempuan</td>
						<td>: <?= $jeniskelamin[1]['jumlah']?></td>
					</tr>
				</table>
			</div>
		</div>
		
		
		<h2>Buku</h2>
		<div class="cont-buku">
			<div class="chart-content pie-chart-content">
				<h4>Jumlah buku berdasarkan jenis</h4>
				<div class="main-chart">
					<canvas id="canvas-dua"></canvas>
					<table>
						<?php if(count($jenis)<7):?>
							<?php $i=1;?>
							<?php $total = 0;?>
							<?php foreach($jenis as $jns):?>
								<tr>
									<td><div class="warna warna<?= $i;?>"></div></td>
									<?php $i++;?>
									<td><?= $jns["jenis"];?></td>
									<td><?= ": ".$jns["jumlah"];?></td>
								</tr>
								<?php $total += $jns["jumlah"];?>
							<?php endforeach;?>
							<tr>
								<td></td>
								<td>Jumlah</td>
								<td><?= ": ".$total?></td>
							</tr>
						<?php else:?>
							<?php $total = 0;?>
							<?php for($i=0;$i<5;$i++):?>
								<tr>
									<td><div class="warna warna<?= $i+1;?>"></div></td>
									<td><?= $jenis[$i]["jenis"];?></td>
									<td><?= ": ".$jenis[$i]["jumlah"];?></td>
								</tr>
								<?php $total += $jenis[$i]["jumlah"];?>
							<?php endfor;?>
							<?php 
								$lainnya_array =  array_slice($jenis,5);
								$lainnya=0; 
								foreach($lainnya_array as $lain_arr){
									$lainnya+=$lain_arr["jumlah"];
								}
							?>
							<tr>
								<td><div class="warna warna6"></div></td>
								<td><?= "Lainnya"?></td>
								<td><?= ": ".$lainnya;?></td>
							</tr>
							<tr>
								<td></td>
								<td>Jumlah</td>
								<?php $total += $lainnya;?>
								<td><?= ": ".$total?></td>
							</tr>
								
							
						<?php endif;?>
					</table>
				</div>
			</div>

			<div class="last-book-content" id="container">
			
				<h4>Buku terakhir dimasukkan</h4>
				<div class="card">
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
			</div>
		</div>

		<h2>Peminjaman</h2>
		<div class="cont-peminjaman">
			<div class="chart-content pie-chart-content-small">
				<h4>Jumlah peminjaman berdasarkan status peminjaman</h4>
				<div class="chart-small">
					<canvas id="canvas-tiga"></canvas>
					<table>
						<?php $i=1;?>
						<?php $total = 0;?>
						<?php foreach($peminjaman as $pemin): ?>
							<tr>
								<td><div class="warna warna<?= $i;?>"></div></td>
								<?php $i++;?>
								<td><?= $pemin["status"];?></td>
								<td><?= ": ".$pemin["jumlah"];?></td>
							</tr>
							<?php $total += $pemin["jumlah"];?>
						<?php endforeach; ?>
							<tr>
								<td></td>
								<td>Jumlah</td>
								<td><?= ": ".$total?></td>
							</tr>
					</table>
				</div>
				
			</div>
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

	<script src="js/data.js"></script>
	<script src="js/chart.js"></script>

<?php 
	require 'template/footer.php'
?>

