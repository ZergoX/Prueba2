<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Modificar datos</title>
    <style>
        .body
        {
            background: #E5EAEE;
        }
        .fondoRegistros
        {
            margin-top: 100px;
            margin-bottom: 300px;
            background-color:whitesmoke;
        };
    </style>
</head>
<body class="body">
    <?php require('HeaderUsersEmpresa.php');?>

    <div class="container fondoRegistros"><br/>
        <div class="form-row">
            <div class="col-md-6">
            <form action="<?= base_url() ."index.php/CRUD_EMPRESA/UpdateEmpresa/".$CarpturarEmpresa['CODIGO_EMPRESA']?>" method="post">
            </div>
                <div class="col-md-6">
                    <div class="form-row">
                        <h1><label for=""><strong> Actualizar </strong> Mis Datos </label></h1>
                    </div>
                    <div class="form-row">        
                        <label for="rut">RUT</label>
                        <input type="text" name="rut" id="rut" value="<?= $CarpturarEmpresa['RUT_EMPRESA'] ?>" class="form-control" required="true" minlength="9" maxlength="9" disabled>
                    </div>
                    <div class="form-row">
                        <label for="nombre">NOMBRE</label>
                        <input type="text" name="nombre" id="nombre" value="<?= $CarpturarEmpresa['NOMBRE_EMPRESA']?>" class="form-control" required="true" minlength="1" maxlength="50">
                    </div>                                    
                    <div class="form-row">
                        <label for="direccion">DIRECCIÓN</label>
                        <input type="text" name="direccion" id="direccion" value="<?= $CarpturarEmpresa['DIRECCION_EMPRESA']?>" class="form-control" required="true" minlength="1" maxlength="50">
                    </div><br/>                
                    <div class="form-row">                        
                        <div class="col-md-6">
                            <input type="submit" value="Guardar cambios" class="form-control btn btn-danger">
                        </div>
                    </div><br/>
                </div>
            </div>
        </form><br/>
    </div>
    <?php require('Footer.php');?>
</body>
</html>