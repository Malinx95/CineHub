<section id='more' class="long">
        <h2>Votre recherche</h2>
        <form method='post' action='#more' class='filtres'>
            <fieldset>
                <legend>Filtres</legend>
                <div>
                    <div>
                        <label>option 1</label>
                        <input type='checkbox'>
                    </div>
                    <div>
                        <label>option 2</label>
                        <input type='checkbox'>
                    </div>
                </div>
                <div>
                    <input class="button" type="submit" value="Appliquer les filtres">
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
                    $type = "movie";
                    $query = $_GET["search"];
                    $results = tmdb($type, $query);
                    foreach($results as $key => $value){
                        $result = $value;
                        echo "\t\t\t\t\t<a href='voir.php?id=", $result["id"], "&type=movie'>\n";
                        echo "\t\t\t\t\t\t<article>\n";
                        echo "\t\t\t\t\t\t\t<h3>", $result["original_title"], "</h3>\n";
                        if(isset($result["poster_path"])){
                            echo "\t\t\t\t\t\t\t<img class='thumbnail' src='https://image.tmdb.org/t/p/original", $result["poster_path"], "' alt='poster ", $result["original_name"], "'/>\n";
                        }
                        else{
                            echo "\t\t\t\t\t\t\t<img class='thumbnail' src='ressources/images/no-image.png' width='150' height='225' alt='no-image'/>\n";
                        }
                        echo "\t\t\t\t\t\t\t<p>", getInfo($result, "release_date", "Date indisponnible"), "</p>\n";
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
                        if(isset($result["poster_path"])){
                            echo "\t\t\t\t\t\t\t<img class='thumbnail' src='https://image.tmdb.org/t/p/original", $result["poster_path"], "' alt='poster ", $result["original_name"], "'/>\n";
                        }
                        else{
                            echo "\t\t\t\t\t\t\t<img class='thumbnail' src='ressources/images/no-image.png' width='150' height='225' alt='no-image'/>\n";
                        }
                        echo "\t\t\t\t\t\t\t<p>", getInfo($result, "first_air_date", "Date indisponnible"), "</p>\n";
                        echo "\t\t\t\t\t\t</article>\n";
                        echo "\t\t\t\t\t</a>\n";
                    }
                    ?>
                </div>
            </fieldset>
        </fieldset>
    </section>
