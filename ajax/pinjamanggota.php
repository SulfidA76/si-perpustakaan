<?php 
require '../functions.php';

$keyword = $_GET["keyword"];

$query = "SELECT * FROM anggota 
				WHERE
				nama LIKE '%$keyword%'
			LIMIT 5";
$anggotas = query($query);

    
?>

<?php foreach($anggotas as $anggota):?>
	<option value="<?= $anggota["id"]?>">
		<p><?= $anggota["nama"].', '.$anggota["telp"];?></p>
	</option>
<?php endforeach;?>