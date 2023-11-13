
<?php require 'inc/header.php'; ?>

    <div class="mision container">
        <h2 tabindex="5">Misión</h2>
        <p tabindex="6">
            La misión de nuestra empresa es crear experiencias memorables y únicas, mediante el diseño, 
            planeación y ejecución de eventos de alta calidad. Garantizamos un servicio excepcional y 
            a la medida de las necesidades del cliente. La principal meta es ofrecer soluciones creativas 
            que dejen una impresión duradera en cada uno de los participantes.
        </p>
    </div>

    <div class="formulario" id="cotizar">

        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <h3 style="margin-bottom: 2%; margin-top: 2%;" tabindex="7">Formulario De Cotización</h3>
                    <h1 id="precioTotal" style="margin-bottom: 2%;">₡ <span>0</span> </h1>
                </div>
            </div>

            <div class="row">
                <div class="col-md"></div>
                    <div class="col-md">
                        <label for="events" tabindex="8">Tipo de Evento</label>
                        <select class="form-control" id="events" tabindex="9">
                            <!-- Se cargan del backend -->
                        </select>
                    </div>
                <div class="col-md"></div>
            </div>

            <p class="text-center" style="margin-top: 2%; font-size: small" tabindex="10">Ubicación</p>

            <div class="row" style="margin-bottom: 2%;">
                <div class="col-md"></div>
                    <div class="col-md">
                        <label for="pr" tabindex="11">Provincia</label>
                        <select class="form-control" id="provinces" tabindex="12">
                            <!-- Se cargan del backend -->
                        </select>
                    </div>
                <div class="col-md"></div>
            </div>

            <div class="row" style="margin-bottom: 2%;">
                <div class="col-md"></div>
                    <div class="col-md">
                        <label for="canton" tabindex="13">Cantón</label>
                        <select class="form-control" id="cantons" tabindex="14">
                            <option value="" data-price="0">Cantones</option>
                        </select>
                    </div>
                <div class="col-md"></div>
            </div>

            <div class="row" >
                <div class="col-md"></div>
                    <div class="col-md">
                        <label for="invitados" tabindex="15">Asistentes al evento</label>
                    </div>
                <div class="col-md"></div>
            </div>

            <div class="row" style="margin-bottom: 2%;">
                <div class="col-md"></div>
                    <div class="col-md">
                        <input type="text" id="invitados" name="invitados" style="width: 100%; height: 110%" data-mask="0000" tabindex="16">
                    </div>
                <div class="col-md"></div>
            </div>

            <div class="row">
                <div class="col-md"></div>
                    <div class="col-md">
                        <label for="slider" tabindex="17">Duración del evento en horas</label>
                    </div>
                <div class="col-md"></div>
            </div>

            <div class="row">
                <div class="col-md"></div>
                    <div class="col-md">
                        <div class="slidecontainer">
                            <input type="range" min="4" max="12" value="4" class="slider" id="myRange" style="width: 100%;" tabindex="18">
                            <p id="valorHoras2"></p>
                        </div>
                    </div>
                <div class="col-md"></div>
            </div>

            <div class="row" style="margin-top: 1%;">
                <div class="col-md"></div>
                    <div class="col-md">
                        <label for="menu" tabindex="19">Menú</label>
                        <select class="form-control" id="menu" tabindex="20">
                            <!-- Se carga del backend -->
                        </select>
                    </div>
                <div class="col-md"></div>
            </div>

        


            <div class="row" style="margin-top: 2%;">
                <div class="col-md"></div>
                    <div class="col-md">
                        <div class="form-check">
                            <!-- se selecciona o deselecciona con la tecla 'espacio' -->
                            <input type="checkbox" class="form-check-input" id="pirotecnia" name="pirotecnia" tabindex="21"/>  
                            <label class="form-check-label" for="pirotecnia" tabindex="22">Pirotecnia Fría</label>
                        </div>
                    </div>
                <div class="col-md"></div>
            </div>

            <div class="row" style="margin-bottom: 2%; margin-top: 2%;">
                <div class="col-md-4"></div>
                <div class="col-md">
                    <button class="btn btn-success btn-lg" id="calculatePrice" tabindex="23">Calcular Precio</button>
                </div>
                <div class="col-md">
                    <button class="btn btn-primary btn-lg" id="processBill" tabindex="24">Generar Factura</button>
                </div>
                <div class="col-md"></div>
            </div>
    </div>


<?php require 'inc/footer.php'; ?>
