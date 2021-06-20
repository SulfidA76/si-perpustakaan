<?php 
require '../functions.php';

$keyword = $_GET["keyword"];
$peminjamans = query("SELECT p.idPeminjaman AS id, 
                    a.nama AS nama, 
                    b.judul AS judul, 
                    a.telp AS telp, 
                    s.status AS status, 
                    p.waktuPeminjaman AS waktuPeminjaman, 
                    p.waktuPengembalian AS waktuPengembalian 
        FROM anggota a, buku b, peminjaman p, statusPeminjaman s 
        WHERE p.idBuku = b.id AND
            p.idAnggota = a.id AND
            p.idStatus = s.id AND 
            (a.nama LIKE '%$keyword%' OR
            b.judul LIKE '%$keyword%')
        ORDER BY p.idStatus DESC, p.waktuPeminjaman DESC, a.nama");



?>

<table class="content-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        
                        
                        <th>Nama</th>
                        <th>Judul Buku</th>
                        <th>No Telpon</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Jadwal Pengembalian</th>
                        <th>Status</th>
                        <th>Denda</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; ?>
                    <?php foreach($peminjamans as $peminjaman) : ?>
                        <tr>
                            <td><?= $i; ?></td>
                            
                            
                            <td><?= $peminjaman["nama"]; ?></td>
                            <td><?= $peminjaman["judul"];  ?></td>
                            <td><?= $peminjaman["telp"];  ?></td>
                            <td><?= date("d-m-Y",$peminjaman["waktuPeminjaman"]);  ?></td>
                            <td><?= date("d-m-Y",$peminjaman["waktuPengembalian"]);  ?></td>
                            <td><?= $peminjaman["status"];  ?></td>
                            <td><?= denda($peminjaman["waktuPengembalian"],$peminjaman["status"]);  ?></td>
                            <td>
                                <div class="aksi2">
                                    <?php if(($peminjaman["status"]=='telat') || ($peminjaman["status"]=='dipinjam')):  ?>
                                        <a href="dikembalikan.php?id=<?= $peminjaman["id"]; ?>" class="kembali">dikembalikan</a> 
                                        <a href="perpanjang.php?id=<?= $peminjaman["id"]; ?>" class="ubah" onclick="return confirm('Pastikan denda telah dibayar')">perpanjang</a> 
                                    <?php endif;?>
                                    <a href="hapusPeminjaman.php?id=<?= $peminjaman["id"]; ?>" class="hapus" onclick="return confirm('Yakin ingin menghapus data?')">hapus</a>
                                </div>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>

            </table>