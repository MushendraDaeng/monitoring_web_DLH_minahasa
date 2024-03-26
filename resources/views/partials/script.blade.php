  <!-- Bootstrap JS -->
	<script src="{{ asset ('../rukada/vertical/assets/js/bootstrap.bundle.min.js') }}"></script>
	<!--plugins-->
	<script src="{{ asset ('../rukada/vertical/assets/js/jquery.min.js') }}"></script>
	<script src="{{ asset ('../rukada/vertical/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
	<script src="{{ asset ('../rukada/vertical/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
	
	<script src="{{ asset ('../rukada/vertical/assets/plugins/fancy-file-uploader/jquery.ui.widget.js') }}"></script>
	<script src="{{ asset ('../rukada/vertical/assets/plugins/fancy-file-uploader/jquery.fileupload.js') }}"></script>
	<script src="{{ asset ('../rukada/vertical/assets/plugins/fancy-file-uploader/jquery.iframe-transport.js') }}"></script>
	<script src="{{ asset ('../rukada/vertical/assets/plugins/fancy-file-uploader/jquery.fancy-fileupload.js') }}"></script>
	<script src="{{ asset ('../rukada/vertical/assets/plugins/Drag-And-Drop/dist/imageuploadify.min.js') }}"></script>

  {{-- <script src="{{asset('../pspdfkit/pspdfkit.js')}}"></script> --}}

	<!--notification js -->
	<script src="{{ asset ('../rukada/vertical/assets/plugins/notifications/js/lobibox.min.js') }}"></script>
	<script src="{{ asset ('../rukada/vertical/assets/plugins/notifications/js/notifications.min.js') }}"></script>
	<script src="{{ asset ('../rukada/vertical/assets/plugins/notifications/js/notification-custom-script.js') }}"></script>

	<script src="{{ asset ('../rukada/vertical/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
	<script src="{{ asset ('../rukada/vertical/assets/plugins/apexcharts-bundle/js/apexcharts.min.js') }}"></script>
	<script src="{{ asset ('../rukada/vertical/assets/js/dashboard-human-resources.js') }}"></script>
	<script src="{{ asset ('../rukada/vertical/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset ('../rukada/vertical/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}">
	
	
	
	<!--app JS-->
	<script>
		$(document).ready(function() {
			$('#example').DataTable();
		  } );
	</script>
	
	<script>
		$(document).ready(function() {
			var table = $('#example2').DataTable( {
				lengthChange: false,
				buttons: [ 'copy', 'excel', 'pdf', 'print']
			} );
		 
			table.buttons().container()
				.appendTo( '#example2_wrapper .col-md-6:eq(0)' );
		} );
	</script>

	
	@stack('addons-script')
	
	<!--app JS-->
	<script src="{{ asset ('../rukada/vertical/assets/js/app.js') }}"></script>
	