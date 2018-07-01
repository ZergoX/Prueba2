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
    <div class="container fondoRegistros">
        <div class="row">
            <div class="col-md-6">
            </div>
            <div class="col-md-6">
                <form action="<?= base_url()?>index.php/CRUD_EMPRESA/AddEmpresa" method="post" id="formularioCliente">
                    <div><br/>
                        <h1><label for=""><strong> Registro </strong>de empresa </label></h1>
                    </div><br/>
                    <div class="form-row">
                        <label for="rut">Rut de la Empresa</label>
                        <input type="text" name="rutEmpresa" id="rutEmpresa" class="form-control" value="<?= $this->session->datosEmpresa['rutEmpresa']?>" placeholder="sin puntos ni guion" required="true" minlength="9" maxlength="9">
                    </div>
                    <div class="form-row">
                        <label for="nombre">Nombre de la empresa</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="<?= $this->session->datosEmpresa['nombreEmpresa']?>" placeholder="Nombre ..." required="true" maxlength="50" minlength="2">
                    </div>
                    <div class="form-row">
                        <label for="direccion">Direccion</label>
                        <input type="text" name="direccion" id="direccion" class="form-control" value="<?= $this->session->datosEmpresa['direccionEmpresa'] ?>" placeholder="Direccion ..." required="true" maxlength="100" minlength="5">
                    </div>
                    <div class="form-row">
                        <label for="pass1">Contraseña</label>
                        <input type="password" name="pass1" id="pass1" class="form-control" placeholder="Contrseña ..." required="true" maxlength="50" minlength="6">
                    </div>
                    <div class="form-row">
                        <label for="pass2">Repita su contraseña</label>
                        <input type="password" name="pass2" id="pass2" class="form-control" placeholder="Repita su contraseña ..." required="true" maxlength="50" minlength="6">
                    </div><br/>
                    <div class="form-row">
                        <label for="">Datos de contactos</label>
                    </div>
                    <div class="form-row">
                        <label for="rutContacto">Rut del contacto</label>
                        <input type="text" name="rutContacto" id="rutContacto" class="form-control" value="<?= $this->session->datosEmpresa['RutContacto'] ?>" placeholder="sin puntos ni guion" required="true" minlength="9" maxlength="9" onChange="validarSiNumero(this.value);">
                    </div>
                    <div class="form-row">
                        <label for="nombreContacto">Nombre del contacto</label>
                        <input type="text" name="nombreContacto" id="nombreContacto" class="form-control" value="<?= $this->session->datosEmpresa['nombreContacto']?>"  placeholder="Nombre..." required="true" minlength="1" maxlength="50">
                    </div>
                    <div class="form-row">
                        <label for="correo">Correo</label>  
                        <input type="email" name="correo" id="correo" class="form-control" value="<?= $this->session->datosEmpresa['CorreoContacto']?>" placeholder="Correo eletronico..." required="true" maxlength="50" minlength="5">
                    </div>
                    <div class="form-row">
                        <label for="telefono1">Numero telefonico</label>
                        <input type="number" name="telefono1" id="telefono1" class="form-control" value="<?= $this->session->datosEmpresa['telefonoContacto']?>" placeholder="numero telefonico" required="true">
                    </div><br/>
                    <div class="form-row">
                        <div class="col-md-6">
                            <input type="submit" value="Registar" class="form-control btn btn-danger">
                        </div>
                        <div class="col-md-6">
                            <input type="submit" value="Limpiar" class="form-control btn btn-info" id="LimpiarDatos">
                        </div>
                    </div><br/>
                </form>                

                <?php if($this->session->mensajes_Empresa != null){ ?>
                    <div class="alert alert-danger" role="alert">
                        <ul class="navbar-nav">
                            <?php $dato = $this->session->mensajes_Empresa; foreach ($dato as $key => $i) { ?>
                            <li>
                                <?= $i?>
                                <?= $this->session->set_userdata("mensajes_Empresa",null)?> 
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
        $("#LimpiarDatos").on("click",function()
        {
            $("#rutEmpresa").val("");
            $("#nombre").val("");
            $("#direccion").val("");
            $("#rutContacto").val("");
            $("#nombreContacto").val("");
            $("#correo").val("");
            $("#telefono1").val("");
        });
    </script>
</body>
</html>