
// JS DEL PANEL DE ADMINISTRACION

// VARIABLES GLOBALES

(function () {
    "use strict";
  
    document.addEventListener('DOMContentLoaded', function (){

        
        // AL ENVIAR EL FROMULARIO DE INICIO DE SESION
        $("body").on("submit", "form#login_admin", adminLogin);
        
        // showNotification("Factura generada", true);

        //prueba para el conexion con el backend
        // (async function(){
        //   const myData = new FormData();
        //   myData.append('message', 'mensaje del frontEnd');
        //   myData.append('ajaxMethod', 'foo');
        //   var result = await ajaxRequest(myData);
        //   showNotification(result.Message, result.Success);
        // })();
  
  
    }); // end DOMContentLoaded
  
})();


// ///////////////// *******************************  FUNCIONES  ****************************** /////////////////////

function adminLogin(e){
    e.preventDefault();
    
    window.location.href = "home.php";
}

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

  ///////////// ************************ AJAX BACKEND CONN ************************ ///////////////
// FUNCION QUE REALIZA LA CONECCION CON EL BACKEND
// Debe haber un campo en el form data indicando el metodo a utilizar en el ajax controller llamado 'ajaxMethod'
async function ajaxRequest(formData){
    return new Promise(resolve => {
      $.ajax({
        url:'../app/Ajax.php',
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