<?php
function getConnexion(){
    $cnx= mysqli_connect("localhost","root","","BOUTIQUE2023");
    return $cnx;
}
 function getAllCategori(){
    $cnx=getConnexion();
    $tab=[];
    $req=mysqli_query($cnx,"select * from categorie");
    while($d=mysqli_fetch_array($req)){
        $tab[]=$d;
    }
    mysqli_free_result($req);//vider le jeu d'enregistement(tab)
    return $tab;
 }

 function getAllProduits(){
    $cnx=getConnexion();
    $tab=[];
    $req=mysqli_query($cnx,"select * from produit");
    while($d=mysqli_fetch_array($req)){
        $tab[]=$d;
    }
    mysqli_free_result($req);//vider le jeu d'enregistement(tab)
    return $tab;
 }

 function getAllProduitByCatId($id){
    $cnx=getConnexion();
    $tab=[];
    $req=mysqli_query($cnx,"select * from produit where cat_id={$id}");
    while($d=mysqli_fetch_array($req)){
        $tab[]=$d;
    }
    mysqli_free_result($req);//vider le jeu d'enregistement(tab)
    return $tab;
 }
 function getSession(){
    if(!isset($_SESSION)){
        session_start();}
        if(!isset($_SESSION["panier"])){
            $_SESSION["panier"]=array();
        }
    }
    function  addPanier($id){
        getSession();
        if(isset($_SESSION["panier"][$id])){
$_SESSION["panier"][$id]++;
        }
        else{
            $_SESSION["panier"][$id]=1;
        }
    }
    function getPanier(){
getSession();
return $_SESSION["panier"];
    }
 function getProductsFromPanier(){
    $panier=getPanier();
    $keys=array_keys($panier);
    if(empty($keys)){
        return array();}
        else{
$s=implode(",",$keys);
$cnx=getConnexion();
$req=mysqli_query($cnx, "select * from produit where id in ({$s})");
$tab=[];
while($d=mysqli_fetch_array($req)){
    $tab[]=$d;
}
mysqli_free_result($req);//vider le jeu d'enregistement(tab)
return $tab;
}
        }
    
 function getSizePanier(){
    $panier=getPanier();
    return sizeof($panier);
 }