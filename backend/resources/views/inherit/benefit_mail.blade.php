@extends('inherit.layouts.mail')

@section('content')
   <div>
     Добрый день! <br/>
     На Ваш кошелек {{ $wallet }} поступила крипто валюта в следствии распределения крипто-средств от {{$name}}<br/>
     <br/>
     С уважением,<br/>
     команда Momento Coins
   </div>
@endsection

