<?php 
include "header.php"; 
if(isset($_SESSION['admin'])){
  $admin_data=$_SESSION['admin'];
  $admin_id = $_SESSION['admin']['id'];
?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <?php
  include('top-bar.php');
  ?>
  <!-- Main Sidebar Container -->
  <?php
include "navbar.php"
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2"> 
          <div class="col-md-12">
            <div class="card">
              <div class="card-heading">
                <h4 class="h4 text-center p-3 bg-info">Classffied Ads Managements</h4>
              </div>
              <div class="card-body">
              <div class="form-row">
                <div class="form-group col-md-12">
                <button class="btn btn-sm btn-danger float-right" data-toggle="modal" data-target="#ad_price">Ads Price <i class="fa fa-plus"></i></button>

                <button class="btn btn-sm btn-success mx-2 float-right" data-toggle="modal" data-target="#addStaff">Ads Setting <i class="fa fa-plus"></i></button>
               
                </div>
              </div>
                <div class="form-row">
                <?php 
                 $get_plan=$conn->query("SELECT * FROM `tbl_advertisment_packages`");
                 while($rw=$get_plan->fetch_assoc()):
                ?>
                <div class="col-md-4">
            <!-- Widget: user widget style 2 -->
                  <div class="card card-widget widget-user-2">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header
                    <?php if($rw['pkg_name']=='Gold'){echo "bg-warning";}elseif($rw['pkg_name']=='Bronze'){echo "bg-info";}elseif($rw['pkg_name']=='Silver'){echo "bg-primary";} 
                      
                      ?>
                    ">
                      <!-- <div class="widget-user-image">
                        <img class="img-circle elevation-2" src="../common/dist/img/user7-128x128.jpg" alt="User Avatar">
                      </div> -->
                      <!-- /.widget-user-image -->
                      <h3 class="widget-user-username"><?=$rw['pkg_name'];?></h3>
                      <h5 class="widget-user-desc"><?php if($rw['pkg_name']=='Gold'){echo "Recommended";}elseif($rw['pkg_name']=='Bronze'){echo "Basic";}elseif($rw['pkg_name']=='Silver'){echo "Most Used";} 
                      
                      ?></h5>
                    </div>
                    <div class="card-footer p-0">
                      <ul class="nav flex-column">
                      <?php
                      $get_content=$conn->query("SELECT * FROM `tbl_ads_content` where pkg_id='$rw[pkg_id]'");
                      while($content=$get_content->fetch_assoc()):
                      ?>
                        <li class="nav-item">
                          <a href="#" class="nav-link">
                            <?=$content['content_desc'];?><span class="float-right badge bg-primary"><i class="fa fa-check"></i></span>
                          </a>
                        </li>
                        <?php 
                        endwhile;
                        ?>
                        
                        <li class="nav-item bg-primary">
                        <h4 class="h4 ml-2 p-2">Only <span class="float-right "><?=$rw['pkg_prices'];?>/- Rs</span></h4>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <!-- /.widget-user -->
                </div>
         <?php
          endwhile;
         ?>
            
                </div>
                
              </div>
            </div>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  </div>
  <!-- ad_price -->
  <div class="modal fade" id="ad_price" role="dialog">  
    <div class="modal-dialog modal-lg">  
      <div class="modal-content">
      <form action="action.php" method="POST" enctype="multipart/form-data">
        <div class="modal-header">  
          <h4 class="modal-title">Ads Plan Price</h4>  
         

          <button type="button" class="close" data-dismiss="modal">×</button>  
        </div>  
        <div class="modal-body"> 
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="name">Select Ads Plan</label>
                <select name="ads_id" id="" class="form-control" required>
                <option value="">Choose Ads Plan</option>
                <?php
                $get_plan=$conn->query("SELECT * FROM `tbl_advertisment_packages`");
                while($rw=$get_plan->fetch_assoc()):
                  ?>
                  <option value="<?=$rw['pkg_id'];?>"><?=$rw['pkg_name'];?></option>
                  <?php
                endwhile;
                ?>
                
                </select>
            </div>
            <div class="form-group col-md-12">
                <label for="name">Enter Price</label>
               <input type="text" name="price" id="n" class="form-control" placeholder="599">
            </div>
        </div> 
        </div>  
        <div class="modal-footer">  
          <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Close</button>
          <button type="submit" name="save_ads_prices" class="btn btn-success btn-sm "> Next</button>
            
        </div>  
        </form>

      </div>  

    </div>  
  </div>

  <div class="modal fade" id="addStaff" role="dialog">  
    <div class="modal-dialog modal-lg">  
      <div class="modal-content">
      <form action="ads_setting_details.php" method="GET" enctype="multipart/form-data">
        <div class="modal-header">  
          <h4 class="modal-title">Ads Content Setting</h4>  
         

          <button type="button" class="close" data-dismiss="modal">×</button>  
        </div>  
        <div class="modal-body"> 
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="name">Select Ads Plan</label>
                <select name="ads_id" id="" class="form-control" required>
                <option value="">Choose Ads Plan</option>
                <?php
                $get_plan=$conn->query("SELECT * FROM `tbl_advertisment_packages`");
                while($rw=$get_plan->fetch_assoc()):
                  ?>
                  <option value="<?=$rw['pkg_id'];?>"><?=$rw['pkg_name'];?></option>
                  <?php
                endwhile;
                ?>
                
                </select>
            </div>
        </div> 
        </div>  
        <div class="modal-footer">  
          <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Close</button>
          <button type="submit" name="save_categories" class="btn btn-success btn-sm "> Next</button>
            
        </div>  
        </form>

      </div>  

    </div>  
  </div> 
  <!-- /.content-wrapper -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
</body>
<?php include "footer.php";
?>
<?php
}else{
    unset($_SESSION['admin']);
    header('location:login.php');
    ob_end_flush();
}
?>
