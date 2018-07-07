<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro de empleados</title>
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
    <?php require("HeaderAdmin.php")?>

    <div class="container fondoRegistros">
        <div class="row">
            <div class="col-md-6">
            </div>
            <div class="col-md-6"><br/>
                <form action="<?= base_url()?>index.php/CRUD_EMPLEADO/AddEmpleado" method="post">
                    <div class="form-row">
                        <h1><label for=""><strong> Registro </strong>de Empleados </label></h1>
                    </div>
                    <div class="form-row">
                        <label for="rut">Rut</label>
                        <input type="text" name="rut" id="rut" value="<?= $this->session->MantenerDatosEmpleado['rut']?>" class="form-control" placeholder="sin puntos ni guíon" required="true" maxlength="9" minlength="9">
                    </div>
                    <div class="form-row">
                        <label for="">Nombre</label>
                        <input type="text" name="nombre" id="nombre" value="<?= $this->session->MantenerDatosEmpleado['nombre']?>" class="form-control" placeholder="Nombres..." required="true" maxlength="50" minlength="1">
                    </div>
                    <div class="form-row">
                        <label for="paterno">Apellido paterno</label>
                        <input type="text" name="paterno" id="paterno" value="<?= $this->session->MantenerDatosEmpleado['paterno']?>" class="form-control" placeholder="Apellido paterno ..." required="true" maxlength="50" minlength="1">
                    </div>
                    <div class="form-row">
                        <label for="materno">Apellido Materno</label>
                        <input type="text" name="materno" id="materno" value="<?= $this->session->MantenerDatosEmpleado['materno']?>" class="form-control" placeholder="Apellido materno ..." required="true" maxlength="50" minlength="1">
                    </div>
                    <div class="form-row">
                        <label for="pass1">Contraseña</label>
                        <input type="password" name="pass1" id="pass1" class="form-control" placeholder="minimo 6 caracteres" required="true" maxlength="50" minlength="6">
                    </div>
                    <div class="form-row">
                        <label for="pass2">Repita su contraseña</label>
                        <input type="password" name="pass2" id="pass2" class="form-control" placeholder="debe ser identica a la anterior" required="true" maxlength="50" minlength="6">
                    </div>
                    <div class="form-row">
                        <label for="rol">Cargo/Rol</label>
                        <select name="rol" id="rol" class="form-control">
                            <option value="0">Seleccione</option>
                            <option value="R">Receptor de Muestras</option>
                            <option value="T">Tecnico de Laboratorio</option>
                            <option value="A">Administrador</option>
                        </select>
                    </div><br/>
                    <div class="form-row">
                        <div class="col-md-6">
                            <input type="submit" value="Registrar" class="form-control btn btn-danger">
                        </div>
                        <div class="col-md-6">
                            <input type="submit" value="Limpiar" class="form-control btn btn-info" id="limpiardatos">
                        </div>
                    </div>
                </form><br/>
                <?php if($this->session->MensajeRegistroEmpleado != null){ ?>
                    <div class="alert alert-danger" role="alert">
                        <ul class="navbar-nav">
                            <?php $dato = $this->session->MensajeRegistroEmpleado; foreach ($dato as $key => $i) { ?>
                            <li>
                                <?= $i?>
                                <?= $this->session->set_userdata("MensajeRegistroEmpleado",null)?> 
                            </li>
                            <?php } ?> 
                        </ul>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>      
    <?php require("Footer.php")?>

    <script>
        $("#limpiardatos").on("click",function()
        {
            $("#rut").val("");
            $("#nombre").val("");
            $("#paterno").val("");
            $("#materno").val("");
            $("#correo").val("");
        });
    </script>
</body>
</html>