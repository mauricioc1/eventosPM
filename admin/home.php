<!-- INICIO DE SESION PARA EL PANEL ADMINISTRACION -->

<?php 
require 'inc/header.php'; 

    if(!isset($_SESSION['ADMIN'])) exit(header('Location: index.php'));

?>

    <div class="admin-panel">
        <div class="container-fluid w-100">
            <h1>Panel de administrador</h1>
            <h6>Bienvenido, administrador</h6>
        </div>
        <div class="container" style="background-color: lightgray;">
            <div class="row">
                <div class="col-sm-12" style="margin-bottom: 10px;">
                    <div class="pull-left">
                        <a href="./users.php" style="width: 100%; height: 100px;" class="btn btn-outline-dark btn-user-background"><i class="fa fa-book fa-fw" aria-hidden="true"></i> Boton1 </a>
                    </div>
                    <div class="">
                        <a href="./events.php" style="width: 100%; height: 100px;" class="btn btn-outline-dark btn-event-background"><i class="fa fa-book fa-fw" aria-hidden="true"></i> Boton2 </a>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="pull-left">
                        <a href="./bills.php" style="width: 100%; height: 100px;" class="btn btn-outline-dark btn-bill-background"><i class="fa fa-book fa-fw" aria-hidden="true"></i>  Boton3 </a>
                    </div>
                    <div class="">
                        <a href="menu.php" style="width: 100%; height: 100px;" class="btn btn-outline-dark btn-menu-background"><i class="fa fa-book fa-fw" aria-hidden="true"></i> Boton4 </a>
                    </div>
                </div>
            </div>
        </div>      
    </div>



<?php require 'inc/footer.php'; ?>