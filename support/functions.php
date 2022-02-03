<?php
if(isset($_SESSION['support'])){
    function get_categories_name($cat_id,$conn){
        $get_cat=$conn->query("SELECT * FROM `tbl_categories` where cat_id='$cat_id'")->fetch_assoc();
        return $get_cat;
    }
}


?>