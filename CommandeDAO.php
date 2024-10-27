<?php
require_once("Commande.php");
class CommandeDAO{
    private $pdo;
    public function __construct(){
        $this->pdo=new PDO("mysql:host=localhost;dbname=TP1web","root","");
    }
    public function save(Commande $Commande){
        $statement= $this->pdo->prepare("INSERT INTO Commandes(ref,total,totalPaye,etat) VALUES(?,?,?,?)");
        $statement->execute([$Commande->getRef(),$Commande->getTotal(),$Commande->getTotalPaye(),$Commande->getEtat()]);
        return 1;
    }
    public function update(Commande $Commande){
        $statement= $this->pdo->prepare("UPDATE Commandes ref=? , total=? , totalPaye=? , etat=? WHERE id=?");
        $statement->execute([$Commande->getRef(),$Commande->getTotal(),$Commande->getTotalPaye,$Commande->getEtat,$Commande->getId]);
        return 1;
    }
    public function findById($id){
        $result=null;
        $statement= $this->pdo->prepare("SELECT * FROM Commandes WHERE id=?");
        $statement->execute([$id]);
        $row=$statement->fetch(PDO::FETCH_ASSOC);
        if($row){
            $result=new Commande($row['id'],$row['ref'],$row['total'],$row['totalPaye'],$row['etat']);
        }
        return $result;
    }
    public function findByRef($ref){
        $result=null;
        $statement= $this->pdo->prepare("SELECT * FROM Commandes WHERE ref=?");
        $statement->execute([$ref]);
        $row=$statement->fetch(PDO::FETCH_ASSOC);
        if($row){
            $result=new Commande($row['id'],$row['ref'],$row['total'],$row['totalPaye'],$row['etat']);
        }
        return $result;
    }
    public function findAll(){
        $result=[];
        $statement= $this->pdo->prepare("SELECT * FROM Commandes");
        $statement->execute();
        while($row=$statement->fetch(PDO::FETCH_ASSOC)){
            $result[]=new Commande($row['id'],$row['ref'],$row['total'],$row['totalPaye'],$row['etat']);
        }
        return $result;
    }
    public function deleteById($id){
        $statement= $this->pdo->prepare("DELETE FROM Commandes WHERE id=?");
        $statement->execute([$id]);
        return 1;
    }
    public function deleteByRef($ref){
        $statement= $this->pdo->prepare("DELETE FROM Commandes WHERE ref=?");
        $statement->execute([$ref]);
        return 1;
    }
}
?>