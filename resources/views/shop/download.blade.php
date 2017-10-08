@extends('layouts.app')

@section('content')


<div class="container">
	
	<div class="row">

		<div class="col-sm-8 col-md-8 col-md-offset-2 col-sm-offset-2 download">
			<h1>Download Your Files </h1>


     
              {!!Form::open(['url'=>'/invoice/'.$invoice->id .'/download-all' , 
        'id' => 'ordersubmitform' ,  ])!!}
{!!Form::submit('Download All' , ['class'=>'btn btn-success pull-right dowload-all ' ,'onclick'=>'submitForm(this)' ])!!}

      {!!Form::close()!!}
			<table class="table">
  <thead class="thead-inverse">
    <tr>
      <th>#</th>
      <th>Product Name</th>
      <th>Download</th>
      <th>Sstatus



      </th>
    </tr>
  </thead>
  <tbody>

  	@foreach($invoice->product as $product)
    <tr>
      <th scope="row">{{$product->id}}</th>
      <td>{{$product->title}}</td>
      <td>


      	{!!Form::open(['url'=>'invoice/'.$invoice->id.'/'.$product->id .'/download' , 
      	'id' => 'ordersubmitform' ])!!}
{!!Form::submit('Download' , ['class'=>'btn btn-primary','onclick'=>'submitForm(this)' ])!!}
		   <a href="{{url('invoice/'.$invoice->id.'/'.$product->id .'/download')}}" class="btn btn-large pull-right"> 	
      	
      </a>
      {!!Form::close()!!}


      </td>
      <td class="lable lable-success">Done</td>
    </tr>
    @endforeach

  </tbody>
</table>


			</div>
			</div>
		</div><!-- end Container -->


@endsection

@section('footer')
<script type="text/javascript">
    function submitForm(btn) {
        // disable the button
        btn.disabled = true;
        // submit the form    
        btn.form.submit();
    }
</script>
@endsection