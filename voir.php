<?php
$current = 0;
include 'include/functions.inc.php';
$id = $_GET["id"];
$type = $_GET["type"];
$title = getInfo($id, "title", $type);
include_once 'include/header.inc.php';
hits();
?>
    <section id="card">
        <?php
        echo "<h2>Résumé</h2>\n";
        echo "\t\t<div class=\"center\">\n";
        echo "\t\t\t<img class=\"poster\" src=\"", getInfo($id, "poster", $type), "\" alt=\"poster ", getInfo($id, "title", $type), "\"/>\n";
        echo "\t\t\t<p>", getInfo($id, "rating", $type), "</p>\n";
        echo "\t\t\t<h3>Synopsis</h3>\n";
        echo "\t\t\t<p>", getInfo($id, "overview", $type), "</p>\n";
        echo "\t\t</div>\n";
        ?>
        <a class="morebutton button" href="#more">Voir plus</a>
        <?php echo "<img class=\"bg\" src=\"" . getInfo($id, "backdrop", $type) . "\" alt=\"bg\"/>\n" ?>
    </section>
    <section id="more">
        <h2>Plus d'informations</h2>
        <div class="center">
            <?php
            echo "<h3>Origine</h3>\n";
            echo "\t\t\t<p>", getInfo($id, "origin", $type), "</p>\n";
            echo "\t\t\t<h3>Réalisateurs</h3>\n";
            echo "\t\t\t<p>" . getInfo($id, "directors", $type) . "</p>\n";
            echo "\t\t\t<h3>Durée</h3>\n";
            echo "\t\t\t<p>", getInfo($id, "time", $type), "</p>\n";
            echo "\t\t\t<h3>Acteurs</h3>\n";
            echo "\t\t\t<p>". getInfo($id, "actors", $type) . "</p>\n";
            echo "\t\t\t<h3>Genres</h3>\n";
            echo "\t\t\t<p>", getInfo($id, "genres", $type), "</p>\n";
            echo "\t\t\t<h3>Date de sortie</h3>\n";
            echo "\t\t\t<p>", getInfo($id, "date", $type), "</p>\n";
            echo "\t\t\t<h3>Producteurs</h3>\n";
            echo "\t\t\t<p>", getInfo($id, "producers", $type), "</p>\n";
            echo "\t\t\t<h3>Page officielle</h3>\n";
            echo "\t\t\t<p>", getInfo($id, "site", $type), "</p>\n";
            ?>
        </div>
    </section>
<?php
include_once 'include/footer.inc.php';
?>
