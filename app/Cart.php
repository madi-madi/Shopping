<?php

namespace App;

class Cart
{
    //

    public $items = NULL;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart){
        if($oldCart){
        $this->items =$oldCart->items;
        $this->totalQty = $oldCart->totalQty;
        $this->totalPrice = $oldCart->totalPrice;

        }
    }

    public function add($item , $id){
        $stroedItem = ['qty'=>'0' , 'price'=>$item->price,'item'=>$item];
        if($this->items){
            if(array_key_exists($id , $this->items)){
            $stroedItem = $this->items[$id];
           // dd($stroedItem);

  }
}


        $stroedItem['qty']++;
        $stroedItem['price'] = $item->price * $stroedItem['qty'];
        $this->items[$id] = $stroedItem;
        $this->totalQty++;
        $this->totalPrice += $item->price; 

    }

    public function remove($item , $id){
        $stroedItem = ['qty'=>'0' , 'price'=>$item->price,'item'=>$item];
        
        if($this->items){
            if(array_key_exists($id , $this->items)){

              
           unset($this->items[$id]);


         //  dd($this->items);

  }
}
                  

            
            
            
          




       // $stroedItem['qty'];
        $stroedItem['price'] = $item->price * $stroedItem['qty'];
        $this->totalQty--;
        $this->totalPrice -= $item->price; 
       // dd($this->totalPrice ,$this->totalQty--,$stroedItem['qty'] );

    }


}