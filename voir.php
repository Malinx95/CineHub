<?php
$current = 0;
include 'include/functions.inc.php';
if(isset($_GET["id"]) && !empty($_GET["id"]) && isset($_GET["type"]) && ($_GET["type"] == "movie" || $_GET["type"] == "tv")){
    $id = $_GET["id"];
    $type = $_GET["type"];
    $infos = getInfos($id, array("title", "poster", "rating", "overview", "backdrop", "origin", "directors", "time", "actors", "genres", "date", "producers", "site"), $type);
    $title = $infos[0];
}
else{
    $title = "error";
}
if(isset($info)){
    $desc = $infos[3];
}
include_once 'include/header.inc.php';
if(isset($id) && !empty($id) && isset($type) && !empty($type)){
    hits();
}
?>
    <section id="card">
        <?php
        if(isset($id) && !empty($id) && isset($type) && !empty($type)){
            echo "<h2>Résumé</h2>\n";
            echo "\t\t<div class=\"center\">\n";
            echo "\t\t\t<img class=\"poster\" src=\"", $infos[1], "\" alt=\"poster ", $infos[0], "\"/>\n";
            echo "\t\t\t<p>", $infos[2], "</p>\n";
            echo "\t\t\t<h3>Synopsis</h3>\n";
            echo "\t\t\t<p class=\"synopsis\">", $infos[3], "</p>\n";
            echo "\t\t</div>\n";
        }
        else{
            echo "<h2>erreur</h2>";
        }
        ?>
        <a class="morebutton button" href="#more">Voir plus</a>
        <?php
        if(isset($id) && !empty($id) && isset($type) && !empty($type)){
            echo "<img class=\"bg\" src=\"" . $infos[4] . "\" alt=\"bg\"/>\n";
        }
        ?>
    </section>
    <section id="more">
        <h2>Plus d'informations</h2>
        <div class="center infos">
            <?php
            if(isset($id) && !empty($id) && isset($type) && !empty($type)){
                echo "<div>\n";
                echo "\t\t\t\t<h3>Langue originale</h3>\n";
                echo "\t\t\t\t<p>", $infos[5], "</p>\n";
                if($type == "movie"){
                    echo "\t\t\t\t<h3>Réalisateurs</h3>\n";
                }
                else{
                    echo "\t\t\t\t<h3>Créateurs</h3>\n";
                }
                echo "\t\t\t\t<ul>\n" . $infos[6] . "\t\t\t\t</ul>\n";
                if($type == "movie"){
                    echo "\t\t\t\t<h3>Durée</h3>\n";
                }
                else{
                    echo "\t\t\t\t<h3>Durée des épisodes</h3>\n";
                }
                echo "\t\t\t\t<p>", $infos[7], "</p>\n";
                echo "\t\t\t\t<h3>Acteurs</h3>\n";
                echo "\t\t\t\t<ul>\n". $infos[8] . "\t\t\t\t</ul>\n";
                echo "\t\t\t</div>\n";
                echo "\t\t\t<div>\n";
                echo "\t\t\t\t<h3>Genres</h3>\n";
                echo "\t\t\t\t<p>", $infos[9], "</p>\n";
                echo "\t\t\t\t<h3>Date de sortie</h3>\n";
                echo "\t\t\t\t<p>", $infos[10], "</p>\n";
                echo "\t\t\t\t<h3>Producteurs</h3>\n";
                echo "\t\t\t\t<p>", $infos[11], "</p>\n";
                echo "\t\t\t\t<h3>Page officielle</h3>\n";
                echo "\t\t\t\t<p>", $infos[12], "</p>\n";
                echo "\t\t\t</div>\n";
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
