<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice_Product extends Model
{
    //
    protected $table = "invoice_product";

        protected $fillable = [
        'id', 'product_id', 'invoice_id',
    ];

    public function download()
{
	return $this->hasMany('App\Download' , 'invoice_product_id' , 'id');
}

}
