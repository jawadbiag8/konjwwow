<?php

ob_start();
include "../common/lib/conn.php";

if (!isset($_SESSION)) {

    session_start();
}
if (isset($_SESSION['vendor'])) {

    $vendor_id = $_SESSION['vendor']['vendor_id'];

    foreach ($_POST as $key => $value) {
        $$key = $value;
    }
// update_vendor
    if (isset($_POST['update_vendor'])) {

        // profile_pic
        $user_profile = '';
        $update_filter = "";
        if ($_FILES['profile_pic']['name']) {
            if ($_FILES["profile_pic"]["size"] > 1000000) {
                $_SESSION['msg']['icon'] = 'error';
                $_SESSION['msg']['title'] = 'Oooops';
                $_SESSION['msg']['description'] = 'Your Profile Picture is Too large. Please Try Another Image';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }
            $fileName = $_FILES['profile_pic']['name'];
            $fileNameNew = time() . '_' . $fileName;
            $fileDestination = '../common/dist/img/' . $fileNameNew;
            if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $fileDestination)) {
                $user_profile = $fileNameNew;
            }
        }
        if (!empty($user_profile) || $user_profile != '') {
            $update_filter = ",profile_pic='$user_profile'";
        }



        $pass = '';
        if (!empty($password) || $password != '') {
            $pass = md5($password);
        }
        $password_filter = '';
        if ($pass != '' || !empty($pass)) {
            $password_filter = ",`vend_pass`='$pass'";
        }

        $business_logo = '';

        if ($_FILES['profile_pic']['name']) {
            $fileName = $_FILES['profile_pic']['name'];
            $fileNameNew = time() . '_' . $fileName;
            $fileDestination = '../common/dist/img/' . $fileNameNew;
            if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $fileDestination)) {
                $business_logo = $fileNameNew;
            }
        }

        $busines_logo_filter = '';
        if (!empty($fileNameNew) || $fileNameNew != '') {
            $busines_logo_filter = ", `vend_logo`='$fileNameNew'";
        }
        $update_query = $conn->query("UPDATE `tbl_vendors` SET `vend_name`='$name',`vend_mobile`='$mobile_number',`vend_email`='$email' $password_filter,`vend_business_name`='$business_name' $busines_logo_filter $update_filter WHERE `vendor_id`='$vendor_id'");
        // echo $conm
        if ($update_query) {
            $check_p = $conn->query("SELECT * from `tbl_vendors` WHERE vendor_id='$vendor_id' ");
            $rows = mysqli_num_rows($check_p);
            if ($rows > 0) {

                $res = mysqli_fetch_assoc($check_p);
                $_SESSION['vendor'] = $res;
            }
            $_SESSION['msg']['icon'] = 'success';
            $_SESSION['msg']['title'] = 'Successfully';
            $_SESSION['msg']['description'] = 'Successfully updated';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            $_SESSION['msg']['icon'] = 'error';
            $_SESSION['msg']['title'] = 'Oooops';
            $_SESSION['msg']['description'] = 'Something Went Wrong, Try Again.';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }
// get_sub_category
    if (isset($_POST['get_sub_category'])) {

        $filterId = $_POST['get_sub_category'];
        $classes = "SELECT * FROM `tbl_sub_categories` where cat_id='$filterId'";
        $totalPosts = $conn->query($classes);
        $num = mysqli_num_rows($totalPosts);
        if ($num > 0) {
            $output = '';

            while ($data = $totalPosts->fetch_assoc()) {
                $output = '
            <option value="' . $data['sub_cat_id'] . '"> ' . $data['sub_cat_name'] . '</option>';
                echo $output;
            }
        } else {
            echo "<option value=''>No SubCategory Available</option>";
        }
    }
// add_product

    if (isset($_POST['add_product'])) {
        // print_r($_POST);
        $fileNameNew = "";
        $data_file = $_FILES['product_image'];
        if (!empty($data_file)) {
            if ($_FILES['product_image']) {
                $fileName = $_FILES['product_image']['name'];
                $fileNameNew = time() . '_' . $fileName;
                $fileDestination = '../common/dist/img/' . $fileNameNew;
                if (move_uploaded_file($_FILES['product_image']['tmp_name'], $fileDestination)) {
                    echo "Success";
                }
            }
        }


// desc_attachment
        $files = array();
        $gellary_files = $_FILES['product_gallery'];
        if (!empty($gellary_files)) {
            $total = count($_FILES['product_gallery']['name']);
            for ($i = 0; $i < $total; $i++) {
                $fileName = time() . '-' . $_FILES['product_gallery']['name'][$i];
                $fileDestination = '../common/dist/product_gellary/' . $fileName;
                if (move_uploaded_file($_FILES['product_gallery']['tmp_name'][$i], $fileDestination)) {
                    array_push($files, $fileName);
                    echo "sucess upload";
                } else {
                    echo "error on upload";
                }
            }
        }
        $attachmentn = json_encode($files);

        $ex_position = "KonJaei-" . time();
        $city_id = $_POST['city_id'];
        $pdf = $_POST['pdfpath'];
        $sql="INSERT INTO `tbl_products`(`product_dics_pdf_path`, `product_name`, `product_desc`, `prod_gellary`, `prod_cat`,`prod_sub_cat`,`city_id`, `product_feature_image`, `vendor_price`, `product_remarks`, `product_quantity`, `vendor_id`, `prod_id_unique`) VALUES('$pdf','$name','$product_desc','$attachmentn','$cat_id','$sub_cat_id','$city_id','$fileNameNew','$price','$remarks', '$quantity','$vender_id','$ex_position')";
        $insertResult = $conn->query($sql);
        echo $conn->error;
          exit;
        if ($insertResult) {
            $to = "msharifse11@gmail.com";
            $mail_subject = "New Product Are Added For Approval";
            $mail_message = "
     <html>
     <head>
     <title>Please Check Your Portal To see Product details</title>
     </head>
     <body> Product name: " . $name . "
      Product Quantity: " . $quantity . "
     
     <br>
     
     </body>
     </html>
     ";
            //dont forget to include content-type on header if your sending html
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: webmaster@konjae.com";
            mail($to, $mail_subject, $mail_message, $headers);
            $_SESSION['msg']['icon'] = 'success';
            $_SESSION['msg']['title'] = 'success';
            $_SESSION['msg']['description'] = 'Successfully Added';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            $_SESSION['msg']['icon'] = 'error';
            $_SESSION['msg']['title'] = 'error';
            $_SESSION['msg']['description'] = 'Something Went Wrong, Please Try Again.';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }

// contact_msgs
    if (isset($_POST['contact_msgs'])) {
        $insertResult = $conn->query("INSERT INTO `contact_us_msgs`(`contact_id`, `contact_name`, `contact_email`, `contact_msgs`) VALUES(NULL,'$name','$email','$msgs')");
        echo $conn->error;
        // exit;
        if ($insertResult) {
            $_SESSION['msg']['icon'] = 'success';
            $_SESSION['msg']['title'] = 'Successfully';
            $_SESSION['msg']['description'] = ' Your Request Submitted Successfully, Please Wait. Our Support will Contact You with in 24 Hrs After Some basics Verifications. Thanks.';
            // header('Location:vendor/login.php');
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            $_SESSION['msg']['icon'] = 'error';
            $_SESSION['msg']['title'] = 'Ooops';
            $_SESSION['msg']['description'] = 'Something Went Wrong, Please Try Again.';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }
// add_account
    if (isset($_POST['add_account'])) {
        $checkQuery = $conn->query("SELECT * FROM `tbl_accounts` where acc_number='$Account_number_local' AND acc_banks_name='$bank_name'");
        $num = mysqli_num_rows($checkQuery);
        if ($num > 0) {
            $_SESSION['msg']['icon'] = 'error';
            $_SESSION['msg']['title'] = 'Ooops';
            $_SESSION['msg']['description'] = 'Allready Same Accounts are Attached.';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            $insertResult = $conn->query("INSERT INTO `tbl_accounts`(`acc_id`, `acc_number`, `acc_Ibn_number`, `acc_holder_name`, `acc_banks_name`, `acc_email`) VALUES(NULL,'$Account_number_local','$Account_number','$account_holder_name','$bank_name','$account_email')");
            echo $conn->error;
            // exit;
            if ($insertResult) {
                $_SESSION['msg']['icon'] = 'success';
                $_SESSION['msg']['title'] = 'success';
                $_SESSION['msg']['description'] = 'Successfully Added';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            } else {
                $_SESSION['msg']['icon'] = 'error';
                $_SESSION['msg']['title'] = 'Ooops';
                $_SESSION['msg']['description'] = 'Something Went Wrong, Please Try Again.';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }
        }
    }

// update_order_status
    if (isset($_POST['update_order_status'])) {
        $insertResult = $conn->query("UPDATE `tbl_orders` SET `status`='$status' WHERE `order_id`='$order_id'");
        echo $conn->error;
        // exit;
        if ($insertResult) {
            $_SESSION['msg']['icon'] = 'success';
            $_SESSION['msg']['title'] = 'success';
            $_SESSION['msg']['description'] = 'Successfully Updated';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            $_SESSION['msg']['icon'] = 'error';
            $_SESSION['msg']['title'] = 'Ooops';
            $_SESSION['msg']['description'] = 'Something Went Wrong, Please Try Again.';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }
// send_request
    if (isset($_POST['send_request'])) {
        $insertResult = $conn->query("INSERT INTO `tbl_ads_requests`(`request_id`, `vendor_id`,`product_id`, `pkg_id`, `descriptions`) VALUES(NULL,'$vendor_id','$product_id','$ads_id','$description')");
        echo $conn->error;
        // exit;
        if ($insertResult) {
            $to = 'msharifse11@gmail.com';
            $mail_subject = "New Ads Request";
            $mail_message = "
      <html>
      <head>
      <title>Please See the Dashboard For New Ads Request</title>
      </head>
      <body>
      " . $description . "
      </body>
      </html>
      ";
            //dont forget to include content-type on header if your sending html
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: webmaster@konjae.com";
            mail($to, $mail_subject, $mail_message, $headers);
            $_SESSION['msg']['icon'] = 'success';
            $_SESSION['msg']['title'] = 'success';
            $_SESSION['msg']['description'] = 'Successfully Request Sent';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            $_SESSION['msg']['icon'] = 'error';
            $_SESSION['msg']['title'] = 'Ooops';
            $_SESSION['msg']['description'] = 'Something Went Wrong, Please Try Again.';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }

// send_email
    if (isset($_POST['send_email'])) {
        // message
        $insertResult = $conn->query("INSERT INTO `tbl_marketing_email`(`email_id`, `mail_subject`, `mail_content`) VALUES(NULL,'$subject','$message')");
        $get_app = $conn->query("SELECT * FROM `tbl_applicants`");
        $applicants_email = array();
        while ($row = $get_app->fetch_assoc()) {
            $email = $row['app_email'];
            array_push($applicants_email, $email);
        }
        if ($insertResult) {
            foreach ($applicants_email as $key => $single_email) {
                $to = $single_email;
                $mail_subject = "$subject";
                $mail_message = "
      <html>
      <head>
      <title>Some Heading</title>
      </head>
      <body>
      " . $message . "
      </body>
      </html>
      ";
                //dont forget to include content-type on header if your sending html
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= "From: webmaster@codeinpk.com";
                mail($to, $mail_subject, $mail_message, $headers);
            }

            $_SESSION['msg']['title'] = 'success';
            $_SESSION['msg']['description'] = 'Successfully Sent';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            $_SESSION['msg']['title'] = 'error';
            $_SESSION['msg']['description'] = 'Something Went Wrong, Please Try Again.';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }
// add_operation_kit
    if (isset($_POST['add_member'])) {
        $checkQuery = $conn->query("SELECT * FROM `tbl_staff` where mobile='$course_id' AND email='$app_id'");
        $num = mysqli_num_rows($checkQuery);
        if ($num > 0) {
            $_SESSION['msg']['icon'] = "success";
            $_SESSION['msg']['title'] = "Successfully";
            $_SESSION['msg']['description'] = 'Member Allready Exist.';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            $pass = md5($password);
            $insertResult = $conn->query("INSERT INTO `tbl_staff`(`staff_id`, `staff_name`, `mobile`, `email`, `password`, `role_id`, `status`) VALUES(NULL,'$name','$mobile_number','$email','$pass','$role_id','$status')");
            echo $conn->error;
            // exit;
            if ($insertResult) {
                $_SESSION['msg']['icon'] = "success";
                $_SESSION['msg']['title'] = "Successfully";
                $_SESSION['msg']['description'] = 'Member Added Successfully';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            } else {
                $_SESSION['msg']['icon'] = "error";
                $_SESSION['msg']['title'] = "Successfully";
                $_SESSION['msg']['description'] = 'Something Went Wrong, Please Try Again.';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }
        }
    }

// edit_member
    if (isset($_POST['edit_member'])) {
        $filterId = $_POST['edit_member'];
        $classes = "SELECT * FROM `tbl_applicants` WHERE app_id='$filterId'";
        $staffinforamtions = $conn->query($classes);
        $num = mysqli_num_rows($staffinforamtions);
        if ($num > 0) {
            $output = '';
            foreach ($staffinforamtions as $data) {
                $output .= '                     
    <div class="modal-body"> 
        <div class="form-row">
            <div class="form-group col-md-12">
            <input type="hidden" name="id"  value="' . stripslashes($data['app_id']) . '" class="form-control" >
                <label for="name">Full Name</label>
                <input type="text" name="full_name"  value="' . stripslashes($data['app_name']) . '" class="form-control" >
            </div>
        </div> 
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name"> Email:</label>
                <input type="text" name="app_email" value="' . stripslashes($data['app_email']) . '"  class="form-control" >
            </div>
            <div class="form-group col-md-6">
                <label for="name">Mobile Number</label>
                <input type="text" name="mobile_num" value="' . stripslashes($data['app_mobile']) . '"  class="form-control" >
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
        } else {
            echo "No Record Found";
        }
    }

//edit_product

    if (isset($_POST['edit_product'])) {
        $filterId = $_POST['edit_product'];
        $classes = "SELECT * FROM `tbl_products` WHERE product_id='$filterId'";
        $staffinforamtions = $conn->query($classes);
        $num = mysqli_num_rows($staffinforamtions);
        if ($num > 0) {
            $output = '';
            foreach ($staffinforamtions as $data) {
                $pending = "";
                $approved = "";
                $rejected = "";
                $disabled = "";
                if ($data['product_status'] == 'pending') {
                    $pending = "selected";
                } elseif ($data['product_status'] == 'approved') {
                    $approved = "selected";
                } elseif ($data['product_status'] == 'rejected') {
                    $rejected = "selected";
                } elseif ($data['product_status'] == 'disabled') {
                    $disabled = "selected";
                }
//                $output .= '                     
//    <div class="modal-body"> 
//        <div class="form-row">
//            <div class="form-group col-md-12">
//            <input type="hidden" name="id"  value="' . stripslashes($data['product_id']) . '" class="form-control" >
//                <label for="name">Full Name</label>
//                <input type="text" name="full_name" readonly  value="' . stripslashes($data['product_name']) . '" class="form-control" >
//            </div>
//        </div> 
//        <div class="form-row">
//            <div class="form-group col-md-6">
//                <label for="name"> Price:</label>
//                <input type="text" name="price" value="' . stripslashes($data['vendor_price']) . '"  class="form-control" >
//            </div>
//            </div> 
//            <div class="form-row">
//             <div class="form-group col-md-12">
//                <label for="name">Quantity</label>
//                <input type="text"  name="product_quantity" value="' . stripslashes($data['product_quantity']) . '"  class="form-control" >
//            </div>
//            <div class="form-group col-md-12">
//                <label for="name">Remarks</label>
//                <input type="text" readonly name="product_remarks" value="' . stripslashes($data['product_remarks']) . '"  class="form-control" >
//            </div>
//           
//            <div class="form-group col-md-12">
//            <label for="name">Descirption</label>
//            <textarea name="product_desc" readonly id="" cols="10" rows="3" class="form-control">' . stripslashes($data['product_desc']) . '</textarea>
//            </div>        
//        </div> 
//        <div class="form-row">
//        <div class="form-group  col-md-6">
//            <label for="name">Update Product Feature Image</label>
//            <input type="file" name="feature_images" class="form-control">
//        </div> 
//        <div class="form-group  col-md-6">
//            <label for="name">Update Product Gallery</label>
//            <input type="file" name="product_gallery[]" multiple class="form-control">
//        </div>           
//        </div>   
//        </div>
//    <div class="modal-footer">  
//    <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Close</button>
//    <button type="submit" name="update_product" class="btn btn-success btn-sm"> Update</button>
//  </div> 
//            ';
//                echo $output;
                echo json_encode($data);
            }
        } else {
            echo "No Record Found";
        }
    }

// update_product_info
    if (isset($_POST['update_product'])) {
//        var_dump($_POST);
//        exit();
        // course_thumbnail
        $thumbnail = '';
        if (!empty($_FILES['feature_images']['name'])) {
            $fileName = $_FILES['feature_images']['name'];
            $fileNameNew = time() . '_' . $fileName;
            $fileDestination = '../common/dist/img/' . $fileNameNew;
            if (move_uploaded_file($_FILES['feature_images']['tmp_name'], $fileDestination)) {
                $thumbnail = $fileNameNew;
            }
        }
// sharif update


        $updateThumnail = "";
        if ($thumbnail != '') {
            $updateThumnail = ", `product_feature_image`='$thumbnail'";
        }

        $files = array();
        $gellary_files = $_FILES['product_gallery'];
        if (!empty($gellary_files)) {
            $total = count($_FILES['product_gallery']['name']);
            echo $total;
            if ($total > 1):
                for ($i = 0; $i < $total; $i++) {
                    $fileName = time() . '-' . $_FILES['product_gallery']['name'][$i];
                    $fileDestination = '../common/dist/product_gellary/' . $fileName;
                    if (move_uploaded_file($_FILES['product_gallery']['tmp_name'][$i], $fileDestination)) {
                        array_push($files, $fileName);
                        echo "sucess upload";
                    } else {
                        echo "error on upload";
                    }
                }
            endif;
        }
        $update_files = "";
        if (sizeof($files) > 0) {
            $update_files = json_encode($files);
        }

        $udpate_filter = "";
        $status_Filter = "";
        if ($update_files != "" || !empty($update_files)) {
            $udpate_filter = ", prod_gellary='$update_files'";

            $status_Filter = ", product_status='pending'";
        }

        $course_description_n = addslashes($course_description);
        $pdfpath = $_POST["pdfpath"];
        $update_query = $conn->query("UPDATE `tbl_products` SET `product_name`='$full_name',`product_desc`='$product_desc' $updateThumnail,`vendor_price`='$price',`product_dics_pdf_path`='$pdfpath',`product_remarks`='$product_remarks',`product_quantity`='$product_quantity' $udpate_filter $status_Filter WHERE `product_id`='$id'");
        if ($update_query) {
            $_SESSION['msg']['icon'] = 'success';
            $_SESSION['msg']['title'] = 'success';
            $_SESSION['msg']['description'] = 'Successfully Updated';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            $_SESSION['msg']['icon'] = 'error';
            $_SESSION['msg']['title'] = 'error';
            $_SESSION['msg']['description'] = 'Error while updating';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }

// edit_quiz
    if (isset($_POST['edit_quiz'])) {
        $filterId = $_POST['edit_quiz'];
        $classes = "SELECT * FROM `tbl_quiz` WHERE quiz_id='$filterId'";
        $staffinforamtions = $conn->query($classes);
        $num = mysqli_num_rows($staffinforamtions);
        if ($num > 0) {
            $output = '';
            foreach ($staffinforamtions as $data) {
                $output .= '               

        <div class="modal-body"> 
        <div class="form-row">
            <div class="form-group col-md-12">
            <input type="hidden" name="quiz_id"  value="' . stripslashes($data['quiz_id']) . '" class="form-control" >
                <label for="name">Question Title</label>
                <textarea name="q_title"  cols="10" class="form-control" rows="3">' . stripslashes($data['q_title']) . '</textarea>
            </div>
        </div>
        <div class="form-row">
        <div class="form-group col-md-6">
                <label for="name">Option A</label>
                <input type="text" required name="option_a" class="form-control"  value="' . stripslashes($data['option_a']) . '" >
            </div>
            <div class="form-group col-md-6">
                <label for="name">Option A Attach</label>
                <input type="file" required name="option_a_attach" class="form-control">
            </div>
        </div>

        <div class="form-row">
        <div class="form-group col-md-6">
                <label for="name">Option B</label>
                <input type="text" required name="option_b" class="form-control"  value="' . stripslashes($data['option_b']) . '">
            </div>
            <div class="form-group col-md-6">
                <label for="name">Option B Attach</label>
                <input type="file" required name="option_b_attach" class="form-control" >
            </div>
        </div> 
        <div class="form-row">
        <div class="form-group col-md-6">
                <label for="name">Option C</label>
                <input type="text" required name="option_c" class="form-control"  value="' . stripslashes($data['option_c']) . '">
            </div>
            <div class="form-group col-md-6">
                <label for="name">Option C Attach</label>
                <input type="file" required name="option_c_attach" class="form-control" >
            </div>
        </div> 
        <div class="form-row">
        <div class="form-group col-md-6">
                <label for="name">Option D</label>
                <input type="text" required name="option_d" class="form-control"  value="' . stripslashes($data['option_d']) . '">
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
        } else {
            echo "No Record Found";
        }
    }
// quiz_info
    if (isset($_POST['quiz_info'])) {
        $filterId = $_POST['quiz_info'];
        $classes = "SELECT * FROM `tbl_quiz` WHERE quiz_id='$filterId'";
        $staffinforamtions = $conn->query($classes);
        $num = mysqli_num_rows($staffinforamtions);
        if ($num > 0) {
            $output = '';
            foreach ($staffinforamtions as $data) {
                $output .= '               

        <div class="modal-body"> 
        <div class="form-row">
            <div class="form-group col-md-12">
            <input type="hidden" name="quiz_id"  value="' . stripslashes($data['quiz_id']) . '" class="form-control" >
                <label for="name">Question Title</label>
                <textarea name="q_title" cols="10" class="form-control" rows="3">' . $data['q_title'] . '</textarea>
            </div>
        </div>
        <div class="form-row">
        <div class="form-group col-md-6">
                <label for="name">Option A</label>
                <input type="text" required name="option_a" class="form-control"  value="' . stripslashes($data['option_a']) . '" >
            </div>
            <div class="form-group col-md-6">
                <label for="name">Option A Attach</label>
                ';
                if ($data['option_a_attachment']) {
                    $output .= '<span class="ml-4"><img width="50" height="50" src="../common/dist/quiz_question_images/' . $data['option_a_attachment'] . '" alt="' . $data['option_a_attachment'] . '"> </span>';
                }
                $output .= '
            </div>
        </div>

        <div class="form-row">
        <div class="form-group col-md-6">
                <label for="name">Option B</label>
                <input type="text" required name="option_b" class="form-control"  value="' . stripslashes($data['option_b']) . '">
            </div>
            <div class="form-group col-md-6">
                <label for="name">Option B Attach</label>
                ';
                if ($data['option_b_attachment']) {
                    $output .= '<span class="ml-4"><img width="50" height="50" src="../common/dist/quiz_question_images/' . $data['option_b_attachment'] . '" alt=""> </span>';
                }
                $output .= '
                
            </div>
        </div> 
        <div class="form-row">
        <div class="form-group col-md-6">
                <label for="name">Option C</label>
                <input type="text" required name="option_c" class="form-control"  value="' . stripslashes($data['option_c']) . '">
            </div>
            <div class="form-group col-md-6">
                <label for="name">Option C Attach</label>
                ';
                if ($data['option_c_attachment']) {
                    $output .= '<span class="ml-4"><img width="50" height="50" src="../common/dist/quiz_question_images/' . $data['option_c_attachment'] . '" alt="' . $data['option_a_attachment'] . '"> </span>';
                }
                $output .= '
            </div>
        </div> 
        <div class="form-row">
        <div class="form-group col-md-6">
                <label for="name">Option D</label>
                <input type="text" required name="option_d" class="form-control"  value="' . stripslashes($data['option_d']) . '">
            </div>
            <div class="form-group col-md-6">
                <label for="name">Option D Attach</label>
                ';
                if ($data['option_d_attachment']) {
                    $output .= '<span class="ml-4"><img width="50" height="50" src="../common/dist/quiz_question_images/' . $data['option_d_attachment'] . '" alt=""> </span>';
                }
                $output .= '
            </div>
        </div> 
        <div class="form-row">
            <div class="form-group col-md-12">
                    <label for="name">Correct Answer</label>
                    <input type="text" required name="option_d" class="form-control"  value="' . stripslashes($data['right_ans']) . '">
                </div>
            </div>
        </div> 
    <div class="modal-footer">  
    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
 
  </div> 
      ';
                echo $output;
            }
        } else {
            echo "No Record Found";
        }
    }


// update_lecture
    if (isset($_POST['update_lecture'])) {
        // ',,,,,,,,
        $update_query = $conn->query("UPDATE `tbl_lectures` SET `lec_title`='$lecture_title',`lecture_description`='$lecture_description',`lecture_link`='$lecture_link' WHERE `lec_id`='$lec_id'");
        if ($update_query) {
            $_SESSION['msg']['title'] = 'success';
            $_SESSION['msg']['description'] = 'Successfully Added';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            $_SESSION['msg']['title'] = 'error';
            $_SESSION['msg']['description'] = 'Error while updating';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }
    // update_course_
    if (isset($_POST['update_course_'])) {

        // course_thumbnail
        $thumbnail = '';
        if (!empty($_FILES['course_thumbnail']['name'])) {
            $fileName = $_FILES['course_thumbnail']['name'];
            $fileNameNew = time() . '_' . $fileName;
            $fileDestination = '../common/dist/course_thumbnail/' . $fileNameNew;
            if (move_uploaded_file($_FILES['course_thumbnail']['tmp_name'], $fileDestination)) {
                $thumbnail = $fileNameNew;
            }
        }
        $updateThumnail = "";
        if ($thumbnail != '') {
            $updateThumnail = ", `course_thumbnail`='$thumbnail'";
        }
        $course_description_n = addslashes($course_description);
        $update_query = $conn->query("UPDATE `tbl_courses` SET `course_title`='$course_title',`course_desc`='$course_description_n',`course_expacted_hrs`='$course_hours' $updateThumnail WHERE `course_id`='$course_id'");
        if ($update_query) {
            $_SESSION['msg']['title'] = 'success';
            $_SESSION['msg']['description'] = 'Successfully Updated';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            $_SESSION['msg']['title'] = 'error';
            $_SESSION['msg']['description'] = 'Error while updating';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }

// update_quiz
    if (isset($_POST['update_quiz'])) {
        // ',,,,,,,,
        $update_query = $conn->query("UPDATE `tbl_quiz` SET `lec_id`='$lec_id',`q_title`='$q_title',`option_a`='$option_a',`option_a_attachment`='$fileNamea',`option_b`='$option_b',`option_b_attachment`='$fileNameb',`option_c`='$option_c',`option_c_attachment`='$fileNamec',`option_d`='$option_d',`option_d_attachment`='$fileNamed' WHERE `quiz_id`='$quiz_id'");
        if ($update_query) {
            $_SESSION['msg']['title'] = 'success';
            $_SESSION['msg']['description'] = 'Successfully Added';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            $_SESSION['msg']['title'] = 'error';
            $_SESSION['msg']['description'] = 'Error while updating';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }


//delect product
    if (isset($_POST['delete_product'])) {

        $insertResult = $conn->query("DELETE FROM `tbl_products` WHERE product_id='$delete_product'");
        echo $conn->error;
        if ($insertResult) {
            echo "success";
            $_SESSION['msg']['icon'] = 'success';
            $_SESSION['msg']['title'] = 'success';
            $_SESSION['msg']['description'] = 'Successfully Deleted';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            echo "error";
            $_SESSION['msg']['icon'] = 'error';
            $_SESSION['msg']['title'] = 'error';
            $_SESSION['msg']['description'] = 'Something Went Wrong, Please Try Again.';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }


//delect account
    if (isset($_POST['delete_account_'])) {

        $insertResult = $conn->query("DELETE FROM `tbl_accounts` WHERE acc_id='$delete_account_'");
        echo $conn->error;
        if ($insertResult) {
            echo "success";
            $_SESSION['msg']['title'] = 'success';
            $_SESSION['msg']['description'] = 'Successfully Deleted';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            echo "error";
            $_SESSION['msg']['title'] = 'error';
            $_SESSION['msg']['description'] = 'Something Went Wrong, Please Try Again.';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }
}
?>