<?php
require_once "Commande.php";
require_once "CommandeDAO.php";
class CommandeService{
    private $DAO;
    public function __construct(){
        $this->DAO=new CommandeDAO();
    }
    public function save(Commande $Commande){
        $loaded=$this->DAO->findByRef($Commande->getRef());
        if($loaded!=null){
            return -1;
        }
        elseif($Commande->getTotal()<=0){
            return -2;
        }
        elseif($Commande->getTotalPaye()!=0){
            return -3;
        }
        else{
            return $this->DAO->save($Commande);
            return 1;
        }
    }
    public function payer($ref,$montant){
        $loaded=$this->DAO->findByRef($ref);
        if($loaded==null){
            return -1;
        }
        elseif($loaded->getTotalPaye()+$montant>$loaded->getTotal()){
            return -2;
        }
        else{
            $nvTotalPaye=$loaded->getTotalPaye()+$montant;
            if($nvTotalPaye<$loaded->getTotal()){
                $loaded->setEtat("pending");
            }
            else{
                $loaded->setEtat("validated");
            }
            $loaded->setTotalPaye($nvTotalPaye);
            return $this->DAO->update($loaded);
            return 1;
        }
    }
    public function update(Commande $Commande){
        return $this->DAO->update($Commande);
    }
    public function findById($id){
        return $this->DAO->findById($id);
    }
    public function findByRef($ref){
        return $this->DAO->findByRef($ref);
    }
    public function findAll(){
        return $this->DAO->findAll();
    }
    public function deleteById($id){
        return $this->DAO->deleteById($id);
    }
    public function deleteByRef($ref){
        $loaded=$this->DAO->findByRef($ref);
        if($loaded==null){
            return -1;
        }
        elseif($loaded->getEtat()!="intialised"){
            return -2;
        }
        else{
        return $this->DAO->deleteByRef($ref);
        return 1;
        }
    }

}
?>