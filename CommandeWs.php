<?php
require_once "Commande.php";
require_once "CommandeService.php";
class CommandeWs{
    private $service;
    public function __construct(){
        $this->service=new CommandeService();
    }

    public function save(Commande $Commande){
        $result=$this->service->save($Commande);
        $responce=[];
        if($result==-1){
            $responce=["status"=>500,$data=>"commande already exists"];
        }
        elseif($result==-2){
            $responce=["status"=>500,$data=>"total is negatif or equal to 0"];
        }
        elseif($result==-3){
            $responce=["status"=>500,$data=>"totalPaye is not equal to 0"];
        }
        elseif($result==1){
            $responce=["status"=>201,$data=>"save already done"];
        }
        return json_encode($responce);
    }
    public function payer($ref,$montant){
        $result=$this->service->payer($ref,$montant);
        $responce=[];
        if($result==-1){
            $responce=["status"=>500,$data=>"commande not found"];
        }
        elseif($result==-2){
            $responce=["status"=>500,$data=>"totalPaye + montant is greater than total"];
        }
        elseif($result==1){
            $responce=["status"=>200,$data=>"payement already done"];
        }
    }
    public function update(Commande $Commande){
        $responce=["status"=>200,$data=>"commande updated"];
        $result=$this->service->update($Commande);
        return json_encode($responce);
    }
    public function findById($id){
        $result=$this->service->findById($id);
        $responce=[];
        if($result==null){
            $responce=["status"=>204,$data=>"No data found"];
        }
        else{
            $responce=["status"=>200,$data=>$result];
        }
        return json_encode($responce);
    }
    public function findByRef($ref){
        $result=$this->service->findByRef($ref);
        $responce=[];
        if($result==null){
            $responce=["status"=>204,$data=>"No data found"];
        }
        else{
            $responce=["status"=>200,$data=>$result];
        }
        return json_encode($responce);
    }
    public function findAll(){
        $result= $this->service->findAll();
        $responce=[];
        if(empty($result)){
            $responce=["status"=>204,$data=>"No data found"];
        }
        else{
            $responce=["status"=>200,$data=>$result];
        }
        return json_encode($responce);
    }
    public function deleteById($id){
        return $this->service->deleteById($id);
    }
    public function deleteByRef($ref){
        $result=$this->service->deleteByRef($ref);
        $responce=[];
        if($result==-1){
            $responce=["status"=>204,$data=>"No data found"];
        }
        elseif($result==-2){
            $responce=["status"=>500,$data=>"Commande already payed"];
        }
        elseif($result==1){
            $responce=["status"=>200,$data=>"Commande deleted"];
        }
        return json_encode($responce);
    }
}
?>