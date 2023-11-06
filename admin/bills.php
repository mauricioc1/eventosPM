<?php 
require 'inc/tableHeader.php'; 
?>
<div class="container" style="background-color:white;">
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>ID Factura</th>
                    <th>Nombre</th>
                    <th>Cantón</th>
                    <th>Asistentes</th>
                    <th>Duración</th>
                    <th>Menú</th>
                    <th>Monto total</th>
                    <th>Borrar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>0001</td>
                    <td>John</td>
                    <td>San Pedro</td>
                    <td>6</td>
                    <td>60</td>
                    <td>Arroz con pollo</td>
                    <td>120000</td>
                    <td><button class="btn btn-dark" type="button">Borrar</button></td>
                </tr>
                <tr>
                    <td>0002</td>
                    <td>Sergio</td>
                    <td>Santo Domingo</td>
                    <td>2</td>
                    <td>50</td>
                    <td>Carne</td>
                    <td>240000</td>
                    <td><button class="btn btn-dark" type="button">Borrar</button></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                <th>ID Factura</th>
                    <th>Nombre</th>
                    <th>Cantón</th>
                    <th>Asistentes</th>
                    <th>Duración</th>
                    <th>Menú</th>
                    <th>Monto total</th>
                    <th>Borrar</th>
                </tr>
            </tfoot>
        </table>
    </div>


<?php?>