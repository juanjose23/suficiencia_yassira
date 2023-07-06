<?php include_once "view/template/header.php" ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Trabajadores</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Trabajadores</a></li>
                    <li class="breadcrumb-item active">Gestion de trabajadores</li>
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
                        <h3 class="card-title">Lista de Colaboradores</h3>
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
                                    <th>Código trabajador</th>
                                    <th>Foto</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Telefono</th>
                                    <th>Correo</th>
                                  
                                    <th>Cédula</th>
                                    <th>Código INSS</th>
                                    <th>Estado</th>
                                    <th>Estado civil</th>
                                    <th>Género</th>
                                    <th>Nacionalidad</th>
                                    <th>Fecha de nacimiento</th>
                                    <th>Fecha de registro del trabajador</th>
                                    <th>Dirección</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($trabajador['trabajador'] as $row) { ?>
                                    <tr>
                                        <td class="table-plus">
                                            <?php echo $row['id']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['codigo']; ?>
                                        </td>
                                        <td>
                                            <div class="avatar mr-2 flex-shrink-0">
                                                <img src="assets/img/colaborador/<?php echo $row['foto']; ?>" class="border-radius-100 shadow" width="50" height="50" alt="" />
                                            </div>
                                        </td>
                                        <td>
                                            <?php echo $row['nombre']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['apellido']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['telefono']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['correo']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['cedula']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['inss']; ?>
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
                                        <td>
                                            <?php echo $row['nombre_estado']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['genero']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['nacionalidad']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['fecha_registro']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['fecha_nacimiento']; ?>
                                        </td>

                                        <td>
                                            <?php echo $row['direccion_domicilio']; ?>
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

            <form id="crear" name="crear" method="POST" action="index.php?c=colaborador&a=crear_colaborador" autocomplete="off" enctype="multipart/form-data">
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
                                    <label style="font: bold 16px Arial, sans-serif;">Apellido</label>
                                    <input name="apellido" type="text" class="form-control" id="apellido" value="" required>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label style="font: bold 16px Arial, sans-serif;">Fecha de nacimiento</label>
                                    <input name="fecha_nacimiento" class="form-control" placeholder="Seleccionar" data-date-format="dd/mm/yy" data-range="true" data-multiple-dates-separator=" - " data-language="es" type="date" />
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label style="font: bold 16px Arial, sans-serif;">Cedula de identidad</label>
                                    <input name="cedula" type="text" class="form-control" id="cedula" value="" required>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label style="font: bold 16px Arial, sans-serif;">Codigo Inss</label>
                                    <input name="codigo_inss" type="text" class="form-control" id="codigo_inss" value="" required>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label style="font: bold 16px Arial, sans-serif;">Correo electronico</label>
                                    <input name="correo" type="email" class="form-control" id="correo" value="" required>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label style="font: bold 16px Arial, sans-serif;">Telefono</label>
                                    <input name="telefono" type="text" class="form-control" id="telefono" value="" required>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label style="font: bold 16px Arial, sans-serif;">Genero</label>
                                    <select name="genero" class="selectpicker form-control" id="genero" value="">
                                        <option VALUE="F">Femenino</option>
                                        <option VALUE="M">Masculino</option>
                                        <Option value="O">Otro</OPTIOn>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2 col-sm-12">
                                <label style="font: bold 16px Arial, sans-serif;" for="capacidad">Estado civil:</label>
                                <select name=" id_estado_civil" id=" id_estado_civil" class="selectpicker form-control" required>
                                    <?php foreach ($data["estado"] as $estado) : ?>
                                        <option value="<?php echo $estado['id']; ?>"><?php echo $estado['nombre_estado']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label style="font: bold 16px Arial, sans-serif;">Nacionalidad</label>
                                    <select name="nacionalidad" class="selectpicker form-control" id="nacionalidad" value="">
                                        <optgroup label="América del Norte">
                                            <option value="CA">Canadá</option>
                                            <option value="US">Estados Unidos</option>
                                        </optgroup>
                                        <optgroup label="América Central">
                                            <option value="CR">Costa Rica</option>
                                            <option value="CU">Cuba</option>
                                            <option value="DO">República Dominicana</option>
                                            <option value="SV">El Salvador</option>
                                            <option value="GT">Guatemala</option>
                                            <option value="HT">Haití</option>
                                            <option value="HN">Honduras</option>
                                            <option value="JM">Jamaica</option>
                                            <option value="MX">México</option>
                                            <option value="NI">Nicaragua</option>
                                            <option value="PA">Panamá</option>
                                            <option value="PR">Puerto Rico</option>
                                        </optgroup>
                                        <optgroup label="América del Sur">
                                            <option value="AR">Argentina</option>
                                            <option value="BO">Bolivia</option>
                                            <option value="BR">Brasil</option>
                                            <option value="CL">Chile</option>
                                            <option value="CO">Colombia</option>
                                            <option value="EC">Ecuador</option>
                                            <option value="PY">Paraguay</option>
                                            <option value="PE">Perú</option>
                                            <option value="UY">Uruguay</option>
                                            <option value="VE">Venezuela</option>
                                        </optgroup>
                                    </select>
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


                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label style="font: bold 16px Arial, sans-serif;">Foto del Coloborador</label>
                                    <input name="imagenes" type="file" class="fallbuack form-control" id="foto" accept=" image/jpeg,image/png" required>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label style="font: bold 16px Arial, sans-serif;">Direccion de domicilio</label>
                                    <textarea name="direccion_domicilio" id="direccion_domicilio" cols="30" rows="10" class="form-control"></textarea>
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