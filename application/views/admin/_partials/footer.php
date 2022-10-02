<footer class="main-footer text-sm">
	<strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
	<div class="float-right d-none d-sm-inline-block">
		<b>Version</b> 3.0.2-pre
	</div>
</footer>
<!-- jQuery -->
<script src="<?= base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url(); ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/moment/moment.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="<?= base_url(); ?>assets/js/adminlte.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/blockui/blockui.js"></script>
<script src="<?= base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/toastr/toastr.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables-buttons/js/buttons.jzip.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables-buttons/js/pdfmake.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables-buttons/js/vfs_font.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables-fixedcolumns/js/dataTables.fixedColumns.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
	let baseUrl = "<?= base_url(); ?>";
	$("#btn-logout").click(function(){
    Swal.fire({
	    title: "Logout",
	    text: "Yakin akan logout ?",
	    icon: 'warning',
	    showCancelButton: true,
	    confirmButtonColor: '#3085d6',
	    cancelButtonColor: '#d33',
	    confirmButtonText: "Ya",
	    cancelButtonText: "Tidak"
    }).then((result) => {
      if (result.value) {
	      let config = {
	        url: `${baseUrl}Auth/logout`
	      }

	      $.ajax(config)
	      .then(function(data) {
	        window.location.href = baseUrl;
	      })
	      .fail(function(){
          Toast.fire({
            type: 'error',
            title: msg.fail.save
          });
	      });
      }
    });
	});
</script>