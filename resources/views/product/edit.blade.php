
@extends('layouts.app')
@section('title', 'Edit Product')
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
        <h1>Product Edit</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Product Edit</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <form action="{{route('product-edit',$product->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Product information edit</h3>
            <div class="card-tools">
              <a href="{{route('product-list')}}" class="btn btn-success float-right"><i class="fa fa-angle-double-left"></i> Back</a>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-4 form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{$product->name}}">
              </div>
              <div class="col-md-4 form-group">
                <label for="product_category_id">Category</label>
                <select id="product_category_id" name="product_category_id" class="form-control" @change='getSubCat();' v-model="product_category_id">
                  <option v-for="cat in categories" :value="cat.id">@{{cat.name}}</option>
                </select>
              </div>
              <div class="col-md-4 form-group">
                <label for="product_sub_category_id">Sub-category</label>
                <select id="product_sub_category_id" v-model="product_sub_category_id" name="product_sub_category_id" class="form-control">
                  <option v-for="subcat in subcategories" :value="subcat.id">@{{subcat.name}}</option>
                </select>
              </div>
              <div class="col-md-4 form-group">
                <label for="brand_id">Brand</label>
                <select id="brand_id" name="brand_id" v-model="brand_id" class="form-control">
                  <option v-for="brand in brands" :value="brand.id">@{{brand.name}}</option>
                </select>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <div class="row">
              <div class="col-12">
                <input type="submit" value="Update" class="btn btn-success float-right">
              </div>
            </div>
          </div>
          <!-- /.card-footer -->
        </div>
        <!-- /.card -->
      </div>
    </div>
  </form>
</section>
<!-- /.content -->
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
        product_category_id: {{$product->product_category_id}},
        product_sub_category_id: {{$product->product_sub_category_id}},
        brand_id: {{$product->brand_id}},
        subcategories: '',
        categories: '',
        brands: '',
      },
      methods: {
        getCat: function(){
          axios.get('/api/categories')
          .then(function (response) {
            app.categories = response.data;
          }); 
        },
        getSubCat: function(){
          axios.get('/api/subcategories/' + this.product_category_id)
          .then(function (response) {
            app.subcategories = response.data;
          }); 
        },
        getBrand: function(){
          axios.get('/api/brands')
          .then(function (response) {
            app.brands = response.data;
          }); 
        },
      },
      beforeMount(){
        this.getSubCat();
        this.getCat();
        this.getBrand();
      }
  });
</script> 
@endsection