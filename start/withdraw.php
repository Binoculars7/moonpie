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

    <title>Moonpie - Withdrawal</title> 
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
                    <span class="text">Withdraw</span>
                </div>

                <div class="boxes" style="margin-top:-1.1em;">
                    <div class="box box1" style="background:#768991;">
                        <i class="uil uil-book" style="background:#0b0b0b; color:white; padding:0 0.25em; border-radius:50px; font-size:25px; margin-bottom:0.3em;"></i>
                        <span class="text" id="rstatus" style="display:none;">Referral Status</span>
                        <span class="number"><p id="codeshow" style="display:none;"><small>Referred <i class="uil uil-check" style="font-size:20px;  color:green; background:white; border-radius:50px; padding:0 0.2em;"></i></small></p>
                            <form method="post">
                                <div id="codehide" style="margin-top:-0.5em;">
                                    
                                    <input id = "codehide" name="aname" type="text" required placeholder="Account Name" style="padding-left:1em; height:3em; width:200px; border-radius:5px; border:none; box-shadow:0 0px 1px black;">
                                </div>
                                <div id="codehide" style="margin-top:-0.3em;">
                                    
                                    <input id = "codehide" name="anum" type="text" required placeholder="Account Number" style="padding-left:1em; height:3em; width:200px; border-radius:5px; border:none; box-shadow:0 0px 1px black;">
                                </div>
                                <div id="codehide" style="margin-top:-0.3em;">
                                    
                                    <input id = "codehide" name="bname" type="text" required placeholder="Bank Name" style="padding-left:1em; height:3em; width:200px; border-radius:5px; border:none; box-shadow:0 0px 1px black;">
                                </div>
                                <div style="margin-top:-0.3em;" id="codehides">
                                    <input id="codehides" value="Update Bank Info" name="submit" type="submit" style="background:#0b0b0b; color:white; height:3em; width:200px; border-radius:5px; border:none; box-shadow:0 0px 1px black; cursor:pointer;">
                                </div> 
                                
                                
                            </form>
                            
 <?php

if (isset($_POST['submit'])) {
    $aname = $_POST['aname'];
    $anum = $_POST['anum'];
    $bname = $_POST['bname'];
    $dater = date('Y-m-d');


    $sqlup = "UPDATE `bankinfo` SET `ACCNAME`='$aname',`ACCNUM`='$anum',`BANKNAME`='$bname',`DATER`='$dater' WHERE `EMAIL` = '$email'";
    $query = mysqli_query($con, $sqlup);

    echo "<script>alert('Bank Info Updated');</script>";
        

    }

    

// VF59977766;





?>


                        </span>
                    </div>
                    <div class="box box2" style="padding:3.6em 0;">
                        <i class="uil uil-check" style="background:green; color:white; padding:0 0.25em; border-radius:50px; font-size:25px; margin-top:0.3em; margin-bottom:0.3em;"></i>
                        <span class="text">My Bank Info</span>
                        <span class="number" id="noted">
                            
               
                        
        <?php 
        
        
        $sqlkk = "SELECT * FROM bankinfo WHERE EMAIL = '$email'";
        $run_Sqlkk = mysqli_query($con, $sqlkk);


while($fetch_infokk = mysqli_fetch_assoc($run_Sqlkk)){
        $aname = $fetch_infokk['ACCNAME'];
        $anum = $fetch_infokk['ACCNUM'];
        $bname = $fetch_infokk['BANKNAME'];

        if ($aname == '0') {
            $aname = 'Account Name';
        }
        if ($anum == '0') {
            $anum = 'Account Number';   
        }
        if ($bname == '0') {
            $bname = 'Bank Name';
        }
        echo '<small>';
        echo '<div style="text-align:center; font-size:22px; font-weight:bold; text-transform:capitalize;"><small>'.$aname.'</small></div>';  

        echo '<div style="font-size:17px; margin-top:-0.5em; text-align:center; font-weight:bold;">'.$anum.'</div>';    
        
        echo '<div style="font-size:13px; margin-top:-0.5em; text-align:center; text-transform:capitalize;">'.$bname.'</div>';  
        echo '</small>';   
    }
        
        
        
        
        ?>
               
               
                        
                </span>
                    </div>
                    <div class="box box3"  style="padding:2.7em 0;">
                    <i class="uil uil-check" style="background:blue; color:white; padding:0 0.25em; border-radius:50px; font-size:25px; margin-top:0.3em; margin-bottom:0.3em;"></i>
                        <span class="text">Next Withdrawal</span>
                        <span class="number" id="noteds">
                            


            <script>

            // Get current date
const now = new Date();

// Get the current year and month
const year = now.getFullYear();
const month = now.getMonth();

// Get the last day of the current month
const lastDayOfMonth = new Date(year, month + 1, 0, 23, 59, 59);

// Function to calculate the remaining time
function countdown() {
    const now = new Date();
    const remainingTime = lastDayOfMonth - now;

    if (remainingTime <= 0) {
        clearInterval(interval);
        console.log("The month has ended.");
        return;
    }

    // Calculate days, hours, minutes, and seconds
    const days = Math.floor(remainingTime / (1000 * 60 * 60 * 24));
    const hours = Math.floor((remainingTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);

    // Display the countdown
    document.getElementById("countdown").innerText = `${days}d ${hours}h ${minutes}m ${seconds}s`;

}

// Run countdown every second
const interval = setInterval(countdown, 1000);


            </script>
            <div id="countdown" style="font-size:28px; text-align:center;"></div>
                        <?php 
        
        
        $sqlkk = "SELECT * FROM bankinfo WHERE EMAIL = '$email'";
        $run_Sqlkk = mysqli_query($con, $sqlkk);


while($fetch_infokk = mysqli_fetch_assoc($run_Sqlkk)){
        $aname = $fetch_infokk['ACCNAME'];
        $anum = $fetch_infokk['ACCNUM'];
        $bname = $fetch_infokk['BANKNAME'];

 
    }
        
        ?>

            <div style="margin-top:-0.3em; text-align:center;" id="codehides">
                <input id="codehides" value="Make Request" name="submit" type="submit" style="color:grey; height:3em; width:200px; border-radius:5px; border:none; box-shadow:0 0px 1px black; cursor:pointer;">
            </div> 

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