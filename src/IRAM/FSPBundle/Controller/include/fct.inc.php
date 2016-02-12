<?php
/** 
 * Fonctions pour l'application GSB
 
 * @package default
 * @author Cheri Bibi
 * @version    1.0
 */
 /**
 * Teste si un quelconque visiteur est connecté
 * @return vrai ou faux 
 */
function estConnecte(){
  return isset($_SESSION['email']);
}
/**
 * Enregistre dans une variable session les infos d'un visiteur
 
 * @param $email 
 * @param $nom
 * @param $prenom
 */
function connecter($email,$nom,$prenom,$dateNaissance,$pays){
	$_SESSION['email']= $email; 
	$_SESSION['nom']= $nom;
	$_SESSION['prenom']= $prenom;
	$_SESSION['dateNaissance']= $dateNaissance;
	$_SESSION['pays']= $pays;
}
/**
 * Détruit la session active
 */
function deconnecter(){
	session_destroy();
}

function dateAnglaisVersFrancais($date){
   @list($annee,$mois,$jour)=explode('-',$date);
   $date="$jour"."/".$mois."/".$annee;
   return $date;
}

function ajouterIdTheme($theme)
{
 $refidtheme = '0';
 switch($theme)
 {
  case 'logement' : $refidtheme = '1';
                    break;
  case 'cours'    : $refidtheme = '2';
                    break;
  case 'evenement': $refidtheme = '3';
                    break;
  case 'culture'  : $refidtheme = '4';
                    break;
 }
 return $refidtheme;
} 
?>
