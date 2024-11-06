<?php require_once "../controllerUserData.php"; ?>
<?php 
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM usertable WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $name = $fetch_info['name'];
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        if($status == "verified"){
            if($code != 0){
                header('Location: ../reset-code.php');
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
$amt = "";
$sqlk = "SELECT * FROM successpayment WHERE email = '$email'";
$run_Sqlk = mysqli_query($con, $sqlk);
if($run_Sqlk){
    $fetch_infok = mysqli_fetch_assoc($run_Sqlk);
    $statuss = isset($fetch_infok['STATUS']);
    $emaill = isset($fetch_infok['EMAIL']);

    if ($statuss == 'paid') {
        echo "<script>window.location='../start/';</script>";
    }else{
        if (isset($_GET['paystatus'])) {

            $paystatus = $_GET['paystatus'];
            if ($paystatus == 'onepay') {
                $amt = 1000;
            }elseif($paystatus == 'twopay'){
                $amt = 5000;
            }elseif($paystatus == 'threepay'){
                $amt = 10000;
            }
            else{
                $amt = '';
            }

        }else{
                echo "<script>window.location='pricing.php';</script>";
                //echo "http://localhost/moonpie/home/creditor.php?paystatus=onepay";
        }


            
            $email = $_SESSION['email'];
            
            $new_status = 'paid';
            $date = date('Y-m-d');

            $timestamp = time();
            $timestamper = $timestamp;
            
            if ($amt == '') {
                echo "<script>window.location='pricing.php';</script>";
            }else{
                $refidx = rand(4567, 99987);
                $refidy = rand(45, 989);
                $refid = 'VF'.$refidx.$refidy;

                $sqll = "INSERT INTO `successpayment`(`EMAIL`, `AMT`, `STATUS`, `DATE`, `timestamper`) VALUES ('$email','$amt','$new_status','$date', '$timestamper')";
                $query = mysqli_query($con, $sqll);

                $sqllf = "INSERT INTO `myrefcode`(`EMAIL`, `REFID`, `DATER`) VALUES ('$email','$refid','$date')";
                $queryf = mysqli_query($con, $sqllf);

                $sqlp = "INSERT INTO `bankinfo`(`EMAIL`, `ACCNAME`, `ACCNUM`, `BANKNAME`, `DATER`) VALUES ('$email','0','0', '0', '$date')";
                $queryp = mysqli_query($con, $sqlp);

                $sqlpp = "INSERT INTO `walletaddress`(`EMAIL`, `ADDRESS`, `DATER`) VALUES ('$email','0','$date')";
                $querypp = mysqli_query($con, $sqlpp);

                echo "<script>window.location='../start/';</script>";
            }
            
            
           
            
    }

}
}



?>