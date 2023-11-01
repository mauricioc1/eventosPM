
<?php require 'inc/header.php'; ?>

    <div class="mision container">
        <h2>Mision</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore minima minus omnis esse voluptatibus sapiente accusantium amet iste labore sequi numquam, excepturi delectus beatae voluptate ducimus nemo, atque, consequuntur sunt.</p>
    </div>

    <div class="formulario" id="cotizar">

    <div class="container">
        <div class="row">
            <div class="col text-center">
                <h3 style="margin-bottom: 2%; margin-top: 2%;">Formulario De Cotización</h3>
                <h1 id="precioTotal" style="margin-bottom: 2%;">₡0.00</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md"></div>
                <div class="col-md">
                    <label for="events">Tipo de Evento</label>
                    <select class="form-control" id="events">
                        <option value="nulo">Seleccionar Evento</option>
                        <option value="opcion1">opcion1</option>
                        <option value="opcion2">opcion2</option>
                        <option value="opcion3">opcion3</option>
                        <option value="opcion4">opcion4</option>
                    </select>
                </div>
            <div class="col-md"></div>
        </div>

        <p class="text-center" style="margin-top: 2%; font-size: small">Ubicación</p>

        <div class="row" style="margin-bottom: 2%;">
            <div class="col-md"></div>
                <div class="col-md">
                    <label for="pr">Provincia</label>
                    <select class="form-control" id="pr">
                        <option value="nulo">Seleccionar Provincia</option>
                        <option value="opcion1">opcion1</option>
                        <option value="opcion2">opcion2</option>
                        <option value="opcion3">opcion3</option>
                        <option value="opcion4">opcion4</option>
                    </select>
                </div>
            <div class="col-md"></div>
        </div>

        <div class="row" style="margin-bottom: 2%;">
            <div class="col-md"></div>
                <div class="col-md">
                    <label for="canton">Cantón</label>
                    <select class="form-control" id="canton">
                        <option value="nulo">Seleccionar Cantón</option>
                        <option value="opcion1">opcion1</option>
                        <option value="opcion2">opcion2</option>
                        <option value="opcion3">opcion3</option>
                        <option value="opcion4">opcion4</option>
                    </select>
                </div>
            <div class="col-md"></div>
        </div>

        <div class="row" >
            <div class="col-md"></div>
                <div class="col-md">
                    <label for="invitados">Asistentes al evento</label>
                </div>
            <div class="col-md"></div>
        </div>

        <div class="row" style="margin-bottom: 2%;">
            <div class="col-md"></div>
                <div class="col-md">
                    <input type="text" id="invitados" name="invitados" style="width: 100%; height: 110%">
                </div>
            <div class="col-md"></div>
        </div>

        <div class="row">
            <div class="col-md"></div>
                <div class="col-md">
                    <label for="slider">Duración del evento en horas</label>
                </div>
            <div class="col-md"></div>
        </div>

        <div class="row">
            <div class="col-md"></div>
                <div class="col-md">
                    <div class="slidecontainer">
                        <input type="range" min="4" max="12" value="4" class="slider" id="myRange" style="width: 100%;">
                        <p id="valorHoras"></p>
                    </div>
                </div>
            <div class="col-md"></div>
        </div>

        <div class="row" style="margin-top: 1%;">
            <div class="col-md"></div>
                <div class="col-md">
                    <label for="menu">Menú</label>
                    <select class="form-control" id="menu">
                        <option value="nulo">Seleccionar Menú</option>
                        <option value="opcion1">opcion1</option>
                        <option value="opcion2">opcion2</option>
                        <option value="opcion3">opcion3</option>
                        <option value="opcion4">opcion4</option>
                    </select>
                </div>
            <div class="col-md"></div>
        </div>

    


        <div class="row" style="margin-top: 2%;">
            <div class="col-md"></div>
                <div class="col-md">
                    <div class="form-check">
                        <input type="checkbox"  class="form-check-input" id="pirotecnia" name="pirotecnia"/>  
                        <label class="form-check-label" for="pirotecnia">Pirotecnia Fría</label>
                    </div>
                </div>
            <div class="col-md"></div>
        </div>

        <div class="row" style="margin-bottom: 2%; margin-top: 2%;">
            <div class="col-md-4"></div>
            <div class="col-md">
                <button class="btn btn-success btn-lg" id="calculatePrice">Calcular Precio</button>
            </div>
            <div class="col-md">
                <button class="btn btn-primary btn-lg" id="processBill">Generar Factura</button>
            </div>
            <div class="col-md"></div>
        </div>
    </div>


<?php require 'inc/footer.php'; ?>
