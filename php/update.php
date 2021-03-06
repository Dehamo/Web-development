<?php session_start();
// redicrection vers index.php si l'utilisateur n'est pas connecté
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
        </div>
    </div>
    <!-- End header -->

    <!-- Main -->
    <div class="main">
        <!-- Text -->
        <div id="container">
            <div id="presentation">
                <!-- Gestion des erreurs de saisie -->
                <p class="textError">
                <?php if ( isset($_GET['action']) )
                {
                    echo $_GET['action'];
                }
                ?>
                </p>
                <!-- Formulaire de mise à jour des informations de l'utilisateur -->
                <p class="text">Pour modifier vos informations personnelles, il vous suffit de remplir le formulaire ci-dessous.</p>
                    <form action="user.php">
                        <p><label for="loginMembre">Nom d'utilisateur</label></p>
                        <p><input type="text" name="loginMembre" id="loginMembre" value="<?php echo $_SESSION['loginMembre'] ?>"/></p>
                        <p><label for="passwordMembre">Mot de passe</label></p>
                        <p><input type="password" name="passwordMembre" id="passwordMembre" /></p>
                        <p><label for="nom">Nom</label></p>
                        <p><input type="text" name="nom" id="nom" value="<?php echo $_SESSION['nom'] ?>"/></p>
                        <p><label for="prenom">Prénom</label></p>
                        <p><input type="text" name="prenom" id="prenom" value="<?php echo $_SESSION['prenom'] ?>"/></p>
                        <p><label for="mail">Adresse mail</label></p>
                        <p><input type="text" name="mail" id="mail" value="<?php echo $_SESSION['mail'] ?>"/></p>
                        <br />
                        <button type="submit" name="submit" id="update" value="update">Mettre à jour</button>
                        <br />
                        <br />
                        <p><input type="checkbox" class="checkbox" name="checkbox" id="checkbox" value="1"/>Je veux supprimer mon compte</p>
                        <br />
                        <button type="submit" name="submit" id="delete" value="delete">Supprimer mon compte</button>
                    </form>
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
