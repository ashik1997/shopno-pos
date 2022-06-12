<!-- user_id
bank_account_id
note
pay_for_month
paid_date
amount -->
@extends('layouts.app')
@section('title', 'Salary Pay List')
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
        <h1>Salary Pay</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Salary Pay</li>
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
            <h3 class="card-title">Salary pay information</h3>
            <div class="card-tools">
              <a href="{{route('salary-pay-add')}}" class="btn btn-success float-right">Add New</a>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="table-responsive">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>salary_pay_id</th>
                  <th>employee_id</th>
                  <th>bank_account_id</th>
                  <th>amount</th>
                  <th>note</th>
                  <th>pay_for_month</th>
                  <th>paid_date</th>
                  <th>action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($salary_pays as $key => $salary_pay)
                <tr>
                  <td>{{$salary_pay->id}}</td>
                  <td>{{$salary_pay->user->name}}<br>{{$salary_pay->user->phone}}</td>
                  <td>{{$salary_pay->bank_account->bank_name}}<br>{{$salary_pay->bank_account->account_no}}</td>
                  <td>{{$salary_pay->amount}}</td>
                  <td>{{$salary_pay->note}}</td>
                  <td>{{$salary_pay->pay_for_month}}</td>
                  <td>{{$salary_pay->paid_date}}</td>
                  <td><span class="btn-group"><a href="{{route('salary-pay-edit',$salary_pay->id)}}"class="btn btn-primary">edit</a><a href="{{route('salary-pay-delete',$salary_pay->id)}}"class="btn btn-danger">delete</a></span></td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>salary_pay_id</th>
                  <th>employee_id</th>
                  <th>bank_account_id</th>
                  <th>amount</th>
                  <th>note</th>
                  <th>pay_for_month</th>
                  <th>paid_date</th>
                  <th>action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <span class="float-right">{{ $salary_pays->links() }}</span>
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