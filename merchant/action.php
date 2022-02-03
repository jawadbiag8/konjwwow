<?php
ob_start();
include "../common/lib/conn.php";

if (!isset($_SESSION)) {

    session_start();

}
if(isset($_SESSION['merchant'])){

$mer_id = $_SESSION['merchant']['mer_id'];

foreach($_POST  as $key => $value)
{
   $$key = $value;
}


// add_lecture
if(isset($_POST['add_lecture'])){
  
  // print_r($_POST);
  $fileName="";
  if($_FILES['lecture_attach']['name']){
    $fileName = $_FILES['lecture_attach']['name'];
    $fileNameNew=time().'_'.$fileName;
    $fileDestination = '../common/dist/img/'.$fileNameNew;
  if(move_uploaded_file($_FILES['lecture_attach']['tmp_name'],$fileDestination)){
   echo "Success";
  }
  }
  
// desc_attachment
$files=array();
if($_FILES['desc_attachment'] !="" || !empty($_FILES['desc_attachment'])){
  $total = count($_FILES['desc_attachment']['name']);
  for($i=0;$i<$total;$i++){
    $fileName = time().'-'.$_FILES['desc_attachment']['name'][$i];
    $fileDestination = '../common/dist/course_desc/'.$fileName;
  if(move_uploaded_file($_FILES['desc_attachment']['tmp_name'][$i],$fileDestination)){
    array_push($files,$fileName); 
    echo "sucess upload";
  }else{
    echo  "error on upload";
  } 
  }

}
$attachmentn=json_encode($files);
$ex_position=$position+1;

  $insertResult=$conn->query("INSERT INTO `tbl_lectures`(`lec_id`, `course_id`, `lec_title`, `lect_type`,`lecture_description`, `lecture_link`, `lecture_attach`,`desc_attachment`,`position_order`) VALUES(NULL,'$course_id','$lecture_title','$lecture_type','$lecture_description','$lecture_link','$fileNameNew','$attachmentn','$ex_position')");
  echo $conn->error;
  // exit;
  if($insertResult){
    $_SESSION['msg']['title']='success';
    $_SESSION['msg']['description']='Successfully Added';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }else{
    $_SESSION['msg']['title']='error';
    $_SESSION['msg']['description']='Something Went Wrong, Please Try Again.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }

}
    
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
// add_product
if(isset($_POST['add_product'])){
  
  // print_r($_POST);
  $fileNameNew="";
  if($_FILES['product_image']){
    $fileName = $_FILES['product_image']['name'];
    $fileNameNew=time().'_'.$fileName;
    $fileDestination = '../common/dist/img/'.$fileNameNew;
  if(move_uploaded_file($_FILES['product_image']['tmp_name'],$fileDestination)){
   echo "Success";
  }
  }
  
// desc_attachment
//$files=array();
//if($_FILES['desc_attachment'] !="" || !empty($_FILES['desc_attachment'])){
//  $total = count($_FILES['desc_attachment']['name']);
//  for($i=0;$i<$total;$i++){
//    $fileName = time().'-'.$_FILES['desc_attachment']['name'][$i];
//    $fileDestination = '../common/dist/course_desc/'.$fileName;
//  if(move_uploaded_file($_FILES['desc_attachment']['tmp_name'][$i],$fileDestination)){
//    array_push($files,$fileName); 
//    echo "sucess upload";
//  }else{
//    echo  "error on upload";
//  } 
//  }
//
//}
//$attachmentn=json_encode($files);

$ex_position="KonJaei-".time();

  $insertResult=$conn->query("INSERT INTO `tbl_products`(`product_id`, `product_name`, `product_desc`, `product_feature_image`, `product_price`, `product_remarks`, `mer_id`, `prod_id_unique`) VALUES(NULL,'$name','$product_desc','$fileNameNew','$price','$remarks','$vender_id','$ex_position')");
  echo $conn->error;
  //  exit;
  if($insertResult){
    $_SESSION['msg']['icon']='success';
    $_SESSION['msg']['title']='success';
    $_SESSION['msg']['description']='Successfully Added';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }else{
    $_SESSION['msg']['icon']='error';
    $_SESSION['msg']['title']='error';
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

// update_order_status_customer

if(isset($_POST['update_order_status_customer'])){
  $insertResult=$conn->query("UPDATE `tbl_orders` SET `status`='$status' WHERE `order_id`='$order_id'");
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
// send_email
if(isset($_POST['send_email'])){
  // message
  $insertResult=$conn->query("INSERT INTO `tbl_marketing_email`(`email_id`, `mail_subject`, `mail_content`) VALUES(NULL,'$subject','$message')");
$get_app=$conn->query("SELECT * FROM `tbl_applicants`");
$applicants_email=array();
  while($row=$get_app->fetch_assoc()){
    $email=$row['app_email'];
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

    $_SESSION['msg']['title']='success';
    $_SESSION['msg']['description']='Successfully Sent';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }else{
    $_SESSION['msg']['title']='error';
    $_SESSION['msg']['description']='Something Went Wrong, Please Try Again.';
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

// edit_member
if(isset($_POST['edit_member'])){
  $filterId=$_POST['edit_member'];
  $classes="SELECT * FROM `tbl_applicants` WHERE app_id='$filterId'";
  $staffinforamtions=$conn->query($classes);
      $num   = mysqli_num_rows($staffinforamtions);
        if($num>0){
          $output='';
          foreach($staffinforamtions as $data){   
            $output.='                     
    <div class="modal-body"> 
        <div class="form-row">
            <div class="form-group col-md-12">
            <input type="hidden" name="id"  value="'.stripslashes($data['app_id']).'" class="form-control" >
                <label for="name">Full Name</label>
                <input type="text" name="full_name"  value="'.stripslashes($data['app_name']).'" class="form-control" >
            </div>
        </div> 
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name"> Email:</label>
                <input type="text" name="app_email" value="'.stripslashes($data['app_email']).'"  class="form-control" >
            </div>
            <div class="form-group col-md-6">
                <label for="name">Mobile Number</label>
                <input type="text" name="mobile_num" value="'.stripslashes($data['app_mobile']).'"  class="form-control" >
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
    <button type="submit" name="update_member" class="btn btn-success btn-sm"> Update</button>
  </div> 
            ';
        echo $output;
        }
        }else{
        echo "No Record Found";
        }
}

//edit_product

if(isset($_POST['edit_product'])){
  $filterId=$_POST['edit_product'];
  $classes="SELECT * FROM `tbl_products` WHERE product_id='$filterId'";
  $staffinforamtions=$conn->query($classes);
      $num   = mysqli_num_rows($staffinforamtions);
        if($num>0){
          $output='';
          foreach($staffinforamtions as $data){   
            $pending="";
            $approved="";
            $rejected="";
            $disabled="";
            if($data['product_status'] == 'pending'){
              $pending="selected";
            }elseif($data['product_status'] == 'approved'){
              $approved="selected";
            }elseif($data['product_status'] == 'rejected'){
              $rejected="selected";
            }elseif($data['product_status'] == 'disabled'){
              $disabled="selected";
            }
            $output.='                     
    <div class="modal-body"> 
        <div class="form-row">
            <div class="form-group col-md-12">
            <input type="hidden" name="id"  value="'.stripslashes($data['product_id']).'" class="form-control" >
                <label for="name">Full Name</label>
                <input type="text" name="full_name"  value="'.stripslashes($data['product_name']).'" class="form-control" >
            </div>
        </div> 
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name"> Price:</label>
                <input type="text" name="price" value="'.stripslashes($data['product_price']).'"  class="form-control" >
            </div>
            <div class="form-group col-md-6">
                <label for="name">Feature Image</label>
                <input type="file" name="feature_img" class="form-control" >
            </div>
            </div> 
            <div class="form-row">
            <div class="form-group col-md-12">
                <label for="name">Status</label>
              <select name="status" id="" class="form-control">
                      <option value="approved" '.$approved.'>Approved</option>
                      <option value="rejected" '.$rejected.'>Rejected</option>
                      <option value="panding" '.$pending.'>Pending</option>
                      <option value="disabled" '.$disabled.'>Disabled</option>
              </select>
            </div>
            <div class="form-group col-md-12">
                <label for="name">Renarks</label>
                <input type="text" name="product_remarks" value="'.stripslashes($data['product_remarks']).'"  class="form-control" >
            </div>
            
            <div class="form-group col-md-12">
            <label for="name">Descirption</label>
            <textarea name="product_desc" id="" cols="10" rows="3" class="form-control">'.stripslashes($data['product_desc']).'</textarea>
            </div>        
        </div>    
        </div>
    <div class="modal-footer">  
    <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Close</button>
    <button type="submit" name="update_product" class="btn btn-success btn-sm"> Update</button>
  </div> 
            ';
        echo $output;
        }
        }else{
        echo "No Record Found";
        }
}

// update_product_info
if(isset($_POST['update_product'])){
   
  // course_thumbnail
  $thumbnail='';
    if(!empty($_FILES['feature_img']['name'])){
      $fileName = $_FILES['feature_img']['name'];
      $fileNameNew=time().'_'.$fileName;
      $fileDestination = '../common/dist/course_thumbnail/'.$fileNameNew;
    if(move_uploaded_file($_FILES['feature_img']['tmp_name'],$fileDestination)){
      $thumbnail=$fileNameNew;
    }
    }
    $updateThumnail="";
    if($thumbnail !=''){
      $updateThumnail=", `product_feature_image`='$thumbnail'";
    }
    $course_description_n=addslashes($course_description);
    $update_query=$conn->query("UPDATE `tbl_products` SET `product_name`='$full_name',`product_desc`='$product_desc' $updateThumnail,`product_price`='$price',`product_remarks`='$product_remarks',`product_status`='$status'  WHERE `product_id`='$id'");
    if($update_query)
    {
      $_SESSION['msg']['icon']='success';
      $_SESSION['msg']['title']='success';
      $_SESSION['msg']['description']='Successfully Updated';
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      exit();
    }
    else{
      $_SESSION['msg']['icon']='error';
      $_SESSION['msg']['title']='error';
      $_SESSION['msg']['description']='Error while updating';
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


//delect product
if(isset($_POST['delete_product'])){
  
  $insertResult=$conn->query("DELETE FROM `tbl_products` WHERE product_id='$delete_product'");
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
    $_SESSION['msg']['title']='error';
    $_SESSION['msg']['description']='Something Went Wrong, Please Try Again.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }

}
if(isset($_POST['update_profile_data'])){
  $pass='';
  if(!empty($password) || $password !=''){
    $pass=md5($password);
  }
  $password_filter='';
  if($pass !='' || !empty($pass)){
    $password_filter=",`mer_password`='$pass'";
  }

  // update_profile_pic

  $user_profile='';
$update_filter="";


  if($_FILES['update_profile_pic']['name']){
    if($_FILES["update_profile_pic"]["size"] > 1000000){
      $_SESSION['msg']['icon']='error';
      $_SESSION['msg']['title']='Oooops';
      $_SESSION['msg']['description']='Your Profile Picture is Too large. Please Try Another Image';
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      exit();
    }

    $fileName = $_FILES['update_profile_pic']['name'];
    $fileNameNew=time().'_'.$fileName;
    $fileDestination = '../common/dist/img/'.$fileNameNew;
  if(move_uploaded_file($_FILES['update_profile_pic']['tmp_name'],$fileDestination)){
    $user_profile= $fileNameNew;
  }
  }
  if(!empty($user_profile) || $user_profile!=''){
    $update_filter=",profile_pic='$user_profile'";

  }


    $update_query=$conn->query("UPDATE `tbl_merchant` SET `mer_name`='$name',`mer_phone`='$mobile_number',`mer_email`='$email' $password_filter,`mer_business_name`='$business_name'  $update_filter WHERE `mer_id`='$mer_id'");
    // echo $conn->error;
    // echo $update_query;
    // exit;
    if($update_query)
    {
      $check_p= $conn->query("SELECT * from `tbl_merchant` WHERE mer_id='$mer_id' ");
    $rows=mysqli_num_rows($check_p);
    if($rows > 0){

      $res=mysqli_fetch_assoc($check_p);
      $_SESSION['merchant']=$res;
    }
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

//delect account
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
    $_SESSION['msg']['title']='error';
    $_SESSION['msg']['description']='Something Went Wrong, Please Try Again.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }

}

}
?>