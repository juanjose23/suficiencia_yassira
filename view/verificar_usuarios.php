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
                        <h3 class="card-title">Lista de usuarios para verificar</h3>
                       
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
                                    <th>Accion</th>
                                    <th>Fecha de registro del usuario</th>
                                  
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data["verificar"] as $row) { ?>
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
                                        <a href="index.php?c=usuarios&a=verificarr&id=<?php echo $row["id"]; ?>" class="btn btn-block btn-warning">Verificar</a>
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
<?php include_once "view/template/footer.php" ?>