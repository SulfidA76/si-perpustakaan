//cari peminjaman
document.getElementById("keywordP").addEventListener("keyup", function(){
	document.getElementById("loader").style.display="block";
	var requestSearch = new XMLHttpRequest();
	requestSearch.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("container-table").innerHTML = "";
		  document.getElementById("container-table").innerHTML = this.responseText;
		}
	  };
	requestSearch.open('GET', 'ajax/peminjaman.php?keyword='+document.getElementById("keywordP").value, true);
    requestSearch.send();
    document.getElementById("loader").style.display="none";
});

