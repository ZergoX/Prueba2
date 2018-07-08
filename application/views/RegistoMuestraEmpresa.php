<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro Muestras</title>
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
    <?php require('HeaderReceptorMuestras.php') ?>

    <div class="container fondoRegistros"><br/>
        <div class="row">
            <div class="col-md-6">
                <form action="<?=base_url()?>index.php/CRUD_MUESTRAS/Empresa" method="post">
                    <div class="form-row">
                        <div class="col-md-8">
                            <input type="search" name="buscar" id="buscar" placeholder="Codigo cliente" required="true" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <input type="submit" value="Buscar" class="form-control btn btn-danger" id="buscar">
                        </div>
                    </div><br/>
                    <?php foreach ($datos_Empresas as $key => $i) { ?>
                        <div class="form-row">
                            <input type="text" name="rut" id="rut" value="<?= $i['RUT_EMPRESA']?>" class="form-control" placeholder="Rut cliente" disabled>
                        </div><br/>
                        <div class="form-row">
                            <input type="text" name="nombre" id="nombre" value="<?= $i['NOMBRE_EMPRESA']?>" class="form-control" placeholder="nombre del cliente" disabled>
                        </div>    
                    <?php } ?>
                </form>
            </div>
            <div class="col-md-6">
                <form action="<?= base_url()?>index.php/CRUD_MUESTRAS/AddMuestras" method="post">
                    <div class="form-row">
                        <label for="fecha">Fecha de recepción</label>
                        <input type="date" name="fecha" id="fecha" class="form-control" required="true">
                    </div>
                    <div class="form-row">
                        <label for="temperatura">Temperatura</label>
                        <input type="number" name="temperatura" id="temperatura" required="true" placeholder="Temperatura de la muestra" class="form-control">
                    </div>
                    <div class="form-row">
                        <label for="">Cantidad de muestras</label>
                        <input type="number" name="cantidad" id="cantidad" required="true" placeholder="Cantidad de muestras" class="form-control" min="1" max="50">
                    </div><br/>
                    <div class="form-row">
                        <label for="tipoAnalisis">Tipo de Analisis</label>
                        <select name="tipoAnalisis" id="tipoAnalisis" class="form-control">
                            <option value="0">Seleccione</option>
                            <?php foreach ($listado_analisis as $key => $i) { ?>
                                <option value="<?= $i['ID_TIPO_ANALISIS']?>"><?= $i['NOMBRE_TIPO_ANALISIS']?></option>
                            <?php } ?>
                        </select>
                    </div><br/>
                    <div class="form-row">
                        <input type="button" value="agregar" class="btn btn-primary" id="agregarTipo">
                    </div>
                    <div class="form-row">
                        <textarea name="analisis" id="analisis" analisis cols="10" rows="4" class="form-control" placeholder="Analisis a realizar"></textarea>
                    </div><br/>
                    <div class="form-row">
                        <input type="submit" value="Guardar" class="btn btn-primary">
                    </div>
                </form>
                <?php if($this->session->mensaje_erro_muestra != null){ ?>
                    <div class="alert alert-danger" role="alert">
                        <ul class="navbar-nav">
                            <?php $dato = $this->session->mensaje_erro_muestra; foreach ($dato as $key => $i) { ?>
                            <li>
                                <?= $i?>
                                <?= $this->session->set_userdata("mensaje_erro_muestra",null)?> 
                            </li>
                            <?php } ?> 
                        </ul>
                    </div>
                <?php } ?>
            </div>
        </div><br/>
    </div>

    <?php require('Footer.php')?>

    <script>
        $("select#tipoAnalisis").on('change',function()
        {
            var tipoAnalisis = $('#tipoAnalisis option:selected').html();
            
            $("#agregarTipo").on('click',function()
            {
                var texto = $("#analisis").val(tipoAnalisis);
                
            });
        });
    </script>
</body>
</html>