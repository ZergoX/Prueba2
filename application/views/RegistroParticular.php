<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro Empresa</title>
    <style>
        .body
        {
            background: #E5EAEE;
        }
        .fondoRegistros
        {
            margin-top: 40px;
            margin-bottom: 40px;
            background-color:whitesmoke;
        };
    </style>
</head>
<body class="body">
    <?php 
        require("HeaderMain.php");
    ?>

    <div class="container fondoRegistros" id="limpiarformulario">
        <div class="row">
            <div class="col-md-6">
            </div>
            <div class="col-md-6">
                <form action="<?= base_url()?>/index.php/CRUD_PARTICULAR/AddParticular" method="post" id="formularioCliente">
                    <div class="form-row">
                        <h1><label for=""><strong> Registro </strong>de Cliente </label></h1>
                    </div>
                    <div class="form-row">
                        <label for="rutCliente">Rut</label>
                        <input type="text" name="rutCliente" id="rutCliente" value="<?= $this->session->mantener_datos['rut']?>" class="form-control" placeholder="sin puntos ni guion" required="true" minlength="9" maxlength="9">
                    </div>
                    <div class="form-row">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" value="<?= $this->session->mantener_datos['nombre']?>" class="form-control" placeholder="Nombre ..." required="true" maxlength="50" minlength="2">
                    </div>
                    <div class="form-row">
                        <label for="direccion">Direccion</label>
                        <input type="text" name="direccion" id="direccion" value="<?= $this->session->mantener_datos['direccion']?>" class="form-control" placeholder="Direccion ..." required="true" maxlength="100" minlength="5">
                    </div>
                    <div class="form-row">
                        <label for="correo">Correo</label>
                        <input type="email" name="correo" id="correo" value="<?= $this->session->mantener_datos['correo']?>" class="form-control" placeholder="Correo eletronico..." required="true" maxlength="50" minlength="5">
                    </div>
                    <div class="form-row">
                        <label for="pass1">Contrseña</label>
                        <input type="password" name="pass1" id="pass1" class="form-control" placeholder="Contrseña ..." required="true" maxlength="50" minlength="6">
                    </div>
                    <div>
                        <label for="pass2">Repita su contraseña</label>
                        <input type="password" name="pass2" id="pass2" class="form-control" placeholder="Repita su contraseña ..." required="true" maxlength="50" minlength="6">
                    </div>
                    <div class="form-row">
                        <label for="telefono1">Numero telefonico</label>
                        <input type="number" name="telefono1" id="telefono1" value="<?= $this->session->mantener_datos['telefono1']?>" class="form-control" placeholder="numero telefonico" required="true">
                    </div>
                    <div class="form-row">
                        <label for="telefono2">Segundo numero telefonico</label>
                        <input type="number" name="telefono2" id="telefono2" value="<?= $this->session->mantener_datos['telefono2']?>" class="form-control" placeholder="opcional ...">
                    </div><br/>
                    <div class="form-row">
                        <div class="col-md-6">
                            <input type="submit" value="Registar" class="form-control btn btn-danger">
                        </div>
                        <div class="col-md-6">
                            <input type="submit" value="Limpiar" class="form-control btn btn-info" id="limpiar">
                        </div>
                    </div><br/>
                </form>
                <?php if($this->session->mensaje_particular != null){ ?>
                    <div class="alert alert-danger" role="alert">
                        <ul class="navbar-nav">
                            <?php $dato = $this->session->mensaje_particular; foreach ($dato as $key => $i) { ?>
                            <li>
                                <?= $i?>
                                <?= $this->session->set_userdata("mensaje_particular",null)?> 
                            </li>
                            <?php } ?> 
                        </ul>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <?php
        require("Footer.php");
    ?>

    <script>
        $("#limpiar").on("click",function()
        {
            $("#rutCliente").val("");
            $("#nombre").val("");
            $("#direccion").val("");
            $("#correo").val("");
            $("#telefono1").val("");
            $("#telefono2").val("");
        });
    </script>

</body>
</html>