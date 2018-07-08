<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listado de datos</title>
    <style>
        .fondoAnalisis
        {
            min-height: 200px;
            margin-top:100px;
            margin-bottom: 350px;
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
    
    <div class="container table-responsive fondoAnalisis">
        <table class="table table-striped table-bordered" border="1" id="ListadoTelefonos">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Codigo del analisis</th>
                    <th scope="col">Rut responsable</th>
                    <th scope="col">Fecha del resultado</th>
                    <th scope="col">Estado</th>
                    <th scope="col">PPM</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listaAnalisisResultado as $key => $i) { ?>                
                <tr>
                    <th><?= $i['ID_ANALISIS_MUESTRAS']?></th>
                    <th><?= $i['RUT_EMPLEADO_ANALISTA']?></th>
                    <th><?= $i['FECHA_REGISTRO']?></th>
                    <th><?= $i['ESTADO_MUESTRA']?></th>
                    <th><?= $i['PPM']?></th>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php require('Footer.php')?>
    <script>
        $(document).ready(function() {
            $('#ListadoTelefonos').DataTable
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
