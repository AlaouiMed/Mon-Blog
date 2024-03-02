<?php
session_start();
require_once 'Controleur/ControleurAccueil.php';
require_once 'Controleur/ControleurBillet.php';
require_once 'Controleur/AuthControleur.php';
require_once 'Vue/Vue.php';
class Routeur
{
    private $ctrlAccueil;
    private $ctrlBillet;
    private $ctrlUser;
    public function __construct()
    {
        $this->ctrlAccueil = new ControleurAccueil();
        $this->ctrlBillet = new ControleurBillet();
        $this->ctrlUser = new AuthControleur();
    }
    // Traite une requête entrante
    public function routerRequete()
    {
        try {
            if (isset($_GET['action'])) {
                if ($_GET['action'] == 'billet') {
                    $idBillet = intval($this->getParametre($_GET, 'id'));
                    if ($idBillet != 0) {
                        $this->ctrlBillet->billet($idBillet);
                    } else
                        throw new Exception("Identifiant de billet non valide");
                }else if ($_GET['action'] == 'ajouter') {
                    $titre = $this->getParametre($_POST, 'titre');
                    $contenu = $this->getParametre($_POST, 'contenu');
                    $this->ctrlAccueil->ajouterBillets($titre, $contenu);
                } else if ($_GET['action'] == 'commenter') {
                    $auteur = $this->getParametre($_POST, 'auteur');
                    $contenu = $this->getParametre($_POST, 'contenu');
                    $idBillet = $this->getParametre($_POST, 'id');
                    $this->ctrlBillet->commenter($auteur, $contenu, $idBillet);
                } else if ($_GET['action'] == 'register') {
                    $email = $this->getParametre($_POST, 'email');
                    $username = $this->getParametre($_POST, 'username');
                    $password = $this->getParametre($_POST, 'password');
                    $this->ctrlUser->register($email, $username, $password);
                } else if ($_GET['action'] == 'login') {
                    $email = $this->getParametre($_POST, 'email');
                    $password = $this->getParametre($_POST, 'password');
                    $this->ctrlUser->login($email, $password);
                } else if ($_GET['action'] == 'logout') {
                    $this->ctrlUser->logout();
                } else
                    throw new Exception("Action non valide");
            }else if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === TRUE){
                $this->ctrlAccueil->accueil();
            }
             else { // aucune action définie : affichage de l'accueil
                header("Location: login.php");
                exit(); 
            }
        } catch (Exception $e) {
            $this->erreur($e->getMessage());
        }
    }
    // Affiche une erreur
    private function erreur($msgErreur)
    {
        $vue = new Vue("Erreur");
        $vue->generer(array('msgErreur' => $msgErreur));
    }

    // Recherche un paramètre dans un tableau
    private function getParametre($tableau, $nom)
    {
        if (isset($tableau[$nom])) {
            return $tableau[$nom];
        } else
            throw new Exception("Paramètre '$nom' absent");
    }
}
