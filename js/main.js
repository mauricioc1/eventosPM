
// VARIABLES GLOBALES

(function () {
  "use strict";

  document.addEventListener('DOMContentLoaded', function (){
    // Despues de cargar todo el DOM se ejecuta el codigo
    var slider = document.querySelector("#myRange");
    var output = document.querySelector("#valorHoras");
    $(output).text($(slider).val()); // Display the default slider value

    

    // Update the current slider value (each time you drag the slider handle)
    $("body").on("input", slider, function(e){
      $(output).text($(e.target).val());
    });


    // ------------------------------------ INDEX -------------------------------------------
    $("body").on("click", "#navigation li", navigation);


  }); // end DOMContentLoaded


})();

// ///////////////// *******************************  FUNCIONES  ****************************** /////////////////////
function navigation(e){
  // e.target.preventDefult();

  console.log(e.target);
  if($(e.target).hasClass("inicio")){
    location.reload();
  }

  if($(e.target).hasClass("cotizar")){
      $('html, body').animate({
          scrollTop: $("#cotizar").offset().top
      }, 1000);
  }
  
  if($(e.target).hasClass("contacto")){
    $('html, body').animate({
      scrollTop: $("#footer").offset().top
  }, 1000);
  }

}



