





@foreach($invoice->products as $product )
{{$product->title}}
{{$product->price}}
{{$product->id}}
@endforeach