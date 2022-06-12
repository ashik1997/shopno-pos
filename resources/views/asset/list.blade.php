<!-- store_id
name
purchase_date
unit_price
qty
amount -->
@extends('layouts.app')
@section('title', 'Asset List')
@section('link')
<!-- Font Awesome -->
<link rel="stylesheet" href="{{asset('backend/')}}/plugins/fontawesome-free/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="{{asset('backend/')}}/ionicons/2.0.1/css/ionicons.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('backend/')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<!-- Theme style -->
<link rel="stylesheet" href="{{asset('backend/')}}/dist/css/adminlte.min.css">
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Asset</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Asset</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Asset information</h3>
            <div class="card-tools">
              <a href="{{route('asset-add')}}" class="btn btn-success float-right">Add New</a>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="table-responsive">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>asset_id</th>
                  <th>store_id</th>
                  <th>name</th>
                  <th>unit_price</th>
                  <th>qty</th>
                  <th>total</th>
                  <th>purchase_date</th>
                  <th>action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($assets as $key => $asset)
                <tr>
                  <td>{{$asset->id}}</td>
                  <td>{{$asset->store->name}}</td>
                  <td>{{$asset->name}}</td>
                  <td>{{$asset->unit_price}}</td>
                  <td>{{$asset->qty}}</td>
                  <td>{{$asset->amount}}</td>
                  <td>{{$asset->purchase_date}}</td>
                  <td><span class="btn-group"><a href="{{route('asset-edit',$asset->id)}}"class="btn btn-primary">edit</a><a href="{{route('asset-delete',$asset->id)}}"class="btn btn-danger">delete</a></span></td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>asset_id</th>
                  <th>store_id</th>
                  <th>name</th>
                  <th>unit_price</th>
                  <th>qty</th>
                  <th>total</th>
                  <th>purchase_date</th>
                  <th>action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <span class="float-right">{{ $assets->links() }}</span>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
@section('script')
<!-- jQuery -->
<script src="{{asset('backend/')}}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('backend/')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="{{asset('backend/')}}/plugins/datatables/jquery.dataTables.js"></script>
<script src="{{asset('backend/')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('backend/')}}/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('backend/')}}/dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": false,
      "autoWidth": false,
    });
  });
</script>
@endsection