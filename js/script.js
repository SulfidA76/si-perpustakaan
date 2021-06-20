document.getElementById("tombol-cari").style.display="none";

// cari buku
document.getElementById("keyword").addEventListener("keyup", function(){
	document.getElementById("loader").style.display="block";
	var request = new XMLHttpRequest();
	request.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("container").innerHTML = "";
		  document.getElementById("container").innerHTML = this.responseText;
      console.log(document.getElementById("keyword").value)
		}
	  };
	request.open('GET', 'ajax/buku.php?keyword='+document.getElementById("keyword").value, true);
    request.send();
    //console.log(document.getElementById("keyword").value);
    document.getElementById("loader").style.display="none";
});


//tampilkan modal
function modal(str){
    var modal = document.getElementById('simpleModal');

    //get close btn
    var closeBtn =document.getElementsByClassName('closeBtn')[0];

    //modalBtn.addEventListener('click', openModal);

    closeBtn.addEventListener('click', closeModal);

    window.addEventListener('click', outsideClick);

    modal.style.display='block';
    
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("container-modal").innerHTML = "";
        document.getElementById("container-modal").innerHTML = this.responseText;
        var main= document.querySelector('main');
        main.style.overflow='hidden';
      }
      };
    request.open('GET', 'ajax/modal.php?id='+str, true);
    request.send();

    function outsideClick(e){
        if(e.target==modal){
            modal.style.display='none';
            var main= document.querySelector('main');
            main.style.overflow='scroll';
        }
    }

    function closeModal(){
        modal.style.display='none';
        var main= document.querySelector('main');
        main.style.overflow='scroll';
    }
};
function menuToggle(){
  const menuToggle = document.querySelector('.menu-toggle input');
  const aside = document.querySelector('aside');
  aside.classList.toggle('slide');
  // menuToggle.addEventListener('click', function(){
      
  // });
}


