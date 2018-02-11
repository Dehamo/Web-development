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
                <li class="active">
                    <a href="conferences.php">Evénements</a>
                </li>
                <li>
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
                <p class="textError">
                    <?php if ( isset($_GET['action']) )
                    {
                        echo $_GET['action'];
                    }
                    ?>
                </p>
                <h3>Conférences</h3>
                <table>
                    <tr>
                        <th>Titre</th>
                        <th>Date</th>
                        <th>Lieu</th>
                        <th>Organisateur</th>
                    </tr>
                <?php
                // connexion à la base de données
                $bdd = new PDO('mysql:host=localhost;dbname=aftal', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

                $res = $bdd->query('SELECT id, titre, debut, localisation, organisateur FROM conference');
                $res->execute();
                 // affichage de toutes les conférences
                foreach ($res as $row)
                {
                ?>
                    <tr>
                        <td><a href="confDetail.php?confId=<?php echo $row['id'] ?>"><?php echo $row['titre'] ?></a></td>
                        <td><?php echo $row['debut'] ?></td>
                        <td><?php echo $row['localisation'] ?></td>
                        <td><?php echo $row['organisateur'] ?></td>
                    </tr>
                <?php
                }
                ?>
                </table>
                <p>
                <a href="conference_user.php">Mes conférences</a>
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
