<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<meta name="description" content="Pokhara Engineering College">
	<meta name="keywords" content="Pokhara Engineering College, Civil Engineering, Computer Engineering">
	<meta name="author" content="Pokhara Engineering College">
	<meta name="robots" content="noindex, nofollow">
	<title>Hotel Pushp</title>

	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="/logo.jpg">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="/backend/assets/css/bootstrap.min.css">

	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="/backend/assets/css/font-awesome.min.css">

	<!-- Lineawesome CSS -->
	<link rel="stylesheet" href="/backend/assets/css/line-awesome.min.css">

	<!-- Chart CSS -->
	<link rel="stylesheet" href="/backend/assets/plugins/morris/morris.css">

	<!-- Main CSS -->
	<link rel="stylesheet" href="/backend/assets/css/style.css">
	<!-- Select2 CSS -->
	<link rel="stylesheet" href="/backend/assets/css/select2.min.css">

	<!-- Datetimepicker CSS -->
	<link rel="stylesheet" href="/backend/assets/css/bootstrap-datetimepicker.min.css">

	<!-- Datatable CSS -->
	<link rel="stylesheet" href="/backend/assets/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->

</head>

<body>
	<!-- Main Wrapper -->
	<div class="main-wrapper">

		<header>
			@include('admin.body.header')
		</header>


		@include('admin.body.sidebar')

		<!-- Page Wrapper -->
		<div class="page-wrapper">

			<!-- Page Content -->
			@yield('admin')

			<!-- /Page Content -->

		</div>
		<!-- /Page Wrapper -->

	</div>
	<!-- /Main Wrapper -->

	<!-- jQuery -->

	<script>
		CKEDITOR.plugins.addExternal('youtube', '/backend/ckeditor/plugins/youtube/', 'plugin.js');
		CKEDITOR.replace('editor', {
			filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
			filebrowserUploadMethod: 'form',
			extraPlugins: 'youtube'
		});
	</script>

	{{-- <script src="/backend/assets/js/jquery-3.5.1.min.js"></script> --}}
	<script src="/backend/assets/js/popper.min.js"></script>


	<!-- Bootstrap Core JS -->
	<script src="/backend/assets/js/bootstrap.min.js"></script>



	<!-- Slimscroll JS -->
	<script src="/backend/assets/js/jquery.slimscroll.min.js"></script>

	<!-- Chart JS -->
	<script src="/backend/assets/plugins/morris/morris.min.js"></script>
	<script src="/backend/assets/plugins/raphael/raphael.min.js"></script>
	<script src="/backend/assets/js/chart.js"></script>

	<!-- Select2 JS -->
	<script src="/backend/assets/js/select2.min.js"></script>

	<!-- Datetimepicker JS -->
	<script src="/backend/assets/js/moment.min.js"></script>
	<script src="/backend/assets/js/bootstrap-datetimepicker.min.js"></script>
	<!-- Datatable JS -->
	<script src="/backend/assets/js/jquery.dataTables.min.js"></script>
	<script src="/backend/assets/js/dataTables.bootstrap4.min.js"></script>

	<!-- Custom JS -->
	<script src="/backend/assets/js/app.js"></script>
	<script src="/backend/assets/js/handlebars.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script>
		@if(Session::has('message'))
		var type = "{{ Session::get('alert-type','info') }}"
		switch (type) {
			case 'info':
				toastr.info(" {{ Session::get('message') }} ");
				break;
			case 'success':
				toastr.success(" {{ Session::get('message') }} ");
				break;
			case 'warning':
				toastr.warning(" {{ Session::get('message') }} ");
				break;
			case 'error':
				toastr.error(" {{ Session::get('message') }} ");
				break;
		}
		@endif
	</script>

	<script>
		$(() => {
			$('#datatable').DataTable({
				"bProcessing": true,
				"sAutoWidth": false,
				"bDestroy": true,
				"sPaginationType": "bootstrap", // full_numbers
				"iDisplayStart ": 15,
				"iDisplayLength": 5,
				"bPaginate": false, //hide pagination
				"bFilter": true, //hide Search bar
				"bInfo": false, // hide showing entries
			});
		})
	</script>
</body>

</html>