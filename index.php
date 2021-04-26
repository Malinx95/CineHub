<?php
$title = "Accueil";
$current = 1;
include_once 'include/header.inc.php';
include 'include/functions.inc.php';
?>
    <section id="card">
        <h2>Introduction</h2>
        <div class="center accueil">
            <img class="biglogo" src="ressources/logo/logo.png" alt="logo cinehub"/>
            <p>Bienvenue sur CineHub ! Le site pour les passionés de films et séries en tout genre !</p>
            <p>Cliquez sur le bouton ci-dessous pour commencer !</p>
            <a class="voir button" href="rechercher.php">Voir les films et séries</a>
        </div>
        <a class="morebutton button" href="#more">Voir plus</a>
        <img class="bg" src="https://stationf.co/wp-content/uploads/2019/06/hero-home-page.jpg" alt="bg"/>
    </section>
    <section id="more">
        <h2>Informations</h2>
        <div class="center accueil">
            <h3>Présentation</h3>
            <p>Ce site à été crée dans le cadre de l'Unité d'Enseignement Developpement Web 2020-2021.</p>
            <p>Réalisé par Maxime Grodet &amp; Antoine Qiu en L2 Informatique, groupe C.</p>
            <p>Sur notre site vous pourrez trouver une large sélection de films et séries que vous pouvez explorer et trier !</p>
            <h3>Image du jour</h3>
            <?php echo nasa()?>
            <h3>Votre Géolocalisation</h3>
            <?php echo "<p>".geo()."</p>\n";?>
        </div>
    </section>
<?php
include_once 'include/footer.inc.php';
?>