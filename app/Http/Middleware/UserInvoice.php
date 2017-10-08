<?php

namespace App\Http\Middleware;

use Closure;
use App\Invoice;
use DB;
use App\User;
use Auth;


class UserInvoice
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $invoice_id = $request->route('id');
        $invoice = Invoice::find($invoice_id);

        if (!is_null($invoice)) {
            # code...
           
         $status = $invoice->status;
        $invoice_user_id = $invoice->user_id;
        }
        
      // dd($invoice)
        $user = Auth::user();
        if (!is_null($user)) {
            # code...
        $user = Auth::user()->id;

        }

      /*  $d = DB::table('invoices')
            ->whereExists(function ($query) {
                $query->select("id")
                      ->from('users')
                      ->whereRaw('users.id = invoices.user_id');
            })
            ->get();*/

        
          if (is_null($invoice) ) {
            
            return redirect()->route('home');

             //dd($invoice_user_id);
        }

        elseif(!Auth::check() || $user != $invoice_user_id || $status!='success'  ) {

            return redirect()->route('home'); 
        }else {
            
        //  return  Response(view('errors.404'),404);
        }
        return $next($request);
    }
}
