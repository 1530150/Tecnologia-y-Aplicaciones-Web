<?php include_once RUTA_APP . "/views/header.php"; ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Inicio
        <small>Panel de configuración</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
<!-- Small boxes (Stat box) -->
      <div class="row">
        <?php if($_SESSION["tienda"] == 1 ): //Se verifica si el usuario es admin ?>
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-maroon">
              <div class="inner">
                <h3><?php echo $data[0] ?></h3>

                <p>Tiendas</p>
              </div>
              <div class="icon">
                <i class="fa fa-building"></i>
              </div>
              <a href="<?php echo RUTA_URL?>/public/tiendas/" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        <?php else: ?>
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
              <div class="inner">
                <h3><?php echo $data[1] ?></h3>

                <p>Usuarios</p>
              </div>
              <div class="icon">
                <i class="fa fa-user"></i>
              </div>
              <a href="<?php echo RUTA_URL?>/public/usuarios/" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3><?php echo $data[2] ?></h3>

                <p>Productos</p>
              </div>
              <div class="icon">
                <i class="fa fa-cube"></i>
              </div>
              <a href="<?php echo RUTA_URL?>/public/productos/" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3><?php echo $data[3] ?></h3>

                <p>Categorías</p>
              </div>
              <div class="icon">
                <i class="fa fa-tags"></i>
              </div>
              <!-- /.row -->
              <a href="<?php echo RUTA_URL?>/public/categorias/" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        <?php endif ?>
      </div>
     </section>
     <!-- /.content -->

<?php include_once RUTA_APP . "/views/footer.php"; ?>
