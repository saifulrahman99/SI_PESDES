function openNav() {
  document.getElementById("konten").style.marginLeft = "280px";
  document.getElementById("header").style.marginLeft = "280px";
  document.getElementById("sidebar").style.marginLeft = "0";
}

function closeNav() {
  document.getElementById("konten").style.marginLeft = "0";
  document.getElementById("header").style.marginLeft = "0";
  document.getElementById("sidebar").style.marginLeft = "-280px";
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