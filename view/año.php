<?php include_once "view/template/header.php" ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Año</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Año</a></li>
                    <li class="breadcrumb-item active">Gestion de vehiculos</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <!-- /.card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Lista de Categorias de vehiculos por año</h3>
                        <div class="align-content-end text-right">
                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-default">Crear categoria</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="table-plus datatable-nosort">Numero</th>
                                    <th>Nombre</th>
                                    <th>Descripcion</th>

                                </tr>

                            </thead>
                            <tbody>
                                <?php foreach ($años['años'] as $row) { ?>
                                    <tr>
                                        <td class="table-plus">
                                            <?php echo $row['id']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['nombre']; ?>
                                        </td>

                                        <td>
                                            <?php echo $row['descripcion']; ?>
                                        </td>


                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>

<div id="modal-default" class="modal fade">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <form id="crear" name="crear" method="POST" action="index.php?c=año&a=guardar" autocomplete="off" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label style="font: bold 16px Arial, sans-serif;">Nombre</label>
                                    <input name="nombre" type="text" class="form-control" id="nombre" value="" required>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label style="font: bold 16px Arial, sans-serif;">Descripcion</label>
                                    <input name="descripcion" type="text" class="form-control" id="apellido" value="" required>
                                </div>
                            </div>
                            
                        </div>
                        <div class=" btn-list">
                            <button id="guardar" name="guardar" type="submit" class="btn btn-success">Agregar</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
</section>
<?php include_once "view/template/footer.php" ?>