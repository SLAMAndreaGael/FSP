<?php

namespace IRAM\FSPBundle\Controller;
require_once("include/fct.inc.php");
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PdoFsp;

class UserController extends Controller
{
 public function accueilConnecteAction()
 {
    $session = $this->get('request')->getSession();
    $request = $this->get('request');
    $pdo = $this->get('fsp.pdo');
    $lesAnnonces = $pdo->getAnnonces();
    return $this->render('FSPBundle:User:accueil.html.twig', array('lesAnnonces'=>$lesAnnonces));
 }

 public function connexionAction()
 {
  return $this->render('FSPBundle:User:connexion.html.twig');
 }

 public function validerconnectionAction()
 {
  $session = $this->get('request')->getSession();
  $request = $this->get('request');
  $email = $request->request->get('email');
  $mdp = $request->request->get('mdp');
  $pdo = $this->get('fsp.pdo');
  $user = $pdo->getInfosUser($email,$mdp);
  if(!is_array($user)){
   return $this->render('FSPBundle:User:connexion.html.twig',array(
   'message'=>"Erreur d'email ou de mot de passe "));
  }
  else {
   $session->set('email',$user['email']);
   $session->set('nom',$user['nom']);
   $session->set('prenom',$user['prenom']);
   $session->set('dateNaissance',$user['dateNaissance']);
   $session->set('pays',$user['pays']);        
   return $this->render('FSPBundle:User:accueil.html.twig');
   }
 }  

 public function deconnexionAction()
 {
  $session = $this->get('request')->getSession();
  $session->clear();
  return $this->render('FSPBundle:User:connexion.html.twig');
 }

 public function inscriptionAction()
 {
  return $this->render('FSPBundle:User:inscription.html.twig');
 }

 public function ajouterAnnonceAction()
 {
  return $this->render('FSPBundle:User:ajouter.html.twig');
 }

 public function validerajouterAction()
 {
  $session = $this->get('request')->getSession();
  $request = $this->get('request');
  $pdo = $this->get('fsp.pdo');
  $titre = $request->request->get('titre');
  $contenu = $request->request->get('contenu');
  $date = $request->request->get('date');
  $theme = $request->request->get('theme');
  $refnomlangue = $request->request->get('langue');
  $refidetat = '1';
  $refemail = $session->get('email');
  $refidtheme = ajouterIdTheme($theme);
  $pdo->ajouterAnnonce($date,$titre,$contenu,$refnomlangue,$refemail,$refidtheme,$refidetat);
  return $this->render('FSPBundle:User:ajouter.html.twig');
 }

 public function modifierAnnonceAction()
 {
  return $this->render('FSPBundle:User:modifier.html.twig');
 }

 public function supprimerAnnonceAction()
 {
  return $this->render('FSPBundle:User:supprimer.html.twig');
 }

 public function compteAction()
 {
  $session = $this->get('request')->getSession();
  $request = $this->get('request');
  $pdo = $this->get('fsp.pdo');
  $email = $request->request->get('email');
  $lesAnnonces = $pdo->getAnnoncesUser($email);
  return $this->render('FSPBundle:User:compte.html.twig',array('lesAnnonces'=>$lesAnnonces));
 }

 public function validerinscriptionAction()
 {
  $session = $this->get('request')->getSession();
  $pdo = $this->get('fsp.pdo');
  $request = $this->get('request');
  $email = $request->request->get('email');
  $nom = $request->request->get('nom');
  $prenom = $request->request->get('prenom');
  $dateNaissance = $request->request->get('dateNaissance');
  $pays = $request->request->get('pays');
  $mdp = $request->request->get('mdp');
  $pdo->inscription($email,$nom,$prenom,$dateNaissance,$pays,$mdp);
  return $this->render('FSPBundle:User:connexion.html.twig');
 }
}

