<?php
namespace App\Services;
use App\InheritUsers;
use Carbon\Carbon;
use Mail;

/*
   Высылка писем расопрядителю
*/
class CheckPeriodService
{
    //Выполнить сервис
    public function run()
    {
       ini_set('memory_limit', '512M');
       set_time_limit(0);

       $wills = InheritUsers::getWillsForCheck();
       foreach($wills as $will)
       {
         try{
           $will->timesend = Carbon::now()->toDateString();
           Mail::send('inherit.mail', ['will' => $will], function ($m) use ($will) {
              $m->from('support@momentocoins.com', 'Momento Coins');
             $m->to($will->email, $will->name)->subject('Confirm your alive');
           });
         }
         catch(\Exception $e)
         {
//             echo $e->getMessage();
         }
         $will->save();
       }
       return "done";
    }

}
                