
<?php 

  if(session_status() != PHP_SESSION_ACTIVE) {
      session_start();
  }

  $Distributor=$_SESSION['Distributor']; // THIS IS THE FIELD OF BDM NAME
    $Username=$_SESSION['Username'];
    $Name=$_SESSION['Name'];
 $JobberId=$_SESSION['DistID'];
     $usertype=$_SESSION['UserType'];
  ?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
 <?php include("../config.php");?>
      <?php include("linkPage.php");?>
     
<nav class="navbar navbar-expand-sm navbar-static-top navbar-light bg-info text-white shadow-lg" style="color:white;height:20px">
  <a class="nav-item text-white "  href="#" style="padding:0px"> <img src="/WS/assets/CPG Logo.png" style="width:40px;height:40px" alt="CENTURY LOGo"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse " id="navbarNavAltMarkup">
    <div class="navbar-nav">
     <li class="nav-item"> <a class=" nav-link active text-white" href="/WS/DASHBOARD/">Home <span class="sr-only">(current)</span></a></li>
      <li class="nav-item"> <a class="nav-link text-white" href="/WS/Customers/">Customer</a></li>
      <li class="nav-item"> <a class=" nav-link text-white" href="/WS/Products/">Product</a></li>
           
      
      <li class="nav-item"> <a class=" nav-link text-white" href="/WS/Jobbers/">Distributor</a></li>
       <!--
<li class="nav-item"> <a class="nav-link text-white" href="/WS/Discount/">Discount</a></li>
       <li class="nav-item"><a class=" nav-link text-white" href="/WS/Payment/">Payment</a></li>-->
       <li class="nav-item"><a class=" nav-link text-white" href="/WS/users/">Users</a></li>

      <!-- <div class="dropdown " >-->
        <li class="nav-item dropdown"> 
        <a href="#" class="dropdown-toggle nav-link text-white" data-toggle="dropdown">Reports</a>
        <div class="dropdown-menu">
            <a href="/WS/WITHDRAWAL/PARSE" class="dropdown-item">Withdrawal</a>
            <a href="/WS/WITHDRAWAL/" class="dropdown-item">Sales</a>
        </div>
      </li>
    
    
        <li class="nav-item"><a class=" nav-link text-white" href="http://dev.push.cpfiportal.com/WS/Logout.php/">Logout</a></li>
        <li class="nav-item " ><a class="nav-link text-white " style="float:right"><?php echo $Name;?></a></li>
    </div>
  </div>
</nav>

</head>


</html>