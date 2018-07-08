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
    <?php require('HeaderTecnicoLaboratorio.php');
     
      $formato = substr($listado_tecnico['RUT_EMPLEADO'],0,2).".".substr($listado_tecnico['RUT_EMPLEADO'],2,3).".".substr($listado_tecnico['RUT_EMPLEADO'],5,3)."-".substr($listado_tecnico['RUT_EMPLEADO'],8,9);?>

        <div class="container fondoRegistros"><br/>
            <form action="<?= base_url() ."index.php/CRUD_EMPLEADO/EditEmpleadoAnalista/". $listado_tecnico['RUT_EMPLEADO']?>" method="post">
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
                            <input type="text" name="nombre" id="nombre" value="<?= $listado_tecnico['NOMBRE_EMPLEADO']?>" class="form-control" required="true" minlength="1" maxlength="50">
                        </div>
                        <div class="form-row">
                                <label for="">Apellido Paterno</label>
                                <input type="text" name="paterno" id="paterno" value="<?= $listado_tecnico['APELLIDO_PATERNO_EMPLEADO']?>" class="form-control" required="true" minlength="1" maxlength="50">
                        </div> 
                        <div class="form-row">
                                <label for="">Apellido Materno</label>
                                <input type="text" name="materno" id="materno" value="<?= $listado_tecnico['APELLIDO_MATERNO_EMPLEADO']?>" class="form-control" required="true" minlength="1" maxlength="50">
                        </div><br /> 
                        <div class="form-row">                        
                            <div class="col-md-6">
                                <input type="submit" value="Actualizar" class="form-control btn btn-danger">
                            </div>
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
                </div><br/>
            </form>
        </div>
      <?php require('Footer.php');?>
</body>
</html>