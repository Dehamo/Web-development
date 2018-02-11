<?php

session_start();
unset($errorLogin);
unset($errorUpdate);
// test sur l'origine des données (formulaire)
if ( isset($_GET['submit']) )
{
    if ($_GET['submit'] == 'login')
    {
        $bdd = new PDO('mysql:host=localhost;dbname=aftal', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

        $req = $bdd->prepare('SELECT * FROM membre WHERE loginMembre = :loginMembre AND passwordMembre = :passwordMembre');
        $req->execute(array(
            'loginMembre' => $_GET['loginMembre'],
            'passwordMembre' => $_GET['passwordMembre']
        ));

        $res = $req->fetch();
        // test de validité des données saisies
        if (!$res)
        {
            $errorLogin = "Erreur de saisie";
            header('Location: member.php?action='.$errorLogin);
            exit;
        }
        // utilisateur connecté
        else
        {
            $_SESSION['id'] = $res['id'];
            $_SESSION['loginMembre'] = $res['loginMembre'];
            $_SESSION['nom'] = $res['nom'];
            $_SESSION['prenom'] = $res['prenom'];
            $_SESSION['mail'] = $res['mail'];
        }
    }
    // déconnexion
    if ($_GET['submit'] == 'logout')
    {
        session_destroy();
    }
    // mise à jour des informations de l'utilisateur
    if ($_GET['submit'] == 'update')
    {
        if ( isset($_SESSION['id']) )
        {
            $bdd = new PDO('mysql:host=localhost;dbname=aftal', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

            $req = $bdd->prepare('UPDATE membre SET loginMembre = :loginMembre, passwordMembre = :passwordMembre, nom = :nom, prenom = :prenom, mail = :mail WHERE id = :id');
            $req->execute(array(
                'loginMembre' => $_GET['loginMembre'],
                'passwordMembre' => $_GET['passwordMembre'],
                'nom' => $_GET['nom'],
                'prenom' => $_GET['prenom'],
                'mail' => $_GET['mail'],
                'id' => $_SESSION['id']
            ));

            if ( $req->rowCount() == 1 )
            {
                $_SESSION['loginMembre'] = $_GET['loginMembre'];
                $_SESSION['nom'] = $_GET['nom'];
                $_SESSION['prenom'] = $_GET['prenom'];
                $_SESSION['mail'] = $_GET['mail'];

                header('Location: index.php?action=update');
                exit;
            }
            else
            {
                $errorUpdate = "Utilisateur non mis à jour";
                header('Location: update.php?action='.$errorUpdate);
                exit;
            }
        }
    }
    // suppression du compte
    if ($_GET['submit'] == 'delete')
    {
        if ( isset($_SESSION['id']) )
        {
            if (isset($_GET['checkbox']) AND $_GET['checkbox'] == 1) {
                $bdd = new PDO('mysql:host=localhost;dbname=aftal', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

                $req = $bdd->prepare('DELETE FROM membre WHERE id = :id');
                $req->execute(array(
                    'id' => $_SESSION['id']
                ));

                session_destroy();

                header('Location: index.php?action=delete');
                exit;
            }
        }
    }
}
header('Location: index.php');
exit;