<?php
$title = "Statistiques";
$current = 4;
include_once 'include/header.inc.php';
include 'include/functions.inc.php';
?>
    <section id="card">
        <h2>Top</h2>
        <div class="center ranking">
            <fieldset>
                <legend>Top des films les plus consultés</legend>
                <?php
                    echo rankingTop("stats/movie_hits.csv", "movie");
                ?>
            </fieldset>
            <fieldset>
                <legend>Top des series les plus consultés</legend>
                <?php
                    echo rankingTop("stats/tv_hits.csv", "tv");
                ?>
            </fieldset>
        </div>
        <?php
        echo "<p>Nombre de magnifique visiteur : $hit</p>\n"
        ?>
        <a class="morebutton button" href="#more">Voir plus</a>
        <img class="bg" src="https://stationf.co/wp-content/uploads/2019/06/hero-home-page.jpg" alt="bg"/>
    </section>
    <section id="more">
        <h2>Graphiques</h2>
        <div class="center">
<?php
echo svgGraph("stats/movie_hits.csv");
echo svgGraph("stats/tv_hits.csv");
echo "\t\t\t<img src=\"include/graph1.php\" alt=\"graph1\"/>\n";
echo "\t\t\t<img src=\"include/graph2.php\" alt=\"graph2\"/>\n";
?>
        </div>
    </section>
<?php
include_once 'include/footer.inc.php';
?>
