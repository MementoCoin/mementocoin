<?php
namespace App\Blockchain;
//Интерфейс взаимодействия с блокчейн
class Blockchain
{

   public static function provide($blockchain)
   {
      return new $blockchain();
   }

}

?>