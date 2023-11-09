<!-- INICIO DE SESION PARA EL PANEL ADMINISTRACION -->

<?php require 'inc/header.php'; ?>


<!-- INICIO DE SESION -->
<?php 
    if(isset($_SESSION['ADMIN'])) exit(header('Location: home.php'));
?>

<div class="background_login">

    <div class="login_container">
        <div class="login_logo"><img src="../imgs/logo.png" alt="logo EventosPM" tabindex="1"></img></div>
        <h1 tabindex="2">Ingresar al panel de administrador</h1>
        
        <form id="login_admin" method="post">

            <div class="campo">
                <label for="email"><i class="fa-regular fa-circle-user"></i></label>
                <input type="email" name="email" id="email" placeholder="Correo Electrónico" tabindex="3">
            </div>

            <div class="campo">
                <label for="password"><i class="fa-solid fa-lock"></i></label>
                <input type="password" name="password" id="password" placeholder="Contraseña" tabindex="4">
            </div>

            <div class="submit_btn">
                <input type="submit" value="Iniciar sesión" tabindex="5">
            </div>


        </form>
        
    </div>


</div>



<?php require 'inc/footer.php'; ?>