<?php
   include("../DB/dbcon.php");
      


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>
Project PUSH</title>
<link rel="shortcut icon" type="image/png" href="images/CPG Logo.png"/>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="WS/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
 
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page" style="background-color:lightgrey">

  <!-- /.login-logo -->
  <div class="login-box-body">
  
<center>
 
   
    <form method="POST" action="authenticator.php" id="login" name="frmLogin"  role="form" style="background-color:white;width:400px;height:350px;margin-top:20px;padding-bottom:50px">
      <div class="login-box">
  <div class="login-logo">
 
  
  </div><br>
    <img src="images/CPG Logo.png" style="width:50px;height:50px" alt="CENTURY LOGo"><br>
    <b>Project Push</b><br><br>
      <div class="form-group has-feedback">
        <input type="text" name="Username" id="Username" class="form-control" placeholder="Username" style="width:300px" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input  type="Password" name="Password" id="Password" class="form-control" placeholder="********" style="width:300px" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
    
        <!-- /.col -->
        <div class=" form-group col-xs-6 ">
          <button type="submit" class="btn btn-danger btn-block btn-flat form-control" style="width:300px">Sign In</button>
        </div></div>
        <!-- /.col -->
      </div>
    </form>
</center>
   <!--
    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div>
    /.social-auth-links -->

    <!--
    <a href="#">I forgot my password</a><br>
    <a href="register.html" class="text-center">Register a new membership</a>
    -->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->


</body>
<style type="text/css">
p{
  font-size: 7pt;
  color:black;
  text-align: center;
 
}

.footer {
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
  
   text-align: center;
}

</style>
<div class="footer"><p>CPFI 2019<Br>Powered by<br>John Albert Asonza</p></div>
 
</html>
