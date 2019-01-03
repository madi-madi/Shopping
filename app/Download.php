<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    //

public function invoice_product()
{
	return $this->belongsTo('App\Invoice_Product' , 'invoice_product_id' , 'id');
}

}
