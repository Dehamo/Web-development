<?php session_start();
if (!isset($_SESSION['id']))
{
    header('Location: index.php');
    exit;
}?>

<!-- Document en xhtml -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<!-- Espace de nom -->
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- Documentation : titre, encodage, auteur, description, mots-clés -->
<head>
    <title>Aftal</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="Dehareng Morgane" />
    <meta name="description" content="Aftal - Association des etudiants de formation tal" />
    <meta name = "keywords" content = "aftal; association; etudiants; tal"/>
    <link href="../css/style.css" type="text/css" rel="stylesheet" />
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'/>
    <link rel="icon" type="image/png" href="../images/favicon.png" />
</head>

<!-- Corps -->
<body>

<!-- Box -->
<div class="box">
    <!-- Header -->
    <div class="header">
        <div class="logo">
            <div id="logo-img">
                <a href="index.php">
                    <img src="../images/logo.png" alt="aftal"/>
                </a>
            </div>
            <div id="acro">AFTAL</div>
            <div id="name">Association des étudiants de formation TAL</div>
        </div>
        <div class="menu">
            <ul id="menu">
                <li>
                    <a href="index.php">Accueil</a>
                </li>
                <li>
                    <a href="conferences.php">Evénements</a>
                </li>
                <li class="active">
                    <a href="stages.php">Emploi</a>
                </li>
            </ul>
            <div class="connect">
                <br />
                <form action="user.php" method="get">
                    <?php echo $_SESSION['loginMembre'] ?>
                    <button type="submit" name="submit" id="logout" value="logout">Se déconnecter</button>
                </form>
                <p class="text"><a href="update.php">Modifier mes informations</a></p>
            </div>  
        </div>
    </div>
    <!-- End header -->

    <!-- Main -->
    <div class="main">
        <!-- Text -->
        <div id="container">
            <div id="presentation">
                <?php
                // connexion à la base de données
                $bdd = new PDO('mysql:host=localhost;dbname=aftal', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

                $req = $bdd->prepare('SELECT * FROM stage WHERE id = :id');
                $req->execute(array(
                    'id' => $_GET['stageId']
                ));

                $res = $req->fetch();
                ?>
                <!-- Affichage des informations du stage -->
                <h3><?php echo $res['titre'] ?></h3>
                <p class="text">Chez <?php echo $res['entreprise'] ?></p>
                <p class="text" id="texte2">Localisation : <?php echo $res['localisation'] ?></p>
                <p class="text" id="texte3">Date : <?php echo $res['debut'] ?></p>
                <p class="text" id="texte4">Durée : <?php echo $res['duree'] ?></p>
                <p class="text" id="texte5">Rémunération : <?php echo $res['remuneration'] ?></p>
                <p class="text" id="texte6">Compétences : <?php echo $res['competences'] ?></p>
                <p class="text" id="texte7">Descriptif : <?php echo $res['descriptif'] ?></p>
                <br />
                <p>
                <a href="stages.php">Retour à la page principale</a>
                </p>
            </div>
        </div>
    </div>
    <!-- End main -->

    <!-- Footer -->
    <div class="footer">
        <p class="center">&copy; Morgane Dehareng</p>
    </div>
    <!-- End footer -->

</div>
<!-- End box -->

</body>
</html>
