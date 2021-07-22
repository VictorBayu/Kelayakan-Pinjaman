           <!-- Footer -->
           <footer class="sticky-footer bg-white">
               <div class="container my-auto">
                   <div class="copyright text-center my-auto">
                       <span>Copyright &copy; Kelayakan Pinjaman <?= date('Y'); ?></span>
                   </div>
               </div>
           </footer>
           <!-- End of Footer -->

           </div>
           <!-- End of Content Wrapper -->

           </div>
           <!-- End of Page Wrapper -->

           <!-- Scroll to Top Button-->
           <a class="scroll-to-top rounded" href="#page-top">
               <i class="fas fa-angle-up"></i>
           </a>

           <!-- Logout Modal-->
           <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog" role="document">
                   <div class="modal-content">
                       <div class="modal-header">
                           <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                           <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                               <span aria-hidden="true">×</span>
                           </button>
                       </div>
                       <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                       <div class="modal-footer">
                           <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                           <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
                       </div>
                   </div>
               </div>
           </div>

           <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css">
           <script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>
           <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
           <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
           <script src="https://cdn.amcharts.com/lib/4/themes/dataviz.js"></script>
           <script src="https://cdn.amcharts.com/lib/4/themes/material.js"></script>
           <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
           <script src="https://cdn.amcharts.com/lib/4/themes/frozen.js"></script>
           <script src="https://cdn.amcharts.com/lib/4/themes/spiritedaway.js"></script>



           <!-- <script src="../../data-table/"></script>
           <script src="../../data-table/data-table-active.js"></script>
           <script src="../../data-table/bootstrap-table-editable.js"></script>
           <script src="../../data-table/bootstrap-editable.js"></script>
           <script src="../../data-table/bootstrap-table-resizable.js"></script>
           <script src="../../data-table/colResizable-1.5.source.js"></script>
           <script src="../../data-table/bootstrap-table-export.js"></script> -->
           <!-- Bootstrap core JavaScript-->
           <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
           <script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

           <!-- Core plugin JavaScript-->
           <script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

           <!-- Custom scripts for all pages-->
           <script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>
           <script type="text/javascript" src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

           <script src="//code.jquery.com/jquery-3.5.1.js"></script>
           <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
           <script src="//cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
           <script src="//cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
           <script src="//cdn.datatables.net/buttons/1.7.1/js/buttons.bootstrap4.min.js"></script>
           <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
           <script src="//cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
           <script src="//cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
           <script src="//cdn.datatables.net/buttons/1.7.1/js/buttons.colVis.min.js"></script>
           <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
           <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

           <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"></script>
           <script src="//cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css"></script>
           <script src="//cdn.datatables.net/buttons/1.7.1/css/buttons.bootstrap4.min.css"></script>

           <script>
               $('.custom-file-input').on('change', function() {
                   let fileName = $(this).val().split('\\').pop();
                   $(this).next('.custom-file-label').addClass("selected").html(fileName);
               });
               $('.form-check-input').on('click', function() {
                   const menuId = $(this).data('menu');
                   const roleId = $(this).data('role');
                   $.ajax({
                       url: "<?= base_url('admin/changeAccess'); ?>",
                       type: 'post',
                       data: {
                           menuId: menuId,
                           roleId: roleId
                       },
                       success: function() {
                           document.location.href = "<?= base_url('admin/roleAccess/') ?>" + roleId;
                       }
                   })
               });
           </script>
           </body>
           <script>
               $(document).ready(function() {
                   var table = $('#example').DataTable({
                       lengthChange: false,
                       searching: false,
                       //scrollY: '150px',
                       buttons: ['excel']
                   });

                   table.buttons().container()
                       .appendTo('#example_wrapper .col-md-6:eq(0)');
               });
           </script>
           <script>
               $(document).ready(function() {
                   init();
               });

               function init() {
                   $(".init-loading").html("<i class='fa fa-spin fa-refresh'></i> &nbsp;&nbsp;&nbsp;Memuat Data ...");
                   grafik();
               }

               function grafik() {
                   $.ajax({
                       url: "<?php echo base_url() ?>admin/index",
                       dataType: "json",
                       success: function(data) {
                           barChart(data, "grafik");
                       }
                   })
               }
           </script>


           </html>