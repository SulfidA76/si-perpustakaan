<?php 
require '../functions.php';

$keyword = $_GET["keyword"];

$query = "SELECT * FROM buku 
				WHERE
				judul LIKE '%$keyword%' OR 
				penulis LIKE '%$keyword%' OR 
				penerbit LIKE '%$keyword%' OR 
				tahunterbit LIKE '%$keyword%' OR
				jenis LIKE '%$keyword%'
			";
$bukus = query($query);


?>
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