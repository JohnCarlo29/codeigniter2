<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
            </div>
         </div>
        <!-- /page content -->
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url('assets/vendors/jquery/dist/jquery.min.js');?>"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url('assets/vendors/bootstrap/dist/js/bootstrap.min.js');?>"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url('assets/vendors/nprogress/nprogress.js');?>"></script>
    
    
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url('assets/build/js/custom.min.js');?>"></script>

    <script src="<?php echo base_url('assets/js/jquery.dataTables.min.js');?>"></script>
    <script src="<?php echo base_url('assets/js/dataTables.bootstrap.min.js');?>"></script>
    <script src="<?php echo base_url('assets/js/sweetalert.min.js');?>"></script>
    <script>
        var csrf_token = '<?php echo $this->security->get_csrf_hash(); ?>';
    </script>
    <script src="<?php echo base_url('assets/js/myscript.js');?>"></script>

  </body>
</html>