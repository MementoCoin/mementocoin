<?php

namespace App\Http\Controllers\Inherit;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Services\CheckPeriodService;
use App\Services\DistributeService;
/*
  Контроллер сервиса операций 
*/
class InheritServiceController extends Controller
{
    //Запустить сервис операций
    public function run()
    {
        return response()->json(json_encode(["state"=>0, "result"=>["check"=>(new CheckPeriodService)->run(), "distribute"=>(new DistributeService)->run()]]));
    }


}
