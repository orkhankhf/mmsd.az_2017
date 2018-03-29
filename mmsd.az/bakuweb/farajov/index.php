<?php
  session_start();
  if(isset($_SESSION["login_fv26d5s1s8w92dfc"]) && isset($_SESSION["password_df165w6f1d5f94fq"])){
    unset($_SESSION["login_fv26d5s1s8w92dfc"]);
    unset($_SESSION["password_df165w6f1d5f94fq"]);
  }
  if(isset($_SESSION['rutbe'])){
    unset($_SESSION['rutbe']);
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Adminpanel - Giriş</title>
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="assets/styles.css" rel="stylesheet" media="screen">
    <link href="assets/native.css" rel="stylesheet" media="screen">
    <script src="vendors/jquery-1.9.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  </head>
  <body id="login">
    <div class="container">
      <form class="form-signin" action="connection.php" method="POST">
        <h2 class="form-signin-heading login_header">Adminpanel</h2>
        <input type="text" class="input-block-level" name="login" placeholder="Login" required="">
        <input type="password" class="input-block-level" name="password" placeholder="Şifrə" required="">
        <!-- <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label> -->
        <button class="btn btn-large btn-primary" type="submit">Daxil ol</button>
      </form>
    </div> <!-- /container -->
  </body>
</html>