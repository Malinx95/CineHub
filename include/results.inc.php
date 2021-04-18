<section id='more' class="long">
        <h2>Votre recherche</h2>
        <form method='post' action='#more' class='filtres'>
            <fieldset>
                <legend>Filtres</legend>
                <div>
                    <div>
                        <label for="movie">Films</label>
                        <input id="movie" type='radio' name="type" value="movie" <?php if(isset($_POST["type"]) && $_POST["type"] == "movie"){echo "checked=\"true\"";}?>/>
                        <label for="both">Films &amp; Séries</label>
                        <input id="both" type='radio' name="type" value="both" <?php if(!isset($_POST["type"]) || $_POST["type"] == "both"){echo "checked=\"true\"";}?>/>
                        <label for="tv">Séries</label>
                        <input id="tv" type='radio' name="type" value="tv" <?php if(isset($_POST["type"]) && $_POST["type"] == "tv"){echo "checked=\"true\"";}?>/>
                    </div>
                </div>
                <div>
                    <input class="button" type="submit" value="Appliquer les filtres"/>
                </div>
            </fieldset>
        </form>
        <fieldset class="results">
            <legend>Résultat</legend>
<?php echo search_results($_GET["search"]); ?>
        </fieldset>
    </section>
