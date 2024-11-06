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
header('Content-Type: application/json');

if($email != false && $password != false){


$sqlk = "SELECT * FROM successpayment WHERE EMAIL = '$email'";
$run_Sqlk = mysqli_query($con, $sqlk);
if($run_Sqlk){
$fetch_infok = mysqli_fetch_assoc($run_Sqlk);
$amts = $fetch_infok["AMT"];
$statuss = isset($fetch_infok["STATUS"]);
$timestamper = $fetch_infok["timestamper"];               

$timestamp = time();
$timestamp;

$new_timestamp = ($timestamp - $timestamper)/50;
$numberv = $new_timestamp;

$number = round($numberv, 2);

echo json_encode(['number' => $number]);

}

}
?> 
