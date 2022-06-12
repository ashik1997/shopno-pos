@extends('layouts.app')
@section('title', 'Settings')
@section('link')
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{asset('backend/')}}/plugins/fontawesome-free/css/all.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="{{asset('backend/')}}/dist/css/adminlte.min.css">
@endsection
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
	    <div class="row mb-2">
	      <div class="col-sm-6">
	        <h1 class="m-0 text-dark">Settings</h1>
	      </div><!-- /.col -->
	      <div class="col-sm-6">
	        <ol class="breadcrumb float-sm-right">
	          <li class="breadcrumb-item"><a href="#">Home</a></li>
	          <li class="breadcrumb-item active">Site info</li>
	        </ol>
	      </div><!-- /.col -->
	    </div><!-- /.row -->
	  </div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">

        	<div class="card-header">
	            <h3 class="card-title">Site information</h3>
        	</div>
        	@if ($errors->any())
            <div class="alert alert-danger alert-dismissible" id="myAlert">
              <a href="" class="close">&times;</a>
              <ul>
              @foreach ($errors->all() as $error)
                <li>
                <strong>Oh sanp!</strong> {{ $error }}
                </li>
              @endforeach
              </ul>
            </div>
            @endif

	        <form action="{{ route('site-info') }}" method="post" enctype="multipart/form-data">
	        	@csrf
	          <!-- /.card-header -->
		        <div class="card-body">
		        	<div class="row">
	              <div class="col-md-6">
	                <div class="form-group">
	                  <label for="site_name">Site name</label>
	                  <input type="text" name="site_name" id="site_name" class="form-control" value="{{ $site_info->site_name }}">
	                </div>
	              </div>
	              <div class="col-md-6">
	                <div class="form-group">
	                  <label for="phone">Phone</label>
	                  <input type="text" name="phone" id="phone" class="form-control" value="{{ $site_info->phone }}">
	                </div>
	              </div>
	              <div class="col-md-6">
	                <div class="form-group">
	                  <label for="email">Email</label>
	                  <input type="email" name="email" id="email" class="form-control" value="{{ $site_info->email }}">
	                </div>
	                <!-- /.form-group -->
	              </div>
	              <div class="col-md-6">
	                <div class="form-group">
	                  <label for="short_about">Short about</label>
	                  <textarea name="short_about" id="short_about" class="form-control">{{ $site_info->short_about }}</textarea>
	                </div>
	                <!-- /.form-group -->
	              </div>
	              <div class="col-md-6">
	                <div class="form-group">
	                  <label for="address">Address</label>
	                  <textarea name="address" id="address" class="form-control">{{ $site_info->address }}</textarea>
	                </div>
	                <!-- /.form-group -->
	              </div>
	              <div class="col-md-6">
	                <div class="form-group">
	                  <label for="map_embed">Map embed (Width: 100%)</label>
	                  <textarea name="map_embed" id="map_embed" class="form-control">{!!$site_info->map_embed!!}</textarea>
	                </div>
	                <!-- /.form-group -->
	              </div>
	              <!-- /.col -->
		        	</div>
		          <!-- /.row -->

	            <h5><i class="fas fa-flag" aria-hidden="true"></i> Site Logo</h5>
	            <hr>
	            <div class="row">
	            	<div class="col-md-4 form-group">
									<label for="header_logo">Header logo (Dimensions: 180x56)</label>
									<input type="file" name="header_logo" id="header_logo"  @change="header_logo($event)" class="form-control-file">
									<br>
									<img :src="form.header_logo" alt="" width="180" height="56">
	              </div>
	              <div class="col-md-4 form-group">
									<label for="footer_logo">Footer logo (Dimensions: 180x56)</label>
									<input type="file" name="footer_logo" id="footer_logo"  @change="footer_logo($event)" class="form-control-file">
									<br>
									<img :src="form.footer_logo" alt="" width="180" height="56">
	              </div>
	              <!-- /.col -->
	            </div>
	            <!-- /.row -->
		        </div>
		        <!-- /.card-body -->
		    
	        	<div class="card-footer">
	        		<button type="submit" name="update" class="btn btn-outline-success btn-lg">Update</button>
	        	</div>
	        </form>
        </div>
        <!-- /.card -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content -->
@endsection
@section('script')
<!-- vue -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.17/vue.js"></script>
<!-- jQuery -->
<script src="{{asset('backend/')}}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('backend/')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('backend/')}}/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('backend/')}}/dist/js/demo.js"></script>
<script>
  var app = new Vue({
      el: "#app",
      data: {
          form: {
          	header_logo: "/images/logo/{{ $site_info->header_logo }}",
          	footer_logo: "/images/logo/{{ $site_info->footer_logo }}",
          },
          rows: [
                {}
            ]
      },
      methods: {
        header_logo(event){
	        let file = event.target.files[0];
	        let reader = new FileReader();
	        reader.onload = (e) => {
	        // The file's text will be printed here
	        this.form.header_logo = e.target.result
	        };
	        reader.readAsDataURL(file);
        },
        footer_logo(event){
	        let file = event.target.files[0];
	        let reader = new FileReader();
	        reader.onload = (e) => {
	        // The file's text will be printed here
	        this.form.footer_logo = e.target.result
	        };
	        reader.readAsDataURL(file);
        },
        addRow: function () {
          this.rows.push({});
        },
        removeElement: function (row) {
          var index = this.rows.indexOf(row);
          this.rows.splice(index, 1);
        },
      }
  });
</script> 
@endsection