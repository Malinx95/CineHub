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
    </section>
    <section id="more">
        <h2>Graphiques</h2>
        <div class="center">
            <?php
            echo svgGraph("stats/movie_hits.csv");
            echo svgGraph("stats/tv_hits.csv");
            echo "<img src='include/graph1.php' />\n";
            echo "<img src='include/graph2.php' />\n";
            ?>
        </div>
    </section>
<?php
include_once 'include/footer.inc.php';
?>
