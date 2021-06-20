<?php 
require '../functions.php';

$keyword = $_GET["keywordA"];

$query = "SELECT * FROM anggota 
				WHERE
				nama LIKE '%$keyword%' OR 
				jeniskelamin LIKE '%$keyword%' OR 
				telp LIKE '%$keyword%' OR 
				pekerjaan LIKE '%$keyword%' 
                ORDER BY nama
			";
$anggotas = query($query);


?>

		
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
				


			