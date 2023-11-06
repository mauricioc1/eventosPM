<?php 
require 'inc/tableHeader.php'; 
?>
<div class="container" style="background-color:white;">
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Nombre evento</th>
                    <th>Precio</th>
                    <th>Editar</th>
                    <th>Borrar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Boda</td>
                    <td>45000</td>
                    <td><button class="btn btn-dark" type="button">Editar</button></td>
                    <td><button class="btn btn-dark" type="button">Borrar</button></td>
                </tr>
                <tr>
                    <td>Evento Empresarial</td>
                    <td>60000</td>
                    <td><button class="btn btn-dark" type="button">Editar</button></td>
                    <td><button class="btn btn-dark" type="button">Borrar</button></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th>Nombre evento</th>
                    <th>Precio</th>
                    <th>Editar</th>
                    <th>Borrar</th>
                </tr>
            </tfoot>
        </table>

        <button class="btn btn-dark" type="button" style="margin-bottom: 1%; margin-top: 1%">Agregar Evento</button>

    </div>


<?php?>