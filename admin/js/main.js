
// JS DEL PANEL DE ADMINISTRACION

// VARIABLES GLOBALES

(function () {
    "use strict";
  
    document.addEventListener('DOMContentLoaded', function (){

        
        // AL ENVIAR EL FROMULARIO DE INICIO DE SESION
        $("body").on("submit", "form#login_admin", adminLogin);

        $("body").on("click", "[data-download-bill]", downloadBill);
        
        
        // showNotification("Factura generada", true);

        //prueba para el conexion con el backend
        // (async function(){
        //   const myData = new FormData();
        //   myData.append('message', 'mensaje del frontEnd');
        //   myData.append('ajaxMethod', 'foo');
        //   var result = await ajaxRequest(myData);
        //   showNotification(result.Message, result.Success);
        // })();

        // pagina de facturas
        if($("#bills-table")) initDataTable('bills', 'loadBillsDataTable');
        // tabla de usuarios
        if($("#users-table")) initDataTable('users', 'loadUsersDataTable');
        // tabla de eventos
        if($("#events-table")) initDataTable('events', 'loadEventsDataTable');
         // tabla de menu
         if($("#menu-table")) initDataTable('menu', 'loadMenuDataTable');

        
        
  
    }); // end DOMContentLoaded
  
})();


// ///////////////// *******************************  FUNCIONES  ****************************** /////////////////////

async function adminLogin(e){
  e.preventDefault();

  // nombre de usuario
  var email = $("input#email").val();
  // contrasenna
  var pass = $("input#password").val();

  const formData = new FormData();

  formData.append("email", email);
  formData.append("pass", pass);
  formData.append("ajaxMethod", "adminLogin");

  var result = await ajaxRequest(formData);
  showNotification(result.Message, result.Success);
  if(result.Success){
    setTimeout(()=>{
      window.location.href = 'home.php';
    }, 1500)
  }

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

async function downloadBill(button){
  const myData = new FormData();
  myData.append('ajaxMethod', 'generateAdminBill');
  myData.append('idBill', $(button.currentTarget).attr("data-download-bill"));

  var result = await ajaxRequest(myData);

  window.open(
    'http://localhost/eventosPM/app/Factura_Nro_1.pdf',
    '_blank' // <- This is what makes it open in a new window.
  );

  showNotification(result.Message, result.Success);
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



 ///////////// ************************ TABLAS ************************ ///////////////

 // FUNCION PARA INICIALIZAR LAS TABLAS
 function initDataTable(table, ajaxMethod){
  const columns = getDataTableColumns(table);
  $("#"+table+"-table").DataTable({
    "responsive": true,
    "autoWidth": false,
    "processing": true,
    "serverSide": true,
    "ajax":{
      url: '../app/Ajax.php',
      type:"POST",
      data: {ajaxMethod: ajaxMethod, table:table}
    },
    "columns": columns
  });
}

// FUNCION PARA ESTABLECER LAS COLUMNAS
function getDataTableColumns(table){
  var columns = new Array();

  //PARA FACTURAS
  if(table === 'bills') columns = [{data: 'idFactura'}, {data: 'nombreEvento'}, {data: 'asistentes'}, {data: 'duracion'}, {data: 'canton'}, {data: 'menu'}, {data: 'pirotecnia'}];

  // PARA USUARIOS
  if(table === 'users') columns = [{data: 'username'}, {data: 'email'}];

  // PARA EVENTOS
  if(table === 'events') columns = [{data: 'idEvent'}, {data: 'nameEvent'}, {data: 'priceEvent'}];

  // PARA MENU
  if(table === 'menu') columns = [{data: 'idFood'}, {data: 'nameFood'}, {data: 'priceFood'}];

  //PARA LAS ACCIONES
  columns.push({data: 'actions', "orderable": false });

  return columns;
}