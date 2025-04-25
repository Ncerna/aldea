<?php
session_start();
if(isset($_SESSION['S_IDUSUARIO'])){
  header('Location: ../vista/home.php');
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link href="../plantilla/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title> SAEP | Login</title>
  </head>
  <style>
.swal2-popup{
  font-size:0.7rem !important;
}
#namesistem{
  font-size: 10px;
}
#body_fonnd:before {
    content: '';
    position: fixed;
    width: 100vw;
    height: 100vh;
    /*background-image: url(https://i.postimg.cc/8cf6v1rk/1.jpg);*/
  background-image: url('vendor/imglogin/imagen5.png');
    background-position: center center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    -webkit-background-size: cover;
    filter: blur(3px);
}

</style>
  <body id="body_fonnd">
  
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
       
      </div>
      <div class="login-box" style="border-radius: 10px">
        <form class="login-form" autocomplete="false" onsubmit="VerificarUsuario(this); return false;">
          <h3 class="login-head">
            <img src="vendor/default.png" style="width: 50px;height:50px;">
            <p id="namesistem" class="semibold-text mb-2">Sistema de gestion escolar</p></h3>
            
          <div class="form-group">
             <div class="loader" style="display: none; text-align: center;" >
                <img alt="" src="vendor/abc.gif" style="width: 50px;height:50px;">
              </img>
            </div>
            <div class="alert alert-danger sm" id="pass_incorecto" role="alert" style="display: none">
              <strong id="mensajes_aviso" style="font-size: x-small">
              </strong>
            </div>

            <label class="control-label">USERNAME</label>
            <input  class="form-control" autocomplete="false"  id="txt_usuario"  onkeypress="return (event.charCode > 63 &&   event.charCode < 91) ||
            (event. charCode > 96 && event.charCode < 123)||(event. charCode >47 && event.charCode<58)||(event. charCode>44 && event. charCode<47)||(event. charCode==95)" placeholder="Usuario" required="" type="text" value="">
          </div>
          <div class="form-group">
            <label class="control-label">PASSWORD</label>
           <input  class="form-control" id="txt_contracena" name="contra" onkeypress="return (event.charCode > 63 &&   event.charCode < 91) ||
              (event. charCode > 96 && event.charCode < 123)||(event. charCode >34 && event.charCode<39)||(event. charCode>47 && event. charCode<58)||(event. charCode==42)" placeholder="password" required="" type="password" value="">
          </div>
          <input hidden="" id="tokenSHA256" name="" style="display: none" type="text">
          <div class="form-group">
            <div class="utility">
              <div class="animated-checkbox">
                <label>
                  <input type="checkbox"><span class="label-text">Recordarme</span>
                </label>
              </div>
             
            </div>
          </div>
          <div class="form-group btn-container">
            <button  id="input-login" class="btn btn-primary btn-block" type="submit"><i  class="fa fa-sign-out" aria-hidden="true"></i>Ingresar</button>

            
          </div>
        </form>
       
      </div>
    </section>
    <!-- Essential javascripts for application to work-->
    <script src="vendor/jquery/jquery-3.2.1.min.js">
    </script>
    <script src="../js/usuario.js">
    </script>
    <script>
  $(document).ready(function() {
    
    generateToken();

  } );

  function generateToken() {
    var pass = '';
    var str = 'AB$CD"#&[EF?GHI$y$J/KLMñNO8PQRSTUVWXYZ' + 
    'ab4cde/fghijklmn4opqrstu4vwxyz0123456789@#$';
    for (i = 1; i <= 96; i++) {
      var char = Math.floor(Math.random()* str.length + 1);
      pass += str.charAt(char);
    }
    $("#tokenSHA256").val(pass);
  }
</script>

  
  </body>
</html>
