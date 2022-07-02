<?php
session_start();
include '../objets/objetsGeneraux.php';
include '../functions/fonctionsDB.php';
include '../modules/navigation/objets/getNavigation.php';
$route = filter($_GET['route']);
// Trouver la référence
$dataRoute = new GetNavigation();
$dataRoute = $dataRoute->getFrom($route);
$securiter = $dataRoute[0]['securiter'];
$chemin = $dataRoute[0]['chemin'];
if($securiter == 0) {
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Contrôle systèmatique
    // Routeur securité 0
    // Controle champs vide
    $controleForm = array();
    array_push($controleForm, champsVide($_POST));
      if($controleForm == [0]) { include '../'.$chemin; } else { header('location:../index.php?message=Un ou plusieurs champs sont vide.'); }
  } else {
    header('location:../../index.php?message=Erreur de traitement');
  }
} else  {

  if($securiter == $_SESSION['role'])
  {
    if(filter($_POST['idNav'] > 0)) {
      $idNav = filter($_POST['idNav']);
      array_pop($_POST);
    } else {
      array_pop($_POST);
    }
    $controleForm = array();
    array_push($controleForm, champsVide($_POST));
    if($controleForm == [0]) {
      include '../'.$chemin;
    } else {
        header('location:../index.php?message=Un ou plusieurs champs sont vide.');
      }
    } else {
      header('location:../index.php?idNav='.findTargetRoute(2));
    }
}
