<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="../images/favicon.ico">

    <title>Flipmart - Dashboard</title>
	<!-- Vendors Style-->
	<link rel="stylesheet" href="{{ asset('backend/css/vendors_css.css') }}">
	  
	<!-- Style-->  
	<link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('backend/css/skin_color.css') }}">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <!-- Select2 CSS -->
  {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
 --}}

  <style>
    input::placeholder {
      color: #8a99b5 !important; /* Change this color to your desired placeholder color */
      opacity: 1; /* This is optional, default is 1 */
    }
    .select2-selection__placeholder{
      color: #8a99b5 !important;
    }
    /* Custom background color for Select2 dropdown */
    .select2-container--default .select2-selection--single {
        background-color: #272e48; 
        color: #fff;  
        border: 1px solid rgba(255, 255, 255, 0.12); 
    }

    /* Custom background color for the dropdown options */
    .select2-container--default .select2-results__option {
        background-color: #272e48; /* Dark background color for the options */
        color: #fff;      
        border: none;
    }

    /* Custom background color for the highlighted (hovered) option */
    .select2-container--default .select2-results__option--highlighted {
        background-color: #272e48; /* Darker background color for the highlighted option */
        color: #fff; 
        border: none;
    }

    /* Custom background color for the search box */
    .select2-container--default .select2-search--dropdown .select2-search__field {
        background-color: #272e48; /* Dark background color for the search box */
        color: #fff;           /* Text color for the search box */
    }
    .select2-selection__rendered{
      color: #8a99b5 !important;
    }

  </style>

    @stack('styles')
     
  </head>

<body class="hold-transition dark-skin sidebar-mini theme-primary fixed">
	
<div class="wrapper">

    @include('admin.body.header')
  
  <!-- Left side column. contains the logo and sidebar -->
  @include('admin.body.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	  <div class="container-full">

		<!-- Main content -->

    @yield('content')
    
		<!-- /.content -->
	  </div>
  </div>
  <!-- /.content-wrapper -->

  @include('admin.body.footer')

  <!-- Control Sidebar -->
@include('admin.body.controll-sidebar')
  
</div>
<!-- ./wrapper -->
  	
	 
	<!-- Vendor JS -->
	<script src="{{ asset('backend/js/vendors.min.js') }}"></script>
    <script src="{{ asset('assets/icons/feather-icons/feather.min.js') }}"></script>	
	<script src="{{ asset('assets/vendor_components/easypiechart/dist/jquery.easypiechart.js') }}"></script>
	<script src="{{ asset('assets/vendor_components/apexcharts-bundle/irregular-data-series.js') }}"></script>
	<script src="{{ asset('assets/vendor_components/apexcharts-bundle/dist/apexcharts.js') }}"></script>
	@if(Session::has('message'))
  {{ Session::get('message') }} 
  @endif

	<!-- Sunny Admin App -->
	<script src="{{ asset('backend/js/template.js') }}"></script>
	<script src="{{ asset('backend/js/pages/dashboard.js') }}"></script>

  {{-- scripts for tags input --}}
  <script src="{{ asset('assets/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js') }}"></script>

  {{-- scripts for ck editor --}}
  <script src="{{ asset('assets/vendor_components/ckeditor/ckeditor.js') }}"></script>
	<script src="{{ asset('assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js') }}s"></script>
	<script src="{{ asset('backend/js/pages/editor.js') }}"></script>

  {{-- scripts for data table --}}
  <script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script>
	<script src="{{ asset('backend/js/pages/data-table.js') }}"></script>

{{-- scripts for toastr --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <script>
    @if(Session::has('message'))
      var type = "{{ Session::get('alert-type','info') }}"
      switch(type) {
        case 'info':
        toastr.info(" {{ Session::get('message') }} ");
        toast[0].style.color = "red";
        break;
        case 'success':
        toastr.success(" {{ Session::get('message') }} ");
        break;
        case 'warning':
        toastr.warning(" {{ Session::get('message') }} ");
        break;
        case 'error':
        toastr.error(" {{ Session::get('message') }}");
        break;
      }
    @endif
  </script>


  {{-- ==== scripts for sweet alert ==== --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    $(function(){
      $(document).on('click','#delete', function(e){
        e.preventDefault();
        var link = $(this).attr('href');

        Swal.fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!"
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = link;
            Swal.fire({
              title: "Deleted!",
              text: "Your file has been deleted.",
              icon: "success"
            });
          }
        });
      });
    });
  </script>


  <!-- ============== Select2 JS ================= -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


{{-- ======= ajax ============ --}}
<script>
  $.ajaxSetup({
  headers:{
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
})
</script>
	
	
</body>
</html>
