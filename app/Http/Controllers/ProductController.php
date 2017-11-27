<?php

namespace App\Http\Controllers;
use Paypal;
use Response;
use App\Cart;
use App\Product;
use Session;
use App\User;
use App\Invoice;
use DB;
use App\Invoice_Product;
use Auth;
use App\Download;
use Zipper;
use Mail;
use App\Mail\Mymail;
use Storage;
use Cookie;
use Illuminate\Cookie\CookieJar;
//use Symfony\Component\HttpFoundation\Cookie;
use Omnipay\Omnipay;
use Illuminate\Support\Facades\Input;



use Illuminate\Http\Request;

class ProductController extends Controller
{


    private $_apiContext;

    public function __construct()
    {
      /*  $this->_apiContext = PayPal::ApiContext(
            config('services.paypal.client_id'),
            config('services.paypal.secret'));*/

    /*    $this->_apiContext->setConfig(array(
            'mode' => 'sandbox',
            'service.EndPoint' => 'https://api.sandbox.paypal.com',
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => storage_path('logs/paypal.log'),
            'log.LogLevel' => 'FINE'
        ));*/

    }

 



    public function index()
    {
        //
                $products = Product::orderBy('id', 'desc')->paginate(8);
                $invoice = Invoice::all();
              
                //$size = Storage::size('1497449186.txt');
               // dd($size);
        return view('welcome', compact('products' , 'invoice'));

    }


    public function mailInfo($id)
    {
        //
               // $products = Product::all();
            
               // dd($Invoice);
        return view('mail.mesgmail');

    }

    public function addCart(CookieJar $cookieJar,Request $request  )
    {
        $id = $request->id;

        if (Cookie::has('product')) {
          # code...
          $productCookie = Cookie::get('product');
          $request->session()->put('product', $productCookie);

        }

      if (Session::has('product')) {
          $productSession = Session::get('product');
         $request->session()->put('product', $productSession.','.$id);
       } else {
       $request->session()->put('product', $id);


       }
       // $array = explode(',' , $productCookie);

       $productCookie = Cookie::get('product');
        if (Cookie::has('product')) {
        //  echo '(1)';
         $cookieJar->queue(cookie('product',$productCookie.','.$id,10080));
       } else {
       // echo '(2)';
        //$cookieJar->queue(cookie('product',NULL,10080));
        $cookieJar->queue(cookie('product',$id,10080));
//echo '(3)';

       }

        $value = $request->cookie('product');
       // $request->session()->put('product', $value);
//          echo $request->id.'-';
        //  echo $value;

      return response()->json(['msg' =>count(explode(',' , Session::get('product')))]);
           /*   return redirect()->back()
          ->withFlashMessage('تمت الإضافة للسلة بنجاح');*/

    }


    public function removeCart(CookieJar $cookieJar ,Request $request  )
    {
        $id = $request->id;
        $productCookie = Cookie::get('product');
        $array = explode(',' , $productCookie);
       // dd($array);
        $key = array_search($id , $array);
        if ($key !== false) {
          # code...
          unset($array[$key]);
        }
        $newProductCookie = implode(',', $array);
        if (count($array) == 0) {
          # code...
         $remove = Cookie::queue(Cookie::forget('product'));
         Session::forget('product');
         //dd($remove);
         return redirect()->back();
        }

        $cookieJar->queue(cookie('product',$newProductCookie,10080));
        $request->session()->put('product', $newProductCookie);

      $productCookie = Session::get('product');
      $array = explode(',', $productCookie);

      //dd($array);
      $arrayProduct = array();
      $arrayPrice = array();
      foreach ($array as $value) {
        $productValue = Product::where('id' , $value)->get();
       // dd($productValue)->;
       $arrayProduct[] = $productValue;
       $arrayProduct= array_flatten($arrayProduct);
       //dd($arrayProduct[]);
      
      }
      $count = NULL;
        foreach ($arrayProduct as $value) {
          # code...

          $count +=$value->price;

        }
        return response()->json(['msg' =>count(explode(',' , Session::get('product'))),'count'=>$count]);
        return redirect()->back();

        

    }


    public function showCart(){

      $productCookie = Cookie::get('product');
      $array = explode(',', $productCookie);

      //dd($array);
      $arrayProduct = array();
      $arrayPrice = array();
      foreach ($array as $value) {
        $productValue = Product::where('id' , $value)->get();
       // dd($productValue)->;
       $arrayProduct[] = $productValue;
       $arrayProduct= array_flatten($arrayProduct);
       //dd($arrayProduct[]);
      
      }
      $count = NULL;
        foreach ($arrayProduct as $value) {
          # code...

          $count +=$value->price;

        }

   //dd($count);
    return response()->view('shop.shopping-cart' , compact('arrayProduct','count'));
      return view('shop.shopping-cart' , compact('arrayProduct'));
    }

    /*  Payment   */



    public function getCheckout_Paypal(Request $request)
    {

            $params = array( 
            'cancelUrl' => 'http://127.0.0.1:8000', 
            'returnUrl' => route('getDone'),  
            'amount' =>input::get('pay').'.00', 
            'currency' => 'USD'
            ); 
$gateway = Omnipay::create('PayPal_Express');
$gateway->setUsername('ibrahim.s.m.2016.k-facilitator_api1.gmail.com');
$gateway->setPassword('8F55STJV7VBCZHGU');
$gateway->setSignature('AFcWxV21C7fd0v3bYYYRCpSSRl31Aa-HGpH14p1y6TsHpGYaxnkn0JTh');
 $gateway->setTestMode(true);
 //$gateway->getDefaultParameters();
$response = $gateway->purchase($params)->send();
//dd(array_collapse($response));


if ($response->isSuccessful()) {
    // redirect to offsite payment gateway
    print_r($response);  
   
} elseif ($response->isRedirect()) {
    // payment was successful: update database
     $response->redirect()->back();
} else {
    // payment failed: display message to customer
    echo $response->getMessage();

}
    }

  public function getCheckout_Stripe(Request $request)
    {

    // dd($request);

      $token = $request->stripeToken;
//dd($token);
$formData = array( 'number' =>input::get('cardnumber'),
                   'expiryMonth' => input::get('exp-date'),
                   'expiryYear' => '2018',
                   'cvv' => '123'
                  );
     // dd($formData);

 // $token=$request->input('token_input_stripe');
//dd($token);

  $params = array(
           "amount" => input::get('pay').'.00',
             "currency" => "usd",
              "customer" => Auth::user()->id,
             "description" => "Example charge",
              "source" => $token,
                // 'card' => $formData
                 //'source'=> $token=$request->input('_token'),
                 );
//  dd($params);
  $gateway = Omnipay::create('Stripe');

$gateway->setApiKey('sk_test_brOC7dZppS1KosPkGThkedGS');
$gateway->setTestMode(true);
//dd($gateway);

    $response = $gateway->purchase($params)->send();
//dd($response);
if ($response->isSuccessful()) {
    // redirect to offsite payment gateway
  //
 // echo "string";
  return  redirect()->route('getDone');
  
} elseif ($response->isRedirect()) {
    // payment was successful: update database
   // print_r($response);
} else {
    // payment failed: display message to customer
    //echo $response->getMessage();
  //echo "Here";
  

}
    }


  /*  {
        $payer = PayPal::Payer();
        $payer->setPaymentMethod('paypal');

        $amount = PayPal:: Amount();
        $amount->setCurrency('USD');
        $amount->setTotal($request->input('pay'));

        $transaction = PayPal::Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription('Buy Premium '.$request->input('type').' Plan on '.
            $request->input('pay'));

        $redirectUrls = PayPal:: RedirectUrls();
        $redirectUrls->setReturnUrl(route('getDone'));
        $redirectUrls->setCancelUrl(route('getCancel'));

        $payment = PayPal::Payment();
        $payment->setIntent('sale');
        $payment->setPayer($payer);
        $payment->setRedirectUrls($redirectUrls);
        $payment->setTransactions(array($transaction));

        $response = $payment->create($this->_apiContext);
        $redirectUrl = $response->links[1]->href;

        return redirect()->to( $redirectUrl );
    }*/

    public function getDone(Request $request  )
    {
        //dd($request->all());
        
        //dd($pay_id);
        $invoice = new Invoice;
       // $id = $request->get('paymentId');
        //dd($id);
        $token = $request->get('token');
       // dd($token);
        $payer_id = $request->get('PayerID');
       // $payment = PayPal::getById($id, $this->_apiContext);
      //  $paymentExecution = PayPal::PaymentExecution();
      //  $paymentExecution->setPayerId($payer_id);
      //  $executePayment = $payment->execute($paymentExecution, $this->_apiContext);
       // $oldCart = Session::get('cart');
       // $cart = new Cart($oldCart);
        $user = Auth::user();
            $invoice->data = "token" .$token ."payer_id" .$payer_id ;
            if (!is_null($invoice->data)) {
                # code...
                $invoice->status = 'success';
            }

            if ($invoice->status ='success') {
                # code...
                $invoice->notes = "Done";
            }
            
            $invoice->user_id = $user->id ;
            //dd($invoice);
           $invoice->save();
                   if (Cookie::has('product')) {
         // dd('Done');
          $productCookie = Cookie::get('product');
          $array = explode(',' , $productCookie);
          //dd($array);
        }

        foreach ($array as $value) {

            $Id_invoice = $invoice->id;
           $Id_product = $value;
            # code...
            $invoice_id = DB::table("invoice_product")->insert([
                "invoice_id"=>$Id_invoice 
                , "product_id"=>$Id_product]);

        }

        if (is_null($invoice)) {
        
    $user = Auth::user();
   // $user->email
        $invoices = Invoice::find($Id_invoice);
        //dd($invoices);
        Mail::to($user->email)->send(new Mymail($invoices));

        }
                   
      // Session::forget('cart');
     if($invoice->status !='success'){

      return redirect('/');


  }
       // $invoice = Invoice::find($Id_invoice);
        //dd($Id_invoice->product);
        Cookie::queue(Cookie::forget('product'));
        Session::forget('product');
        return redirect('invoice/'.$Id_invoice.'/download' )
                ->with('success', 'Successfully purchased products !');

    }

        public function getCancel()
    {
        return redirect()->route('payPremium');
    }

 
        public function download( $id)
    {
        $invoice = Invoice::find($id);


        $down_invoice = Invoice_Product::find($id);
     // dd($down_invoice->id);

        return view('shop.download', compact('invoice', 'down_invoice'));
    }



    public function downloadDone($invoice_id , $product_id )
    {
    

        $Id_invoice = Invoice::find($invoice_id);
        $Id_product = Product::find($product_id);

        $download = new Download;
        $download->invoice_id = $Id_invoice->id ;
        $download->product_id = $Id_product->id ; 
        $download->save();

        $file= public_path(). "/download/".$Id_product->product_file;
        $headers = array(
              'Content-Type: application/pdf',
            );
        
        if($download !=''){

            return Response::download($file, $Id_product->product_file, $headers);
           
           }  
    }


    public function downloadAll($invoice_id)
    {
        $invoice = Invoice::find($invoice_id);
        
        $all_files = array();
   //     $info_product= array();
        $msg = '*****Shopping Online*******'."\r\n".
               '*****Shopping Online*******'."\r\n".
               'Your purchase was successfully in this Invoice Number'.$invoice->id.' '.
               Auth::user()->name ."\r\n".
               '---------------------'."\r\n";

        foreach($invoice->product as $product) {

            $download =  new Download;
            $download->invoice_id = $invoice->id;
            $download->product_id = $product->id;
            $download->save();

        $files = public_path('image/'.$product->product_file);

        $size = Storage::size($product->product_file);

        if ($size <1024) {
            $size . ' B ';
        }else{

            $size /=1024 ;
           // $size =  intval($size) . ' KB ';
            $size = number_format($size , 1 , '.' ,''). ' KB ';
           // dd($size);
        }
         
         $all_files[] = $files ;

         $msg .= ' Product Name : '.$product->title ."\r\n".
         ' Download File : '.$product->imagePath."\r\n".
         ' Size File '.$product->title.' :'.$size ."\r\n".'---------------------'."\r\n";

        }
        

        $noteName = time().'.txt';
        $msg = Storage::disk('local')->put($noteName, $msg);
          $directory = public_path().'/image/'.$noteName ; 
          array_push($all_files ,$directory);

        $file_name_zip = time().'.zip'; 
        $file_path= public_path().'/download/'.$file_name_zip; 
        $content =  Zipper::make('download/'.$file_name_zip)->add($all_files)->close();
        Storage::delete($noteName);

         $headers = array(
              'Content-Type: application/zip',
         );

        if($download != '')
         {
               return Response::download($file_path , $file_name_zip , $headers)
                                         ->deleteFileAfterSend(true);

              }





    }


    public function testMail()
{

    $user = Auth::user();
   // $user->email
$data = array( 'email' => 'ibrahim.s.m.2010@gmail.com', 'first_name' => 'Lar',
 'from' => 'shoppingt277@gmail.com', 'from_name' => 'Vel' );

Mail::send( 'mail.mes', $data, function( $message ) use ($data)
{
    $message->to( $data['email'] )->from( $data['from'], $data['first_name'] )->subject( 'Welcome!' );
});

return "done";

}  



}