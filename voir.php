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
        if(!empty($results["poster_path"])){
            echo "\t<img class='poster' src='https://image.tmdb.org/t/p/original", $results["poster_path"], "' alt='poster ", $results["original_title"], "'/>\n";
        }
        else{
            echo "\t<img class='poster' src='ressources/images/no-image.png' alt='poster ", $results["original_title"], "'/>\n";
        }
        echo "\t<p>", $results["vote_average"], "/10 (", $results["vote_count"], " votes)</p>\n";
        echo "\t<h3>Synopsis</h3>\n";
        if(!empty($results["overview"])){
            echo "\t<p>", $results["overview"], "</p>\n";
        }
        else{
            echo "\t<p>Aucun synopsis disponible.</p>\n";
        }
    }

    if($_GET["type"] == "tv") {
        echo "<h2>", $results["original_name"], "</h2>\n";
        if(!empty($results["poster_path"])){
            echo "\t<img class='poster' src='https://image.tmdb.org/t/p/original", $results["poster_path"], "' alt='poster ", $results["original_name"], "'/>\n";
        }
        else{
            echo "\t<img class='poster' src='ressources/images/no-image.png' alt='poster ", $results["original_name"], "'/>\n";
        }
        echo "\t<p>", $results["vote_average"], "/10 (", $results["vote_count"], " votes)</p>\n";
        echo "\t<h3>Synopsis</h3>\n";
        if(!empty($results["overview"])){
            echo "\t<p>", $results["overview"], "</p>\n";
        }
        else{
            echo "\t<p>Aucun synopsis disponible.</p>\n";
        }
    }
    ?>
    <a class="morebutton" href="#more"><button>Voir plus</button></a>
</section>
<section id="more">
    <h2>Plus d'informations</h2>
    <?php
    if($_GET["type"] == "movie") {
        echo "\t<p>Origine : ", getInfo($results, "original_language"), "</p>\n";
        echo "\t<p>Réalisateurs : </p>\n";
        echo "\t<p>Durée : ", getInfo($results, "runtime"), "</p>\n";
        echo "\t<p>Acteurs : </p>\n";
        echo "\t<p>Genres : ", getList($results, "genres", "name"), "</p>\n";
        echo "\t<p>Date de sortie : ", getInfo($results, "release_date"), "</p>\n";
        echo "\t<p>Producteurs : ", getList($results, "production_companies", "name"), "</p>\n";
        echo "\t<p>Page officielle : <a href='", getInfo($results, "homepage"), "'>", getInfo($results, "homepage"), "</a></p>\n";
    }
    if($_GET["type"] == "tv") {
        echo "\t<p>Origine : ", getInfo($results, "original_language"), "</p>\n";
        echo "\t<p>Réalisateurs : ", getList($results, "created_by", "name"), "</p>\n";
        echo "\t<p>Durée des épisodes : ", getInfo($results, "episode_run_time")[0], "</p>\n";
        echo "\t<p>Acteurs : </p>\n";
        echo "\t<p>Genres : ", getList($results, "genres", "name"), "</p>\n";
        echo "\t<p>Date de sortie : ", getInfo($results, "first_air_date"), "</p>\n";
        echo "\t<p>Producteurs : ", getList($results, "production_companies", "name"), "</p>\n";
        echo "\t<p>Page officielle : <a href='", getInfo($results, "homepage"), "'>", getInfo($results, "homepage"), "</a></p>\n";
    }
    ?>
</section>
<?php
include_once 'include/footer.inc.php';
?>
