<?php
$title = "Voir";
$current = 0;
include_once 'include/header.inc.php';
include 'include/functions.inc.php';
hits();
?>
<section id="card">
    <?php
    $results = details($_GET["id"]);
    if($_GET["type"] == "movie"){
        echo "<h2>", $results["original_title"], "</h2>\n";
        echo "\t<div class='center'>\n";
        if(!empty($results["poster_path"])){
            echo "\t\t<img class='poster' src='https://image.tmdb.org/t/p/original", $results["poster_path"], "' alt='poster ", $results["original_title"], "'/>\n";
        }
        else{
            echo "\t\t<img class='poster' src='ressources/images/no-image.png' alt='poster ", $results["original_title"], "'/>\n";
        }
        echo "\t\t<p>", $results["vote_average"], "/10 (", $results["vote_count"], " votes)</p>\n";
        echo "\t\t<h3>Synopsis</h3>\n";
        if(!empty($results["overview"])){
            echo "\t\t<p>", $results["overview"], "</p>\n";
        }
        else{
            echo "\t\t<p>Aucun synopsis disponible.</p>\n";
        }
        echo "\t</div>\n";
    }

    if($_GET["type"] == "tv") {
        echo "<h2>", $results["original_name"], "</h2>\n";
        echo "\t<div class='center'>\n";
        if(!empty($results["poster_path"])){
            echo "\t\t<img class='poster' src='https://image.tmdb.org/t/p/original", $results["poster_path"], "' alt='poster ", $results["original_name"], "'/>\n";
        }
        else{
            echo "\t\t<img class='poster' src='ressources/images/no-image.png' alt='poster ", $results["original_name"], "'/>\n";
        }
        echo "\t\t<p>", $results["vote_average"], "/10 (", $results["vote_count"], " votes)</p>\n";
        echo "\t\t<h3>Synopsis</h3>\n";
        if(!empty($results["overview"])){
            echo "\t\t<p>", $results["overview"], "</p>\n";
        }
        else{
            echo "\t\t<p>Aucun synopsis disponible.</p>\n";
        }
        echo "\t</div>\n";
    }
    ?>
    <a class="morebutton button" href="#more">Voir plus</a>
    <img class="bg" src="https://stationf.co/wp-content/uploads/2019/06/hero-home-page.jpg" alt="bg"/>
</section>
<section id="more">
    <h2>Plus d'informations</h2>
    <div class="center">
        <?php
        if($_GET["type"] == "movie") {
            echo "\t\t<p>Origine : ", getInfo($results, "original_language"), "</p>\n";
            echo "\t\t<p>Réalisateurs : </p>\n";
            echo "\t\t<p>Durée : ", getInfo($results, "runtime"), "</p>\n";
            echo "\t\t<p>Acteurs : </p>\n";
            echo "\t\t<p>Genres : ", getList($results, "genres", "name"), "</p>\n";
            echo "\t\t<p>Date de sortie : ", getInfo($results, "release_date"), "</p>\n";
            echo "\t\t<p>Producteurs : ", getList($results, "production_companies", "name"), "</p>\n";
            echo "\t\t<p>Page officielle : <a href='", getInfo($results, "homepage"), "'>", getInfo($results, "homepage"), "</a></p>\n";
        }
        if($_GET["type"] == "tv") {
            echo "\t\t<p>Origine : ", getInfo($results, "original_language"), "</p>\n";
            echo "\t\t<p>Réalisateurs : ", getList($results, "created_by", "name"), "</p>\n";
            echo "\t\t<p>Durée des épisodes : ", getInfo($results, "episode_run_time")[0], "</p>\n";
            echo "\t\t<p>Acteurs : </p>\n";
            echo "\t\t<p>Genres : ", getList($results, "genres", "name"), "</p>\n";
            echo "\t\t<p>Date de sortie : ", getInfo($results, "first_air_date"), "</p>\n";
            echo "\t\t<p>Producteurs : ", getList($results, "production_companies", "name"), "</p>\n";
            echo "\t\t<p>Page officielle : <a href='", getInfo($results, "homepage"), "'>", getInfo($results, "homepage"), "</a></p>\n";
        }
        ?>
    </div>

</section>
<?php
include_once 'include/footer.inc.php';
?>
