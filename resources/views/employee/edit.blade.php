
@extends('layouts.app')
@section('title', 'Edit Employee')
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
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Employee Edit</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Employee Edit</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <form action="{{route('employee-edit',$employee->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">General</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-4 form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{$employee->name}}">
              </div>
              <div class="col-md-4 form-group">
                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone" class="form-control" value="{{$employee->phone}}">
              </div>
              <div class="col-md-4 form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="{{$employee->email}}">
              </div>
              <div class="col-md-4 form-group">
                <label for="date_of_birth">Date of birth</label>
                <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" value="{{$employee->date_of_birth}}">
              </div>
              <div class="col-md-4 form-group">
                <label for="nid">NID</label>
                <input type="text" id="nid" name="nid" class="form-control" value="{{$employee->nid}}">
              </div>
              <div class="col-md-4 form-group">
                <label for="blood_group">Blood Group</label>
                <input type="text" id="blood_group" name="blood_group" class="form-control" value="{{$employee->blood_group}}">
              </div>
              <div class="col-md-4 form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image"  @change="photo($event)" class="form-control-file">
                <br>
                <img :src="form.image" alt="" width="150" height="150">
              </div>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <div class="col-md-12">
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">Others</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-4 form-group">
                <label for="store_id">Store</label>
                <select id="store_id" name="store_id" class="form-control">
                  <option value="0">Select one</option>
                  @foreach ($stores as $key => $store):
                  <option @if($employee->store_id==$store->id) selected @endif value="{{$store->id}}">{{$store->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-4 form-group">
                <label for="role">Role</label>
                <select id="role" name="role" class="form-control">
                  <option value="">Select one</option>
                  @foreach ($roles as $key => $role):
                  <option @if($employee->role==$role->name) selected @endif value="{{$role->name}}">{{$role->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-4 form-group">
                <label for="job_title">Job title</label>
                <input type="text" id="job_title" name="job_title" class="form-control" value="{{$employee->job_title}}">
              </div>
              <div class="col-md-4 form-group">
                <label for="join_date">Join date</label>
                <input type="date" id="join_date" name="join_date" class="form-control" value="{{$employee->join_date}}">
              </div>
              <div class="col-md-4 form-group">
                <label for="salary">Salary</label>
                <input type="number" id="salary" name="salary" class="form-control" value="{{$employee->salary}}">
              </div>
              <div class="col-md-4 form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control" value="{{$employee->username}}">
              </div>
              <div class="col-md-4 form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" value="">
              </div>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <a href="#" class="btn btn-secondary">Cancel</a>
        <input type="submit" value="Update" class="btn btn-success float-right">
      </div>
    </div>
  </form>
</section>
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
            image: "/images/employees/{{ $employee->img }}",
          },
          rows: [
                {}
            ]
      },
      methods: {
          photo(event){
        let file = event.target.files[0];
        let reader = new FileReader();
        reader.onload = (e) => {
        // The file's text will be printed here
        this.form.image = e.target.result
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