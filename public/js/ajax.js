  
  $(document).ready((function(){

    $(#addCart).submit(function(e){
      e.preventDefault();
     // var _token = $('input[name="_token"]').val();
      var product_id = $('input[name="product_id"]').val();
      var data = new FormData();

     // data.append('_token' , _token);
      data.append('product_id' , product_id);
    });

    $.ajax({

      url  : {{url('/add-cart/id')}},
      type :"GET",
      data :data,
      contentType : "multipart/form-data",
      proccessData : false ,

    });
//console.log(data);
    

  });    
