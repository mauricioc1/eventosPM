<!-- INICIO DE SESION PARA EL PANEL ADMINISTRACION -->

<?php 
    require 'inc/header.php'; 

    if(!isset($_SESSION['ADMIN'])) exit(header('Location: index.php'));

?>
    <div class="panel-container">
        <div class="admin-panel">
            <div class="">
                <h1>Panel de administrador</h1>
                <h6>Bienvenido, administrador</h6>
            </div>

            <div class="panel-navigation-container">
                <a href="users.php" class="navigation-option">
                    <div>
                        <p>Administrar Usuarios</p>
                        <i class="fa-regular fa-circle-user"></i>
                    </div>
                </a>
                <a href="events.php" class="navigation-option">
                    <div >
                        <p>Administrar Eventos</p>
                        <i class="fa-regular fa-calendar-days"></i>
                    </div>
                </a>
                <a href="bills.php" class="navigation-option option-below">
                    <div >
                        <p>Administrar Facturas</p>
                        <i class="fa-solid fa-file-invoice-dollar"></i>
                    </div>
                </a>
                <a href="menu.php" class="navigation-option option-below">
                    <div>
                        <p>Administrar Menú</p>
                        <i class="fa-solid fa-utensils"></i>
                    </div>
                </a>
            </div>
                
        </div>
    </div>
    



<?php require 'inc/footer.php'; ?>