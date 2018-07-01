<header>    
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/jquery.dataTables.min.css">
    
    <nav class="navbar navbar-light bg-light">
    <a  href="<?= base_url()?>/index.php/Welcome" class="navbar-brand">Instituto de Salud Pública</a>
    <form class="form-inline">
        <a href="#" class="navbar-brand" data-toggle="modal" data-target="#exampleModal">Login</a>
    </form>
    </nav>

<!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Inicio de Sesion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="form-row">
                            <label for="rut">Rut</label>
                            <input type="text" name="rut" id="rut" class="form-control" required="true" placeholder="sin puntos ni guion">
                        </div>
                        <div class="form-row">
                            <label for="">Contraseña</label>
                            <input type="password" name="pass" id="pass" class="form-control" required="true" placeholder="contraseña ...">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger">Ingresar</button>
                    <a href="<?= base_url()?>/index.php/CRUD_EMPRESA"><button type="button" class="btn btn-outline-secondary">Cuenta Empresa</button></a>
                    <a href="<?= base_url()?>/index.php/CRUD_PARTICULAR"><button type="button" class="btn btn-outline-secondary">Cuenta Cliente</button></a>
                </div>
            </div>
        </div>
    </div>
</header>