<?php 
require '../functions.php';

$id = $_GET["id"];

$query = "SELECT * FROM buku 
				WHERE
				id=$id
			";
$buku = query($query)[0];
?>
            <div class="modal-body" id="modal-body">
						
					
                <table>
                    <tr>
                        <td rowspan="5">
                            <img src="img/<?= $buku["cover"]; ?>" alt="">   
                        </td>
                        <th>judul</th>
                        <td>:</td>
                        <td><?= $buku["judul"]; ?></td>
                    </tr>
                    <tr>
                        <th>penulis</th>
                        <td>:</td>
                        <td><?= $buku["penulis"]; ?></td>
                    </tr>
                    <tr>
                        <th>penerbit</th>
                        <td>:</td>
                        <td><?= $buku["penerbit"]; ?></td>
                    </tr>
                    <tr>
                        <th>tahun terbit</th>
                        <td>:</td>
                        <td><?= $buku["tahunterbit"]; ?></td>
                    </tr>
                    <tr>
                        <th>jenis</th>
                        <td>:</td>
                        <td><?= $buku["jenis"]; ?></td>
                    </tr>
                </table>
                <p class="deskripsi">Deskripsi</p>
                <p><?= $buku["Deskripsi"]; ?></p>
                </div>

                
                <div class="modal-footer">
						
						<a href="ubah.php?id=<?= $buku["id"]; ?>" class="ubah">Ubah</a> 
						<a href="hapus.php?id=<?= $buku["id"]; ?>" class="hapus" onclick="return confirm('Yakin ingin menghapus data?')">Hapus</a>
				</div>