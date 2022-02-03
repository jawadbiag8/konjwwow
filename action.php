<?php
ob_start();
if(!isset($_SESSION)){
  session_start();
}
include "common/lib/conn.php";
foreach($_POST  as $key => $value)
{
   $$key = $value;
}

// add_merchant
if(isset($_POST['add_merchant'])){

  $pass = md5($password);
  
  $insertResult=$conn->query("INSERT INTO `tbl_merchant`(`mer_id`, `mer_name`, `mer_email`, `mer_password`, `mer_phone`, `mer_business_name`, `mer_address`) VALUES(NULL,'$name','$email','$pass','$number','$business','$address')");
  echo $conn->error;
  // exit;
  if($insertResult){
    $_SESSION['msg']['icon']='success';
    $_SESSION['msg']['title']='success';
    $_SESSION['msg']['description']='Your Account Register Successfully';
    header('Location:login.php');
    exit();
  }else{
    $_SESSION['msg']['icon']='error';
    $_SESSION['msg']['title']='error';
    $_SESSION['msg']['description']='Something Went Wrong, Please Try Again.';
    header('Location:singup.php');
    exit();
  }

}
//add_vendor

// add_lecture
if(isset($_POST['save_partner'])){

  $fileName="";
  if($_FILES['business_logo']['name']){
    $fileName = $_FILES['business_logo']['name'];
    $fileNameNew=time().'_'.$fileName;
    $fileDestination = 'common/dist/img/'.$fileNameNew;
  if(move_uploaded_file($_FILES['business_logo']['tmp_name'],$fileDestination)){
   echo "Success";
  }
  }
$check_q=$conn->query("SELECT * FROM `tbl_vendors` where  vend_mobile='$mobile_number' OR vend_email='$email'");
$num=mysqli_num_rows($check_q);
echo "SELECT * FROM `tbl_vendors` where  vend_mobil='$mobile_number' OR vend_email='$email'";
// print_r($num);

if($num > 0){
  $_SESSION['msg']['icon']='error';
  $_SESSION['msg']['title']='Ooops';
  $_SESSION['msg']['description']='Your Request Allready Submitted Please Contact Us on Support Contacts.';
  header('Location: ' . $_SERVER['HTTP_REFERER']);
  exit();
}else{
  $pass = md5($password);
  $insertResult=$conn->query("INSERT INTO `tbl_vendors`(`vendor_id`, `vend_name`, `vend_mobile`, `vend_email`, `vend_pass`, `vend_business_name`, `vend_logo`) VALUES(NULL,'$name','$mobile_number','$email','$pass','$business_name','$fileNameNew')");
  echo $conn->error;
  // exit;
  if($insertResult){
    $_SESSION['msg']['icon']='success';
    $_SESSION['msg']['title']='Successfully';
    $_SESSION['msg']['description']=' Your Request Submitted Successfully, Please Wait. Our Support will Contact You with in 24 Hrs After Some basics Verifications. Thanks.';
    // header('Location:vendor/login.php');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }else{
    $_SESSION['msg']['icon']='error';
    $_SESSION['msg']['title']='Ooops';
    $_SESSION['msg']['description']='Something Went Wrong, Please Try Again.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }

}
}
// send_request
// 
if(isset($_POST['send_request'])){
  $insertResult=$conn->query("INSERT INTO `tbl_request_a_qoute`(`req_id`, `name`, `email`, `mobile`, `business_name`, `cat_id`, `address`, `details`) VALUES(NULL,'$name','$email','$mobile_number','$business_name','$cat_id','$address','$request_qoute')");
  echo $conn->error;
  // exit;
  if($insertResult){
    $_SESSION['msg']['icon']='success';
    $_SESSION['msg']['title']='Successfully';
    $_SESSION['msg']['description']=' Your Request Submitted Successfully, Please Wait. Our Support will Contact You with in 24 Hrs After Some basics Verifications. Thanks.';
    // header('Location:vendor/login.php');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }else{
    $_SESSION['msg']['icon']='error';
    $_SESSION['msg']['title']='Ooops';
    $_SESSION['msg']['description']='Something Went Wrong, Please Try Again.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }

}
// contact us
if(isset($_POST['contact_msgs'])){
  $insertResult=$conn->query("INSERT INTO `contact_us_msgs`(`contact_id`, `contact_name`, `contact_email`, `contact_msgs`) VALUES(NULL,'$name','$email','$msgs')");
  echo $conn->error;
  // exit;
  if($insertResult){
    $_SESSION['msg']['icon']='success';
    $_SESSION['msg']['title']='Successfully';
    $_SESSION['msg']['description']=' Your Request Submitted Successfully, Please Wait. Our Support will Contact You with in 24 Hrs After Some basics Verifications. Thanks.';
    // header('Location:vendor/login.php');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }else{
    $_SESSION['msg']['icon']='error';
    $_SESSION['msg']['title']='Ooops';
    $_SESSION['msg']['description']='Something Went Wrong, Please Try Again.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }

}
// newsletter
if(isset($_POST['news_letter'])){
  $query_check=$conn->query("SELECT * FROM `tbl_news_letter` where email='$email' ");
  if(mysqli_num_rows($query_check) > 0){
    $_SESSION['msg']['icon']='error';
    $_SESSION['msg']['title']='Ooops';
    $_SESSION['msg']['description']='You Already joined Our News Letter program.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }else{
    $insertResult=$conn->query("INSERT INTO `tbl_news_letter`(`news_letter_id`, `email`) VALUES(NULL,'$email')");
    echo $conn->error;
    // exit;
    if($insertResult){
      $_SESSION['msg']['icon']='success';
      $_SESSION['msg']['title']='Successfully';
      $_SESSION['msg']['description']=' Thank You For Joining Our News Letter';
      // header('Location:vendor/login.php');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      exit();
    }else{
      $_SESSION['msg']['icon']='error';
      $_SESSION['msg']['title']='Ooops';
      $_SESSION['msg']['description']='Something Went Wrong, Please Try Again.';
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      exit();
    }
  }
  

}

  




?>