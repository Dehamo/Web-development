<?php

// démarrage de la session
session_start();
// gestion des erreurs de saisie
unset($errorLogin);
// tests sur la validité des données si tous les champs sont remplis
if ( isset($_GET['loginMembre']) AND isset($_GET['passwordMembre']) AND isset($_GET['passwordMembre2']) AND isset($_GET['nom']) AND isset($_GET['prenom']) AND isset($_GET['mail']) )
{
    if ( $_GET['passwordMembre'] != $_GET['passwordMembre2'] ) 
    {
        $errorLogin = "Les mots de passe ne correspondent pas";
    }
    else if ( ! filter_var($_GET['mail'], FILTER_VALIDATE_EMAIL) )
    {
        $errorLogin = "Cet email n'est pas valide";
    }
    // test sur l'existence d'un nom d'utilisateur similaire
    else
    {
        $bdd = new PDO('mysql:host=localhost;dbname=aftal', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")); 

        $req = $bdd->prepare('SELECT id FROM membre WHERE loginMembre = :loginMembre');
        $req->execute(array(
            'loginMembre' => $_GET['loginMembre']
        ));

        $res = $req->fetch();

        if( $res )
        {
            $errorLogin = "Ce login existe, merci d'en choisir un autre";
        }
        // insertion des données dans la base de données
        else
        {
            $req = $bdd->prepare('INSERT INTO membre (loginMembre, passwordMembre, nom, prenom, mail) VALUES (:loginMembre, :passwordMembre, :nom, :prenom, :mail)');
            $req->execute(array(
                'loginMembre' => $_GET['loginMembre'],
                'passwordMembre' => $_GET['passwordMembre'],
                'nom' => $_GET['nom'],
                'prenom' => $_GET['prenom'],
                'mail' => $_GET['mail']
            ));

            // renvoi à la page d'accueil
            header('Location: index.php?action=join');
            exit;
        }
    }
}
// message d'erreur si tous les champs ne sont pas remplis
else
{
    $errorLogin = "Remplissez tous les champs !";
}

if ( isset($errorLogin) )
{
    header('Location: account.php?action='.$errorLogin);
    exit;
}