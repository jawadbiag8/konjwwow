<?php 
if(!isset($_SESSION)){
  session_start();
}
?>
<footer class="main-footer">
    <strong>Copyright &copy; 2021 <a href="#">KonJae</a></strong>
    All rights reserved.

  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
</body>
<!-- jQuery -->
<script src="../common/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../common/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

<!-- Bootstrap 4 -->
<script src="../common/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../common/plugins/chart.js/Chart.min.js"></script>
<script src="../common/plugins/chart.js/Chart.js"></script>

<!-- Sparkline -->
<script src="../common/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../common/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../common/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../common/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../common/plugins/moment/moment.min.js"></script>
<script src="../common/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../common/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../common/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../common/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../common/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="../common/plugins/toastr/toastr.min.js"></script>
<script src="../common/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../common/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../common/dist/js/demo.js"></script>
<script src="../common/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../common/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../common/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>


<script src="../common/plugins/datatables/pdfmake.min.js"></script>
<script src="../common/plugins/datatables/vfs_fonts.js"></script>
<script src="../common/plugins/datatables/jszip.min.js"></script>
<script src="../common/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="../common/plugins/datatables/buttons.print.min.js"></script>
<script src="../common/plugins/datatables/buttons.html5.min.js"></script>
<script src="../common/plugins/datatables/buttons.flash.min.js"></script>


<?php if( isset ($_SESSION['msg'])) { 
    ?>
    <script>
     $(function() {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 5000
    });
    Toast.fire({
        icon: '<?php echo $_SESSION['msg']['icon']; ?>',
        title: '<?php echo $_SESSION['msg']['description']; ?>', 
      })
      Swal.fire({
        icon: '<?php echo $_SESSION['msg']['icon']; ?>',
        title: '<?php echo $_SESSION['msg']['title']; ?>',
        text: '<?php echo $_SESSION['msg']['description']; ?>',
        footer: '<a>KonJae B2B Solutions </a>',
  
      });
     });

    </script>
                               
    <?php
    unset ($_SESSION['msg'] ); 
        }   
    ?>
<script>
$(function(){
  $("#datatable").DataTable();
});    
    $(document).ready(function()
{
   $('.mt-2 ul li ul.nav-treeview li a').click(function(e){
     if ($(this).attr('class') != 'active'){
       $('.mt-2 ul li a').removeClass('active');
       $(this).addClass('active');
     }
   });
	   $('a').filter(function(){
			return this.href === document.location.href;
	   }).addClass('active')
	   $("ul.nav-treeview > li > a").each(function () {
         var currentURL = document.location.href;
         var thisURL = $(this).attr("href");
         if (currentURL.indexOf(thisURL) != -1) {
	         $(this).parents("ul.nav-treeview").css('display', 'block');
         }
       });
       $('.mt-2 > ul > li > a').each(function(){
      var currURL = document.location.href;
	  var myHref= $(this).attr('href');
      if (currURL.match(myHref)) {
			$(this).addClass('active');
			$(this).parent().find("ul.nav-treeview").css('display', 'block');
	  }
	});
}); 
</script>