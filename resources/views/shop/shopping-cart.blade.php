@extends('layouts.app')

@section('content')
<div class="container cart">
@if(Cookie::has('product')||Session::has('product'))
	<div class="row content-cart">
		<div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
			 <ul class="list-group">
			 	@foreach($arrayProduct as $product)
			 	<li class="list-group-item">
			 	
			 	
          <a   class="remove pull-right"
           id ="{{$product->id}}" role="button" >
          <i class="fa fa-window-close fa-lg" aria-hidden="true"></i></a>
			 		
			 	<span class="badge num">{{count($product->id)}}</span>
			 	<strong class=""> {{$product->title}}</strong>
			 	<span class="label label-success">{{$product->price}}$</span>
			 	</li>


			 	@endforeach
			 </ul>
		</div>
 			
 		

		<div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3" >
			<strong > Total Price 
				<span id="total-price">{{$count}}</span>
			 </strong>
		</div>
		<hr>




		<form action="/getCheckout" method="post" id = "checkout-form">
				{{csrf_field()}}
				
				<input type="hidden" name="pay" value="{{$count}}">
				<br/> <br/>
				<div class="col-xs-3 col-md-offset-3 ">
				<button type="submit" class="btn btn-info " style="background:#0177b5"><sup style="color:#fff;">$</sup> Buy with Pypal</button>

				
				</div>
			</form>
			<div class="col-xs-3 col-md-offset-1 ">

				<button type="" class="btn btn-info stripe" style="background:#0177b5"><sup style="color:#fff;">$</sup> Stripe </button>
</div>
			 
		@else
				<div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
			<strong> No Item in Cart !!</strong>
		</div>
	</div>
@endif

</div>


@endsection

@section('footer')

<!-- Stripe-->
<div class="fix-stripe">
<div class="form-stripe  col-md-5" style="background: #e6ebf1;">
	

<!-- Non visible scripts in the example page -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/caret/1.0.0/jquery.caret.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mobilephonenumber/1.0.7/jquery.mobilePhoneNumber.min.js"></script>

  <script src="https://js.stripe.com/v3/"></script>
<form action="{{url('/checkout')}}" method="post">
{{ csrf_field() }}
<input type="hidden" name="pay" value="{{$count}}">
  <div class="group">
    <label>
      <span>Name</span>
      <input name="cardholder-name" class="field" placeholder="Jane Doe" />
    </label>
    <label>
      <span>Phone</span>
      <input class="field" placeholder="(123) 456-7890" type="tel" />
    </label>
  </div>
  <div class="group">
    <label>

      <span>Card</span>
      <div id="card-element" class="field"></div>
    </label>
  </div>
  <button type="submit" class="pay">Pay {{$count}} $</button>
  <div class="outcome">
    <div class="error" role="alert"></div>
    <div class="success">
      Success! Your Stripe token is <span class="token"></span>
     

    </div>
  </div>
   <input type="hidden" name="token_input_stripe"  class="token_input" value="">
  	
</form>

</div>
</div>
<!-- End form Stripe -->


 <div class="not">
    <div class="col-md-3 notif text-center" >
    	<div class="text-center"><i class="fa fa-exclamation-triangle fa-2x" aria-hidden="true"></i></div>

      <div class="text-center"> Are you sure Delete ? </div>
<div >
    <a  class="no pull-left text-center">No</a>
  <a  class="yes pull-right text-center">Yes</a> 
  
</div> 
</div>
</div>
<script type="text/javascript">
 
  $(function(){

    $('.remove').click(function(){


      var product_id = $(this).attr('id');
      var pay = $('input[name="pay"]').val();

     $('.not').css({"position":"fixed", "z-index":"99999","background-color": "rgba(0,0,0,0.3)"});
     $('.notif').css({"display":"block","transform": "translate(-50%,-100%)"});
     $('.notif').animate({ top:'170px'},70);
      $('.yes').click(function(){
      			//if (jQuery(this).data('clicked',true)) {}
     	      $.get('/remove-cart',{id : product_id,  } , function(data){
        //alert(data['count']);
        $('#total').text(data['remove']);
        $('#total-price').text(data['count']);
        $('input[name="pay"]').val(data['count']);


     });
     	      $('.notif').css({"display": "none"});
     	      $('.not').css({"position":"", "z-index":"","background-color": ""});
     	      //$(this).parent()
     	     // alert('#'+product_id);
     	      $('#'+product_id).parent().fadeOut( 1600).remove();

     });




    // if ($('.yes').data('clicked', true)){
     	//alert('yes');
     	
  //   }

            $('.no').click(function(){
      	$('.notif').css({"display": "none"});
      	$('.not').css({"position":"", "z-index":"","background-color": ""});
      });
  
     // $(this).parent().remove();
      // $(this).remove();

    //  $(this).html('<a  href="{{url('/remove-cart/'.$product->id)}}" class="btn btn-success pull-right remove" id ="{{$product->id}}" role="button">'+'<i class="fa fa-shopping-cart fa-lg " aria-hidden="true">'+'</i>' +'remove cart' +'</a>');
    });
   
     $('.stripe').click(function(){

    $('.fix-stripe').css({"position":"fixed", "z-index":"99999","background-color": "rgba(0,0,0,0.3)"});
     $('.form-stripe').css({"display":"block","transform": "translate(25%,60%)"});
  });
 $(document).keyup(function(e) {
     if (e.keyCode == 27) { // escape key maps to keycode `27`
        // <DO YOUR WORK HERE>
            $('.fix-stripe').css({"position":"", "z-index":"","background-color": ""});
     $('.form-stripe').css({"display":"","transform": ""});

    }
});
    

  });    

</script>

<script type="text/javascript">
  
var stripe = Stripe('pk_test_xNM4darzR77Ku1cftYXILDcE');
var elements = stripe.elements();

var card = elements.create('card', {
  style: {
    base: {
      iconColor: '#666EE8',
      color: '#31325F',
      lineHeight: '40px',
      fontWeight: 300,
      fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
      fontSize: '15px',

      '::placeholder': {
        color: '#CFD7E0',
      },
    },
  }
});
card.mount('#card-element');

function setOutcome(result) {
  var successElement = document.querySelector('.success');
  var errorElement = document.querySelector('.error');
  successElement.classList.remove('visible');
  errorElement.classList.remove('visible');

  if (result.token) {
    // Use the token to create a charge or a customer
    // https://stripe.com/docs/charges
    successElement.querySelector('.token').textContent = result.token.id;
    $('input[name="token_input_stripe"]').val(result.token.id);
    successElement.classList.add('visible');
  } else if (result.error) {
    errorElement.textContent = result.error.message;
    errorElement.classList.add('visible');
  }
}

card.on('change', function(event) {
  setOutcome(event);
});

document.querySelector('form').addEventListener('submit', function(e) {
  e.preventDefault();
  var form = document.querySelector('form');
  var extraDetails = {
    name: form.querySelector('input[name=cardholder-name]').value,
  };
  stripe.createToken(card, extraDetails).then(setOutcome);
});

function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}
</script>


@endsection