<?php
include("../common/lib/conn.php");
if(!isset($_SESSION)){
    session_start();
}
if(isset($_SESSION['admin'])){
    foreach($_POST  as $key => $value)
    {
       $$key = $value;
    }
    $response = array( 
        'status' => 0, 
        'message' => 'Form submission failed, please try again.' 
    ); 
    if(isset($_POST['plot_data'])){
        $SqlQ="SELECT * FROM `tbl_plot_description` where plot_id='$plot_data'";
        $userQuery=$conn->query($SqlQ);
        // $resularr=array();
        $getVa=mysqli_fetch_assoc($userQuery);
         header("Content-type: application/json");
          echo json_encode($getVa);
    }
    // get_applicant_data
    if(isset($_POST['get_applicant_data'])){
        $SqlQ="SELECT * FROM `hr_rec_stepo` where rec_id='$get_applicant_data'";
        $userQuery=$conn->query($SqlQ);
        // $resularr=array();
        $applicants_data=mysqli_fetch_assoc($userQuery);
         header("Content-type: application/json");
          echo json_encode($applicants_data);
    }


    if(isset($_POST['member_details'])){
        $SqlQ="SELECT  * FROM `tbl_members` where member_id='$member_details'";
        $userQuery=$conn->query($SqlQ);
        // $resularr=array();
        $getVa=mysqli_fetch_assoc($userQuery);
         header("Content-type: application/json");
          echo json_encode($getVa);
    }
 
}    
?>