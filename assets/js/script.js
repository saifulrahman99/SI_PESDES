function myFunction() {
   var element = document.getElementById("konten");
   var element2 = document.getElementById("header");
   var element3 = document.getElementById("sidebar");
  
   element.classList.toggle("toggleNav");
   element2.classList.toggle("toggleNav");
   element3.classList.toggle("toggleNav2");
}

// sidebar menu collapse
document.addEventListener("DOMContentLoaded", function(){

  document.querySelectorAll('.menu-sidebar .nav-link').forEach(function(element){

    element.addEventListener('click', function (e) {

      let nextEl = element.nextElementSibling;
      let parentEl  = element.parentElement;  

      if(nextEl) {
        e.preventDefault(); 
        let mycollapse = new bootstrap.Collapse(nextEl);

        if(nextEl.classList.contains('show')){
          mycollapse.hide();
        } else {
          mycollapse.show();
              // find other submenus with class=show
              var opened_submenu = parentEl.parentElement.querySelector('.submenu.show');
              // if it exists, then close all of them
              if(opened_submenu){
                new bootstrap.Collapse(opened_submenu);
              }

            }
          }

        });
  })

}); 
  // DOMContentLoaded  end

  // konfirmasi hapus
function confirm_delete(){
  return confirm("Anda Yakin Menghapus Data Ini?");
}