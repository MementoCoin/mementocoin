<?php

namespace App;
use App\InheritBenefits;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Blockchain\Blockchain;


//Модель завещателей
class InheritUsers extends Model
{
    const ACTIVE = 0;
    const CANCEL = 1;
    const DISTRIBUTED = 2;

    public $table = 'inheritusers';

    //создать пользователя2
    public static function createNewAccount($password)
    {
       $bc = Blockchain::provide("App\\Blockchain\\Eth\\Ethereum");
       return $bc->newAccount($password);
    }



    //Добавить пожелание
     public static function addWill($name, $email, $password, $wallet, $timeperiod, $timeaccept, $benefits)
     {
       if(empty($wallet))
         $wallet = self::createNewAccount($password);
       else
       {
          $user = self::where('wallet', '=', $wallet)
                      ->where('state', '=', self::ACTIVE)
                      ->first();
          if(!empty($user))
          {
            $user->state = self::CANCEL;
            $user->save();
          }
        }
        if(empty($wallet))
          return ["error"=>"Doesn't  wallet create"];
        $obj = new self();
        $obj->name = $name;
        $obj->email = $email;
        $obj->password = $password;
        $obj->wallet = $wallet;
        $obj->timeperiod = $timeperiod;
        $obj->timeaccept = $timeaccept;
        $obj->state = 0;
        $obj->timebase = Carbon::now()->toDateString();

        if($obj->save())                                              
        {                                                                           
           foreach($benefits as $benefit)
           {
              InheritBenefits::addBenefit($obj->id, $benefit['wallet'], $benefit['email'], $benefit['part']);
           }
        }
        return "";
     }
    //отменить пожелание
     public static function deleteWill($wallet, $password)
     {
        $user = self::where('wallet', '=', $wallet)
                    ->where('password', '=', $password)
                    ->where('state', '=', self::ACTIVE)
                    ->first();
        if(!empty($user))
        {
          $user->state = self::CANCEL;
          $user->save();
        }
        return "";
     }
    //Список пожелания у которых прошел срок и нужно проверить
    public static function getWillsForCheck()
    {
       return self::whereRaw("DATE_ADD(timebase,INTERVAL timeperiod MINUTE) < now()")
                  ->where('state', '=', self::ACTIVE)
                  ->whereNull('timesend')
//                  ->whereNotNull('contract')
                  ->get();
 
    }
    //Список пожелания у которых прошел срок потверждение и нужно распределить
    public static function getWillsForDistribute()
    {
       return self::whereRaw("DATE_ADD(timesend,INTERVAL timeaccept  MINUTE) < now()")
                  ->where('state', '=', self::ACTIVE)
                  ->whereNotNull('timesend')
 //                 ->whereNotNull('contract')
                  ->get();
    }

    

    //
}
