<?php
if(isset($_SESSION['admin'])){
    function get_categories_name($cat_id,$conn){
        $get_cat=$conn->query("SELECT * FROM `tbl_categories` where cat_id='$cat_id'")->fetch_assoc();
        return $get_cat;
    }
    function get_vendor_name($vendor_id,$conn){
        $set_vendor=$conn->query("SELECT * FROM `tbl_vendors` where vendor_id='$vendor_id'")->fetch_assoc();
        return $set_vendor['vend_business_name'];
    }
}


?>