<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listado de Empleados</title>
    <style>
        .fondoAnalisis
        {
            min-height: 200px;
            margin-top:100px;
            margin-bottom: 100px;
            background: #E5EAEE;
        }
        .body
        {
            background: #E5EAEE;
        }
    </style>
</head>
<body class="body">
<?php require("HeaderAdmin.php")?><br/>

<div class="container table-responsive fondoAnalisis"><br/>
    <table class="table table-striped table-bordered" border="1" id="listadoEmpleados">
        <thead class="thead-dark">
            <tr>
                <th scope="col">RUT</th>
                <th scope="col">NOMBRE</th>
                <th scope="col">ESTADO</th>
                <th scope="col">Rol</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listado_empleados as $key => $i) { 
                $tipo = ($i['ROL']== 'A') ? "Administrador" : (($i['ROL']=='T') ? "Tecnico en Laboratorio" : "Receptor de Muestras");?>
            <tr>
                <th><?= $i['RUT_EMPLEADO']?></th>
                <th><?= $i['NOMBRE_EMPLEADO'] ." ". $i['APELLIDO_PATERNO_EMPLEADO'] ." ". $i['APELLIDO_MATERNO_EMPLEADO']?></th>
                <th><?= $i['ESTADO_EMPLEADO']?></th>
                <th><?= $tipo ?></th>
                <th><a href="<?= base_url() ."index.php/CRUD_EMPLEADO/HabilitarEmpleado/". $i['RUT_EMPLEADO'] ?>"><input type="submit" value="Habilitar" class="btn btn-outline-danger"></a></th>
                <th><a href="<?= base_url() ."index.php/CRUD_EMPLEADO/DeshabilitarEmpleado/". $i['RUT_EMPLEADO' ]?>"><input type="submit" value="Dehabilitar" class="btn btn-outline-info"></a></th>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div><br/>

<?php require("Footer.php")?>

    <script>
        $(document).ready(function() {
            $('#listadoEmpleados').DataTable
            ({
                responsive: true,

                language:{
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron datos en la tabla ",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }
            });
        } );
    </script>
</body>
</html>