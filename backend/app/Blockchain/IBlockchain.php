<?php
namespace App\Blockchain;
//Интерфейс взаимодействия с блокчейн
interface IBlockchain
{

   //Получить балансе
   public function getBalance($wallet, $user = null, $password = null);

   //сделать транзакцию
   public function transaction($wallet_src, $wallet_dst, $amount, $user = null, $password = null);
   //создать новый аккаунт
   public function newAccount($password);


}

?>