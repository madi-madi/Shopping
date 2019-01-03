@extends('layouts.app')



@section('content')

<div class="container home">

  {{$products->links()}}

    <div class="row">


        @foreach($products as $product)
  <div class="col-sm-6 col-md-3">
    <div class="thumbnail">
      <img src="{{url('/image/'.$product->imagePath)}}" class="img-responsive" alt="...">
      <div class="caption">
        <h3>{{$product->title}}</h3>
        <p>{{$product->description}}</p>
         <a class="pull-left"><b>{{$product->price}}<sup>$</sup></b></a>
         <div id="product">
         @if(array_search($product->id , explode(',' , Cookie::get('product'))) === false )
         <a   class="btn btn-success pull-right id " id ="{{$product->id}}" role="button">
          <i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i> Add to cart</a>
          @else
          <a   class="btn btn-success pull-right remove"
           id ="{{$product->id}}" role="button">
          <i class="fa fa-shopping-cart fa-lg " aria-hidden="true"></i> remove cart</a>
          @endif
         </div>
               <!--   <a href="{{url('/add-cart/'.$product->id)}}" class="btn btn-success pull-right"
         role="button">Add to cart</a>  -->
       
      </div>
    </div>
  </div>

@endforeach
</div>
  {{$products->links()}}
</div>


@endsection



@section('footer')

<script type="text/javascript">

 
  $(function(){

    $('.id').click(function(){
      //e.preventDefault();
      var product_id = $(this).attr('id');
      $.get('/add-cart',{id : product_id,  } , function(data){
      //  alert(data['msg']);
       $('#total').text(data['msg']);

     });


    });
   

       $('.remove').click(function(){
      //e.preventDefault();
      var product_id = $(this).attr('id');
      $.get('/remove-cart',{id : product_id,  } , function(data){
      
        $('#total').text(data['msg']);
        
        
      // $('#total').text(data['remove']);

     });


    });
 
    

  });    

</script>

@endsection