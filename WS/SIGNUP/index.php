<?php
    require_once("../../DB/dbcon.php");

    $distname=false;
    $emailid=false;
    $tsm=false;
    $asm=false;
    $routesales=false;
    $password=false;
    $address=false;
   
    //$phonenum=false;

    
if(isset($_GET['submit'])){
    if(isset($_GET['distname'])){
        $distname=$_GET['distname'];
    }
    // if(isset($_GET['phonenum'])){
    //    $phonenum=$_GET['phonenum'];
   // }

    if(isset($_GET['emailid'])){
        $emailid=$_GET['emailid'];
    }

    if(isset($_GET['tsm'])){
        $tsm=$_GET['tsm'];
    }

    if(isset($_GET['routesales'])){
        $routesales=$_GET['routesales'];
    }   

    if(isset($_GET['username'])){
        $username=$_GET['username'];
    }

    if(isset($_GET['password'])){
        $password=$_GET['password'];
    }

if(isset($_GET['address'])){
        $address=$_GET['address'];
    }
    if(isset($_GET['area'])){
        $area=$_GET['area'];
    }

    if(isset($_GET['province'])){
        $province=$_GET['province'];
    }




    //$q="WITHDRAWAL~POST~".$emailId."~".$wrid."~".$jobberId."~".$skulist."~".$remark;
    $q="SIGNUP~CREATEACCOUNT~".$distname."~".$emailid."~".$address."~".$routesales."~".$password;

    header("Location: ../SIGNUP/PROCEDURE/?msg=".$q);
}
?>


<html>

	<!--Css Styles-->
	<style>
	.divider-text {
    position: relative;
    text-align: center;
    margin-top: 15px;
    margin-bottom: 15px;
}
.divider-text span {
    padding: 7px;
    font-size: 12px;
    position: relative;   
    z-index: 2;
}
.divider-text:after {
    content: "";
    position: absolute;
    width: 100%;
    border-bottom: 1px solid #ddd;
    top: 55%;
    left: 0;
    z-index: 1;
}

.btn-facebook {
    background-color: #405D9D;
    color: #fff;
}
.btn-twitter {
    background-color: #42AEEC;
    color: #fff;
}
	</style>
	<!--CSS Style-->
<body style="background-color: lightgrey">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">


<div class="container" >
<br>





<div class="card bg-light">
<article class="card-body mx-auto" style="max-width: 400px;">
	<h4 class="card-title mt-3 text-center">Create Account</h4>
	<!--
	<p>
		<a href="" class="btn btn-block btn-twitter"> <i class="fab fa-twitter"></i>   Login via Twitter</a>
		<a href="" class="btn btn-block btn-facebook"> <i class="fab fa-facebook-f"></i>   Login via facebook</a>
	</p>
-->
	<p class="divider-text">
        <span class="bg-light"></span>
    </p>
	<form method='GET' Action='?'>
	<div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
		 </div>
       <!-- <input name="distname" id="distname" class="form-control" placeholder="Distributor Name" type="text">
       --> <select type="select" name="distname" id="distname"  class="form-control" required>
       <option value="" active>--Select Distributor--</option>
      <?php
            $strType="";
                                              include("../../DB/dbcon.php");
                                              $sqlType="Select DistributorName from DSRDistributor order by DistributorName ASC ";
                                              echo $sqlType;
                                              //and bu='".$BusinessUnit."'
                                              $stmtType=sqlsrv_query($con,$sqlType);
                                              while($rowType=sqlsrv_fetch_array($stmtType,SQLSRV_FETCH_ASSOC)){
                                                    $strType.="<option>".$rowType['DistributorName']. "</option>";
                                              }

                                              echo $strType;
                                            ?>
        </select>
    </div> <!-- form-group// -->
    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-home"></i> </span>
         </div>
        <input name="routesales" id="routesales" class="form-control" placeholder="Route Sales" type="" required>
    </div>
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
		 </div>
        <input name="emailid" id="emailid" class="form-control" placeholder="Email address" type="email" required>
    </div> <!-- form-group// -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
		</div><!--
		<select class="custom-select" style="max-width: 120px;">
		    <option selected="">+63</option>
		    <option value="1">+972</option>
		    <option value="2">+198</option>
		    <option value="3">+701</option>
		</select>-->
    	<input name="phonenum"  id="phonenum" class="form-control" placeholder="Phone number" type="text" required>
    </div> <!-- form-group// 
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-building"></i> </span>
		</div>
		<select class="form-control">
			<option selected=""> Select job type</option>
			<option>Designer</option>
			<option>Manager</option>
			<option>Accaunting</option>
		</select>
	</div> <!-- form-group end.// 

<div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
		 </div>
        <input name="tsm" id="tsm" class="form-control" placeholder="TSM Name" type="">
    </div> <!-- form-group// 

    <div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
		 </div>
        <input name="asm" id="asm" class="form-control" placeholder="ASM Name" type="">
    </div> form-group// -->

<div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-home"></i> </span>
         </div>
        <input name="address" id="address" class="form-control" placeholder="Address" type="" required>
    </div>
<!-- 
    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-home"></i> </span>
         </div>
        <input name="province" id="province" class="form-control" placeholder="Province" type="">
    </div>

 <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-home"></i> </span>
         </div>
        <input name="area" id="area" class="form-control" placeholder="Area" type="">
    </div>


<div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
		 </div>
        <input name="username" id="username" class="form-control" placeholder="Username" type="">
    </div> form-group// 

	<div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
		 </div>
        <input name="" class="form-control" placeholder="Username" type="">
    </div> <!-- form-group// .......-->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		</div>

        <input name="password" id="password"  class="form-control" placeholder="Create password" type="password">
    </div> <!-- form-group// 
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		</div>
        <input class="form-control" placeholder="Repeat password" type="password">
    </div> <!-- form-group// -->                                      
    <div class="form-group">
        <button type="submit" name="submit" id="submit" class="btn btn-primary btn-block"> Create Account  </button>
    </div> <!-- form-group// -->    

</form>
</article>
</div> <!-- card.// -->

</div> 
<!--container end.//-->

<br><br>
<article class="bg-secondary mb-3">  
<div class="card-body text-center">
    <h7 class="text-white mt-3">Programmed by: John Albert Asonza</h7>
</div>
<br><br>
</article>
</body>
</html>