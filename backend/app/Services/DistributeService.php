<?php
namespace App\Services;
use App\InheritUsers;
use App\Blockchain\Blockchain;
use App\InheritBenefits;

//Исполнение распоряжений
class DistributeService
{
   //запустить исполнитель
    public function run()
    {
        ini_set('memory_limit', '512M');
        set_time_limit(0);

       $bc = Blockchain::provide("App\\Blockchain\\Eth\\Ethereum");
       $wills = InheritUsers::getWillsForDistribute();
       foreach($wills as $will)
       {
          $amount = $bc->getBalance($will->wallet, $will->user, $will->password);
          $benefits = InheritBenefits::getBenefit($will->id);
          foreach($benefits as $benefit)
          {
             $amount_part = floor($amount * $benefit->part / 100.0);
             if($amount_part > 0)
               $bc->transaction($will->wallet, $benefit->wallet, $amount_part, $will->user, $will->password);
          }
          $will->state = InheritUsers::DISTRIBUTED;
          $will->save();

       }
       return "done";
    }
}
