<header>    
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/custom.css">    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/jquery.dataTables.min.css">

   <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="<?= base_url()?>index.php/Welcome/AccessReceptorMuetras">Instituto de Salud Pública</a>&nbsp;&nbsp;&nbsp;&nbsp;
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Mi Perfil <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Agregar Muestras
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?= base_url() ?>index.php/CRUD_MUESTRAS">Particulares</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Empresas</a>                
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url()?>index.php/CRUD_MUESTRAS/AllMuestras">Listado de Muestras <span class="sr-only">(current)</span></a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <strong><label for="">Bienvenido: </label></strong> &nbsp;<?= $this->session->usuario?>&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="<?= base_url()?>index.php/Welcome/Logout" class="navbar-brand"><i class="fas fa-sign-out-alt fa-2x"></i></a>
        </form>
    </div>
</nav>
</header>