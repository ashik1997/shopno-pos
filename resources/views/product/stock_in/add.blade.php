<!-- batch_id
product_id
supplier_id
purchase_price
sell_price
rack_id
expiration_date
alert_date -->
@extends('layouts.app')
@section('title', 'Stock In')
@section('link')
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{asset('backend/')}}/plugins/fontawesome-free/css/all.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('backend/')}}/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{asset('backend/')}}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="{{asset('backend/')}}/dist/css/adminlte.min.css">
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Stock In</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Stock In</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Product information</h3>
            <div class="card-tools">
              <a href="{{route('product-list')}}" class="btn btn-success float-right"><i class="fa fa-angle-double-left"></i> Back</a>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-3 form-group">
                <label for="product_id">Product</label>
                <select v-model="product_id" @change='getProductName();' name="product_id" class="form-control form-control-sm select2">
                  <option value="0">Select one</option>
                  @foreach($products as $key => $product)
                  <option value="{{$product->id}}">{{$product->name}}({{$product->id}})</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-3 form-group">
                <label for="supplier_id">Supplier</label>
                <select v-model="supplier_id" name="supplier_id" @change='getSupplierName();' class="form-control form-control-sm select2">
                  <option value="0">Select one</option>
                  @foreach($suppliers as $key => $supplier)
                  <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-2 form-group">
                <label for="qty">Quantity</label>
                <input type="text" v-model="qty" name="qty" class="form-control form-control-sm" value="{{old('qty')}}">
              </div>
              <div class="col-md-2 form-group">
                <label for="expiration_date">Expiration Date</label>
                <input type="date" v-model="expiration_date" name="expiration_date" class="form-control form-control-sm" value="{{old('expiration_date')}}">
              </div>
              <div class="col-md-2 form-group">
                <label for="alert_date">Alert Date</label>
                <div class="input-group input-group-sm">
                  <input type="date" class="form-control form-control-sm" v-model="alert_date" name="alert_date" value="{{old('alert_date')}}">
                  <span class="input-group-append">
                    <button type="button" class="btn btn-info btn-flat" @click="addRow"><i class="fas fa-plus"></i></button>
                  </span>
                </div>
              </div>
            </div>
          </div>
          <form action="{{route('product-stock-in')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="card-body">
            <div class="row" v-if="product_rows.length > 0">
              <div class="col-12 col-sm-12">
                <div class="col-md-12">
                  <table id="mytable" class="table table-bordred table-striped table-responsive">
                    <thead>
                      <tr>
                        <th rowspan="2">Product</th>
                        <th rowspan="2">Supplier</th>
                        <th rowspan="2">Qty</th>
                        <th colspan="2">Price</th>
                        <th rowspan="2">Rack ID</th>
                        <th rowspan="2">Expiration Date</th>
                        <th rowspan="2">Alert Date</th>
                      </tr>
                      <tr>
                        <th>Purchase</th>
                        <th>Sale</th>
                      </tr>
                    </thead>
                    <tbody id="add_more_section">
                      <tr v-for="(row,k) in product_rows" :key="k">
                        <td>@{{row.product_name}}<input type="hidden" name="product_id[]" id="product_id" v-model="row.product_id"></td>
                        <td>@{{row.supplier_name}}<input type="hidden" name="supplier_id[]" id="supplier_id" v-model="row.supplier_id"></td>
                        <td><input type="text" name="qty[]" id="qty" v-model="row.qty" style="width:100px;"></td>
                        <td><input type="text" name="purchase_price[]" id="purchase_price" style="width:100px;"></td>
                        <td><input type="text" name="sell_price[]" id="sell_price" style="width:100px;"></td>
                        <td>
                          <select name="rack_id[]" style="padding: 3px 3px;">
                            <option value="0">Select One</option>
                             <option v-for="rack in racks" :value="rack.id">@{{rack.name}}</option>
                          </select>
                        </td>
                        <td><input type="date" name="expiration_date[]" id="expiration_date" v-model="row.expiration_date"></td>
                        <td><div class="input-group-append">
                          <input type="date" name="alert_date[]" id="alert_date" v-model="row.alert_date">
                            <span  v-on:click="removeElement(row);" style="cursor: pointer" title="remove" class="input-group-text text-danger"><i class="fas fa-minus"></i></span>
                          </div></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <div class="card-body" v-if="product_rows.length > 0">
            <div class="row">
              <div class="col-md-2 form-group">
                <label for="stock_date">Stock Date</label>
                <input type="date" name="stock_date" class="form-control form-control-sm" value="{{old('stock_date')}}">
              </div>
              <div class="col-md-2 form-group">
                <label for="invoice_no">Invoice no.</label>
                <input type="text" name="invoice_no" class="form-control form-control-sm" value="{{old('invoice_no')}}">
              </div>
              <div class="col-md-3 form-group">
                <label for="store_id">Store</label>
                <select v-model="store_id" name="store_id" class="form-control form-control-sm select2">
                  <option value="0">Select one</option>
                  @foreach(App\Store::get() as $key => $store)
                  <option value="{{$store->id}}">{{$store->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-2 form-group">
                <label for="batch">Batch</label>
                <input type="text" name="batch" class="form-control form-control-sm" value="{{App\Batch::count()+1}}">
              </div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <div class="row">
              <div class="col-12">
                <input type="submit" value="Submit" class="btn btn-success float-right">
              </div>
            </div>
          </div>
          <!-- /.card-footer -->
          </form>
        </div>
        <!-- /.card -->
      </div>
    </div>
</section>
<!-- /.content -->
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- vue -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.17/vue.js"></script>
<!-- jQuery -->
<script src="{{asset('backend/')}}/plugins/jquery/jquery.min.js"></script>
<!-- Select2 -->
<script src="{{asset('backend/')}}/plugins/select2/js/select2.full.min.js"></script>
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
    product_id: 0,
    product_name: '',
    supplier_id: 0,
    supplier_name: '',
    expiration_date: '',
    alert_date: '',
    qty: 0,
    racks: '',
    product_rows: []
  },
  methods: {
    getProductName: function(){
      axios.get('/api/product/' + this.product_id)
      .then(function (response) {
        app.product_name = response.data[0]['name'];
      }); 
    },
    getSupplierName: function(){
      axios.get('/api/supplier/' + this.supplier_id)
      .then(function (response) {
        app.supplier_name = response.data[0]['name'];
      }); 
    },
    grtRacks: function(){
      axios.get('/api/racks')
      .then(function (response) {
        app.racks = response.data;
      }); 
    },
    addRow: function () {
      this.product_rows.push({ product_id: this.product_id, product_name: this.product_name, supplier_name: this.supplier_name, supplier_id: this.supplier_id,expiration_date: this.expiration_date,alert_date: this.alert_date,qty: this.qty});
    },
    removeElement: function (row) {
      var index = this.product_rows.indexOf(row);
      this.product_rows.splice(index, 1);
    },
    setFilename: function (event) {
      this.filename = event.target.name;
    }
  },
  beforeMount(){
    this.grtRacks();
  }
});
</script> 
@endsection