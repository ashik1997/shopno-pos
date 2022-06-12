@extends('layouts.app')
@section('title', 'Employee List')
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
        <h1>Employee</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Employee</li>
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
            <h3 class="card-title">Employee data</h3>
            <div class="card-tools">
              <a href="{{route('employee-add')}}" class="btn btn-success float-right">Add New</a>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="table-responsive">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>emp_id</th>
                  <th>store_id</th>
                  <th>name</th>
                  <th>phone</th>
                  <th>email</th>
                  <th>job_title</th>
                  <th>date_of_birth</th>
                  <th>join_date</th>
                  <th>salary</th>
                  <th>nid</th>
                  <th>img</th>
                  <th>blood_group</th>
                  <th>role</th>
                  <th>username</th>
                  <th>action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($employees as $key => $emp)
                <tr>
                  <td>{{$emp->id}}</td>
                  <td>@if($emp->store){{$emp->store->name}}@endif</td>
                  <td>{{$emp->name}}</td>
                  <td>{{$emp->phone}}</td>
                  <td>{{$emp->email}}</td>
                  <td>{{$emp->job_title}}</td>
                  <td>{{$emp->date_of_birth}}</td>
                  <td>{{$emp->join_date}}</td>
                  <td>{{$emp->salary}}</td>
                  <td>{{$emp->nid}}</td>
                  <td><img src="/images/employees/{{ $emp->img }}" height="60" width="60"></td>
                  <td>{{$emp->blood_group}}</td>
                  <td>{{$emp->role}}</td>
                  <td>{{$emp->username}}</td>
                  <td><span class="btn-group"><a href="{{route('employee-edit',$emp->id)}}"class="btn btn-primary">edit</a><a href="{{route('employee-delete',$emp->id)}}"class="btn btn-danger">delete</a></span></td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>emp_id</th>
                  <th>store_id</th>
                  <th>name</th>
                  <th>phone</th>
                  <th>email</th>
                  <th>job_title</th>
                  <th>date_of_birth</th>
                  <th>join_date</th>
                  <th>salary</th>
                  <th>nid</th>
                  <th>img</th>
                  <th>blood_group</th>
                  <th>role</th>
                  <th>username</th>
                  <th>action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <span class="float-right">{{ $employees->links() }}</span>
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