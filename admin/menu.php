<?php 
require 'inc/tableHeader.php'; 
?>
<div class="container" style="background-color:white;">
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Nombre comida</th>
                    <th>Precio</th>
                    <th>Editar</th>
                    <th>Borrar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Papitas</td>
                    <td>2000</td>
                    <td><button class="btn btn-dark" type="button">Editar</button></td>
                    <td><button class="btn btn-dark" type="button">Borrar</button></td>
                </tr>
                <tr>
                    <td>Pollito</td>
                    <td>2500</td>
                    <td><button class="btn btn-dark" type="button">Editar</button></td>
                    <td><button class="btn btn-dark" type="button">Borrar</button></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th>Nombre comida</th>
                    <th>Precio</th>
                    <th>Editar</th>
                    <th>Borrar</th>
                </tr>
            </tfoot>
        </table>
        
        <button class="btn btn-dark" type="button" style="margin-bottom: 1%; margin-top: 1%">Agregar Menú</button>

    </div>
<?php?>