
// JS DEL PANEL DE ADMINISTRACION

// VARIABLES GLOBALES

(function () {
    "use strict";
  
    document.addEventListener('DOMContentLoaded', function (){

        
        // AL ENVIAR EL FROMULARIO DE INICIO DE SESION
        $("body").on("submit", "form#login_admin", adminLogin);
     
  
  
    }); // end DOMContentLoaded
  
})();


// ///////////////// *******************************  FUNCIONES  ****************************** /////////////////////

function adminLogin(e){
    e.preventDefault();
    
    window.location.href = "home.php";
}