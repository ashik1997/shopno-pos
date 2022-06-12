<!-- supplier_id
bank_account_id
amount
note
paid_date -->
@extends('layouts.app')
@section('title', 'Supplier Payment List')
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
        <h1>Supplier Payment</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Supplier Payment</li>
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
            <h3 class="card-title">Supplier payment information</h3>
            <div class="card-tools">
              <a href="{{route('supplier-payment-add')}}" class="btn btn-success float-right">Add New</a>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="table-responsive">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>supplier_payment_id</th>
                  <th>supplier_id</th>
                  <th>bank_account_id</th>
                  <th>amount</th>
                  <th>note</th>
                  <th>paid_date</th>
                  <th>action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($supplier_payments as $key => $supplier_payment)
                <tr>
                  <td>{{$supplier_payment->id}}</td>
                  <td>{{$supplier_payment->supplier->name}}<br>{{$supplier_payment->supplier->phone}}</td>
                  <td>{{$supplier_payment->bank_account->bank_name}}<br>{{$supplier_payment->bank_account->account_no}}</td>
                  <td>{{$supplier_payment->amount}}</td>
                  <td>{{$supplier_payment->note}}</td>
                  <td>{{$supplier_payment->paid_date}}</td>
                  <td><span class="btn-group"><a href="{{route('supplier-payment-edit',$supplier_payment->id)}}"class="btn btn-primary">edit</a><a href="{{route('supplier-payment-delete',$supplier_payment->id)}}"class="btn btn-danger">delete</a></span></td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>supplier_payment_id</th>
                  <th>supplier_id</th>
                  <th>bank_account_id</th>
                  <th>amount</th>
                  <th>note</th>
                  <th>paid_date</th>
                  <th>action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <span class="float-right">{{ $supplier_payments->links() }}</span>
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