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
                        <h3 class="card-title">Asignar privilegios</h3>
                        <div class="align-content-end text-right">
                           
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="col-md-6 col-sm-12">
                            <div class="title">
                                <h4>Gestion de negocio</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item" aria-current="page">
                                        Privilegios de usuarios
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Asignar privilegios a usuarios
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <form action="index.php?c=usuarios&a=guardarroles" name="crear" id="crear" method="post" class="row  d-flex align-items-center flex-wrap justify-content-center">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
                        <div class="pd-20 card-box height-100-p">
                            <h5 class="text-center h5 mb-0">Elegir modulos</h5>
                            <p class="text-center text-muted font-14">
                                *Elegis los modulos para asignar
                            </p>
                            <div class="form-group col-md-12">
                                <label style="font: bold 16px Arial, sans-serif;">Usuario</label>
                                <select name="id_usuario" id="id_usuario" class="selectpicker form-control" required>
                                    <?php foreach ($data["usuarios"] as $capacidad) : ?>
                                        <option value="<?php echo $capacidad['id']; ?>">
                                            <?php echo $capacidad['usuario']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mt-3">
                                <?php foreach ($data["privilegios"] as $modulo) : ?>
                                    <div class="mt-3">
                                        <label style="font: bold 16px Arial, sans-serif;" for="">
                                            <?php echo $modulo['nombre']; ?>
                                        </label>
                                        <div class="d-flex flex-column">
                                            <?php foreach ($modulo['submodulos'] as $submodulo) : ?>
                                                <div class="custom-control custom-checkbox ml-5">
                                                    <input type="checkbox" name="id_sub_modulo[]" class="custom-control-input" id="submodulo-<?php echo $submodulo['id']; ?>" value="<?php echo $submodulo['id']; ?>" style="height:50%;" />
                                                    <label class="custom-control-label" for="submodulo-<?php echo $submodulo['id']; ?>"><?php echo $submodulo['nombre']; ?></label>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <input type="text" name="id" id="id" value="<?php echo $id_trabajador ?>" hidden>
                            <div class=" btn-list">
                                <button id="guardar" name="guardar" type="submit" class="btn btn-success">Agregar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </div>
    <!-- /.card-body -->
   
</section>
<?php include_once "view/template/footer.php" ?>