<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\UserRepository;
use App\Download;
//use UserRepository;
use Illuminate\Http\Request;

class InvoiceComposer
{
   
    protected $downloads;
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
   // protected $invoices;
        public function __construct(Download $downloads , Request $request)
    {
        // Dependencies automatically resolved by service container...
        $this->downloads = $downloads;
        $this->request = $request;
       // dd($this->request->get('id'));
    }

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
  

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */

    public function compose(View $view)
    {
        //$view->with('count', $this->users->count());
        //dd($view);

       // $invoice = Invoice::find($Id_invoice);
        

//$invoice = Invoice::find($id);
      //  $download =  Download::all() ;
//$view->with('download' ,$download);
       // $view->with('downloadDone', 'ProductController@downloadDone');
        $invoice_id = $this->request->route('id');
       // dd($id);
       // $id = Route::current()->getParameter('id');
        $download = $this->downloads->find($invoice_id);
        $view->with('download' ,$download);

    }
}