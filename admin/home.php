<!-- INICIO DE SESION PARA EL PANEL ADMINISTRACION -->

<?php 
require 'inc/header.php'; 

    if(!isset($_SESSION['ADMIN'])) exit(header('Location: index.php'));

?>


<h1>Panel de Administración</h1>


<?php require 'inc/footer.php'; ?>