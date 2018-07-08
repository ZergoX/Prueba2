<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listado de Muestras</title>
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
<?php require("HeaderTecnicoLaboratorio.php")?><br/>

<div class="container table-responsive fondoAnalisis"><br/>
    <table class="table table-striped table-bordered" border="1" id="listadoAnalisis">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Codigo Muestra</th>
                <th scope="col">Rut del responsable</th>
                <th scope="col">Fecha de recepción</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listado_analisis_procesar as $key => $i) {
                $formato = substr($i['RUT_EMPLEADO_RECIBE'],0,2).".".substr($i['RUT_EMPLEADO_RECIBE'],2,3).".".substr($i['RUT_EMPLEADO_RECIBE'],5,3)."-".substr($i['RUT_EMPLEADO_RECIBE'],8,9);?>
            <tr>
                <th><?= $i['ID_ANALISIS_MUESTRAS']?></th>
                <th><?= $formato?></th>
                <th><?= $i['FECHA_RECEPCION']?></th>
                <th><a href="<?= base_url() ."index.php/CRUD_RESULTADO_ANALISIS/CapturarDatoAnalisis/" .$i['ID_ANALISIS_MUESTRAS']?>"><input type="submit" value="Procesar .." class="form-control btn btn-outline-danger"></a></th>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div><br/>

<?php require("Footer.php")?>

    <script>
        $(document).ready(function() {
            $('#listadoAnalisis').DataTable
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