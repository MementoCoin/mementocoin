<?php

namespace App\Http\Controllers\Inherit;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Illuminate\Database\Query\Expression as raw;
use App\Http\Controllers\Controller;
use App\InheritUsers;
/*
  Контроллер api 
*/

class InheritController extends Controller
{
    //Вызов корнего адреса, проверка связи
    public function index()
    {
        return response()->json(json_encode(["state"=>0, "result"=>""]));
    }
    //добавить пожелание
    public function add()
    {

        $request = Input::get();
        $data = json_decode($request['data'], true);
        return response()->json(json_encode(["state"=>0, "result"=>InheritUsers::addWill($data['name'], $data['email'], $data['password'], $data['wallet'], $data['timeperiod'], $data['timeaccept'], $data['benefits'])]));
    }
    //удалить пожелание
    public function delete()
    {
        $request = Input::get();
        $data = json_decode($request['data'], true);
        return response()->json(json_encode(["state"=>0, "result"=>InheritUsers::deleteWill($data['wallet'], $data['password'])]));
    }
   public function test()
   {
        $data = [
           'name'=>'name-'.rand(1, 30000)
          ,'password'=>'dgdg%v?^de87y'.rand(1, 30000)
          ,'wallet'=>''
          ,'email'=>'kgolovkin@mail.ru'
          ,'timeperiod'=>0
          ,'timeaccept'=>0
          ,'benefits'=>[
             ['wallet'=>'0x7e475c839ca6328a2d200bc8aa4ee501089ce7bc'
              ,'part'=>20
              ,'email'=>'kgolovkin@mail.ru'
             ]
             ,['wallet'=>'0x1e00374844844aaa8ca92745a88d76bcdf523d8b'
              ,'part'=>20
              ,'email'=>'kgolovkin@mail.ru'
             ]
             ,['wallet'=>'0x2b333b264ab8427d979e78441a98a36399f361f7'
              ,'part'=>20
              ,'email'=>'kgolovkin@mail.ru'
             ]
          ]
        ];
        return response()->json(json_encode(["state"=>0, "result"=>InheritUsers::addWill($data['name'], $data['email'], $data['password'], $data['wallet'], $data['timeperiod'], $data['timeaccept'], $data['benefits'])]));
   }


}
