
// VARIABLES GLOBALES

(function () {
  "use strict";

  document.addEventListener('DOMContentLoaded', function (){
    // Despues de cargar todo el DOM se ejecuta el codigo
    var slider = document.querySelector("#myRange");
    var output = document.querySelector("#valorHoras2");
    $(output).text($(slider).val()); // Display the default slider value

    

    // Update the current slider value (each time you drag the slider handle)
    $("body").on("input", slider, function(){
      $(output).text($(slider).val());
    });


    // ------------------------------------ INDEX -------------------------------------------
    $("body").on("click", "#navigation li", navigation);

    // showNotification("Factura generada", true);

    // prueba para el conexion con el backend
    // (async function(){
    //   const myData = new FormData();
    //   myData.append('message', 'mensaje del frontEnd');
    //   myData.append('ajaxMethod', 'foo');
    //   var result = await ajaxRequest(myData);
    //   showNotification(result.Message, result.Success);
    // })();
    if($("div#cotizar")){
      // cargar las opciones desde la base de datos
      loadEvents();

      loadProvinces();

      loadMenu();

      // cargar los cantones al seleccionar la provincia
      $("body").on("change", "select#provinces", loadCantons);

      $("body").on("click", "button#calculatePrice", calcEventPrice);

    }


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
  // var close = $("<a></a>").html('<i class="fas fa-times noevents"></i>');
  // close.attr('id', 'remove_notification');

  notification.html(text);
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

///////////// ************************ CARGAR EVENTOS ************************ ///////////////
// Funcion para cargar las opciones de los eventos al formulario
async function loadEvents(){
  const data = new FormData();

  data.append('ajaxMethod', 'loadFormSelectEvents');
  await ajaxHTMLRequest(data, 'select#events');
}

///////////// ************************  CARGAR PROVINCIAS ************************ ///////////////
// Funcion para cargar las opciones de los eventos al formulario
async function loadProvinces(){
  const data = new FormData();

  data.append('ajaxMethod', 'loadFormSelectProvinces');
  await ajaxHTMLRequest(data, 'select#provinces');
}

///////////// ************************  CARGAR CANTONES ************************ ///////////////
// Funcion para cargar las opciones de los eventos al formulario
async function loadCantons(){
  const data = new FormData();

  data.append('ajaxMethod', 'loadFormSelectCantons');
  data.append('idProvince', $(this).val());
  await ajaxHTMLRequest(data, 'select#cantons');
}

///////////// ************************  CARGAR MENU ************************ ///////////////
// Funcion para cargar las opciones de los eventos al formulario
async function loadMenu(){
  const data = new FormData();

  data.append('ajaxMethod', 'loadFormSelectMenu');
  await ajaxHTMLRequest(data, 'select#menu');
}
///////////// ************************ CALCULAR PRECIO ************************ ///////////////
// Funcion para calcular el precio de un evento segun las opciones seleccionadas en el form
function calcEventPrice(){
  var totalPrice = 0;

  // event type
  totalPrice += parseInt($("select#events option:selected" ).attr("data-price"));

  // canton price
  totalPrice += parseInt($("select#cantons option:selected" ).attr("data-price"));

  // duration
  totalPrice += parseInt($("p#valorHoras2" ).text()) * 1200;

  // menu 
  totalPrice += parseInt($("input#invitados").val()) * parseInt($("select#menu option:selected" ).attr("data-price"))

  // pirotecnia
  if($( "input#pirotecnia" ).prop( "checked" ) ){
    totalPrice += 5000;
  }
  // precio
  $("h1#precioTotal span").text(totalPrice);
}

///////////// ************************ AJAX BACKEND CONN ************************ ///////////////
// FUNCION QUE REALIZA LA CONECCION CON EL BACKEND
// Debe haber un campo en el form data indicando el metodo a utilizar en el ajax controller llamado 'ajaxMethod'
async function ajaxRequest(formData){
  return new Promise(resolve => {
    $.ajax({
      url:'app/Ajax.php',
      type:'POST',
      processData: false,
      contentType: false,
      data: formData
    }).done(function(data){
      console.log(data);
      resolve(JSON.parse(data));
    });
  });
}

// FUNCION QUE REALIZA LA CONECCION CON EL BACKEND Y RETORNA UN HTML
// Debe haber un campo en el form data indicando el metodo a utilizar en el ajax controller llamado 'ajaxMethod'
// html container indica el contenedor en el cual va ser insertado el html es un string indicando el id
async function ajaxHTMLRequest(formData, html_container){
  $.ajax({
    url: 'app/Ajax.php',
    type:'POST',
    processData: false,
    contentType: false,
    dataType:'html',
    data: formData
  }).done(function(data){
    $(html_container).html(data);
  });
}
