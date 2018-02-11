<?php session_start(); ?>

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
                    <form action="user.php">
                        <p><label for="loginMembre">Nom d'utilisateur</label></p>
                        <p><input type="text" name="loginMembre" id="loginMembre" /></p>
                        <p><label for="passwordMembre">Mot de passe</label></p>
                        <p><input type="password" name="passwordMembre" id="passwordMembre" /></p>
                        <br />
                        <button type="submit" name="submit" id="login" value="login">Se connecter</button>                    
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
