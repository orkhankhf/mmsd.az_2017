<!DOCTYPE html>
<html>
  <head>
    <title>Adminpanel - Şifrə Təyin Et</title>
    <!-- Bootstrap -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="../bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="../assets/styles.css" rel="stylesheet" media="screen">
    <link href="../assets/native.css" rel="stylesheet" media="screen">
    <script src="../vendors/jquery-1.9.1.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <style type="text/css">
    	.btn-primary{
    		width: 100% !important;
    	}
    </style>
  </head>
  <body id="login">
    <div class="container">
      <form class="form-signin" action="set_new_password_for_editor.php" method="POST">
        <h2 class="form-signin-heading login_header">Yeni Redaktor</h2>
        <input type="text" class="input-block-level" name="login" maxlength="25" placeholder="Login (max. 25)" required="">
        <input type="password" class="input-block-level pass1" name="password" maxlength="25" placeholder="Şifrə (max. 25)" required="">
        <input type="password" class="input-block-level pass2" placeholder="Şifrə təkrarı (max. 25)" maxlength="25" required="">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <p>Qeyd: Siz birdəfəlik şifrə ilə daxil oldunuz. Zəhmət olmasa, hərf və rəqəmlərdən ibarət yeni login və şifrə təyin edin. Bu məlumatları yalnız siz biləcəksiniz və Adminpanel'dən daima bu login və şifrə ilə daxil olacaqsınız.</p>
        <!-- <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label> -->
        <button class="btn btn-large btn-primary" type="submit" name="submit">Məlumatları Yenilə Və Daxil ol</button>
      </form>
      <script type="text/javascript">
        $(".form-signin").submit(function(){
          var pass1 = $(".pass1").val();
          var pass2 = $(".pass2").val();
          if(pass1 != pass2){
            alert("Şifrələr eyni deyil!");
            return false;
          }
        })
      </script>
    </div> <!-- /container -->
  </body>
</html>