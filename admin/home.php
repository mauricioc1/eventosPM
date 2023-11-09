<!-- INICIO DE SESION PARA EL PANEL ADMINISTRACION -->

<?php 
    require 'inc/header.php'; 

    if(!isset($_SESSION['ADMIN'])) exit(header('Location: index.php'));

?>
    <div class="panel-container">
        <div class="admin-panel">
            <div class="admin_panel_header">
                <h1 tabindex="1">Panel de administrador</h1>
                <button class="btn_logout" data-logout="true" tabindex="2">Cerrar Sesión</button>
            </div>

            <div class="panel-navigation-container">
                <a href="users.php" class="navigation-option" tabindex="3">
                    <div>
                        <p>Administrar Usuarios</p>
                        <i class="fa-regular fa-circle-user"></i>
                    </div>
                </a>
                <a href="events.php" class="navigation-option" tabindex="4">
                    <div >
                        <p>Administrar Eventos</p>
                        <i class="fa-regular fa-calendar-days"></i>
                    </div>
                </a>
                <a href="bills.php" class="navigation-option option-below" tabindex="5">
                    <div >
                        <p>Administrar Facturas</p>
                        <i class="fa-solid fa-file-invoice-dollar"></i>
                    </div>
                </a>
                <a href="menu.php" class="navigation-option option-below" tabindex="6">
                    <div>
                        <p>Administrar Menú</p>
                        <i class="fa-solid fa-utensils"></i>
                    </div>
                </a>
            </div>
                
        </div>
    </div>
    



<?php require 'inc/footer.php'; ?>