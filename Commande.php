<?php
class Commande{
    public $id;
    public $ref;
    public $total;
    public $totalPaye;
    public $etat;
    public function __construct($id,$ref,$total,$totalPaye=0,$etat="intialised"){
        $this->id=$id;
        $this->ref=$ref;
        $this->total=$total;
        $this->totalPaye=$totalPaye;
        $this->etat=$etat;
    }
    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id=$id;
    }

    public function getRef(){
        return $this->ref;
    }
    public function setRef($ref){
        $this->ref=$ref;
    }
    
    public function getTotal(){
        return $this->total;
    }
    public function setTotal($total){
        $this->total=$total;
    }
    public function getTotalPaye(){
        return $this->totalPaye;
    }
    public function setTotalPaye($totalPaye){
        $this->totalPaye=$totalPaye;
    }
    public function getEtat(){
        return $this->etat;
    }
    public function setEtat($etat){
        $this->etat=$etat;
    }
}
?>