@extends('layouts.app')
@section('title', 'Stock Details')
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
        <h1>Stock Details</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item ">Stock</li>
          <li class="breadcrumb-item active">Details</li>
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
            <h3 class="card-title">Stock Details</h3>
            <div class="card-tools">
              <a href="{{route('product-stock-in-list')}}" class="btn btn-success float-right"><i class="fa fa-angle-double-left"></i>  Back</a>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="table-responsive">
              <table id="" class="table">
                <thead>
                <tr>
                  <th>invoice_no</th>
                  <th>store</th>
                  <th>stock_in_date</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>{{$batch->invoice_no}}</td>
                  <td>{{$batch->store->name}}</td>
                  <td>{{$batch->stock_date}}</td>
                </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-body">

            <div class="table-responsive">
              <table id="" class="table">
                <thead>
                  <tr>
                    <th>batch</th>
                    <th>product</th>
                    <th>supplier</th>
                    <th>qty</th>
                    <th>purchase price</th>
                    <th>sell price</th>
                    <th>total price</th>
                    <th>expiration date</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                  $total_qty = 0;
                  $total_price = 0;
                  @endphp
                  @foreach($batch->stock_ins as $stock_in)
                  @php
                  $total_qty += $stock_in->q;
                  $total_price += $stock_in->purchase_price*$stock_in->qty;
                  @endphp
                  <tr>
                    <td>{{$batch->id}}</td>
                    <td>{{App\Product::where('id',$stock_in->product_id)->pluck('name')[0]}}</td>
                    <td>{{App\Suppliers::where('id',$stock_in->supplier_id)->pluck('name')[0]}}</td>
                    <td>{{$stock_in->qty}}</td>
                    <td>{{$stock_in->purchase_price}}</td>
                    <td>{{$stock_in->sell_price}}</td>
                    <td>{{$stock_in->purchase_price*$stock_in->qty}}</td>
                    <td>{{$stock_in->expiration_date}}</td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th></th>
                    <th></th>
                    <th>total</th>
                    <th>{{$total_qty}}</th>
                    <th></th>
                    <th></th>
                    <th>{{$total_price}}</th>
                    <th></th>
                  </tr>
                </tfoot>
              </table>
            </div>
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