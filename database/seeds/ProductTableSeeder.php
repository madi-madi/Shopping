<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $product = new \App\Product([
        	'imagePath'=>'larvelstrip.jpg',
        	'title'=>'Forsan',
        	'description'=>' Payment in Forsan Shopping ',
        	'price'=>20,

        	]);
        	$product->save();

         $product = new \App\Product([
        	'imagePath'=>'larvelstrip.jpg',
        	'title'=>'Forsan',
        	'description'=>' Payment in Forsan Shopping ',
        	'price'=>20,

        	]);
        	$product->save();

        $product = new \App\Product([
        	'imagePath'=>'larvelstrip.jpg',
        	'title'=>'Forsan',
        	'description'=>' Payment in Forsan Shopping ',
        	'price'=>20,

        	]);
        	$product->save();

         $product = new \App\Product([
        	'imagePath'=>'larvelstrip.jpg',
        	'title'=>'Forsan',
        	'description'=>' Payment in Forsan Shopping ',
        	'price'=>20,

        	]);
        	$product->save();

        $product = new \App\Product([
        	'imagePath'=>'larvelstrip.jpg',
        	'title'=>'Forsan',
        	'description'=>' Payment in Forsan Shopping ',
        	'price'=>20,

        	]);
        	$product->save();
    }
}
