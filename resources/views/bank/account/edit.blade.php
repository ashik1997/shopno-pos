
@extends('layouts.app')
@section('title', 'Edit Account')
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
        <h1>Account Edit</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Account Edit</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <form action="{{route('account-edit',$account->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Account information edit</h3>
            <div class="card-tools">
              <!-- <a href="{{route('account-list')}}" class="btn btn-success float-right"><i class="fa fa-angle-double-left"></i> Back</a> -->
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-4 form-group">
                <label for="bank_name">Bank name</label>
                <input type="text" id="bank_name" name="bank_name" class="form-control" value="{{$account->bank_name}}">
              </div>
              <div class="col-md-4 form-group">
                <label for="account_no">Account no</label>
                <input type="text" id="account_no" name="account_no" class="form-control" value="{{$account->account_no}}">
              </div>
              <div class="col-md-4 form-group">
                <label for="account_type">Account type</label>
                <select id="account_type" name="account_type" class="form-control">
                  <option @if($account->account_type=='cash') selected @endif value="cash">cash</option>
                  <option @if($account->account_type=='bank') selected @endif value="bank">bank</option>
                  <option @if($account->account_type=='mobile') selected @endif value="mobile">mobile</option>
                </select>
              </div>
              <div class="col-md-4 form-group">
                <label for="initial_balance">Initial balance</label>
                <input type="initial_balance" id="initial_balance" name="initial_balance" class="form-control" value="{{$account->initial_balance}}">
              </div>
              <div class="col-md-4 form-group">
                <label for="store_id">Store</label>
                <select id="store_id" name="store_id" class="form-control">
                  @foreach($stores as $key=>$store)
                  <option @if($account->store_id==$store->id) selected @endif value="{{$store->id}}">{{$store->name}}</option>
                  @endforeach
                </select>
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
          },
          rows: [
                {}
          ]
      },
      methods: {
        
      }
  });
</script> 
@endsection