<?php
namespace App\Blockchain\Eth;

use App\Blockchain\IContractedBlockchain;

use Config;

//Объект работы с Ethereum
class Ethereum implements IContractedBlockchain
{
   public $url;          //адрес сети ethereum
   private $user;        //полльзователь
   private $password;    //пароль
   private $id;          //идентификатор операции
   private $jsonrpc;     //

   //Конструкор по умолчанию
   function __construct()         
   {
      $this->url = Config::get('app.ethereum');
      $this->id  = 1;
      $this->jsonrpc = '2.0';
   }

   public function __call($name, $params)
   {
      return $this->runRPC($name, $params);
   }

   protected function runRPC($method, $params)
   {

        $rpc_data = [];
        $rpc_data['jsonrpc'] = $this->jsonrpc;
        $rpc_data['method']  = $method;
        $rpc_data['params']  = $params;
        $rpc_data['id']      = $this->id;
        $json_params = json_encode($rpc_data);
        $req = curl_init();
        curl_setopt($req, CURLOPT_URL, $this->url);


        curl_setopt($req, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        curl_setopt($req, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($req, CURLOPT_POST, true);
        curl_setopt($req, CURLOPT_CONNECTTIMEOUT, 120);
        curl_setopt($req, CURLOPT_POSTFIELDS, $json_params);
        curl_setopt($req, CURLOPT_RETURNTRANSFER, true);

       $result = curl_exec($req);

        if(empty($result) || count($result) <= 0 )
           return ["error"=>"not connected"];
 
       $data = json_decode($result,1);
       $this->id++;

       return $data;
   }

   //Получить балансе
   public function getBalance($wallet, $user=null, $password = null)
   {
     $result = $this->eth_getBalance($wallet, 'latest');


     if(isset($result['error']))
           return '';
     return intval($result['result'], 16);
   }
  
   //сделать транзакцию
   public function transaction($wallet_src, $wallet_dst, $amount, $user = null, $password = null)
   {
      $result = $this->personal_unlockAccount($wallet_src, $password);
       if(isset($result['error']))
           return false;
       $result = $this->eth_sendTransaction(['from'=>$wallet_src, 'to'=>$wallet_dst, 'value'=>'0x'.dechex($amount)]);
       if(isset($result['error']))
           return false;

      $result = $this->miner_start();
       if(isset($result['error']))
           return false;
      $result = $this->miner_stop();
       if(isset($result['error']))
           return false;

      $result = $this->personal_lockAccount($wallet_src);
       if(isset($result['error']))
           return false;

      return true;

   }

   //установить контракт
   public function setContract($wallet, $textContract, $user = null, $password = null)
   {
   }

   //Испольнить контракт
   public function executeContract($contractAbi)
   {
      echo $this->url;
   }
   public function newAccount($password)
   {
       $result = $this->personal_newAccount($password);
       if(isset($result['error']))
           return '';
       return $result['result'];
   }

}
?>