
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

///////////// ************************ NOTIFICACION ************************ ///////////////
// Esta funcion muestra una notificacion con un mensaje pretederminado por un periodo de tiempo en la pantalla
function showNotification(message, success, timer = true){
  const notification = $('<div></div>');
  notification.addClass('notification');
  notification.addClass((success) ? 'n_success' : 'n_error');

  const text = $("<p></p>").text(message);
  var close = $("<a></a>").html('<i class="fas fa-times noevents"></i>');
  close.attr('id', 'remove_notification');

  notification.append(text, close);
  // insert before toma de paramatros (que insertar, antes de que se insetar)
  $("#notification_container").html("");
  $("#notification_container").html(notification);
  // ocultar y mostrar la notif
  setTimeout(()=>{
      notification.addClass('visible');
      setTimeout(()=>{
        if(timer){ // si timer entonces de deshace sola
          notification.removeClass('visible');
          setTimeout(()=>{
              notification.remove();
          }, 500)
        }    
      }, 3000)   
  }, 100)
}



