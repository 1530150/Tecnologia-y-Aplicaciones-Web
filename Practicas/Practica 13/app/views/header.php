<?php
  include_once RUTA_APP . "/controllers/home.php"; //Modelo para sesiones
  include_once RUTA_APP . "/models/ProductosModel.php"; //Modelo para sesiones
  include_once RUTA_APP . "/models/HomeModel.php"; //Modelo para sesiones

  //Se valida si hay una sesión iniciada
  if(!Home::sesionIniciada()){
    header("Location: " . RUTA_URL . "/public/home/login"); //Si no la hay manda al login
  }

  $prodObj = new ProductosModel(); //Se crea un objeto del modelo de objetos

  $productosEscazos = $prodObj->getNotificacionesProductos($_SESSION["tienda"]); //Se traen los productos con stock escazo

  $home = new HomeModel(); //Se crea una instancia del modelo home para poder utilizar los métodos para verficiar si el usuario es admin
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Control de inventario</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo RUTA_URL?>/public/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo RUTA_URL?>/public/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo RUTA_URL?>/public/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo RUTA_URL?>/public/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo RUTA_URL?>/public/dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo RUTA_URL?>/public/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo RUTA_URL?>/public/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo RUTA_URL?>/public/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo RUTA_URL?>/public/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo RUTA_URL?>/public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo RUTA_URL?>/public/bower_components/select2/dist/css/select2.min.css">

  <!-- Estilo custom -->
  <style media="screen">
    /* estilos para el hr */
    hr{
      border: 0;
      height: 1px;
      background: #333;
      background-image: -webkit-linear-gradient(left, #ccc, #333, #ccc);
      background-image: -moz-linear-gradient(left, #ccc, #333, #ccc);
      background-image: -ms-linear-gradient(left, #ccc, #333, #ccc);
      background-image: -o-linear-gradient(left, #ccc, #333, #ccc);
    }

    /* estilos para el botón de sweet alert */
    .swal-button--confirm{
      border-radius: 2px;
      background-color: #605ca8;
      border: 1px solid #3e549a;
      text-shadow: 0px -1px 0px rgba(0, 0, 0, 0.3);
    }

    /* estilos para el footer de sweet alert */
    .swal-footer {
      background-color: rgb(221, 220, 246);
      margin-top: 32px;
      border-top: 1px solid #E9EEF1;
      overflow: hidden;
    }

    /* estilos para el botón principal de bootstrap */
    .btn-primary{
      background-color: #605ca8 !important;
    }
  </style>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-purple-light sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo RUTA_URL?>/public/" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">INV</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><?php echo $home->getNombreTienda($_SESSION["tienda"]) ?></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <?php if(!empty($productosEscazos)): ?>
                <span class="label bg-maroon">
                  <?php echo sizeof($productosEscazos) ?>
                </span>
              <?php endif ?>
            </a>
            <ul class="dropdown-menu">
              <li class="header">
                <?php
                  //Se comprueba que haya productos que necesiten ser actualizados
                  if(!empty($productosEscazos)){
                    echo "Tienes " . sizeof($productosEscazos);

                    //Se comprueba si solo hay un producto
                    if(sizeof($productosEscazos)==1){
                      echo " notificación"; //Se muestra este mensaje cuando sea uno
                    }
                    else{
                      echo " notificaciones"; //Si hay más de uno se muestra este otro mensaje
                    }
                  }
                  else{
                    echo "No tienes notificaciones"; //Si no hay productos que necesiten actualizarse
                  }
                ?>
              </li>
              <li>
                <ul class="menu">
                <?php if(!empty($productosEscazos)): ?>
                  <?php foreach($productosEscazos as $producto): ?>
                      <li>
                        <a href="<?php echo RUTA_URL?>/public/productos/detalles/<?php echo $producto[0] ?>">
                          <i class="fa fa-warning text-red"></i> Solo quedan <?php echo $producto[5] . " " . $producto[2] ?> en stock
                        </a>
                      </li>
                  <?php endforeach ?>
              <?php endif ?>
                </ul>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo RUTA_URL . substr($_SESSION["imagen"], 58) ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION["nombre"]?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo RUTA_URL . substr($_SESSION["imagen"], 58) ?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo $_SESSION["nombre"]?>
                  <small><?php echo $_SESSION["correo"]?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <!-- Se verifica que sea un administrador y que no esté en ninguna tienda -->
                <?php if(($home->getTiendaUsuario($_SESSION["id"])) == 1 && ($_SESSION["tienda"] != 1)):  ?>
                  <div class="pull-left">
                    <a href="<?php echo RUTA_URL?>/public/home/cerrarTienda" class="btn btn-default btn-flat">Salir de la tienda</a>
                  </div>
                <?php endif ?>

                <div class="pull-right">
                  <a href="<?php echo RUTA_URL?>/public/home/cerrarSesion" class="btn btn-default btn-flat">Cerrar sesión</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo RUTA_URL . substr($_SESSION["imagen"], 58) ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION["nombre"]?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> En línea</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENÚ PRINCIPAL</li>
        <?php if($_SESSION["tienda"] == 1 ): //Se verifica si el usuario es admin ?>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-building"></i> <span>Tiendas</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo RUTA_URL?>/public/tiendas/agregar"><i class="fa fa-circle-o"></i>Agregar tienda</a></li>
              <li><a href="<?php echo RUTA_URL?>/public/tiendas/"><i class="fa fa-circle-o"></i> Ver tiendas</a></li>
            </ul>
          </li>
        <?php else: ?>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-user"></i> <span>Usuarios</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo RUTA_URL?>/public/usuarios/agregar"><i class="fa fa-circle-o"></i>Agregar usuario</a></li>
              <li><a href="<?php echo RUTA_URL?>/public/usuarios/"><i class="fa fa-circle-o"></i> Ver usuarios</a></li>
            </ul>
          </li>

          <li class="treeview">
            <a href="#">
              <i class="fa fa-cube"></i> <span>Productos</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo RUTA_URL?>/public/productos/agregar"><i class="fa fa-circle-o"></i>Agregar producto</a></li>
              <li><a href="<?php echo RUTA_URL?>/public/productos/"><i class="fa fa-circle-o"></i> Ver productos</a></li>
            </ul>
          </li>

          <li class="treeview">
            <a href="#">
              <i class="fa fa-tags"></i> <span>Categorías</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo RUTA_URL?>/public/categorias/agregar"><i class="fa fa-circle-o"></i>Agregar categoría</a></li>
              <li><a href="<?php echo RUTA_URL?>/public/categorias/"><i class="fa fa-tags"></i> Ver categorias</a></li>
            </ul>
          </li>

          <li class="treeview">
            <a href="#">
              <i class="fa fa-shopping-cart"></i> <span>Ventas</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo RUTA_URL?>/public/ventas/agregar"><i class="fa fa-circle-o"></i>Agregar venta</a></li>
              <li><a href="<?php echo RUTA_URL?>/public/ventas/"><i class="fa fa-tags"></i> Ver ventas</a></li>
            </ul>
          </li>
        <?php endif ?>
      </ul>


    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
