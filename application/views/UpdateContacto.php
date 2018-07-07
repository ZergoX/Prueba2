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
                <form action="<?= base_url() ."index.php/CRUD_CONTACTOS/UpdateContacto/". $Load_contacto['RUT_CONTACTO']?>" method="post">
                    <div class="form-row">
                        <h1><label for=""><strong> Actualizar </strong>Contactos </label></h1>
                    </div>
                    <div class="form-row">
                        <label for="rut">Rut</label>
                        <input type="text" name="rut" id="rut" class="form-control" value="<?= $Load_contacto['RUT_CONTACTO']?>" required="true" placeholder="sin puntos ni guion" minlength="9" maxlength="9" disabled>
                    </div>
                    <div class="form-row">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="<?= $Load_contacto['NOMBRE_CONTACTO']?>" required="true" placeholder="nombre .. " minlength="2" maxlength="50">
                    </div>
                    <div class="form-row">
                        <label for="correo">Correo</label>
                        <input type="email" name="correo" id="correo" class="form-control"  value="<?= $Load_contacto['EMAIL_CONTACTO']?>" required="true" placeholder="correo electronico" minlength="2" maxlength="50">
                    </div>
                    <div class="form-row">
                        <label for="telefono">Numero telefonico</label>
                        <input type="number" name="telefono" id="telefono" class="form-control" value="<?= $Load_contacto['TELEFONO_CONTACTO']?>"  required="true" placeholder="8 digitos">
                    </div><br/>
                    <div class="form-row">
                        <input type="submit" value="Actualizar" class="form-control btn btn-danger">
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

</body>
</html>