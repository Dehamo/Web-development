<?php

session_start();
unset($result);
if ( isset($_GET['submit']) )
{
    if ($_GET['submit'] == 'inscription')
    {
        $bdd = new PDO('mysql:host=localhost;dbname=aftal', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

        // test si l'utilisateur est déjà inscrit à cette conférence
        $req = $bdd->prepare('SELECT * FROM conference_membre WHERE membreId = :membreId AND conferenceId = :conferenceId');
        $req->execute(array(
            'membreId' => $_SESSION['id'],
            'conferenceId' => $_GET['id']
        ));
        
        $matin = 0;
        $apresmidi = 0;

        if ($_GET['time'] == 'am')
        {
            $matin = 1;
        }
        if ($_GET['time'] == 'pm')
        {
            $apresmidi = 1;
        }
        if ($_GET['time'] == 'all')
        {
            $matin = 1;
            $apresmidi = 1;
        }

        // mise à jour des informations
        if ($req->rowCount() != 0)
        {
            $req = $bdd->prepare('UPDATE conference_membre SET matin = :matin, apresmidi = :apresmidi WHERE membreId = :membreId AND conferenceId = :conferenceId');
            $req->execute(array(
                'membreId' => $_SESSION['id'],
                'conferenceId' => $_GET['id'],
                'matin' => $matin,
                'apresmidi' => $apresmidi
            ));

            if ( $req->rowCount() == 1 )
            {
                $result = "Inscription réussie";
                header('Location: conference_user.php?action='.$result);
                exit;
            }
        }
        // inscription à la conférence 
        else
        {
            $req = $bdd->prepare('INSERT INTO conference_membre VALUES (:membreId, :conferenceId, :matin, :apresmidi)');
            $req->execute(array(
                'membreId' => $_SESSION['id'],
                'conferenceId' => $_GET['id'],
                'matin' => $matin,
                'apresmidi' => $apresmidi
            ));

            $result = "Inscription réussie";
            header('Location: conferences.php?action='.$result);
            exit;
        }
    }
    // mise à jour depuis conference_user
    if ($_GET['submit'] == 'update')
    {
        $matin = 0;
        $apresmidi = 0;

        if (isset($_GET['matin']) AND $_GET['matin'] == 'on')
        {
            $matin = 1;
        }
        if (isset($_GET['apresmidi']) AND $_GET['apresmidi'] == 'on')
        {
            $apresmidi = 1;
        }

        $bdd = new PDO('mysql:host=localhost;dbname=aftal', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

        if ($matin == 0 AND $apresmidi == 0)
        {
            $req = $bdd->prepare('DELETE FROM conference_membre WHERE membreId = :membreId AND conferenceId = :conferenceId');
            $req->execute(array(
                'membreId' => $_SESSION['id'],
                'conferenceId' => $_GET['confId']
            ));

            $result = "Suppression réussie";
            header('Location: conference_user.php?action='.$result);
            exit;
        }
        else
        {
            $req = $bdd->prepare('UPDATE conference_membre SET matin = :matin, apresmidi = :apresmidi WHERE membreId = :membreId AND conferenceId = :conferenceId');
            $req->execute(array(
                'membreId' => $_SESSION['id'],
                'conferenceId' => $_GET['confId'],
                'matin' => $matin,
                'apresmidi' => $apresmidi
            ));

            $result = "Mise à jour réussie";
            header('Location: conference_user.php?action='.$result);
            exit;
        }
    }

    // suppression depuis conference_user
    if ($_GET['submit'] == 'delete')
    {
        $bdd = new PDO('mysql:host=localhost;dbname=aftal', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

        $req = $bdd->prepare('DELETE FROM conference_membre WHERE membreId = :membreId AND conferenceId = :conferenceId');
        $req->execute(array(
            'membreId' => $_SESSION['id'],
            'conferenceId' => $_GET['confId']
        ));

        $result = "Suppression réussie";
        header('Location: conference_user.php?action='.$result);
        exit;
    }
}
// renvoi par défaut
header('Location: conferences.php');
exit;