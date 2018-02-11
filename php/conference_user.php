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
                    <a href="conference_user.php">Evénements</a>
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
                <h3>Mes conférences</h3>

                    <div class="table">
                    <?php
                    $bdd = new PDO('mysql:host=localhost;dbname=aftal', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                    // joiture des tables conférence et conference_user
                    $res = $bdd->prepare('SELECT C.id, C.titre, C.debut, C.localisation, C.organisateur, CM.matin, CM.apresmidi FROM conference C, conference_membre CM WHERE C.id = CM.conferenceId AND CM.membreId = :membreId');
                    $res->execute(array(
                        'membreId' => $_SESSION['id']
                    ));
                    // affichage des conférences auxquelles l'utilisateur est inscrit
                    foreach ($res as $row)
                    {
                    ?>
                        <div class="tr">
                            <form action="updateConf.php" method="get">
                                <input type="hidden" value="<?php echo $row[0] ?>" id="confId" name="confId"/>
                                <div class="td" id="title"><?php echo $row[1] ?></div>
                                <div class="td"><?php echo $row[2] ?></div>
                                <div class="td"><?php echo $row[3] ?></div>
                                <div class="td"><?php echo $row[4] ?></div>
                                
                                <div class="td">matin <input type="checkbox" class="checkbox" <?php if ($row[5] != 0) { echo "checked=\"checked\""; } ?> name="matin"/></div>
                                <div class="td">après-midi <input type="checkbox" class="checkbox" <?php if ($row[6] != 0) { echo "checked=\"checked\""; } ?> name="apresmidi"/></div>
                            <!-- mise à jour des données de conférences inscrites -->
                                <div class="td"><button type="submit" name="submit" id="update" value="update">Mettre à jour</button></div>
                            <!-- suppression de l'inscription à une conférence -->
                                <div class="td"><button type="submit" name="submit" id="delete" value="delete">Supprimer</button></div>
                            </form>
                        </div>
                    <?php
                    }
                    ?>
                    </div>
                    <br />
                <p>
                <a href="conferences.php">Retour à la page principale</a>
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
