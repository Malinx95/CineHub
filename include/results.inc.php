<section id='more'>
        <h2>Votre recherche</h2>
        <form method='post' action='#more' class='filtres'>
            <fieldset>
                <legend>Filtres</legend>
                <div>
                    <label>option 1</label>
                    <input type='checkbox'>
                    <label>option 2</label>
                    <input type='checkbox'>
                </div>
                <div>
                    <input type="submit" value="Appliquer les filtres">
                </div>
            </fieldset>
        </form>
        <fieldset class='results'>
            <legend>Résultat</legend>
            <fieldset>
                <legend>Films</legend>
                <div class="scroll">
                    <?php
                    include_once 'include/functions.inc.php';
                    define("NUMBER", 10);
                    $type = "movie";
                    $query = $_GET["search"];
                    $results = tmdb($type, $query);
                    foreach($results as $key => $value){
                        $result = $value;
                        echo "\t\t\t\t\t<a href='voir.php?id=", $result["id"], "&type=movie'>\n";
                        echo "\t\t\t\t\t\t<article>\n";
                        echo "\t\t\t\t\t\t\t<h3>", $result["original_title"], "</h3>\n";
                        echo "\t\t\t\t\t\t\t<img src='https://image.tmdb.org/t/p/original", $result["poster_path"], "' width='150' alt='poster ", $result["original_title"], "'/>\n";
                        echo "\t\t\t\t\t\t\t<p>", $result["release_date"], "</p>\n";
                        echo "\t\t\t\t\t\t</article>\n";
                        echo "\t\t\t\t\t</a>\n";
                    }
                    ?>
                </div>
            </fieldset>
            <fieldset>
                <legend>Séries</legend>
                <div class="scroll">
                    <?php
                    include_once 'include/functions.inc.php';
                    $type = "tv";
                    $query = $_GET["search"];
                    $results = tmdb($type, $query);
                    foreach($results as $key => $value){
                        $result = $value;
                        echo "\t\t\t\t\t<a href='voir.php?id=", $result["id"], "&type=tv'>\n";
                        echo "\t\t\t\t\t\t<article>\n";
                        echo "\t\t\t\t\t\t\t<h3>", $result["original_name"], "</h3>\n";
                        echo "\t\t\t\t\t\t\t<img src='https://image.tmdb.org/t/p/original", $result["poster_path"], "' width='150' alt='poster ", $result["original_name"], "'/>\n";
                        echo "\t\t\t\t\t\t\t<p>", $result["first_air_date"], "</p>\n";
                        echo "\t\t\t\t\t\t</article>\n";
                        echo "\t\t\t\t\t</a>\n";
                    }
                    ?>
                </div>
            </fieldset>
        </fieldset>
    </section>
