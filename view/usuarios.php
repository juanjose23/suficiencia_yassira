<?php include_once "view/template/header.php" ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Usuarios</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Usuarios</a></li>
                    <li class="breadcrumb-item active">Gestion de usuarios</li>
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
                        <h3 class="card-title">Lista de usuarios</h3>
                        <div class="align-content-end text-right">
                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-default">Agregar
                                Trabajador</button>
                        </div>
                    </div>

                    <div class="card-body">



                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="table-plus datatable-nosort">Numero</th>
                                    <th>Grupo de usuario</th>
                                    <th>Sub-Grupo de usuario</th>
                                    <th>Nombre</th>
                                    <th>Estado</th>
                                    <th>Fecha de registro del usuario</th>
                                  
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data["usuarios"] as $row) { ?>
                                    <tr>
                                        <td class="table-plus">
                                            <?php echo $row['id']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['nombre_grupo']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['nombre_subgrupo']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['usuario']; ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($row['estado'] == 0) {
                                                echo "<span class='badge badge-pill' data-bgcolor='#e7ebf5' data-color='#265ed7'>Verificar</span>";
                                            }elseif ($row['estado'] == 1) {
                                                    echo "<span class='badge badge-pill' data-bgcolor='#e7ebf5' data-color='#265ed7'>Verificar</span>";
                                            } elseif ($row['estado'] == 2) {
                                                echo "<span class='badge badge-pill' data-bgcolor='#e7ebf5' data-color='#e95959'>Inactivo</span>";
                                            }
                                            ?>
                                        </td> 
                                        <td>
                                            <?php echo $row['fecha_registro']; ?>
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="crear" name="crear" method="POST" action="index.php?c=usuarios&a=guardar" autocomplete="off" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <label style="font: bold 16px Arial, sans-serif;" for="capacidad">Colaborador:</label>
                                <select name=" id_trabajador" id="" class="selectpicker form-control" required>
                                    <?php foreach ($date["trabajador"] as $estado) : ?>
                                        <option value="<?php echo $estado['id']; ?>"><?php echo $estado['nombre']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <label style="font: bold 16px Arial, sans-serif;" for="capacidad">Grupo Usuarios:</label>
                                <select name=" id_sub" id=" id_sub" class="selectpicker form-control" required>
                                    <?php foreach ($datas["sub"] as $grupo) {
                                        if (count($grupo['subgrupos']) > 0) { // Verificar si el grupo tiene subgrupos
                                    ?>
                                            <optgroup label="<?php echo $grupo['nombre']; ?>" data-id-grupo="<?php echo $grupo['id']; ?>">
                                                <?php foreach ($grupo['subgrupos'] as $subgrupo) { ?>
                                                    <option value="<?php echo $subgrupo['id']; ?>" name="id_subgrupo"><?php echo $subgrupo['nombre']; ?></option>
                                                <?php } ?>
                                            </optgroup>
                                    <?php
                                        } // Fin de la verificación
                                    } ?>
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label style="font: bold 16px Arial, sans-serif;">Usuario</label>
                                    <input name="usuario" type="email" class="form-control" id="usuario" value="" required>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label style="font: bold 16px Arial, sans-serif;">Contraseña</label>
                                    <input name="contraseña" type="password" class="form-control" id="contraseña" value="" required>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label style="font: bold 16px Arial, sans-serif;">Estado</label>
                                    <select name="estado" class="selectpicker form-control" id="estado" value="">
                                        <option value=0>Verficar</option>
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