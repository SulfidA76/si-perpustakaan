//cari anggota
document.getElementById("keywordA").addEventListener("keyup", function(){
	document.getElementById("loader").style.display="block";
	var requestA = new XMLHttpRequest();
	requestA.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("container-table").innerHTML = "";
		  document.getElementById("container-table").innerHTML = this.responseText;
		}
	  };
	requestA.open('GET', 'ajax/anggota.php?keywordA='+document.getElementById("keywordA").value, true);
    requestA.send();
    document.getElementById("loader").style.display="none";
});

