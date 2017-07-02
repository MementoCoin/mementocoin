<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InheritBenefits extends Model
{
    public $table = 'inheritbenefits';

    //
    public static function addBenefit($user_id, $wallet, $email, $part)
    {
       $obj = new self();
       $obj->user_id = $user_id;
       $obj->wallet  = $wallet;
       $obj->email   = $email;
       $obj->part    = $part;
       return $obj->save();
    }

    //Получить всех выгодопреобретателей
    public static function getBenefit($user_id)
    {
       return self::where('user_id', '=', $user_id)
                  ->get();
    }

}
                                  