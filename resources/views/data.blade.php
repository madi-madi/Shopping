
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
         <a  href="{{url('/add-cart/'.$product->id)}}" class="btn btn-success pull-right " id ="{{$product->id}}" role="button">
          <i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i> Add to cart</a>
          <a  href="{{url('/remove-cart/'.$product->id)}}" class="btn btn-success pull-right remove"
           id ="{{$product->id}}" role="button">
          <i class="fa fa-shopping-cart fa-lg " aria-hidden="true"></i> remove cart</a>
               <!--   <a href="{{url('/add-cart/'.$product->id)}}" class="btn btn-success pull-right"
         role="button">Add to cart</a>  -->
       
      </div>
    </div>
  </div>

@endforeach
</div>
  {{$products->links()}}
