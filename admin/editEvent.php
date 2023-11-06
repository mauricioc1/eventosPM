<?php require 'inc/tableHeader.php'; ?>

<div class="panel-container">
        <div class="edit-panel">
           <h2>Editar Evento<h2>
           <div class="inputsEdit">
                <label for="email"><i class="fa-regular fa-circle-user"></i></label>
                <input type="email" name="email" id="email" placeholder="Correo Electrónico">
            </div>

            <div class="inputsEdit">
                <label for="password"><i class="fa-solid fa-lock"></i></label>
                <input type="password" name="password" id="password" placeholder="Contraseña">
            </div>

            <div class="editButton">
                <input type="submit" value="Iniciar sesión">
            </div>
        </div>
</div>

<?php require 'inc/footer.php'; ?>