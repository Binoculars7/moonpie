<?php require_once "../controllerUserData.php"; ?>
<?php 

$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM usertable WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        if($status == "verified"){
            if($code != 0){
                header('Location: reset-code.php');
            }
        }else{
            header('Location: ../user-otp.php');
        }
    }
}else{
    header('Location: ../login-user.php');
}
?>




<?php


if($email != false && $password != false){


$sqlk = "SELECT * FROM successpayment WHERE EMAIL = '$email'";
$run_Sqlk = mysqli_query($con, $sqlk);
if($run_Sqlk){
    $fetch_infok = mysqli_fetch_assoc($run_Sqlk);
    $statuss = isset($fetch_infok['STATUS']);
    $emaill = isset($fetch_infok['EMAIL']);

    if ($statuss != 'paid') {
        echo "<script>window.location='../home/pricing.php';</script>";
    }else{
        //echo "<script>window.location='pricing.php';</script>";
    }

}else{
 // echo "<script>window.location='pricing.php';</script>";
}


}
?>









<!DOCTYPE html>
<!--=== Coding by CodingLab | www.codinglabweb.com === -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="style.css">
     
    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="icon"  type="image/png" href="moonpie_icon.PNG">

    <title>Moonpie - Referral</title> 
</head>
<body>
    <nav>
        <div class="logo-name">
            
                
    

            <span class="logo_name"><i class='fa fa-pie-chart' style='color:#6665ee;'></i> <small>Moonpie</small></span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="index.php">
                    <i class="uil uil-estate"></i>
                    <span class="link-name">Dashboard</span>
                </a></li>
                <li><a href="refer.php">
                    <i class="uil uil-share"></i>
                    <span class="link-name">Refer a friend</span>
                </a></li>
                <li><a href="withdraw.php">
                    <i class="uil uil-coins"></i>
                    <span class="link-name">Withdraw</span>
                </a></li>
            </ul>
            
            <ul class="logout-mode">

                <li><a href="#">
                <i class="uil uil-user"></i>
                    <span class="link-name" style='font-size:13px;'>
                   <?php echo $fetch_info['name'] ?>
                    </span>
                </a></li>
            
                <li><a href="../logout-user.php">
                    <i class="uil uil-signout"></i>
                    <span class="link-name">Logout</span>
                </a></li>

                <li class="mode">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                    <span class="link-name">Dark Mode</span>
                </a>

                <div class="mode-toggle">
                  <span class="switch"></span>
                </div>
            </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>

           
            <img src="images/profile.jpg" alt="">
        </div>

        <div class="dash-content" style="margin-top: -3em;">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Refer a friend</span>
                </div>

                <div class="boxes" style="margin-top:-1.1em;">
                    <div class="box box1">
                        <i class="uil uil-diamond"></i>
                        <span class="text" id="rstatus" style="display:none;">Referral Status</span>
                        <span class="number"><p id="codeshow" style="display:none;"><small>Referred <i class="uil uil-check" style="font-size:20px;  color:green; background:white; border-radius:50px; padding:0 0.2em;"></i></small></p>
                            <form method="post">
                                <div id="codehide" style="margin-top:-0.5em;">
                                    
                                    <input id = "codehide" name="code" type="text" required placeholder="Referral Code" style="padding-left:1em; height:3em; width:200px; border-radius:5px; border:none; box-shadow:0 1px 3px black;">
                                </div>
                                <div style="margin-top:-0.3em;" id="codehides">
                                    <input id="codehides" name="submit" type="submit" style="background:#6665ee; color:white; height:3em; width:200px; border-radius:5px; border:none; box-shadow:0 0px 3px black;">
                                </div> 
                                
                                
                            </form>
                            
 <?php

if (isset($_POST['submit'])) {
    $refid = $_POST['code'];
    $dater = date('Y-m-d');

    //$refidset = isset($_POST['submit']);


    $sqlk = "SELECT * FROM myrefcode where REFID = '$refid'";
    $run_Sqlk = mysqli_query($con, $sqlk);

    if($fetch_infok = mysqli_fetch_assoc($run_Sqlk)){
        $refidk = $fetch_infok['REFID'];
        if ($refidk == $refid) {
        $sqll = "INSERT INTO `referby`(`EMAIL`, `REFID`, `DATER`) VALUES ('$email','$refid','$dater')";
        $query = mysqli_query($con, $sqll);
        }else{
            echo "<script>alert('Invalid Referral Code');</script>";
        }

    }

    

// VF59977766;
    
}

$sqlkk = "SELECT * FROM referby WHERE EMAIL = '$email'";
$run_Sqlkk = mysqli_query($con, $sqlkk);


while($fetch_infokk = mysqli_fetch_assoc($run_Sqlkk)){
        $refidkk = $fetch_infokk['REFID'];
        if ($refidkk != "") {
            echo "<script>document.getElementById('codehide').style.display = 'none';</script>";
            echo "<script>document.getElementById('codehides').style.display = 'none';</script>";
            echo "<script>document.getElementById('codeshow').style.display = 'block';</script>";
            echo "<script>document.getElementById('rstatus').style.display = 'block';</script>";
            
        }else{

        }
    }








?>


                        </span>
                    </div>
                    <div class="box box2">
                        <i class="uil uil-copy"></i>
                        <span class="text">My Referral Code</span>
                        <span class="number" id="noted">
                            
               
                        
        <?php 
        
        
        $sqlkk = "SELECT * FROM myrefcode WHERE EMAIL = '$email'";
$run_Sqlkk = mysqli_query($con, $sqlkk);


while($fetch_infokk = mysqli_fetch_assoc($run_Sqlkk)){
        $refidkk = $fetch_infokk['REFID'];
        if ($refidkk != "") {
            echo $refidkk;
            
        }else{

        }
    }
        
        
        
        
        ?>
               
               
                        
                </span>
                    </div>
                    <div class="box box3">
                        <i class="uil uil-user"></i>
                        <span class="text">Total Referred</span>
                        <span class="number" id="noteds">
                            

                        <?php 

$sqln = "SELECT EMAIL, REFID,  DATER FROM myrefcode WHERE EMAIL = '$email'";
$run_Sqln = mysqli_query($con, $sqln);

$fetch_infon = mysqli_fetch_assoc($run_Sqln);
$refidn = $fetch_infon['REFID'];

        
$sqlkk = "SELECT EMAIL, REFID, count(REFID) as totalref, DATER FROM referby WHERE REFID = '$refidn'";
$run_Sqlkk = mysqli_query($con, $sqlkk);


while($fetch_infokk = mysqli_fetch_assoc($run_Sqlkk)){
        $refidkk = $fetch_infokk['totalref'];

        echo $refidkk;
        
    }
        
        
        
        
        ?>
              




                        </span>
                    </div>
                </div>
            </div>


            <div class="overview" style="margin-top: -2em;">
                <div class="title" style="margin-bottom:0.8em;">
                    <i class="uil uil-star"></i>
                    <span class="text">Sectors</span>
                </div>

                <div class="boxes">
                    <div class="box box1" style="background:url('Images/web33.png'); background-position:center; background-size:120%; opacity:0.8; box-shadow:0 0 2px grey;">
                        <span class="number" style="color:white; text-shadow:2px 5px black; padding:1.2em 0;"><small>Technology</small></span>
                    </div>
                    <div class="box box2" style="background:url('Images/cocoa.jpg'); background-position:center; background-size:120%; opacity:0.8; box-shadow:0 0 2px grey;">
                        <span class="number" style="color:#ffe6ac; text-shadow:2px 4px black; padding:1.2em 0;"><small>Agriculture</small></span>
                    </div>
                    
                    <div class="box box3" style="background:url('Images/business.jpg'); background-position:center; background-size:120%; opacity:0.8; box-shadow:0 0 2px grey;">
                        <span class="number" style="color:#e7d1fc; text-shadow:2px 4px black; padding:1.2em 0;"><small>Business</small></span>
                    </div>
                </div>
            </div>
            

           
        </div>
    </section>

    <script src="script.js"></script>
</body>
</html>