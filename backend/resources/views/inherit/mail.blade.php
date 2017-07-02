@extends('inherit.layouts.mail')

@section('content')
   <div>
     Добрый день! <br/>
     Подтвердите ваш аккаунт в течении {{ $will->timeaccept }} дней.<br/>
     По истечению этого срока, ваш кошелек будет распределен. <br/>
     <br/>
     С уважением,<br/>
     команда Momento Coins
   </div>
@endsection

