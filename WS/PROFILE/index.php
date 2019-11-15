<?php
  if(session_status() != PHP_SESSION_ACTIVE) {
      session_start();
  }
  include("Header.php");
  $Distributor=$_SESSION['Distributor']; // THIS IS THE FIELD OF BDM NAME
    $Username=$_SESSION['Username'];
    $Name=$_SESSION['Name'];
 $JobberId=$_SESSION['DistID'];
     $usertype=$_SESSION['UserType'];
  
 //include ('Db/config.php');
  $sqlAccount="select Name,UserType,Password,Distributor from dsrusers where Distributor='".$Distributor."'";
  $stmt=sqlsrv_query($link,$sqlAccount);

  while($row=sqlsrv_Fetch_Array($stmt,SQLSRV_FETCH_ASSOC)){
  $strName=$row['Name'];
    $strUserType=$row['UserType'];
    $strPassword=$row['Password'];
  //  $strUserImage=$row['USERIMAGE'];
    
  }
/*
  if($strUserImage==""){
    $strUserImage="BlackUser.png";
  }
**/
?>

          
<!DOCTYPE html>
<html>
  <head>
      <link rel="shortcut icon" type="image/png" href="images/CPG Logo.png"/>
      <?php include("linkPage.php");?>
  </head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a  class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>PROJECT PUSH </b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>PUSH</b> System</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel 
         
    </section>
    <!-- /.sidebar -->
  </aside>

 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>USER PROFILE</h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-5">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
            <!--  <img class="profile-user-img img-responsive img-circle"  src="<?php echo "images/".$strUserImage.""; ?>" alt="User profile picture">
-->

              <h3 class="profile-username text-center"><?php echo $Distributor?></h3>

              <p class="text-muted text-center"><?php echo $Username?></p>

              <strong><i class="fa fa-book margin-r-5"></i> <?php echo $strPassword?>></strong> 
              <?php
                $CountPassword=strlen($strPassword);
                $strHolderPassword="";

                for($Counter=1;$Counter<=$CountPassword;$Counter++){
                  $strHolderPassword.="*";
                }

                
                echo "<h2>".$strHolderPassword."</h2>";
              ?>
              
            </div>
            <!-- /.box-body -->
          </div>
        
        </div>
        <!-- /.col -->
        <div class="col-md-7">
          <div class="box box-primary">

            <form class="form-horizontal" action='function/SaveProfile.php' method="post" onsubmit="return myFunction()" enctype="multipart/form-data">
                <div class="col-md-12">
                    <div class="box-header with-border">
                        <i class="fa fa-book"></i>
                        <h3 class="box-title">Selected Details</h3>
                    </div>
                    <br><br>
                    <!-- TYPE FIELD -->
                     <div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label">Password :</label>

                         <div class="col-sm-7">
                            <input required type="hidden" class="form-control" id="Userid" name="Userid" value="<?php echo $Name ?>">
                            <input required type="password" class="form-control" id="pass1" name="pass1" placeholder="Input Password" value="">
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="inputPassword3" class="col-sm-3 control-label">Re-Type Password :</label>

                         <div class="col-sm-7">
                            <input required type="password" class="form-control" id="pass2" name="pass2" placeholder="Input Re-type Password" value="">
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="inputPassword3" class="col-sm-3 control-label">New Password :</label>

                         <div class="col-sm-7">
                            <input required type="password" class="form-control" id="NewPass" name="NewPass" placeholder="Input new Password" value="">
                          </div>
                      </div>


                      <div class="form-group">
                          <label for="inputPassword3" class="col-sm-3 control-label">Image :</label>

                         <div class="col-sm-7">
                            <input NAME="FileImg"  accept="image/*" type="file">
                          </div>
                      </div>
                </div>

                <div class="box-footer">
                  <input type="submit" value="Submit" class="btn btn-info">
                  <a href='index.PHP'>
                    <button type="button" class="btn btn-info">Cancel</button>
                  </a>
                </div>
              
            </form>
           </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>



<?php  //THIS IS FOOTER---------------------------------------------------------------------- ?>

  
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>

<script>
  function myFunction() {
      var pass1 = document.getElementById("pass1").value;
      var pass2 = document.getElementById("pass2").value;

      var ok = true;
      if (pass1 != pass2) {
          //alert("Passwords Do not match");
          document.getElementById("pass1").style.borderColor = "#E34234";
          document.getElementById("pass2").style.borderColor = "#E34234";
          alert("Password Mismatch");
          ok = false;
      }
      return ok;
  }
  
</script>

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes --> 
<script src="dist/js/demo.js"></script>



</body>
</html>

