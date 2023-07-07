<?php require_once "view/template/header.php";?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Inicio</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href>Inicio</a></li>

                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
    
    
        <h5 class="mb-2">Hola, <?php echo $nombre ?></h5>
        <div class="row">

            <!-- /.col -->
            <div class="col-md-12">
                <!-- Widget: user widget style 1 -->
                <div class="card card-widget widget-user shadow">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-info">
                        <h3 class="widget-user-username"></h3>
                        <h5 class="widget-user-desc"></h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle elevation-2"
                            src="assets/img/colaborador/<?php echo $foto?>"
                            alt="User Avatar" width="40" height="50">
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header"></h5>
                                    <span class="description-text">Fecha del
                                        dia</span>
                                </div>
                                <!-- /.description-block -->
                            </div>

                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header"></h5>
                                    <span class="description-text">Hora</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">
                                        </h5>
                                   
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->

                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.widget-user -->
            </div>

            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
<?php require_once "view/template/footer.php";?>