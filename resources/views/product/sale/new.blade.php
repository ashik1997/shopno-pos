@extends('layouts.app')
@section('title', 'Product Sale')
@section('link')
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{asset('backend/')}}/plugins/fontawesome-free/css/all.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="{{asset('backend/')}}/dist/css/adminlte.min.css">
<style type="text/css">
	.table td, .table th {
	    padding: 2px;
	}
	.card-header {
		padding: 5px 1.25rem;
	}
	.card-body{
		padding: 5px 1.25rem;
	}
</style>
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Product Sale</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Product Sale</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <form action="{{route('product-add')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
	    <div class="col-md-8">
	        <div class="card card-primary">
	          <div class="card-header">
	            <h3 class="card-title">Select Product</h3>
	          </div>
	          <div class="card-body">
	            <div class="row">
	              <div class="col-md-12 form-group">
	              	<label for="product_id">Product code</label>
	              	<div class="input-group">
	              		<input type="text" id="product_id" v-model="product_id" name="product_id" class="form-control" value="{{old('product_id')}}">
		                <div class="input-group-append" @click='addCart();'>
		                	<span class="input-group-text" id="basic-addon2"><i class="fa fa-plus"></i></span>
		                </div>
	              	</div>
	              </div>
	            </div>
	          </div>
	          <!-- /.card-body -->
	        </div>
	        <div class="card card-primary">
	          <div class="card-body">
	            <div class="row">
	              <div class="col-md-12">
	                <table class=" table-bordered">
	                	<thead>
	                		<tr>
	                			<td width="15%">Product name</td>
	                			<td width="10%">Code</td>
	                			<td width="10%">Batch</td>
	                			<td width="10%">Stock</td>
	                			<td width="10%">Qty</td>
	                			<td width="10%">Price</td>
	                			<td width="10%">Dis</td>
	                			<td width="10%">Vat(%)</td>
	                			<td width="10%">Total</td>
	                			<td width="5%"></td>
	                		</tr>
	                	</thead>
	                	<tbody>
	                		<tr v-for="product in products">
	                			<td width="15%">@{{ product.name }}</td>
	                			<td width="10%">@{{ product.id }}</td>
	                			<td width="10%">
	                				<select name="batch_id" id="batch_id" style="width:100%">
	                					<option value="1">Batch1</option>
	                					<option value="2">Batch2</option>
	                				</select>
	                			</td>
	                			<td width="10%"><input type="text" name="stock" id="stock" style="width:100%"></td>
	                			<td width="10%"><input type="text" name="qty" id="qty" style="width:100%">@{{product.qty}}</td>
	                			<td width="10%"><input type="text" name="price" id="price" style="width:100%"></td>
	                			<td width="10%"><input type="text" name="dis" id="dis" style="width:100%"></td>
	                			<td width="10%"><input type="text" name="vat" id="vat" style="width:100%"></td>
	                			<td width="10%">Total</td>
	                			<td width="5%"></td>
	                		</tr>
	                	</tbody>
	                </table>
	              </div>
	            </div>
	          </div>
	          <!-- /.card-body -->
	        </div>
	        <!-- /.card -->
	    </div>
	    <div class="col-md-4">
	        <div class="card card-primary">
	          <div class="card-header">
	            <h3 class="card-title">Payment summery</h3>
	          </div>
	          <div class="card-body">
	          	<table class="table">
	          		<thead>
	          			<tr>
	          				<th width="60%">Item In Cart</th>
	          				<th width="40%">60</th>
	          			</tr>
	          			<tr>
	          				<th width="60%">Discount</th>
	          				<th width="40%">60</th>
	          			</tr>
	          			<tr>
	          				<th width="60%">Total amount</th>
	          				<th width="40%">60</th>
	          			</tr>
	          			<tr>
	          				<th width="60%">Paid amount</th>
	          				<th width="40%">60</th>
	          			</tr>
	          		</thead>
	          	</table>
	          </div>
	          <!-- /.card-body -->
	        </div>
	        <div class="card card-primary">
				<div class="card-header">
					<h3 class="card-title">Customer</h3>
				</div>
				<div class="card-body">
					<table style="width:100%">
						<tbody>
							<tr>
								<td>
									<select class="form-control" name="sale_person_id" id="sale_person_id" required>
								    	<option value="">Sale person</option>
								    	@foreach(App\User::where('role', 'sell_person')->get() as $sell_person)
								    	<option value="{{$sell_person->id}}">{{$sell_person->name}}</option>
								    	@endforeach
								    </select>
								</td>
							</tr>
						</tbody>
					</table>
					<div class="bg-success">
						<table style="width:100%">
							<tbody>
								<tr>
									<td>
										<select class="form-control" name="sale_person_id" id="sale_person_id">
									    	<option value="">Customer name</option>
									    	@foreach(App\Customer::get() as $customer)
									    	<option value="{{$customer->id}}">{{$customer->name}}({{$customer->phone}})</option>
									    	@endforeach
									    </select>
									</td>
								</tr>
								<tr>
									<td colspan="2" class="text-center">OR</td>
								</tr>
								<tr>
									<td>
										<input type="text" class="form-control" name="name" id="name" placeholder="Enter full name *">
									</td>
								</tr>
								<tr>
									<td>
										<input type="eamil" class="form-control" name="eamil" id="eamil" placeholder="Enter email">
									</td>
								</tr>
								<tr>
									<td>
										<input type="text" class="form-control" name="phone" id="phone" placeholder="Enter phone *">
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<!-- /.card-body -->
	        </div>
	        <div class="card card-primary">
				<div class="card-header">
					<h3 class="card-title">Discount</h3>
				</div>
				<div class="card-body">
					<table>
						<tbody>
							<tr>
								<td width="40%">Discount(%)</td>
								<td width="60%"><input type="text" class="form-control" name="discount" id="discount" placeholder="%"></td>
							</tr>
							<tr>
								<td width="40%">Partial</td>
								<td width="60%"><input type="text" class="form-control" name="partial" id="partial" placeholder="tk"></td>
							</tr>
						</tbody>
					</table>
				</div>
				<!-- /.card-body -->
	        </div>
	        <div class="card card-primary">
				<div class="card-header">
					<h3 class="card-title">Payment</h3>
				</div>
				<div class="card-body">
					<table>
						<tbody>
							<tr>
								<td width="40%">Cash payment</td>
								<td width="60%"><input type="text" class="form-control" name="cash_payment" id="cash_payment" placeholder=""></td>
							</tr>
							<tr>
								<td width="40%">Card payment</td>
								<td width="60%"><input type="text" class="form-control" name="card_payment" id="card_payment" placeholder=""></td>
							</tr>
							<tr>
								<td width="40%">Card number</td>
								<td width="60%"><input type="text" class="form-control" name="card_number" id="card_number" placeholder=""></td>
							</tr>
							<tr>
								<td width="40%">Card type</td>
								<td width="60%">
									<select class="form-control" name="card_type" id="card_type">
										<option value="">Select one</option>
										@foreach(App\PaymentCardType::get() as $card_type)
										<option value="{{$card_type->card_type}}">{{$card_type->card_type}}</option>
										@endforeach
									</select>
								</td>
							</tr>
							<tr>
								<td width="40%">Account</td>
								<td width="60%">
									<select class="form-control" name="card_type" id="card_type">
										<option value="">Select one</option>
										@foreach(App\BankAccount::where('account_type', 'bank')->get() as $bank_account)
										<option value="{{$bank_account->id}}">{{$bank_account->bank_name}} ({{$bank_account->account_no}})</option>
										@endforeach
									</select>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<!-- /.card-body -->
	        </div>
	        <div class="card card-primary">
				<div class="card-header">
					<h3 class="card-title">Mobile gateway</h3>
				</div>
				<div class="card-body">
					<table>
						<tbody>
							<tr>
								<td width="40%">Mobile payment</td>
								<td width="60%"><input type="text" class="form-control" name="mobile_bank_amount" id="mobile_bank_amount" placeholder=""></td>
							</tr>
						</tbody>
					</table>		
					<table style="">
						<tbody>		
							<tr>
								<td width="40%">Account</td>
								<td width="60%">
									<select class="form-control" name="mobile_bank" id="mobile_bank">
										<option value="">Select one</option>
										@foreach(App\BankAccount::where('account_type', 'bank')->get() as $bank_account)
										<option value="{{$bank_account->id}}">{{$bank_account->bank_name}} ({{$bank_account->account_no}})</option>
										@endforeach
									</select>
								</td>
							</tr>
							<tr>
								<td width="40%">Sender no</td>
								<td width="60%"><input type="text" class="form-control" name="sender_no" id="sender_no" placeholder=""></td>
							</tr>
							<tr>
								<td width="40%">Trx no</td>
								<td width="60%"><input type="text" class="form-control" name="trx_no" id="trx_no" placeholder=""></td>
							</tr>
						</tbody>
					</table>
				</div>
				<!-- /.card-body -->
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
      	product_id: '',
      	products: ''
      },
      methods: {
      	addCart: function(){
      		const article = { id: this.product_id };
      		// console.log(this.product_id);
      		axios.post("/api/add-to-cart", article)
          .then(function (response) {
          	// console.log(response.data);
            app.products = response.data;
          }); 
      	},
      },
      beforeMount(){
        
      }
  });
</script> 
@endsection