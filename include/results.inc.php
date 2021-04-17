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
                    echo search_results($_GET["search"], "movie");
                    ?>
                </div>
            </fieldset>
            <fieldset>
                <legend>Séries</legend>
                <div class="scroll">
                    <?php
                    include_once 'include/functions.inc.php';
                    echo search_results($_GET["search"], "tv");
                    ?>
                </div>
            </fieldset>
        </fieldset>
    </section>
