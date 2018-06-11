<?php
  //Se valida si hay una sesión iniciada
  if(home::sesionIniciada()){
    header("Location: " . RUTA_URL . "/public/home/index"); //Si la hay manda al inicio
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Inventario | Iniciar sesión</title>
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
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo RUTA_URL?>/public/plugins/iCheck/square/blue.css">

  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <!-- Estilos para el sweet alert -->
  <style media="screen">
  .swal-button {
    padding: 7px 19px;
    border-radius: 2px;
    background-color: #605ca8;
    font-size: 12px;
    border: 1px solid #3e549a;
    text-shadow: 0px -1px 0px rgba(0, 0, 0, 0.3);
  }

  .swal-footer {
    background-color: rgb(221, 220, 246);
    margin-top: 32px;
    border-top: 1px solid #E9EEF1;
    overflow: hidden;
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
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <img src="<?php echo RUTA_URL?>/public/dist/img/logo.png" width="250px" height="250px" style="margin-bottom: -70px;">
    <a href="../../index2.html"><b>Inventario</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Iniciar sesión</p>

    <form id="formulario" action="<?php echo RUTA_URL?>/public/home/login" method="post">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" name="usuario" id="usuario" placeholder="Usuario">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="clave" id="clave" placeholder="Contraseña">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <!-- Si se pasó el parametro "mal" se imprime un mensaje de usuario o contraseña incorrectos -->
      <?php if($data == "mal"): ?>
        <div class="form-group has-feedback">
          <p style="color: red;">Usuario o contraseña incorrectos</p>
        </div>
      <?php endif ?>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-5 pull-right">
          <button type="submit" class="btn btn-primary btn-block btn-flat" style="background-color: #605ca8 !important" onclick="validar();">Iniciar sesión</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?php echo RUTA_URL?>/public/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo RUTA_URL?>/public/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo RUTA_URL?>/public/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });

  formulario = document.getElementById("formulario"); //Se obtiene el formulario

      function validar(){
        event.preventDefault(); //Se aborta el evento submit del formulario
        llenos = 0; //Variable para contar los campos llenados

        //Se comprueba cada campo para ver si se escribió algo
        if(formulario.usuario.value != 0){
          llenos++;
        }

        if(formulario.clave.value != 0){
          llenos++;
        }

        //Si no todos los campos están llenos...
        if(llenos < 2){
          //...se mostrará una alerta diciéndolo
          swal({
            text: "Debes llenar todos los campos",
            button: "Aceptar"
          });
        }else{
          formulario.submit(); //...se ejecuta el evento submit del formulario
        }
      }
</script>
</body>
</html>
