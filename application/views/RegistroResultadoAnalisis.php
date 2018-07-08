<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro de resultado de analisis</title>
    <style>
        .body
        {
            background: #E5EAEE;
        }
        .fondoRegistros
        {
            margin-top: 100px;
            margin-bottom: 100px;
            background-color:whitesmoke;
        };
    </style>
</head>
<body class="body">

    <?php require('HeaderTecnicoLaboratorio.php')?>

    <div class="container fondoRegistros"><br/>
        <div class="row">
            <div class="col-md-6">
            </div>
            <div class="col-md-6">
                <form action="<?= base_url()?>index.php/CRUD_RESULTADO_ANALISIS/AddResultado" method="post">
                    <div class="form-row">
                        <h1><label for=""><strong> Registro </strong>de Muestras </label></h1>
                    </div>
                    <div class="form-row">
                        <label for="codigoCliente">Codigo de Cliente</label>
                        <input type="text" name="codigoCliente" id="codigoCliente" value="<?= $resultado['PARTICULAR_CODIGO_PARTICULAR']?>" class="form-control" disabled>
                    </div>
                    <div class="form-row">
                        <label for="codigoMuestras">Codigo de la muestra</label>
                        <input type="text" name="codigoMuestras" id="codigoMuestras" value="<?= $resultado['ID_ANALISIS_MUESTRAS']?>" class="form-control" disabled>
                    </div>
                    <div class="form-row">
                        <label for="tipoAnalisis">Tipo de analisis</label>
                        <input type="text" name="tipoAnalisis" id="tipoAnalisis" value="<?= $resultado['Tipo_analisis']?>" class="form-control" disabled>
                    </div>
                    <div class="form-row">
                        <label for="ppm">PPM</label>
                        <input type="number" name="ppm" id="ppm" class="form-control" required="true" min="1">
                    </div><br/>
                    <div class="form-row"> 
                        <input type="submit" value="Guardar Analisis" class="btn btn-danger">
                    </div>
                </form>
                <?php if($this->session->mensaje_error_resultado != null){ ?>
                    <div class="alert alert-danger" role="alert">
                        <ul class="navbar-nav">
                            <li>
                                <?=  $this->session->mensaje_error_resultado?>
                                <?= $this->session->set_userdata('mensaje_error_resultado',null)?>
                            </li>
                        </ul>
                    </div>
                <?php } ?>
            </div>
        </div><br/>
    </div>

    <?php require('Footer.php')?>

</body>
</html>