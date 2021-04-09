<?php
$title = "Statistiques";
$current = 4;
include_once 'include/header.inc.php';
include 'include/functions.inc.php';
?>
    <section id="card">
        <?php
            echo "<p>Nombre de magnifique visiteur : $hit</p>\n"
        ?>
        <a class="morebutton" href="#more"><button>Voir plus</button></a>
    </section>
    <section id="more">

    </section>
<?php
include_once 'include/footer.inc.php';
?>
