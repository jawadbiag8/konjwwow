<?php
ob_start();
include "../common/lib/conn.php";

if (!isset($_SESSION)) {

    session_start();

}
if(isset($_SESSION['support'])){

$admin_id = $_SESSION['support']['staff_id'];

foreach($_POST  as $key => $value)
{
   $$key = $value;
}



// add_lecture
if(isset($_POST['add_vender'])){
  
  // print_r($_POST);
  $fileName="";
  if($_FILES['profile_pic']['name']){
    $fileName = $_FILES['profile_pic']['name'];
    $fileNameNew=time().'_'.$fileName;
    $fileDestination = '../common/dist/img/'.$fileNameNew;
  if(move_uploaded_file($_FILES['profile_pic']['tmp_name'],$fileDestination)){
   echo "Success";
  }
  }
  
// desc_attachment
// $files=array();
// if($_FILES['desc_attachment'] !="" || !empty($_FILES['desc_attachment'])){
//   $total = count($_FILES['desc_attachment']['name']);
//   for($i=0;$i<$total;$i++){
//     $fileName = time().'-'.$_FILES['desc_attachment']['name'][$i];
//     $fileDestination = '../common/dist/course_desc/'.$fileName;
//   if(move_uploaded_file($_FILES['desc_attachment']['tmp_name'][$i],$fileDestination)){
//     array_push($files,$fileName); 
//     echo "sucess upload";
//   }else{
//     echo  "error on upload";
//   } 
//   }

// }
//$attachmentn=json_encode($files);
$ex_position=$position+1;

  $pass = md5($password);
  $insertResult=$conn->query("INSERT INTO `tbl_vendors`(`vendor_id`, `vend_name`, `vend_mobile`, `vend_email`, `vend_pass`, `vend_business_name`, `vend_logo`, `vend_remarks`, `vend_memberships`) VALUES(NULL,'$name','$mobile_number','$email','$pass','$business_name','$fileNameNew','$business_remarks','$status')");
  echo $conn->error;
  // exit;
  if($insertResult){
    $_SESSION['msg']['icon']='success';
    $_SESSION['msg']['title']='Successfully';
    $_SESSION['msg']['description']='Successfully Added';
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

// save_categories

if(isset($_POST['save_categories'])){
  
  // print_r($_POST);
  // $fileName="";
  // if($_FILES['profile_pic']['name']){
  //   $fileName = $_FILES['profile_pic']['name'];
  //   $fileNameNew=time().'_'.$fileName;
  //   $fileDestination = '../common/dist/img/'.$fileNameNew;
  // if(move_uploaded_file($_FILES['profile_pic']['tmp_name'],$fileDestination)){
  //  echo "Success";
  // }
  // }
  $uniqu_id="kon_jai".time();
  $insertResult=$conn->query("INSERT INTO `tbl_categories`(`cat_id`, `cat_name`, `cat_feature_image`, `cat_unique_id`) VALUES(NULL,'$name','','$uniqu_id')");
  echo $conn->error;
  // exit;
  if($insertResult){
    $_SESSION['msg']['icon']='success';
    $_SESSION['msg']['title']='Successfully';
    $_SESSION['msg']['description']='Successfully Added';
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

// add_account
if(isset($_POST['add_account'])){
  $checkQuery=$conn->query("SELECT * FROM `tbl_accounts` where acc_number='$Account_number_local' AND acc_banks_name='$bank_name'");
  $num=mysqli_num_rows($checkQuery);
  if($num > 0){
    $_SESSION['msg']['icon']='error';
    $_SESSION['msg']['title']='Ooops';
    $_SESSION['msg']['description']='Allready Same Accounts are Attached.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }else{
  $insertResult=$conn->query("INSERT INTO `tbl_accounts`(`acc_id`, `acc_number`, `acc_Ibn_number`, `acc_holder_name`, `acc_banks_name`, `acc_email`) VALUES(NULL,'$Account_number_local','$Account_number','$account_holder_name','$bank_name','$account_email')");
  echo $conn->error;
  // exit;
  if($insertResult){
    $_SESSION['msg']['icon']='success';
    $_SESSION['msg']['title']='success';
    $_SESSION['msg']['description']='Successfully Added';
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

// send_email
if(isset($_POST['send_email'])){
  // message
  $insertResult=$conn->query("INSERT INTO `tbl_marketing_email`(`email_id`, `mail_subject`, `mail_content`, `mail_type`) VALUES(NULL,'$subject','$message','$receptient_type')");
  if($receptient_type=='vendor'){
    $get_app=$conn->query("SELECT vend_email as customer_email FROM `tbl_vendors`");
  }elseif($receptient_type=='merchant'){
    $get_app=$conn->query("SELECT mer_email as customer_email FROM `tbl_merchant`");
  }elseif($receptient_type=='both'){
    $get_app=$conn->query("SELECT mer_email as customer_email FROM `tbl_merchant` UNION ALL SELECT vend_email FROM `tbl_vendors`");
  }
$applicants_email=array();
  while($row=$get_app->fetch_assoc()){
    $email=$row['customer_email'];
    array_push($applicants_email,$email);
  }
  if($insertResult){
    foreach($applicants_email as $key=>$single_email){
      $to = $single_email;
    $mail_subject = "$subject";
    $mail_message = "
      <html>
      <head>
      <title>Some Heading</title>
      </head>
      <body>
      ".$message."
      </body>
      </html>
      ";
    //dont forget to include content-type on header if your sending html
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: webmaster@codeinpk.com";
  mail($to,$mail_subject,$mail_message,$headers);
    }
    $_SESSION['msg']['icon']="success";
    $_SESSION['msg']['title']="Successfully";
    $_SESSION['msg']['description']='Successfully Sent.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }else{
    $_SESSION['msg']['icon']='error';
      $_SESSION['msg']['title']='Oooops';
      $_SESSION['msg']['description']='Something Went Wrong, Try Again.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }

}
// add_operation_kit
if(isset($_POST['add_member'])){
  $checkQuery=$conn->query("SELECT * FROM `tbl_staff` where mobile='$course_id' AND email='$app_id'");
  $num=mysqli_num_rows($checkQuery);
  if($num > 0){
    $_SESSION['msg']['icon']="success";
      $_SESSION['msg']['title']="Successfully";
    $_SESSION['msg']['description']='Member Allready Exist.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }else{
    $pass=md5($password);
    $insertResult=$conn->query("INSERT INTO `tbl_staff`(`staff_id`, `staff_name`, `mobile`, `email`, `password`, `role_id`, `status`) VALUES(NULL,'$name','$mobile_number','$email','$pass','$role_id','$status')");
    echo $conn->error;
    // exit;
    if($insertResult){
      $_SESSION['msg']['icon']="success";
      $_SESSION['msg']['title']="Successfully";
      $_SESSION['msg']['description']='Member Added Successfully';
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      exit();
    }else{
      $_SESSION['msg']['icon']="error";
      $_SESSION['msg']['title']="Successfully";
      $_SESSION['msg']['description']='Something Went Wrong, Please Try Again.';
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      exit();
  
    }
  }

}

// get_qoute_informations
if(isset($_POST['get_qoute_informations'])){
  $filterId=$_POST['get_qoute_informations'];
  $classes="SELECT * FROM `tbl_request_a_qoute` WHERE req_id='$filterId'";
  $staffinforamtions=$conn->query($classes);
      $num   = mysqli_num_rows($staffinforamtions);
        if($num>0){
          $output='';
          foreach($staffinforamtions as $data){   
            $output.='                     
    <div class="modal-body"> 
        <div class="form-row">
            <div class="row">
            <div class="col-lg-6">
            <label for="">Name <span class="text-danger">*</span> </label>
                <input type="text" name="name" required placeholder="name" class="form-control" value="'.stripslashes($data['name']).'">
            </div>
            <div class="col-lg-6">
            <label for="">Email <span class="text-danger">*</span></label>
                <input type="text" name="email" value="'.stripslashes($data['email']).'" placeholder="email" class="form-control">
            </div>
            <div class="col-lg-6">
            <label for="">Mobile <span class="text-danger">*</span></label>
                <input type="text" required placeholder="Mobile No" value="'.stripslashes($data['mobile']).'" class="form-control" name="mobile_number">
            </div>
            <div class="col-lg-6">
            <label for="">Business Name(if any) </label>
                <input type="text" name="business_name" value="'.stripslashes($data['business_name']).'"  placeholder="Business" class="form-control">
            </div>
            <div class="col-lg-12 mb-4">
                <label for="">Select Category</label>
                <select name="cat_id" id="" class="form-control col-md-12" required>
                    <option value="">Choose Category</option>
                        <ul class="depart-hover">
                        ';
                $userdata=$conn->query("SELECT `cat_id`, `cat_name`, `cat_feature_image`, `cat_unique_id`, `created_at` FROM `tbl_categories` ");
                while($row=$userdata->fetch_assoc()):
                  $output.='
                <option '; if($data['cat_id']==$row['cat_id']){$output.='selected'; }    $output.=' value="'.$row['cat_id'].'">'.$row['cat_name'].'</option>
               ';
                endwhile;
                $output.='
                </select>
            </div>
            <div class="col-lg-12">
            <label for="">Address <span class="text-danger">*</span></label>
                <textarea placeholder="Address " name="address" required class="form-control">'.$data['address'].'</textarea>
            </div>
            <div class="col-lg-12">
            <label for="">Quotations Details <span class="text-danger">*</span></label>
                <textarea placeholder="Quote " name="request_qoute" required class="form-control">'.$data['details'].'</textarea>
            </div>  
            <div class="form-group col-md-12">
            <label>Status</label>
            <input type="text" name="business_name" value="'.stripslashes($data['status']).'"  placeholder="Business" class="form-control">
            </div> 
        </div>
    
            ';
        echo $output;
        }
        }else{
        echo "No Record Found";
        }
}


// edit_qoute_req
if(isset($_POST['edit_qoute_req'])){
  $filterId=$_POST['edit_qoute_req'];
  $classes="SELECT * FROM `tbl_request_a_qoute` WHERE req_id='$filterId'";
  $staffinforamtions=$conn->query($classes);
      $num   = mysqli_num_rows($staffinforamtions);
        if($num>0){
          $output='';
          foreach($staffinforamtions as $data){   
            $output.='                     
    <div class="modal-body"> 
        <div class="form-row">
            <div class="row">
            <div class="col-lg-6">
            <input type="hidden" name="id" required  class="form-control" value="'.stripslashes($data['req_id']).'">
            <label for="">Name <span class="text-danger">*</span> </label>
                <input type="text" name="name" required placeholder="name" class="form-control" value="'.stripslashes($data['name']).'">
            </div>
            <div class="col-lg-6">
            <label for="">Email <span class="text-danger">*</span></label>
                <input type="text" name="email" value="'.stripslashes($data['email']).'" placeholder="email" class="form-control">
            </div>
            <div class="col-lg-6">
            <label for="">Mobile <span class="text-danger">*</span></label>
                <input type="text" required placeholder="Mobile No" value="'.stripslashes($data['mobile']).'" class="form-control" name="mobile_number">
            </div>
            <div class="col-lg-6">
            <label for="">Business Name(if any) </label>
                <input type="text" name="business_name" value="'.stripslashes($data['business_name']).'"  placeholder="Business" class="form-control">
            </div>
            <div class="col-lg-12 mb-4">
                <label for="">Select Category</label>
                <select name="cat_id" id="" class="form-control col-md-12" required>
                    <option value="">Choose Category</option>
                        <ul class="depart-hover">
                        ';
                $userdata=$conn->query("SELECT `cat_id`, `cat_name`, `cat_feature_image`, `cat_unique_id`, `created_at` FROM `tbl_categories` ");
                while($row=$userdata->fetch_assoc()):
                  $output.='
                <option '; if($data['cat_id']==$row['cat_id']){$output.='selected'; }    $output.=' value="'.$row['cat_id'].'">'.$row['cat_name'].'</option>
               ';
                endwhile;
                $cancelled='';
                $pending='';
                $resolved='';
                if($data['status']=='pending'){
                  $cancelled='selected';

                }elseif($data['status']=='resolved'){
                  $resolved='selected';
                }elseif($data['status']=='cancelled'){
                  $cancelled='selected';
                }
                $output.='
                </select>
            </div>
            <div class="col-lg-12">
            <label for="">Address <span class="text-danger">*</span></label>
                <textarea placeholder="Address " name="address" required class="form-control">'.$data['address'].'</textarea>
            </div>
            <div class="col-lg-12">
            <label for="">Quotations Details <span class="text-danger">*</span></label>
                <textarea placeholder="Quote " name="request_qoute" required class="form-control">'.$data['details'].'</textarea>
            </div>  
            <div class="form-group col-md-12">
            <label>Status</label>
            <select name="status" class="form-control" required>
            <option value="pending"  '.$pending.';>pending</option>
            <option value="resolved" '.$resolved.';>resolved</option>
            <option value="cancelled"  '. $cancelled.';>cancelled</option>
            </select>
            </div> 
        </div>
    
            ';
        echo $output;
        }
        }else{
        echo "No Record Found";
        }
}
// update_qoute_request
if(isset($_POST['update_qoute_request'])){
  $filterId=$_POST['update_qoute_request'];
  $update_query=$conn->query("UPDATE `tbl_request_a_qoute` SET status='$status'  WHERE `req_id`='$id'");
  if($update_query)
  {
    // email
    $_SESSION['msg']['icon']='success';
    $_SESSION['msg']['title']='Successfully';
    $_SESSION['msg']['description']='Successfully updated';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }else{
    $_SESSION['msg']['icon']='error';
    $_SESSION['msg']['title']='Oooops';
    $_SESSION['msg']['description']='Something Went Wrong, Try Again.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }

}


// edit_merchant
if(isset($_POST['edit_merchant'])){
  $filterId=$_POST['edit_merchant'];
  $classes="SELECT * FROM `tbl_merchant` WHERE mer_id='$filterId'";
  $staffinforamtions=$conn->query($classes);
      $num   = mysqli_num_rows($staffinforamtions);
        if($num>0){
          $output='';
          foreach($staffinforamtions as $data){   
            $output.='                     
    
        <div class="modal-body"> 
        <div class="form-row">
            <div class="form-group col-md-12">
            <input type="hidden" name="mer_id"  value="'.stripslashes($data['mer_id']).'" class="form-control" >
                <label for="name">Full Name</label>
                <input type="text" name="name" value="'.stripslashes($data['mer_name']).'" class="form-control" >
            </div>
        </div> 
        <div class="form-row">
        <div class="form-group col-md-6">
                <label for="name">Mobile Number</label>
                <input type="text" name="mobile_number" value="'.stripslashes($data['mer_phone']).'"  class="form-control" >
        </div>
        <div class="form-group col-md-6">
                <label for="name">Email</label>
                <input type="email" name="email" value="'.stripslashes($data['mer_email']).'"  class="form-control" >
        </div>
        </div>
        <div class="form-row">
        <div class="form-group  col-md-12">
                <label for="name">Password</label>
                <input type="password" name="password" class="form-control">
        </div> 
        </div>
        <div class="form-row">
        <div class="form-group  col-md-12">
            <label for="name">Business Name</label>
            <input type="text" name="business_name" value="'.stripslashes($data['mer_business_name']).'" class="form-control"   >
        </div>
        
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="name">Status</label>
              <select name="status" id="" class="form-control">
                      <option value="1">Membership Approved</option>
                      <option value="0">Membership Not Approved</option>
              </select>
            </div>
        </div>
        </div>
    <div class="modal-footer">  
    <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Close</button>
    <button type="submit" name="update_merchant" class="btn btn-success btn-sm"> Update</button>
  </div> 
            ';
        echo $output;
        }
        }else{
        echo "No Record Found";
        }
}
//edit_vendor
if(isset($_POST['edit_vender'])){
  $filterId=$_POST['edit_vender'];
  $classes="SELECT * FROM `tbl_vendors` WHERE vendor_id='$filterId'";
  $staffinforamtions=$conn->query($classes);
      $num   = mysqli_num_rows($staffinforamtions);
        if($num>0){
          $output='';
          foreach($staffinforamtions as $data){   
            $output.='                     
    
        <div class="modal-body"> 
        <div class="form-row">
            <div class="form-group col-md-12">
            <input type="hidden" name="vendor_id"  value="'.stripslashes($data['vendor_id']).'" class="form-control" >
                <label for="name">Full Name</label>
                <input type="text" name="name" value="'.stripslashes($data['vend_name']).'" class="form-control" >
            </div>
        </div> 
        <div class="form-row">
        <div class="form-group col-md-6">
                <label for="name">Mobile Number</label>
                <input type="text" name="mobile_number" value="'.stripslashes($data['vend_mobile']).'"  class="form-control" >
        </div>
        <div class="form-group col-md-6">
                <label for="name">Email</label>
                <input type="email" name="email" value="'.stripslashes($data['vend_email']).'"  class="form-control" >
        </div>
        </div>
        <div class="form-row">
        <div class="form-group  col-md-12">
                <label for="name">Password</label>
                <input type="password" name="password" class="form-control">
        </div> 
        </div>
        <div class="form-row">
        <div class="form-group  col-md-6">
            <label for="name">Business Name</label>
            <input type="text" name="business_name" value="'.stripslashes($data['vend_business_name']).'" class="form-control"   >
        </div>
        <div class="form-group  col-md-6">
            <label for="name">Business Logo</label>
            <input type="file" name="profile_pic" class="form-control btn btn-info"   >
        </div>
        </div>
        <div class="form-row">
        <div class="form-group  col-md-12">
            <label for="name">Remarks</label>
            <textarea name="business_remarks" id="" cols="10" rows="3" class="form-control">'.stripslashes($data['vend_remarks']).'</textarea>
        </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="name">Status</label>
              <select name="status" id="" class="form-control">
                      <option value="1">Membership Approved</option>
                      <option value="0">Membership Not Approved</option>
              </select>
            </div>
        </div>
        </div>
    <div class="modal-footer">  
    <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Close</button>
    <button type="submit" name="update_vender" class="btn btn-success btn-sm"> Update</button>
  </div> 
            ';
        echo $output;
        }
        }else{
        echo "No Record Found";
        }
}

// update_vender
if(isset($_POST['update_vender'])){
  $pass='';
  if(!empty($password) || $password !=''){
    $pass=md5($password);
  }
  $password_filter='';
  if($pass !='' || !empty($pass)){
    $password_filter=",`vend_pass`='$pass'";
  }


    $update_query=$conn->query("UPDATE `tbl_vendors` SET `vend_name`='$name',`vend_mobile`='$mobile_number',`vend_email`='$email' $password_filter,`vend_business_name`='$business_name',`vend_remarks`='$business_remarks', `vend_memberships`='$status' WHERE `vendor_id`='$vendor_id'");
    if($update_query)
    {
      $_SESSION['msg']['icon']='success';
      $_SESSION['msg']['title']='Successfully';
      $_SESSION['msg']['description']='Successfully updated';
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      exit();
    }
    else{
      $_SESSION['msg']['icon']='error';
      $_SESSION['msg']['title']='Oooops';
      $_SESSION['msg']['description']='Something Went Wrong, Try Again.';
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      exit();
    }
  }
  // update_merchant
  if(isset($_POST['update_merchant'])){
    $pass='';
    if(!empty($password) || $password !=''){
      $pass=md5($password);
    }
    $password_filter='';
    if($pass !='' || !empty($pass)){
      $password_filter=",`mer_password`='$pass'";
    }
  
  
      $update_query=$conn->query("UPDATE `tbl_merchant` SET `mer_name`='$name',`mer_phone`='$mobile_number',`mer_email`='$email' $password_filter,`mer_business_name`='$business_name',`mer_status`='$status' WHERE `mer_id`='$mer_id'");
      // echo $conn->error;
      // echo $update_query;
      // exit;
      if($update_query)
      {
        $_SESSION['msg']['icon']='success';
        $_SESSION['msg']['title']='Successfully';
        $_SESSION['msg']['description']='Successfully updated';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
      }
      else{
        $_SESSION['msg']['icon']='error';
        $_SESSION['msg']['title']='Oooops';
        $_SESSION['msg']['description']='Something Went Wrong, Try Again.';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
      }
    }
// delete_cate
if(isset($_POST['delete_cate'])){
  
  $insertResult=$conn->query("DELETE FROM `tbl_categories` WHERE cat_id='$delete_cate'");
  echo $conn->error;
  if($insertResult){
    echo "success";
    $_SESSION['msg']['icon']='success';
    $_SESSION['msg']['title']='success';
    $_SESSION['msg']['description']='Successfully Deleted';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }else{
    echo "error";
    $_SESSION['msg']['icon']='error';
      $_SESSION['msg']['title']='Oooops';
      $_SESSION['msg']['description']='Something Went Wrong, Try Again.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }

}
// delete_request_id
if(isset($_POST['delete_request_id'])){
  
  $insertResult=$conn->query("DELETE FROM `tbl_request_a_qoute` WHERE req_id='$delete_request_id'");
  echo $conn->error;
  if($insertResult){
    echo "success";
    $_SESSION['msg']['icon']='success';
    $_SESSION['msg']['title']='success';
    $_SESSION['msg']['description']='Successfully Deleted';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }else{
    echo "error";
    $_SESSION['msg']['icon']='error';
      $_SESSION['msg']['title']='Oooops';
      $_SESSION['msg']['description']='Something Went Wrong, Try Again.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }

}
// delete_merchant
if(isset($_POST['delete_merchant'])){
  
  $insertResult=$conn->query("DELETE FROM `tbl_merchant` WHERE mer_id='$delete_merchant'");
  echo $conn->error;
  if($insertResult){
    echo "success";
    $_SESSION['msg']['icon']='success';
    $_SESSION['msg']['title']='success';
    $_SESSION['msg']['description']='Successfully Deleted';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }else{
    echo "error";
    $_SESSION['msg']['icon']='error';
      $_SESSION['msg']['title']='Oooops';
      $_SESSION['msg']['description']='Something Went Wrong, Try Again.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }

}
// delete_contact_content
if(isset($_POST['delete_contact_content'])){
  
  $insertResult=$conn->query("DELETE FROM `contact_us_msgs` WHERE contact_id='$delete_contact_content'");
  echo $conn->error;
  if($insertResult){
    echo "success";
    $_SESSION['msg']['icon']='success';
    $_SESSION['msg']['title']='success';
    $_SESSION['msg']['description']='Successfully Deleted';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }else{
    echo "error";
    $_SESSION['msg']['icon']='error';
      $_SESSION['msg']['title']='Oooops';
      $_SESSION['msg']['description']='Something Went Wrong, Try Again.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }

}

//delete_vender
if(isset($_POST['delete_vender'])){
  
  $insertResult=$conn->query("DELETE FROM `tbl_vendors` WHERE vendor_id='$delete_vender'");
  echo $conn->error;
  if($insertResult){
    echo "success";
    $_SESSION['msg']['icon']='success';
    $_SESSION['msg']['title']='success';
    $_SESSION['msg']['description']='Successfully Deleted';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }else{
    echo "error";
    $_SESSION['msg']['icon']='error';
      $_SESSION['msg']['title']='Oooops';
      $_SESSION['msg']['description']='Something Went Wrong, Try Again.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }

}

// product status updating
if(isset($_POST['rejected'])){  

    $update_query=$conn->query("UPDATE `tbl_products` SET `product_status`='$rejected' WHERE `product_id`='$p_id'");
    if($update_query)
    {
      $_SESSION['msg']['icon']='success';
      $_SESSION['msg']['title']='Successfully';
      $_SESSION['msg']['description']='Successfully updated';
      header('Location: products_request.php');
      exit();
    }
    else{
      $_SESSION['msg']['icon']='error';
      $_SESSION['msg']['title']='Oooops';
      $_SESSION['msg']['description']='Something Went Wrong, Try Again.';
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      exit();
    }
  }
  /////
  if(isset($_POST['disabled'])){  

    $update_query=$conn->query("UPDATE `tbl_products` SET `product_status`='$disabled' WHERE `product_id`='$p_id'");
    if($update_query)
    {
      $_SESSION['msg']['icon']='success';
      $_SESSION['msg']['title']='Successfully';
      $_SESSION['msg']['description']='Successfully updated';
      header('Location:  products_request.php');
      exit();
    }
    else{
      $_SESSION['msg']['icon']='error';
      $_SESSION['msg']['title']='Oooops';
      $_SESSION['msg']['description']='Something Went Wrong, Try Again.';
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      exit();
    }
  }
/////
if(isset($_POST['approved'])){  

  $update_query=$conn->query("UPDATE `tbl_products` SET `product_status`='$approved' WHERE `product_id`='$p_id'");
  if($update_query)
  {
    $_SESSION['msg']['icon']='success';
    $_SESSION['msg']['title']='Successfully';
    $_SESSION['msg']['description']='Successfully updated';
    header('Location:  products_request.php');
    exit();
  }
  else{
    $_SESSION['msg']['icon']='error';
    $_SESSION['msg']['title']='Oooops';
    $_SESSION['msg']['description']='Something Went Wrong, Try Again.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }
}

// eidtrole
if(isset($_POST['edit_role'])){
  $filterId=$_POST['edit_role'];
  $classes="SELECT * FROM `tbl_staff` where staff_id='$filterId'";
  $staffinforamtions=$conn->query($classes);
      $num   = mysqli_num_rows($staffinforamtions);
        if($num>0){
          $output='';
          foreach($staffinforamtions as $data){  
            
            $active ='';
            $inactive='';
            if($data['status'] == 0){
              $inactive='selected';
            }else{
              $active='selected';
            }
            
            $output.='                     
    <div class="modal-body"> 
        <div class="form-row">
            <div class="form-group col-md-12">
            <input type="hidden" name="staff_id"  value="'.stripslashes($data['staff_id']).'" class="form-control" >
                <label for="name">Full Name</label>
                <input type="text" name="full_name"  value="'.stripslashes($data['staff_name']).'" class="form-control" >
            </div>
        </div> 
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name"> Email:</label>
                <input type="text" name="email" value="'.stripslashes($data['email']).'"  class="form-control" >
            </div>
            <div class="form-group col-md-6">
                <label for="name">Mobile Number</label>
                <input type="text" name="mobile_num" value="'.stripslashes($data['mobile']).'"  class="form-control" >
            </div>
        </div> 
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name"> Password:</label>
                <input type="password" placeholder="*******" name="password"  class="form-control" >
            </div>
            <div class="form-group  col-md-6">
                <label for="name">Assign Role</label>
                <select name="role_id" id="" class="form-control">
                <option value="">Choose Role</option>
                ';
                $roles=$conn->query("SELECT * FROM `tbl_roles`");
                while($row=$roles->fetch_assoc()){
                  $output.='
                    <option value="'.$row['role_id'].'"  ';  if($data['role_id']==$row['role_id']){$output.='selected';} $output.='>'.$row['role_name'].'</option>
                    ';
                }
                $output.='
                </select>
            </div>
        </div> 
            <div class="form-row">
            <div class="form-group col-md-12">
                <label for="name">Status</label>
              <select name="status" id="" class="form-control">
                      <option value="1" '.$active.'>Active</option>
                      <option value="0" '.$inactive.'>Inactive</option>
              </select>
            </div>
        </div>    
        </div>
    <div class="modal-footer">  
    <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Close</button>
    <button type="submit" name="update_staff" class="btn btn-success btn-sm"> Update</button>
  </div> 
            ';
        echo $output;
        }
        }else{
        echo "No Record Found";
        }
}

//delete_staff

if(isset($_POST['delete_staff'])){
  
  $insertResult=$conn->query("DELETE FROM `tbl_staff` WHERE staff_id='$delete_staff'");
  echo $conn->error;
  if($insertResult){
    echo "success";
    $_SESSION['msg']['icon']='success';
    $_SESSION['msg']['title']='success';
    $_SESSION['msg']['description']='Successfully Deleted';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }else{
    echo "error";
    $_SESSION['msg']['icon']='error';
      $_SESSION['msg']['title']='Oooops';
      $_SESSION['msg']['description']='Something Went Wrong, Try Again.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }

}
// add_slider_content

if(isset($_POST['add_slider_content'])){
  
  $fileName="";
  if($_FILES['slider_image']['name']){
    $fileName = $_FILES['slider_image']['name'];
    $fileNameNew=time().'_'.$fileName;
    $fileDestination = '../common/dist/slider_images/'.$fileNameNew;
  if(move_uploaded_file($_FILES['slider_image']['tmp_name'],$fileDestination)){
   echo "Success";
  }
  }

  $insertResult=$conn->query("INSERT INTO `tbl_home_slider_control`(`slider_id`, `slider_content`, `slider_image`, `is_button_exist`, `button_content`, `button_url`) VALUES(NULL,'$slider_content',
  '$fileNameNew',
  '$slider_button',
  '$button_text',
  '$button_url')");
  // echo $conn->error;
  // exit;
  if($insertResult){
    echo "success";
    $_SESSION['msg']['icon']='success';
    $_SESSION['msg']['title']='success';
    $_SESSION['msg']['description']='Successfully Saved';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }else{
    echo "error";
    $_SESSION['msg']['icon']='error';
      $_SESSION['msg']['title']='Oooops';
      $_SESSION['msg']['description']='Something Went Wrong, Try Again.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }

}

// update_staff
if(isset($_POST['update_staff'])){
  $pass='';
  if(!empty($password) || $password !=''){
    $pass=md5($password);
  }
  $password_filter='';
  if($pass !='' || !empty($pass)){
    $password_filter=",`password`='$pass'";
  }


    $update_query=$conn->query("UPDATE `tbl_staff` SET `staff_name`='$full_name',`mobile`='$mobile_num',`email`='$email' $password_filter,`role_id`='$role_id',`status`='$status' WHERE `staff_id`='$staff_id'");
    if($update_query)
    {
      $_SESSION['msg']['icon']='success';
      $_SESSION['msg']['title']='Successfully';
      $_SESSION['msg']['description']='Successfully updated';
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      exit();
    }
    else{
      $_SESSION['msg']['icon']='error';
      $_SESSION['msg']['title']='Oooops';
      $_SESSION['msg']['description']='Something Went Wrong, Try Again.';
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      exit();
    }
  }



// edit_quiz
if(isset($_POST['edit_quiz'])){
  $filterId=$_POST['edit_quiz'];
  $classes="SELECT * FROM `tbl_quiz` WHERE quiz_id='$filterId'";
  $staffinforamtions=$conn->query($classes);
      $num   = mysqli_num_rows($staffinforamtions);
        if($num>0){
          $output='';
          foreach($staffinforamtions as $data){   
            $output.='               

        <div class="modal-body"> 
        <div class="form-row">
            <div class="form-group col-md-12">
            <input type="hidden" name="quiz_id"  value="'.stripslashes($data['quiz_id']).'" class="form-control" >
                <label for="name">Question Title</label>
                <textarea name="q_title"  cols="10" class="form-control" rows="3">'.stripslashes($data['q_title']).'</textarea>
            </div>
        </div>
        <div class="form-row">
        <div class="form-group col-md-6">
                <label for="name">Option A</label>
                <input type="text" required name="option_a" class="form-control"  value="'.stripslashes($data['option_a']).'" >
            </div>
            <div class="form-group col-md-6">
                <label for="name">Option A Attach</label>
                <input type="file" required name="option_a_attach" class="form-control">
            </div>
        </div>

        <div class="form-row">
        <div class="form-group col-md-6">
                <label for="name">Option B</label>
                <input type="text" required name="option_b" class="form-control"  value="'.stripslashes($data['option_b']).'">
            </div>
            <div class="form-group col-md-6">
                <label for="name">Option B Attach</label>
                <input type="file" required name="option_b_attach" class="form-control" >
            </div>
        </div> 
        <div class="form-row">
        <div class="form-group col-md-6">
                <label for="name">Option C</label>
                <input type="text" required name="option_c" class="form-control"  value="'.stripslashes($data['option_c']).'">
            </div>
            <div class="form-group col-md-6">
                <label for="name">Option C Attach</label>
                <input type="file" required name="option_c_attach" class="form-control" >
            </div>
        </div> 
        <div class="form-row">
        <div class="form-group col-md-6">
                <label for="name">Option D</label>
                <input type="text" required name="option_d" class="form-control"  value="'.stripslashes($data['option_d']).'">
            </div>
            <div class="form-group col-md-6">
                <label for="name">Option D Attach</label>
                <input type="file" required name="option_d_attach" class="form-control" >
            </div>
        </div> 
        <div class="form-row">
            <div class="form-group col-md-12">
                    <label for="name">Correct Answer</label>
                    <select name="lead_source" class="form-control">
                    <option>Select..</option>
                      <option value="A">Option A</option>
                      <option value="B">Option B</option>
                      <option value="C">Option C</option>
                      <option value="D">Option D</option>
                    </select>
                </div>
            </div>
        </div> 
    <div class="modal-footer">  
    <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Close</button>
    <button type="submit" name="update_quiz" class="btn btn-success btn-sm"> Update</button>
  </div> 
      ';
  echo $output;
  }
  }else{
  echo "No Record Found";
  }
}
// quiz_info
if(isset($_POST['quiz_info'])){
  $filterId=$_POST['quiz_info'];
  $classes="SELECT * FROM `tbl_quiz` WHERE quiz_id='$filterId'";
  $staffinforamtions=$conn->query($classes);
      $num   = mysqli_num_rows($staffinforamtions);
        if($num>0){
          $output='';
          foreach($staffinforamtions as $data){   
            $output.='               

        <div class="modal-body"> 
        <div class="form-row">
            <div class="form-group col-md-12">
            <input type="hidden" name="quiz_id"  value="'.stripslashes($data['quiz_id']).'" class="form-control" >
                <label for="name">Question Title</label>
                <textarea name="q_title" cols="10" class="form-control" rows="3">'.$data['q_title'].'</textarea>
            </div>
        </div>
        <div class="form-row">
        <div class="form-group col-md-6">
                <label for="name">Option A</label>
                <input type="text" required name="option_a" class="form-control"  value="'.stripslashes($data['option_a']).'" >
            </div>
            <div class="form-group col-md-6">
                <label for="name">Option A Attach</label>
                ';
                if($data['option_a_attachment']){
                  $output.='<span class="ml-4"><img width="50" height="50" src="../common/dist/quiz_question_images/'.$data['option_a_attachment'].'" alt="'.$data['option_a_attachment'].'"> </span>';
                  
                }
                $output.='
            </div>
        </div>

        <div class="form-row">
        <div class="form-group col-md-6">
                <label for="name">Option B</label>
                <input type="text" required name="option_b" class="form-control"  value="'.stripslashes($data['option_b']).'">
            </div>
            <div class="form-group col-md-6">
                <label for="name">Option B Attach</label>
                ';
                if($data['option_b_attachment']){
                  $output.='<span class="ml-4"><img width="50" height="50" src="../common/dist/quiz_question_images/'.$data['option_b_attachment'].'" alt=""> </span>';
                  
                }
                $output.='
                
            </div>
        </div> 
        <div class="form-row">
        <div class="form-group col-md-6">
                <label for="name">Option C</label>
                <input type="text" required name="option_c" class="form-control"  value="'.stripslashes($data['option_c']).'">
            </div>
            <div class="form-group col-md-6">
                <label for="name">Option C Attach</label>
                ';
                if($data['option_c_attachment']){
                  $output.='<span class="ml-4"><img width="50" height="50" src="../common/dist/quiz_question_images/'.$data['option_c_attachment'].'" alt="'.$data['option_a_attachment'].'"> </span>';
                  
                }
                $output.='
            </div>
        </div> 
        <div class="form-row">
        <div class="form-group col-md-6">
                <label for="name">Option D</label>
                <input type="text" required name="option_d" class="form-control"  value="'.stripslashes($data['option_d']).'">
            </div>
            <div class="form-group col-md-6">
                <label for="name">Option D Attach</label>
                ';
                if($data['option_d_attachment']){
                  $output.='<span class="ml-4"><img width="50" height="50" src="../common/dist/quiz_question_images/'.$data['option_d_attachment'].'" alt=""> </span>';
                  
                }
                $output.='
            </div>
        </div> 
        <div class="form-row">
            <div class="form-group col-md-12">
                    <label for="name">Correct Answer</label>
                    <input type="text" required name="option_d" class="form-control"  value="'.stripslashes($data['right_ans']).'">
                </div>
            </div>
        </div> 
    <div class="modal-footer">  
    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>

  </div> 
      ';
  echo $output;
  }
  }else{
  echo "No Record Found";
  }
}


// update_lecture
if(isset($_POST['update_lecture'])){
  // ',,,,,,,,
    $update_query=$conn->query("UPDATE `tbl_lectures` SET `lec_title`='$lecture_title',`lecture_description`='$lecture_description',`lecture_link`='$lecture_link' WHERE `lec_id`='$lec_id'");
    if($update_query)
    {
      $_SESSION['msg']['title']='success';
      $_SESSION['msg']['description']='Successfully Added';
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      exit();
    }
    else{
      $_SESSION['msg']['title']='error';
      $_SESSION['msg']['description']='Error while updating';
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      exit();
    }
  }
  // update_course_
  if(isset($_POST['update_course_'])){
   
    // course_thumbnail
    $thumbnail='';
      if(!empty($_FILES['course_thumbnail']['name'])){
        $fileName = $_FILES['course_thumbnail']['name'];
        $fileNameNew=time().'_'.$fileName;
        $fileDestination = '../common/dist/course_thumbnail/'.$fileNameNew;
      if(move_uploaded_file($_FILES['course_thumbnail']['tmp_name'],$fileDestination)){
        $thumbnail=$fileNameNew;
      }
      }
      $updateThumnail="";
      if($thumbnail !=''){
        $updateThumnail=", `course_thumbnail`='$thumbnail'";
      }
      $course_description_n=addslashes($course_description);
      $update_query=$conn->query("UPDATE `tbl_courses` SET `course_title`='$course_title',`course_desc`='$course_description_n',`course_expacted_hrs`='$course_hours' $updateThumnail WHERE `course_id`='$course_id'");
      if($update_query)
      {
        $_SESSION['msg']['title']='success';
        $_SESSION['msg']['description']='Successfully Updated';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
      }
      else{
        $_SESSION['msg']['title']='error';
        $_SESSION['msg']['description']='Error while updating';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
      }
    }

// update_quiz
if(isset($_POST['update_quiz'])){
  // ',,,,,,,,
    $update_query=$conn->query("UPDATE `tbl_quiz` SET `lec_id`='$lec_id',`q_title`='$q_title',`option_a`='$option_a',`option_a_attachment`='$fileNamea',`option_b`='$option_b',`option_b_attachment`='$fileNameb',`option_c`='$option_c',`option_c_attachment`='$fileNamec',`option_d`='$option_d',`option_d_attachment`='$fileNamed' WHERE `quiz_id`='$quiz_id'");
    if($update_query)
    {
      $_SESSION['msg']['title']='success';
      $_SESSION['msg']['description']='Successfully Added';
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      exit();
    }
    else{
      $_SESSION['msg']['title']='error';
      $_SESSION['msg']['description']='Error while updating';
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      exit();
    }
  }



if(isset($_POST['delete_account_'])){
  
  $insertResult=$conn->query("DELETE FROM `tbl_accounts` WHERE acc_id='$delete_account_'");
  echo $conn->error;
  if($insertResult){
    echo "success";
    $_SESSION['msg']['title']='success';
    $_SESSION['msg']['description']='Successfully Deleted';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }else{
    echo "error";
    $_SESSION['msg']['icon']='error';
      $_SESSION['msg']['title']='Oooops';
      $_SESSION['msg']['description']='Something Went Wrong, Try Again.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }

}
// delete_slider_data
if(isset($_POST['delete_slider_data'])){
  
  $insertResult=$conn->query("DELETE FROM `tbl_home_slider_control` WHERE slider_id='$delete_slider_data'");
  echo $conn->error;
  if($insertResult){
    echo "success";
    $_SESSION['msg']['title']='success';
    $_SESSION['msg']['description']='Successfully Deleted';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }else{
    echo "error";
    $_SESSION['msg']['icon']='error';
      $_SESSION['msg']['title']='Oooops';
      $_SESSION['msg']['description']='Something Went Wrong, Try Again.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }

}
// delete_cities
if(isset($_POST['delete_cities'])){
  
  $insertResult=$conn->query("DELETE FROM `tbl_cities` WHERE cities_id='$delete_cities'");
  echo $conn->error;
  if($insertResult){
    echo "success";
    $_SESSION['msg']['title']='success';
    $_SESSION['msg']['description']='Successfully Deleted';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }else{
    echo "error";
    $_SESSION['msg']['icon']='error';
      $_SESSION['msg']['title']='Oooops';
      $_SESSION['msg']['description']='Something Went Wrong, Try Again.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }

}
// delete_ads_content
if(isset($_POST['delete_ads_content'])){
  
  $insertResult=$conn->query("DELETE FROM `tbl_ads_content` WHERE content_id='$delete_ads_content'");
  echo $conn->error;
  if($insertResult){
    echo "success";
    $_SESSION['msg']['title']='success';
    $_SESSION['msg']['description']='Successfully Deleted';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }else{
    echo "error";
    $_SESSION['msg']['icon']='error';
      $_SESSION['msg']['title']='Oooops';
      $_SESSION['msg']['description']='Something Went Wrong, Try Again.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }

}
// delete_deals_data
if(isset($_POST['delete_deals_data'])){
  
  $insertResult=$conn->query("DELETE FROM `tbl_deals_details` WHERE deal_id='$delete_deals_data'");
  echo $conn->error;
  if($insertResult){
    echo "success";
    $_SESSION['msg']['title']='success';
    $_SESSION['msg']['description']='Successfully Deleted';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }else{
    echo "error";
    $_SESSION['msg']['icon']='error';
      $_SESSION['msg']['title']='Oooops';
      $_SESSION['msg']['description']='Something Went Wrong, Try Again.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }

}
// save_ads_content
if(isset($_POST['save_ads_content'])){
  
  $insertResult=$conn->query("INSERT INTO `tbl_ads_content`(`content_id`, `pkg_id`, `content_desc`) VALUES(NULL,'$pkg_id','$description')");
  echo $conn->error;
  if($insertResult){
    echo "success";
    $_SESSION['msg']['icon']='success';
    $_SESSION['msg']['title']='Successfully';
    $_SESSION['msg']['description']='Content Successfully Added';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }else{
    echo "error";
    $_SESSION['msg']['icon']='error';
      $_SESSION['msg']['title']='Oooops';
      $_SESSION['msg']['description']='Something Went Wrong, Try Again.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }

}
// add_deals_content
if(isset($_POST['add_deals_content'])){
  
  if($_FILES['slider_image']['name']){
    $fileName = $_FILES['slider_image']['name'];
    $fileNameNew=time().'_'.$fileName;
    $fileDestination = '../common/dist/deals_images/'.$fileNameNew;
  if(move_uploaded_file($_FILES['slider_image']['tmp_name'],$fileDestination)){
   echo "Success";
  }
  }

  $insertResult=$conn->query("INSERT INTO `tbl_deals_details`(`deal_id`, `deal_title`, `deal_content`, `deal_price`, `deal_button_title`, `deal_button_url`, `deal_expires_on`, `deal_image`, `deal_status`) VALUES(NULL,'$deals_title','$deals_content','$deals_price','$button_text','$button_url','$deals_expire','$fileNameNew','$status')");
  echo $conn->error;
  if($insertResult){
    echo "success";
    $_SESSION['msg']['icon']='success';
    $_SESSION['msg']['title']='Successfully';
    $_SESSION['msg']['description']='Content Successfully Added';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }else{
    echo "error";
    $_SESSION['msg']['icon']='error';
      $_SESSION['msg']['title']='Oooops';
      $_SESSION['msg']['description']='Something Went Wrong, Try Again.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }

}
// update_deals
if(isset($_POST['update_deals'])){
  $deals_picture='';
  if($_FILES['slider_image']['name']){
    $fileName = $_FILES['slider_image']['name'];
    $fileNameNew=time().'_'.$fileName;
    $fileDestination = '../common/dist/deals_images/'.$fileNameNew;
  if(move_uploaded_file($_FILES['slider_image']['tmp_name'],$fileDestination)){
    $deals_picture=$fileNameNew;
  }
  }
  $picture_filter="";
  if(!empty($deals_picture) || $deals_picture!=''){
    $picture_filter=",`deal_image`='$deals_picture'";
  }

  $insertResult=$conn->query("UPDATE `tbl_deals_details` SET `deal_title`='$deals_title',`deal_content`='$deals_content',`deal_price`='$deals_price',`deal_button_title`='$button_text',`deal_button_url`='$button_url',`deal_expires_on`='$deals_expire' $picture_filter ,`deal_status`='$status' WHERE `deal_id`='$id'");
  echo $conn->error;
  if($insertResult){
    echo "success";
    $_SESSION['msg']['icon']='success';
    $_SESSION['msg']['title']='Successfully';
    $_SESSION['msg']['description']='Content Successfully Updated';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }else{
    echo "error";
    $_SESSION['msg']['icon']='error';
      $_SESSION['msg']['title']='Oooops';
      $_SESSION['msg']['description']='Something Went Wrong, Try Again.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }

}

// save_ads_prices
if(isset($_POST['save_ads_prices'])){
  $insertResult=$conn->query("UPDATE `tbl_advertisment_packages` SET `pkg_prices`='$price' WHERE `pkg_id`='$ads_id'");
  echo $conn->error;
  // exit;
  if($insertResult){
    $_SESSION['msg']['icon']='success';
      $_SESSION['msg']['title']='Successfully';
      $_SESSION['msg']['description']='Successfully Updated';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }else{
    $_SESSION['msg']['icon']='error';
      $_SESSION['msg']['title']='Oooops';
      $_SESSION['msg']['description']='Something Went Wrong, Try Again.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }
 

}
}
?>