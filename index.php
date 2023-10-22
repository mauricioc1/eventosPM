
    <?php require 'inc/header.php'; ?>

    <div class="mision">
        <h3>Mision</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore minima minus omnis esse voluptatibus sapiente accusantium amet iste labore sequi numquam, excepturi delectus beatae voluptate ducimus nemo, atque, consequuntur sunt.</p>
    </div>

    <div class="formulario" id="cotizar">
        <h3>Formulario De Cotizacion</h3>
        <h1 id="precioTotal">$0</h1>


        <label for="eventos">Tipo de Evento</label>
        <select name="eventos" id="eventos">
            <option value="nulo">Seleccionar Evento</option>
            <option value="opcion1">opcion1</option>
            <option value="opcion2">opcion2</option>
            <option value="opcion3">opcion3</option>
            <option value="opcion4">opcion4</option>
        </select>

        <p>ubicacion</p>
        <label for="provincia">Provincia</label>
        <select name="provincia" id="provincia">
            <option value="nulo">Seleccionar Provincia</option>
            <option value="opcion1">opcion1</option>
            <option value="opcion2">opcion2</option>
            <option value="opcion3">opcion3</option>
            <option value="opcion4">opcion4</option>
        </select>
        <label for="canton">Cantón</label>
        <select name="canton" id="canton">
            <option value="nulo">Seleccionar Cantón</option>
            <option value="opcion1">opcion1</option>
            <option value="opcion2">opcion2</option>
            <option value="opcion3">opcion3</option>
            <option value="opcion4">opcion4</option>
        </select>

        <label for="invitados">Asistentes al evento</label>
        <input type="text" id="invitados" name="invitados">
        
        <div class="slidecontainer">
            <input type="range" min="4" max="12" value="4" class="slider" id="myRange">
            <p id="valorHoras"></p>
        </div>

        <label for="menu">Menú</label>
        <select name="menu" id="menu">
            <option value="nulo">Seleccionar Menú</option>
            <option value="opcion1">opcion1</option>
            <option value="opcion2">opcion2</option>
            <option value="opcion3">opcion3</option>
            <option value="opcion4">opcion4</option>
        </select>
        
        <input type="checkbox" id="pirotecnia" name="pirotecnia" />
        <label for="pirotecnia">Pirotecnia Fría</label>
        
        <button type="button" id="factura">Generar Factura</button>
    </div>

    <?php require 'inc/footer.php'; ?>
