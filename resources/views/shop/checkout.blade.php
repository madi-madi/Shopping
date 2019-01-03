@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
			<h1> Checkout </h1>
			<h4>Your Total : {{$total}}$</h4>
			<div id= "charge-error"class="alert alert-danger {{!Session::has('error') ? 'hidden' : ''}}">
							{{ Session::get('error')}}
			</div>
			<form action="/checkout" method="post" id = "checkout-form">
				<div class="col-xs-12">
					<div class="form-grop">
						<label for="name">Name</label>
						<input type="text" id= "name" name="name" class="form-control" required/>
					</div>
				</div>

				<div class="col-xs-12">
					<div class="form-grop">
						<label for="adress">Address</label>
						<input type="text" id= "adress" name="address" class="form-control" required/>
					</div>
				</div>

				<div class="col-xs-12">
					<div class="form-grop">
						<label for="card-name">Card Holder Name</label>
						<input type="text" id= "card-name" name="card-name" class="form-control" required/>
					</div>
				</div>
				

				<div class="col-xs-12">
					<div class="form-grop">
						<label for="card-number">Credit Card Number</label>
						<input type="text" id= "card-number" name="card-number" class="form-control" required/>
					</div>
				</div>

				<div class="col-xs-12">
					<div class="col-xs-6">
					<div class="form-grop">
						<label for="card-expiry-month">Expiration Month</label>
						<input type="text" id= "card-expiry-month" name="card-expiry-month"
						 class="form-control" required/>
					</div>
					</div>
					<div class="col-xs-6">
					<div class="form-grop">
						<label for="card-expiry-year">Expiration Year</label>
						<input type="text" id= "card-expiry-year" name="card-expiry-year"
						 class="form-control" required/>
					</div>
					</div>
				</div>

				<div class="col-xs-12 clearfix">
					<div class="form-grop">
						<label for="card-cvc">CVC Card</label>
						<input type="text" id= "card-cvc" 
						name= "card-cvc" class="form-control" required/>
					</div>
				</div>
				{{csrf_field()}}

				<br/> <br/>
				<div class="col-xs-12 ">
				<button type="submit" class="btn btn-success "> Buy Now</button>
				</div>
			</form>
		</div>
	</div>
	</div>
	@endsection

	@section('footer')
	<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
	<script type="text/javascript" src="{{URL::to('/js/checkout.js')}}"></script>

	@endsection