
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


  }); // end DOMContentLoaded


})();

// ///////////////// *******************************  FUNCIONES  ****************************** /////////////////////




