<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listado de telefonos</title>
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
    <?php require('HeaderUsers.php')?>
    
    <div class="container table-responsive fondoAnalisis">
        <table class="table table-striped table-bordered" border="1" id="ListadoTelefonos">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Número telefonico</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listado_telefonos as $key => $i) { ?>                
                <tr>
                    <th><?= $i['ID_TELEFONO']?></th>
                    <th><?= $i['NUMERO_TELEFONO']?></th>
                    <th><a href="<?= base_url() ."index.php/CRUD_TELEFONO/DeleteTelefono/". $i['ID_TELEFONO']?>"><input type="submit" value="Eliminar" class="btn btn-outline-danger"></a></th>
                </tr>
                <?php } ?>
            </tbody>
        </table><br/><br/>
        <div class="container">
            <form action="<?= base_url()?>index.php/CRUD_TELEFONO/Add" method="post">
                <div class="form-row">
                    <h5><label for=""><strong> Agregar </strong> Número telefono </label></h5>
                </div>
                <div class="form-row"> 
                    <div class="col-md-4">
                        <input type="number" name="telefono" id="telefono" class="form-control" required="true" placeholder="8 digitos ..">
                    </div>
                    <div class="col-md-4">
                        <input type="submit" value="Agregar" class="form-control btn btn-danger">
                    </div>
                </div>
            </form><br/>
            <?php if($this->session->mensaje_erro_add_telefono != null){ ?>
                <div class="alert alert-danger" role="alert">
                    <?= $this->session->mensaje_erro_add_telefono?>
                    <?= $this->session->set_userdata("mensaje_erro_add_telefono",null)?>
                </div>
            <?php } ?>
        </div>
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
