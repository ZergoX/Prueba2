<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Actualizar</title>
    <style>
        .fondoAnalisis
        {
            min-height: 200px;
            margin-top:100px;
            margin-bottom: 400px;
            background: ;
        }
        .body
        {
            background: #E5EAEE;
        }
    </style>
</head>
<body class="body">
    <?php require("HeaderAdmin.php"); ?>
        <div class="container fondoAnalisis">
            <form action="<?= base_url() ."index.php/CRUD_TIPO_ANALISIS/UpdateAnalisis/". $datos_analisis['ID_TIPO_ANALISIS']?>" method="post">
                <div class="form-row">
                    <label for=""><h1><strong>Actualizar Analisis</strong></h1></label>
                </div><br/><br/>
                <div class="form-row">
                    <div class="col-md-6">
                        <label for="">Nombre del analisis</label>
                        <input type="text" name="nombre" id="nombre" value="<?= $datos_analisis['NOMBRE_TIPO_ANALISIS']?>" class="form-control" required="true">
                    </div>
                    <div class="col-md-6">
                        <label for="">* </label>
                        <input type="submit" value="Actualizar" class="form-control btn btn-primary">
                    </div>
                </div>
            </form><br/>
            <?php if($this->session->mensaje_actualizar_analisis != null){ ?>
                <div class="alert alert-danger" role="alert">
                    <?= $this->session->mensaje_actualizar_analisis?>
                    <?= $this->session->set_userdata("mensaje_actualizar_analisis",null)?>
                </div>
            <?php } ?>
        </div>
    <?php require("Footer.php");?>
</body>
</html>