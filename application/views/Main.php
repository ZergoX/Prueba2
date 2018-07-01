<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Instituto de salud Pública</title>
    <style>
        .fondoMain
        {
            min-height: 200px;
            margin-top:100px;
            margin-bottom: 100px;
        }
        .body
        {
            background: #E5EAEE;
        }
    </style>
</head>

<body class="body">
    <div class="container-fluid fondoMain">
        <div class="container">
            <ul class="nav justify-content-center">
                <li class="navbar-brand"><strong><h1>NOTICIAS</h1></strong></li>
            </ul>
            <ul class="nav justify-content-center">
                <div>
                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur? At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere</p>
                </div>
            </ul>
        </div><br/>
        <div class="container-fluid">
        <div class="card-group">
            <div class="card">
                <img class="card-img-top" src="<?= base_url()?>/assets/img/noticia1.jpg" width="200px" height="400px" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Información entregada por el Ministerio de Salud por Sarampión</h5>
                    <p class="card-text">Ante la información que ha circulado por estos días respecto de la enfermedad del Sarampión, desde el Ministerio de Salud creemos pertinente y necesario aclarar lo siguiente:</p>
                </div>
                <div class="card-footer">
                    <mall class="text-muted"><i class="fas fa-arrow-circle-right fa-3x"></i></small>
                </div>
            </div>
            <div class="card">
                <img class="card-img-top" src="<?= base_url()?>/assets/img/noticia3.jpg" width="200px" height="400px" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Día del Donante Voluntario de Sangre en el Instituto de salud Pública</h5>
                    <p class="card-text">Hoy, jueves 14 de junio, se celebra el Día Mundial del Donante Voluntario de Sangre. Para conmemorar esta fecha, el Hospital San José realiza una colecta en la Octava Comisaría de Colina, actividad a la que concurrieron más de una veintena de personas a realizar su donación para contribuir al stock que el establecimiento necesita para cubrir las necesidades de los usuarios.</p>
                </div>
                <div class="card-footer">
                    <mall class="text-muted"><i class="fas fa-arrow-circle-right fa-3x"></i></small>
                </div>
            </div>
            <div class="card">
                <img class="card-img-top" src="<?= base_url()?>/assets/img/noticia2.jpg" width="200px" height="400px" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">El Instituto de salud Pública participa en el lanzamiento local de la Campaña de Invierno 2018.</h5>
                    <p class="card-text">Con un llamado al autocuidado, al reconocimiento de síntomas y al buen uso de la red, se realizó el lanzamiento local de la Campaña de Invierno 2018.</p>
                </div>
                <div class="card-footer">
                    <mall class="text-muted"><i class="fas fa-arrow-circle-right fa-3x"></i></small>
                </div>
            </div>
            </div>
        </div>                
    </div>
    
    <?php
        require("Footer.php");
    ?>
    <?php if($this->session->mensaje_agregar_analisis != null){ ?>
        <script> alert("<?= $this->session->mensaje_agregar_analisis?>")</script> 
        <?= $this->session->set_userdata("mensaje_agregar_analisis",null)?>
    <?php }?>
</body>

</html>