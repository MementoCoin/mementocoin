<?php

namespace App\Http\Controllers\Inherit;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Http\Controllers\Controller;
use App\Services\CheckPeriodService;
use App\Services\DistributeService;
/*
  Контроллер сервиса операций 
*/
class ConfirmController extends Controller
{
    //Страничка подтверждения активности
    public function index($wallet)
    {
        return view('inherit.confirm', [
            'wallet' => $wallet,
        ]);
    }
    //Подтверждение
    public function confirm($wallet)
    {

        return "";
    }
    //Аккаунт потвержден
    public function confirmed($wallet)
    {
        return view('inherit.confirmed', [
        ]);
    }
    //Не верный пароль
    public function error($wallet)
    {
        return view('inherit.error', [
        ]);
    }

    //Подтверждение не доступно
    public function bad($wallet)
    {
        return view('inherit.badwallet', [
        ]);
    }

    //Слишком поздно
    public function toolate($wallet)
    {
        return view('inherit.toolate', [
        ]);
    }

}
