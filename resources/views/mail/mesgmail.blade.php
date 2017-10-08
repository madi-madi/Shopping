

<div class="container" style="text-align:center;" >
    <div class="row">
        <div class="">
        	<h2 style="color:#000">Hello   <strong style="color:#6fda44;">{{Auth::user()->name}}</strong></h2>
			<h3 style="color:#000">Your purchase was <span style="color:#6fda44;">successful</span>  in this Invoice </h3>
            <div class="panel panel-default">

                <div class="panel-body" style="text-align:center;">
  <center> <table class="table table-inverse" style="border:1px solid #ccc; ">
  <thead>
  	    <tr style="border:1px solid #ccc; padding:70px; text-align:center;">
      <th style="border:1px solid #ccc;text-align:center;">Invoice id : {{$invoices->id}}</th>
      <th style="border:1px solid #ccc;text-align:center;"> <img src="http://teus.kz/images/internet_magazin487x361.jpg" width="100px" height="100px"></th>
      <th style="border:1px solid #ccc; text-align:center;">Invoice Name :{{Auth::user()->name}}</th>
    </tr>
    <tr style="border:1px solid #ccc; padding:70px;">
      <th style="border:1px solid #ccc; text-align:center;">#</th>
      <th style="border:1px solid #ccc; text-align:center;">Product Name</th>
      <th style="border:1px solid #ccc; text-align:center;">Product Price</th>
    </tr>
  </thead>
  <tbody>
  	@foreach($invoices->product as $product)
    <tr style="border:1px solid #ccc; padding:70px;">
      <th scope="row" style="border:1px solid #ccc; text-align:center;">{{$product->id}}</th>
      <td style="border:1px solid #ccc; text-align:center;">{{$product->title}}</td>
      <td style="border:1px solid #ccc; text-align:center;">{{$product->price}}</td>
      
    </tr>
    @endforeach

  </tbody>
</table>
</center>
                
            </div>
            <p style="color:#000"> Thank you enjoy shopping with us ....</p>
<p style="color:#000"> Can you Download products in link </p><a href="{{url('invoice/'.$invoices->id.'/download')}}">
   {{'invoice/'.$invoices->id.'/download'}}</a>
        </div>
    </div>
