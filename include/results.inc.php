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
                <?php
                    include_once 'include/functions.inc.php';
                    $type = "movie";
                    $query = $_POST["q"];
                    $results = tmdb($type, $query);
                    foreach($results as $key => $value){
                        echo "\t\t\t\t<fieldset>\n";
                        $result = $value;
                        echo "\t\t\t\t\t<legend>", $result["original_title"], "</legend>\n";
                        echo "\t\t\t\t\t<p>Resume : ", $result["overview"], "</p>\n";
                        echo "\t\t\t\t</fieldset>\n";
                    }
                    
                ?>
            </fieldset>
            <fieldset>
                <legend>Séries</legend>
            </fieldset>
        </fieldset>
    </section>
