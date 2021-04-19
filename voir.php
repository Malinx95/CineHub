<?php
$current = 0;
include 'include/functions.inc.php';
if(isset($_GET["id"]) && isset($_GET["type"])){
    $id = $_GET["id"];
    $type = $_GET["type"];
    $title = getInfo($id, "title", $type);
}
else{
    $title = "error";
}
include_once 'include/header.inc.php';
hits();
?>
    <section id="card">
        <?php
        if(isset($id) && isset($type)){
            echo "<h2>Résumé</h2>\n";
            echo "\t\t<div class=\"center\">\n";
            echo "\t\t\t<img class=\"poster\" src=\"", getInfo($id, "poster", $type), "\" alt=\"poster ", getInfo($id, "title", $type), "\"/>\n";
            echo "\t\t\t<p>", getInfo($id, "rating", $type), "</p>\n";
            echo "\t\t\t<h3>Synopsis</h3>\n";
            echo "\t\t\t<p>", getInfo($id, "overview", $type), "</p>\n";
            echo "\t\t</div>\n";
        }
        else{
            echo "<h2>erreur</h2>";
        }
        ?>
        <a class="morebutton button" href="#more">Voir plus</a>
        <?php
        if(isset($id) && isset($type)){
            echo "<img class=\"bg\" src=\"" . getInfo($id, "backdrop", $type) . "\" alt=\"bg\"/>\n";
        }
        else{
            echo "error";
        }
        ?>
    </section>
    <section id="more">
        <h2>Plus d'informations</h2>
        <div class="center">
            <?php
            if(isset($id) && isset($type)){
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
            }
            else{
                echo "<h3>error</h3>\n";
            }
            ?>
        </div>
    </section>
<?php
include_once 'include/footer.inc.php';
?>
