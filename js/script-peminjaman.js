document.getElementById("buku-peminjaman").addEventListener("keyup", function(){
	//document.getElementById("loader").style.display="block";
	var requestBuku = new XMLHttpRequest();
	requestBuku.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("buku-peminjaman").classList.add("border-radius-top");
			document.getElementById("select-buku").innerHTML = "";
			document.getElementById("select-buku").innerHTML = this.responseText;
			document.getElementById("select-buku").style.display="flex";
			if(document.getElementById("buku-peminjaman").value == ""){
				document.getElementById("select-buku").style.display="none";
			}
		}
	  };
	requestBuku.open('GET', 'ajax/pinjamBuku.php?keyword='+document.getElementById("buku-peminjaman").value, true);
    requestBuku.send();
    //console.log(document.getElementById("keyword").value);
    //document.getElementById("loader").style.display="none";
});


document.getElementById("anggota-peminjaman").addEventListener("keyup", function(){
	//document.getElementById("loader").style.display="block";
	var requestanggota = new XMLHttpRequest();
	requestanggota.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("select-anggota").innerHTML = "";
			document.getElementById("select-anggota").innerHTML = this.responseText;
			document.getElementById("select-anggota").style.display="flex";
			if(document.getElementById("anggota-peminjaman").value == ""){
				document.getElementById("select-anggota").style.display="none";
			}
		}
	  };
	requestanggota.open('GET', 'ajax/pinjamanggota.php?keyword='+document.getElementById("anggota-peminjaman").value, true);
    requestanggota.send();
    //console.log(document.getElementById("keyword").value);
    //document.getElementById("loader").style.display="none";
});


