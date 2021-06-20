<?php 
require '../functions.php';

$keyword = $_GET["keyword"];

$query = "SELECT * FROM buku 
				WHERE
				judul LIKE '%$keyword%' OR
				penulis LIKE '%$keyword%'
			LIMIT 5";
$bukus = query($query);

    
?>

<?php foreach($bukus as $buku):?>
	<option value="<?= $buku["id"]?>">
		<p><?= $buku["judul"] .', '. $buku["penulis"];?></p>
	</option>
<?php endforeach;?>