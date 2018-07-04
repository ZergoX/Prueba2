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
    <?php require('HeaderUsers.php');?>

    <div class="container fondoRegistros"><br/>
        <form action="<?= base_url() ."index.php/CRUD_PARTICULAR/EditParticular/". $cargarDatos['PARTICULAR_CODIGO_PARTICULAR']?>" method="post">
            <div class="form-row">
                <div class="col-md-6">
                </div>
                <div class="col-md-6">
                    <div class="form-row">
                        <h1><label for=""><strong> Actualizar </strong> mis datos </label></h1>
                    </div>
                    <div class="form-row">        
                        <label for="rut">RUT</label>
                        <input type="text" name="rut" id="rut" value="<?= $cargarDatos['RUT_PARTICULAR']?>" class="form-control" required="true" minlength="9" maxlength="9" disabled>
                    </div>
                    <div class="form-row">
                        <label for="nombre">NOMBRE</label>
                        <input type="text" name="nombre" id="nombre" value="<?= $cargarDatos['NOMBRE_PARTICULAR']?>" class="form-control" required="true" minlength="1" maxlength="50">
                    </div>                                    
                    <div class="form-row">
                        <label for="direccion">DIRECCIÓN</label>
                        <input type="text" name="direccion" id="direccion" value="<?= $cargarDatos['DIRECCION_PARTICULAR']?>" class="form-control" required="true" minlength="1" maxlength="50">
                    </div>
                    <div class="form-row">
                        <label for="correo">CORREO ELECTRONICO</label>
                        <input type="email" name="correo" id="correo" value="<?= $cargarDatos['EMAIL_PARTICULAR']?>" class="form-control" required="true" minlength="1" maxlength="50">                
                    </div>
                    <div class="form-row">
                        <label for="">Numero telefonico</label>
                        <input type="number" name="telefono" id="telefono" value="<?= $cargarDatos['NUMERO_TELEFONO']?>"class="form-control" placeholder="No tiene numero registrados" required="true">
                    </div><br/>
                    <div class="form-row">                        
                        <input type="submit" value="Editar" class="form-control btn btn-danger">
                    </div><br/>
                    <?php if($this->session->mensaje_error_update_particular != null){ ?>
                        <div class="alert alert-danger" role="alert">
                            <ul class="navbar-nav">
                                <?php $dato = $this->session->mensaje_error_update_particular; foreach ($dato as $key => $i) { ?>
                                <li>
                                    <?= $i?>
                                    <?= $this->session->set_userdata("mensaje_error_update_particular",null)?> 
                                </li>
                                <?php } ?> 
                            </ul>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </form><br/>
    </div>
    <?php require('Footer.php');?>
</body>
</html>