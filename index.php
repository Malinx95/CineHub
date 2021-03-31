<?php
include_once 'include/header.inc.php';
include 'include/functions.inc.php';
?>
    <section id="card">
        <h2>Accueil</h2>
        <img class="roundedcorner biglogo" src="ressources/logo/logo.png" alt="logo cinehub"/>
        <p>Bienvenue sur CineHub ! Le site pour les passionés de films et séries en tout genre !</p>
        <p>Cliquez sur le bouton ci-dessous pour commencer !</p>
        <a><button>Voir les films et séries</button></a>
        <a class="morebutton" href="#more"><button>Voir plus</button></a>
    </section>
    <section id="more">
        <h2>Informations</h2>
        <h3>Présentation</h3>
        <p>Ce site à été crée dans le cadre de l'Unité d'Enseignement Developpement Web 2020-2021.</p>
        <p>Réalisé par Maxime Grodet &amp; Antoine Qiu en L2 Informatique, groupe C.</p>
        <p>Sur notre site vous pourrez trouver une large sélection de films et séries que vous pouvez explorer et trier !</p>
        <h3>Image du jour</h3>
        <img src="<?php echo nasa()?>" width="500" alt="image nasa">
        <h3>Votre Géolocalisation</h3>
        <?php echo "<p>".geo()."</p>\n";?>
    </section>
<?php
include_once 'include/footer.inc.php';
?>