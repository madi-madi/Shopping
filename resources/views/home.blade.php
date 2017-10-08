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
         @if(array_search($product->id , explode(',' , Cookie::get('product'))) === false)
         <a href="{{url('/add-cart/'.$product->id)}}"  class="btn btn-success pull-right  " id ="{{$product->id}}" role="button">
          <i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i> Add to cart</a>
          @else
          <a  href="{{url('/remove-cart/'.$product->id)}}" class="btn btn-success pull-right remove"
           id ="{{$product->id}}" role="button">
          <i class="fa fa-shopping-cart fa-lg " aria-hidden="true"></i> remove cart</a>
          @endif
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
     // var _token = $('input[name="_token"]').val();
      var product_id = $(this).attr('id');
     // var data = new FormData();
//alert(product_id);
     // data.append('_token' , _token);

      $.get('/add-cart',{id : product_id,  } , function(msg){
                      $('#total').text(msg['tot']);

     });

    });
   
   /* $.ajax({

      url  : {{url('/add-cart/id')}},
      type :"GET",
      data :data,
      contentType : "multipart/form-data",
      proccessData : false ,

    });*/
//console.log(data);
    

  });    

</script>

@endsection