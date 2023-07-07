<?php include_once "view/template/header.php" ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Marca</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Marca</a></li>
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
                        <h3 class="card-title">Lista de marcas de vehiculos</h3>
                        <div class="align-content-end text-right">
                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-default">Crear categoria</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="table-plus datatable-nosort">Numero</th>
                                    <th>Descripcion</th>
                                    <th>siglas</th>
                                    <th>Estado</th>
                                    
                                  
                            </thead>
                            <tbody>
                                <?php foreach ($categorias['categoria'] as $row) { ?>
                                    <tr>
                                        <td class="table-plus">
                                            <?php echo $row['id']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['descripcion']; ?>
                                        </td>
                                      
                                        <td>
                                            <?php echo $row['siglas']; ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($row['estado'] == 1) {
                                                echo "<span class='badge badge-pill' data-bgcolor='#e7ebf5' data-color='#265ed7'>Activo</span>";
                                            } elseif ($row['estado'] == 2) {
                                                echo "<span class='badge badge-pill' data-bgcolor='#e7ebf5' data-color='#e95959'>Inactivo</span>";
                                            }
                                            ?>

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

            <form id="crear" name="crear" method="POST" action="index.php?c=marca&a=guardar" autocomplete="off" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label style="font: bold 16px Arial, sans-serif;">Siglas</label>
                                    <input name="siglas" type="text" class="form-control" id="nombre" value="" required>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label style="font: bold 16px Arial, sans-serif;">Descripcion</label>
                                    <input name="descripcion" type="text" class="form-control" id="apellido" value="" required>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label style="font: bold 16px Arial, sans-serif;">Estado</label>
                                    <select name="estado" class="selectpicker form-control" id="estado" value="">
                                        <option value=0>Seleccionar</option>
                                        <option value=1>Activo</option>
                                        <option value=2>Inactivo</option>
                                    </select>
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