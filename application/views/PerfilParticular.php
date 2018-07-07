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
    <?php require('HeaderUsers.php');
    $formato = substr($Perfil_particular['RUT_PARTICULAR'],0,2).".".substr($Perfil_particular['RUT_PARTICULAR'],2,3).".".substr($Perfil_particular['RUT_PARTICULAR'],5,3)."-".substr($Perfil_particular['RUT_PARTICULAR'],8,9);?>

    <div class="container fondoRegistros"><br/>
        <div class="form-row">
            <div class="col-md-6">
            </div>
            <div class="col-md-6">
                <div class="form-row">
                    <h1><label for=""><strong> Mis </strong>Datos </label></h1>
                </div>
                <div class="form-row">        
                    <label for="rut">RUT</label>
                    <input type="text" name="rut" id="rut" value="<?= $formato?>" class="form-control" required="true" minlength="9" maxlength="9" disabled>
                </div>
                <div class="form-row">
                    <label for="nombre">NOMBRE</label>
                    <input type="text" name="nombre" id="nombre" value="<?= $Perfil_particular['NOMBRE_PARTICULAR']?>" class="form-control" required="true" minlength="1" maxlength="50" disabled>
                </div>                                    
                <div class="form-row">
                    <label for="direccion">DIRECCIÓN</label>
                    <input type="text" name="direccion" id="direccion" value="<?= $Perfil_particular['DIRECCION_PARTICULAR']?>" class="form-control" required="true" minlength="1" maxlength="50" disabled>
                </div>
                <div class="form-row">
                    <label for="correo">CORREO ELECTRONICO</label>
                    <input type="email" name="correo" id="correo" value="<?= $Perfil_particular['EMAIL_PARTICULAR']?>" class="form-control" required="true" minlength="1" maxlength="50" disabled>                
                </div>
                <div class="form-row">
                    <label for="numeroMain">Numero telefónico</label>
                    <input type="text" name="numeroMain" id="numeroMain" value="<?= $Perfil_particular['NUMERO_TELEFONO']?>" class="form-control" required="true" minlength="1" maxlength="50" disabled>    
                </div><br/>
                <div class="form-row">                        
                    <div class="col-md-6">
                        <a href="<?= base_url()."index.php/CRUD_PARTICULAR/LoadUpdateParticular/".$Perfil_particular['PARTICULAR_CODIGO_PARTICULAR']?>"><input type="submit" value="Editar" class="form-control btn btn-danger"></a>
                    </div>
                    <div class="col-md-6">
                        <a href="<?= base_url()."index.php/CRUD_PARTICULAR/deshabilitarCuenta/".$Perfil_particular['PARTICULAR_CODIGO_PARTICULAR']?>"><input type="submit" value="Inhabilitar mi cuenta" class="form-control btn btn-info"></a>
                    </div>
                </div><br/>
                <div class="form-row">
                    <h5><label for=""><strong> Cambiar </strong>Contraseña </label></h5>
                </div>
                <form action="<?= base_url()?>index.php/CRUD_PARTICULAR/CambiarPass" method="post">
                    <div class="form-row">
                        <label for="oldpass">Ingrese su contaseña</label>
                        <input type="password" name="oldpass" id="oldpass" class="form-control" required="true" minlength="1" maxlength="50">
                    </div>
                    <div class="form-row">
                        <label for="newPass">Nueva contraseña</label>
                        <input type="password" name="newPass" id="newPass" class="form-control" required="true" minlength="1" maxlength="50">
                    </div>
                    <div class="form-row">
                        <label for="repeatNewPass">Repita su contraseña</label>
                        <input type="password" name="repeatNewPass" id="repeatNewPass" class="form-control" required="true" minlength="1" maxlength="50">
                    </div><br/>
                    <div class="form-row">
                        <input type="submit" value="Cambiar contraseña" class="form-control btn btn-danger">
                    </div>
                </form>
                <?php if($this->session->mensaje_pass != null){ ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $this->session->mensaje_pass?>
                        <?= $this->session->set_userdata("mensaje_pass",null)?>
                    </div>
                <?php } ?>
            </div>
        </div><br/>
    </div>
    <?php require('Footer.php');?>
</body>
</html>