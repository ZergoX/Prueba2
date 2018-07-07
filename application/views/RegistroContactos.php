<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>registro contactos</title>
    <style>
        .fondoAnalisis
        {
            min-height: 200px;
            margin-top:100px;
            margin-bottom: 250px;
            background: #E5EAEE;
        }
        .body
        {
            background: #E5EAEE;
        }
    </style>
</head>
<body class="body">
    <?php require('HeaderUsersEmpresa.php')?>

    <div class="container fondoAnalisis">
        <div class="form-row">
            <div class="col-md-6">
            </div>
            <div class="col-md-6">
                <form action="<?= base_url()?>index.php/CRUD_CONTACTOS/AgregarContactos" method="post">
                    <div class="form-row">
                        <h1><label for=""><strong> Agregar </strong>Contactos </label></h1>
                    </div>
                    <div class="form-row">
                        <label for="rut">Rut</label>
                        <input type="text" name="rut" id="rut" class="form-control" value="" required="true" placeholder="sin puntos ni guion" minlength="9" maxlength="9">
                    </div>
                    <div class="form-row">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" required="true" placeholder="nombre .. " minlength="2" maxlength="50">
                    </div>
                    <div class="form-row">
                        <label for="correo">Correo</label>
                        <input type="email" name="correo" id="correo" class="form-control"  required="true" placeholder="correo electronico" minlength="2" maxlength="50">
                    </div>
                    <div class="form-row">
                        <label for="telefono">Numero telefonico</label>
                        <input type="number" name="telefono" id="telefono" class="form-control"  required="true" placeholder="8 digitos">
                    </div><br/>
                    <div class="form-row">
                        <div class="col-md-6">
                            <input type="submit" value="Agregar" class="form-control btn btn-danger">
                        </div>
                        <div class="col-md-6">
                            <input type="submit" value="Limpiar" class="form-control btn btn-info" id="limpiarDatos">
                        </div>
                    </div>
                </form>
                <?php if($this->session->mensaje_error_contacto != null){ ?>
                    <div class="alert alert-danger" role="alert">
                        <ul class="navbar-nav">
                            <?php $dato = $this->session->mensaje_error_contacto; foreach ($dato as $key => $i) { ?>
                            <li>
                                <?= $i?>
                                <?= $this->session->set_userdata("mensaje_error_contacto",null)?> 
                            </li>
                            <?php } ?> 
                        </ul>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <?php require('Footer.php')?>
    
    <script>
        $('#limpiarDatos').on('click',function()
        {
            $('#rut').val('');
            $('#nombre').val('');
            $('#correo').val('');
            $('#telefono').val('');
        });
    </script>
</body>
</html>