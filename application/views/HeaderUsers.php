<header>    
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/custom.css">    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/jquery.dataTables.min.css">

   <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="<?= base_url()?>index.php/Welcome/AccessUsers">Instituto de Salud Pública</a>&nbsp;&nbsp;&nbsp;&nbsp;
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="<?= base_url()?>index.php/CRUD_PARTICULAR/loadPerfilParticular">Mi Perfil <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url()?>index.php/CRUD_TELEFONO/">Agregar Numero telefonico</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url()?>index.php/CRUD_RESULTADO_ANALISIS/loadAllReusultadoAnalisis">Mis muestras de analisis</a>
            </li>        
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <strong><label for="">Bienvenido: </label></strong> &nbsp;<?= $this->session->usuario?>&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="<?= base_url()?>index.php/Welcome/Logout" class="navbar-brand"><i class="fas fa-sign-out-alt fa-2x"></i></a>
        </form>
    </div>
    <div class="modal fade" id="ModalAgregarAnalisis" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Analisis</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url()?>index.php/CRUD_TIPO_ANALISIS/AddAnalisis" method="post" id="mantenerModal">
                        <div class="form-row">
                            <div class="col-md-8">
                                <input type="text" name="analisis" id="analisis" class="form-control" required="true" placeholder="Nombre del analisis ..."> 
                            </div>
                            <div class="col-md-4">
                            <input type="submit" value="Agregar" id="Agregar" class="form-control btn btn-outline-danger">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
</header>