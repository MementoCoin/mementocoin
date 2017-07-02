<?php
namespace App\Blockchain;
//Интерфейс взаимодействия с блокчейн
interface IContractedBlockchain extends IBlockchain
{

   //установить контракт
   public function setContract($wallet, $textContract, $user = null, $password = null);

   //Испльнить контракт
   public function executeContract($contractAbi);


}

?>