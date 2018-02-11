<?php session_start(); ?>

<!-- Document en xhtml -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" >

<!-- Espace de nom -->
<html xmlns="http://www.w3.org/1999/xhtml" >

<!-- Documentation : titre, encodage, auteur, description, mots-clés -->
<head>
    <title>Aftal</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="Dehareng Morgane" />
    <meta name="description" content="Aftal - Association des etudiants de formation tal" />
    <meta name = "keywords" content = "aftal; association; etudiants; tal"/>
    <link href="../css/style.css" type="text/css" rel="stylesheet" />
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css' />
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
                <li class="active">
                    <a href="index.php">Accueil</a>
                </li>
                <li>
                    <?php
                    // retrait du lien vers les conférences pour l'utilisateur non connecté
                    if ( !(isset($_SESSION['id']) AND isset($_SESSION['loginMembre'])) )
                    { ?>
                        <a href="#">Evénements</a> 
                    <?php }
                    else
                    { ?>
                        <a href="conferences.php">Evénements</a>
                    <?php } ?>
                </li>
                <li>
                    <?php
                    // retrait du lien vers les stages pour l'utilisateur non connecté
                    if ( !(isset($_SESSION['id']) AND isset($_SESSION['loginMembre'])) )
                    { ?>
                        <a href="#">Emploi</a>
                    <?php }
                    else
                    { ?>
                        <a href="stages.php">Emploi</a>
                    <?php } ?>
                </li>
            </ul>
            <div class="connect">
                <br />
                <?php
                    // utilisateur non connecté
                    if ( !(isset($_SESSION['id']) AND isset($_SESSION['loginMembre'])) ) 
                    { ?>
                        <p id="account"><a href="account.php">Créer un compte</a></p>
                        <a href="member.php">Se connecter</a>
                <?php }
                    // utilisateur connecté
                    else 
                    { ?>
                        
                            <form action="user.php" method="get">
                                <?php echo $_SESSION['loginMembre'] ?>
                                <button type="submit" name="submit" id="logout" value="logout">Se déconnecter</button>
                            </form>
                        
                        <p class="text"><a href="update.php">Modifier mes informations</a></p>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- End header -->

    <!-- Main -->
    <div class="main">
        <?php
        // messages à l'utilisateur
        if ( isset($_GET['action']) AND $_GET['action'] == 'join' )
        {
            echo "<p class='textError'>Inscription terminée</p>";
        }

        if ( isset($_GET['action']) AND $_GET['action'] == 'delete' )
        {
            echo "<p class='textError'>Compte supprimé</p>";
        }

        if ( isset($_GET['action']) AND $_GET['action'] == 'update' )
        {
            echo "<p class='textError'>Compte mis à jour</p>";
        }
        ?>

        <!-- Slide -->
        <div class="center">
            <img src="../images/nuage.png" alt="nuage" id="nuage"/>
        </div>
        <!-- End slide -->

        <!-- Text -->
        <div id="container">
            <div id="presentation">
                <h3>Présentation</h3>
                <p class="text">L'AFTAL a pour objectif de :</p>
                <ul>
                    <li>soutenir les jeunes dans leur projet d’insertion professionnelle</li>
                    <li>constituer une plateforme de diffusion de l’information, destinée aux jeunes intéressés par les formations et métiers liés au TAL</li>
                    <li>animer le réseau en ligne et via des événements</li>
                    <li>organiser de rencontre entre étudiants et anciens</li>
                    <li>faciliter les contacts entre jeunes et acteurs de la recherche et de l’industrie dans ces secteurs</li>
                </ul>
                <p class="text">L'AFTAL :</p>
                <ul>
                    <li>regroupe des jeunes diplômés et étudiants en différentes points de leur parcours</li>
                    <li>accompagne des étudiants dans leur parcours d’insertion professionnelle pour mettre en relation le réseau d’anciens et le réseau d’étudiants</li>
                    <li>vous informe sur les opportunités de stages, d’emplois et d’événements</li>
                    <li>développe les contacts avec les acteurs privés et publics du secteur</li>
                </ul>
            </div>
            <div id="actualites">
                <div>
                    <h3>Actualités</h3>
                    <p class="text">Suivez-nous sur <a href="https://www.linkedin.com/groups/3601996/profile">LinkedIn</a> !</p>
                </div>
            </div>
        </div>
        <!-- End text -->

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
