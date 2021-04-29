<?php
$title = "Statistiques";
$current = 4;
$desc = "Page de statistiques.";
include_once 'include/header.inc.php';
include 'include/functions.inc.php';
?>
    <section id="card">
        <h2>Top</h2>
        <div class="center ranking">
            <fieldset>
                <legend>Top des films les plus consultés</legend>
                <?php echo rankingTop("stats/movie_hits.csv", "movie");?>
            </fieldset>
            <fieldset>
                <legend>Top des series les plus consultés</legend>
                <?php echo rankingTop("stats/tv_hits.csv", "tv");?>
            </fieldset>
        </div>
        <?php echo "<p class=\"visits\">Nombre de magnifiques visiteurs : $hit</p>\n";?>
        <a class="morebutton button" href="#more">Voir plus</a>
        <img class="bg" src="ressources/images/bg-cinema.jpg" alt="bg"/>
    </section>
    <section id="more">
        <h2>Graphiques</h2>
        <div class="center graphs">
<?php
//echo svgGraph("stats/movie_hits.csv");
//echo svgGraph("stats/tv_hits.csv");
if(file_exists("stats/movie_hits.csv")){
    echo "\t\t\t<img src=\"include/graph1.php\" alt=\"graph1\"/>\n";
}
else{
    echo "\t\t\t<p>Aucune données à afficher</p>\n";
}
if(file_exists("stats/tv_hits.csv")){
    echo "\t\t\t<img src=\"include/graph2.php\" alt=\"graph2\"/>\n";
}
else{
    echo "\t\t\t<p>Aucune données à afficher</p>\n";
}
?>
        </div>
    </section>
<?php
include_once 'include/footer.inc.php';
?>
