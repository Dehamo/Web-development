<?php session_start();
if (!isset($_SESSION['id']))
{
    header('Location: index.php');
    exit;
}

$bdd = new PDO('mysql:host=localhost;dbname=aftal', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
?>

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
                <h3>Stages</h3>
                <p class="text">Vous pouvez rechercher un stage en complétant le formulaire ci-dessous.</p>
                <form action="stages.php" method="get">
                    <p>Lieu
                        <select name="localisation">
                            <option value="empty">--</option>
                        <?php
                        // sélection des données
                        $res = $bdd->prepare('SELECT DISTINCT localisation FROM stage WHERE localisation IS NOT NULL');
                        $res->execute();

                        foreach ($res as $row) {
                        ?>
                            <option value="<?php echo $row[0] ?>" <?php if( isset($_GET['localisation']) ) { if($row[0] == $_GET['localisation']) { echo "selected=\"selected\""; } } ?>><?php echo $row[0] ?></option>
                        <?php } ?>
                        </select>
                    </p>
                    <p>Début
                        <select name="debut">
                            <option value="empty">--</option>
                        <?php
                        $res = $bdd->prepare('SELECT DISTINCT debut FROM stage WHERE debut IS NOT NULL');
                        $res->execute();

                        foreach ($res as $row) {
                            ?>
                            <option value="<?php echo $row[0] ?>" <?php if( isset($_GET['localisation']) ) { if($row[0] == $_GET['debut']) { echo "selected=\"selected\""; } } ?>><?php echo $row[0] ?></option>
                        <?php } ?>
                        </select>
                    </p>
                    <p>Durée
                        <select name="duree">
                            <option value="empty">--</option>
                        <?php
                        $res = $bdd->prepare('SELECT DISTINCT duree FROM stage WHERE duree IS NOT NULL');
                        $res->execute();

                        foreach ($res as $row) {
                            ?>
                            <option value="<?php echo $row[0] ?>" <?php if( isset($_GET['localisation']) ) { if($row[0] == $_GET['duree']) { echo "selected=\"selected\""; } } ?>><?php echo $row[0] ?></option>
                        <?php } ?>
                        </select>
                    </p>
                    <br />
                    <button type="submit" name="submit" id="search" value="search">Rechercher</button>
                </form>
                <br />
                <br />
                <table>
                    <tr>
                        <th>Nom</th>
                        <th>Entreprise</th>
                        <th>Lieu</th>
                        <th>Début</th>
                        <th>Durée</th>
                    </tr>
                <?php
                // recherche des stages
                if ( isset($_GET['submit']) AND $_GET['submit'] == "search" )
                {
                    // requête par défaut
                    $query = 'SELECT id, titre, entreprise, localisation, debut, duree FROM stage ';
                    unset($condition);
                    unset($values);

                    $condition = '';
                    $values = array();

                    $a = 0;
                    // test si la requête doit contenir une localisation
                    if ( isset($_GET['localisation']) AND $_GET['localisation'] != 'empty' )
                    {
                        $a = 1; // gestion du AND
                        $condition .= 'localisation = :localisation ';
                        $values['localisation'] = $_GET['localisation'];
                    }
                    // test si la requête doit contenir un début
                    if ( isset($_GET['debut']) AND $_GET['debut'] != 'empty' )
                    {
                        // gestion du AND
                        if ( $a == 1 )
                        {
                            $condition .= 'AND ';
                        }
                        $a = 1;
                        $condition .= 'debut = :debut ';
                        $values['debut'] = $_GET['debut'];
                    }
                    // test si la requête doit contenir une durée
                    if ( isset($_GET['duree']) AND $_GET['duree'] != 'empty' )
                    {
                        // gestion du AND
                        if ( $a == 1 )
                        {
                            $condition .= 'AND ';
                        }
                        $a = 1;
                        $condition .= 'duree = :duree ';
                        $values['duree'] = $_GET['duree'];
                    }

                    // ajout de la condition si elle existe
                    if ($a == 1)
                    {
                        $query .= 'WHERE ';
                        $query .= $condition;
                    }
                     // exécution de la requête
                    $res = $bdd->prepare($query);
                    $res->execute($values);
                }
                // affichage de tous les stages si aucune recherche n'est effectuée
                else
                {
                    $res = $bdd->prepare('SELECT id, titre, entreprise, localisation, debut, duree FROM stage');
                    $res->execute();
                }
                 // affichage du tableau
                foreach ($res as $row)
                {
                ?>
                    <tr>
                        <td><a href="stage.php?stageId=<?php echo $row['id'] ?>"><?php echo $row['titre'] ?></a></td>
                        <td><?php echo $row['entreprise'] ?></td>
                        <td><?php echo $row['localisation'] ?></td>
                        <td><?php echo $row['debut'] ?></td>
                        <td><?php echo $row['duree'] ?></td>
                    </tr>
                <?php
                }
                ?>
                </table>
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
