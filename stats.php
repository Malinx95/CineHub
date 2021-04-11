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
        <div class="ranking">
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
        <a class="morebutton button" href="#more">Voir plus</a>
    </section>
    <section id="more">

    </section>
<?php
include_once 'include/footer.inc.php';
?>
