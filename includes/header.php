<!-- Inclusion de la base de données, des variables PHP globales et des fonctions PHP globales sur la page en cours -->
<?php
    include_once('config/database.php');
    include_once('variables.php');
    include_once('functions.php');
?>

<!-- Header du site -->
<header>
    <div class="header_container">
        <!-- Bouton d'accueil du site -->
        <a href="./" id="header_home">
            <img class="" src="images/home_logo.png"/>
        </a>
        <!-- Menu principal du site -->
        <div id="header_menu">
            <a href="new.php">Nouveau</a>
            <a href="chart.php">Types</a>
            <a href="moves.php">Capacités</a>
        </div>
    </div>
</header>
