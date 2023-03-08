<h1 class="mt-4">APS</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">APS</li>
</ol>

<div class="card mb-4">
    <div class="card-header">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nuevoRolModal">
            Crear nuevo rol
        </button>
    </div>
    <div class="card-body">
        <table id="apsTable" class="table table-bordered table-striped" aria-describedby="apsTable_info">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Estatus</th>
                    <th scope="col">Registro</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Estatus</th>
                    <th scope="col">Registro</th>
                    <th scope="col">Acciones</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<div class="modal fade" id="nuevoRolModal" tabindex="-1" aria-labelledby="nuevoRolModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registro de un nuevo rol de usuario</h5>
                <button type="button" class="close cerrarModal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="row g-3 frmGuardar" method="POST" enctype="multipart/form-data">
                    <div class="col-md-12">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" onclick="guardarRol()">Guardar</button>
                        <button type="button" class="btn btn-secondary cerrarModal" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>