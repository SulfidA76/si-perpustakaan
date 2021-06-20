<?php 
$conn = mysqli_connect("localhost","root","","perpustakaan");

function query($query){
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ( $row = mysqli_fetch_assoc($result)){
		$rows[] = $row;
	}
	return $rows;
}

function cekPanjangText($str){
	if(strlen($str)>17){
		$judul=str_split(strrev($str));
		$judul=strrev(implode(array_slice($judul,strlen($str)-17)))."...";
	} else{
		$judul=$str;
	}
	return $judul;
}

function tambah($data){
	$judul = strtolower(htmlspecialchars($data["judul"]));
	$penulis = strtolower(htmlspecialchars($data["penulis"]));
	$penerbit = strtolower(htmlspecialchars($data["penerbit"]));
	$tahunterbit = strtolower(htmlspecialchars($data["tahunterbit"]));
	$jenis = strtolower(htmlspecialchars($data["jenis"]));
	$deskripsi = strtolower(htmlspecialchars($data["deskripsi"]));

	//upload cover
	$cover = upload();

	if (!$cover){
		return false;
	}

	$query = "INSERT INTO buku
				VALUES 
				('','$judul','$penulis','$penerbit','$tahunterbit','$jenis','$deskripsi','$cover')";

	global $conn;

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);

}

function tambahAnggota($data){
	$nama = strtolower(htmlspecialchars($data["nama"]));
	$telp = strtolower(htmlspecialchars($data["telp"]));
	$pekerjaan = strtolower(htmlspecialchars($data["pekerjaan"]));
	$tanggalbergabung = time();
	$jeniskelamin=$data["jeniskelamin"];

	$query ="INSERT INTO anggota
	VALUES 
	('','$nama','$jeniskelamin',$tanggalbergabung,'$telp','$pekerjaan')";
	global $conn;

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function upload(){

	$namafile = $_FILES['cover']['name'];
	$ukuranfile = $_FILES['cover']['size'];
	$error = $_FILES['cover']['error'];
	$tmpname = $_FILES['cover']['tmp_name'];


	if ( $error === 4){
		echo "<script>
				alert('pilih cover terlebih dahulu!');
			</script>";
		return false;
	}

	$ekstansicoverValid = ['jpeg','jpg','png'];
	$ekstensicover = explode('.',$namafile);
	$ekstensicover= strtolower(end($ekstensicover));
	if (!in_array($ekstensicover, $ekstansicoverValid)){
		echo  "<script>
				alert('yang anda upload bukan cover');
			</script>";
		return false;
	}

	if ($ukuranfile > 2000000){
		echo  "<script>
				alert('ukuran cover terlalu besar lebih dari 2MB');
			</script>";
		return false;
	}

	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensicover;

	
	move_uploaded_file($tmpname, 'img/'.$namaFileBaru);
	return $namaFileBaru;

}


function hapus($id){
	$pemi = query("SELECT* FROM peminjaman WHERE idBuku = '$id'");
	if($pemi != null){
		return 0;
	}
	global $conn;
	mysqli_query($conn,"DELETE FROM buku WHERE id= $id");

	return mysqli_affected_rows($conn);
}

function hapusAnggota($id){
	$pemi = query("SELECT* FROM peminjaman WHERE idAnggota = '$id'");
	if($pemi != null){
		return 0;
	}
	global $conn;
	mysqli_query($conn,"DELETE FROM anggota WHERE id= $id");

	return mysqli_affected_rows($conn);
}


function ubah($data){
	$id = $data["id"];
	$judul = strtolower(htmlspecialchars($data["judul"]));
	$penulis = strtolower(htmlspecialchars($data["penulis"]));
	$penerbit = strtolower(htmlspecialchars($data["penerbit"]));
	$tahunterbit = strtolower(htmlspecialchars($data["tahunterbit"]));
	$jenis = strtolower(htmlspecialchars($data["jenis"]));
	$deskripsi = strtolower(htmlspecialchars($data["deskripsi"]));
	$coverLama = $data["coverLama"];

	if ($_FILES['cover']['error']===4){
		$cover = $coverLama;
	} else {
		$cover =upload();
	}
	

	$query = "UPDATE buku SET 
				judul = '$judul',
				penulis = '$penulis',
				penerbit = '$penerbit',
				tahunterbit = '$tahunterbit',
				jenis = '$jenis',
				deskripsi = '$deskripsi',
				cover = '$cover'
			WHERE id = '$id'";

	global $conn;

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function ubahAnggota($data){
	$id = $data["id"];
	$nama = strtolower(htmlspecialchars($data["nama"]));
	$telp = strtolower(htmlspecialchars($data["telp"]));
	$pekerjaan = strtolower(htmlspecialchars($data["pekerjaan"]));
	$jeniskelamin=$data["jeniskelamin"];	

	$query = "UPDATE anggota SET 
				nama = '$nama',
				jeniskelamin = '$jeniskelamin',
				telp = '$telp',
				pekerjaan = '$pekerjaan'
			WHERE id = '$id'";

	global $conn;

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}



function cari($keyword){
	$query = "SELECT * FROM buku
				WHERE
				judul LIKE '%$keyword%' OR 
				penulis LIKE '%$keyword%' OR 
				penerbit LIKE '%$keyword%' OR 
				tahunterbit LIKE '%$keyword%' OR
				jenis LIKE '%$keyword%' 
			";
	return query($query);
}


function registrasi($data){
	global $conn;

	$username = strtolower(stripcslashes($data["username"]));
	$password = mysqli_real_escape_string($conn,$data["password"]);
	$password2 = mysqli_real_escape_string($conn,$data["password2"]);

	//CEK USERNAME SUDAH ADA ATAU BELUM


	$result = mysqli_query($conn,"SELECT username FROM user WHERE username = '$username'");

	if(mysqli_fetch_assoc($result)){
		//1 jika ada yg sama
		echo "<script>
			alert('username sudah ada');
			</script>";
		return false;
	}



	//CEK KONFIRMASI PASSWORD
	if ( $password !== $password2 ){
		echo "<script>
			alert('konfirmasi password tidak sesuai');
			</script>";
		return false;
	}

	//ENKRIPSI PASSWORD

	$password = password_hash($password, PASSWORD_DEFAULT);

	mysqli_query($conn, "INSERT INTO user VALUES ('','$username','$password')");
	
	return mysqli_affected_rows($conn);

}

function cekStatus($id){

	global $conn;

	$query = "UPDATE peminjaman SET 
		idStatus  = '2'
		WHERE idPeminjaman = '$id'";

	mysqli_query($conn, $query);

}

function denda($int,$status){
	$hari = (time()-$int)/(3600*24);
	if((time()>$int)&&($status=="telat")){
		$denda = ceil($hari)*1000;
	} else $denda =0;
	return $denda;
}

function tambahPeminjaman($data){
	$idBuku = $data["select-buku"];
	$idAnggota = $data["select-anggota"];
	$waktuPeminjaman = time();
	$waktuPengembalian = time()+3*24*3600;

	$query ="INSERT INTO peminjaman
	VALUES 
	('','$idAnggota','$idBuku',1,$waktuPeminjaman,$waktuPengembalian)";
	global $conn;

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


function hapusPeminjaman($id){

	global $conn;
	mysqli_query($conn,"DELETE FROM peminjaman WHERE idPeminjaman= $id");

	return mysqli_affected_rows($conn);
}

function dikembalikan($id){
	$peminjaman = query("SELECT * FROM peminjaman WHERE idPeminjaman='$id'")[0];
	if($peminjaman["waktuPengembalian"]<time()){
		$idStatus=3;
	}else $idStatus=4;

	global $conn;
	mysqli_query($conn,"UPDATE peminjaman SET idStatus = '$idStatus' WHERE idPeminjaman ='$id'");

	return mysqli_affected_rows($conn);

}

function perpanjang($id){
	$peminjaman = query("SELECT * FROM peminjaman WHERE idPeminjaman='$id'")[0];
	if($peminjaman["waktuPengembalian"]<time()){
		$waktuPengembalian=time()+3*24*3600;
	}else $waktuPengembalian=$peminjaman["waktuPengembalian"]+3*24*3600;

	global $conn;
	mysqli_query($conn,"UPDATE peminjaman SET waktuPengembalian = '$waktuPengembalian', idStatus='1' WHERE idPeminjaman ='$id'");

	return mysqli_affected_rows($conn);

}

function createdata(){
	$tgls = query("SELECT tanggalBergabung FROM anggota");
	$array_tgl =[];
	foreach($tgls as $tgl){
		array_push($array_tgl, date("j",$tgl["tanggalBergabung"]) );
	}
	// var_dump($array_tgl);
	$array_limabelashari=[];
	for ($i=0;$i<15;$i++){
		array_unshift($array_limabelashari,date("j",time()-$i*24*3600));
	}
	$array_limabelasorang=[];
	for ($i=0;$i<15;$i++){
		array_push($array_limabelasorang,0);
	}
	foreach($array_limabelashari as $index => $limabelas){
		foreach($array_tgl as $tanggal){
			if($limabelas==$tanggal){
				$array_limabelasorang[$index]++;
			}
		}
	}
	$data = "let data = {";
	for ($i=0;$i<15;$i++){
		$data .="$i:[$array_limabelashari[$i],$array_limabelasorang[$i]]";
		if($i!=14){
			$data.=", ";
		}
	}
	$data.="};\n";
	//var_dump($data);
	
	$jenis = query("SELECT jenis, COUNT(jenis) AS jumlah FROM buku GROUP BY jenis ORDER BY jumlah desc,jenis");
	$data.="var jenisBuku = {";
	if(count($jenis)>6){
		$lainnya_array =  array_slice($jenis,5);
		$lainnya=0; 
		foreach($lainnya_array as $lain_arr){
			$lainnya+=$lain_arr["jumlah"];
		}
		
		for($i=0;$i<5;$i++){
			$jen = $jenis[$i]["jenis"];
			$jum = $jenis[$i]["jumlah"];
			$data.="$jen:$jum,";
		}
		$data.="lainnya:$lainnya};";
	}else {
		$last=array_pop($jenis);
		foreach($jenis as $jns){
			$jen = $jns["jenis"];
			$jum = $jns["jumlah"];
			$data.="$jen:$jum,";
		}
		$jen = $last['jenis'];
		$jum=$last['jumlah'];
		$data.="$jen:$jum};\n";
	}

	$peminjaman = query("SELECT s.status AS status, COUNT(p.idStatus) AS jumlah FROM statuspeminjaman s, peminjaman p WHERE s.id = p.idStatus GROUP BY p.idStatus");
	$data.="var peminjaman = {";
	$last=array_pop($peminjaman);
	foreach($peminjaman as $pemin){
		$jen = $pemin["status"];
		$jum = $pemin["jumlah"];
		if ($pemin["status"]=="telat dikembalikan"){
			$jen ="telatDikembalikan";
		}
		
		$data.="$jen:$jum,";
	}
	$jen = $last['status'];
	$jum=$last['jumlah'];
	$data.="$jen:$jum};\n";
	//var_dump($data);

	$jeniskelamin = query("SELECT  COUNT(jeniskelamin) AS jumlah FROM anggota GROUP BY jeniskelamin ORDER BY jeniskelamin");
	//var_dump($jeniskelamin);
	$lk = $jeniskelamin[0]['jumlah'];
	$pr = $jeniskelamin[1]['jumlah'];
	$data .= "var jenisKelamin = {lakiLaki:$lk, perempuan:$pr};\n";

	//var_dump($data);
	$myfile = fopen("js/data.js","w") or die('Unable to open file!');
	fwrite($myfile,$data);
	fclose($myfile);
}

?>