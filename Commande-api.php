<?php
require_once "CommandeWs.php";
$ws=new CommandeWs();
$responce=[];
$method=$_SERVER['REQUEST_METHOD'];
if($method=="GET"){
    if(isset($_GET['ref'])){
        $responce=$ws->findByRef($_GET['ref']);
    }
    elseif(isset($_GET['id'])){
        $responce=$ws->findById($_GET['id']);
    }
    else{
        $responce=$ws->findAll();
    }
}
echo  $responce;

?>