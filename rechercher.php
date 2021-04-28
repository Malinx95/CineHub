<?php
$title = "Rechercher";
$current = 2;
$desc = "Page de recherche.";
include_once 'include/header.inc.php';
include 'include/functions.inc.php';
?>
    <section id="card">
        <h2>Barre de recherche</h2>
        <div class="center">
            <form method="get" action="#more">
                <div>
                    <input class="searchbar" type="text" name="search" placeholder="rechercher un film ou une série" <?php if(isset($_GET["search"]) && !empty($_GET["search"])){echo "value=\"", $_GET["search"], "\"";} ?>/>
                </div>
                <div>
                    <input class="searchbutton button" type="submit" value="Rechercher"/>
                </div>
            </form>
        </div>
<?php echo last(); ?>
<?php if(isset($_GET["search"]) && !empty($_GET["search"])){echo"\t\t<a class='morebutton button' href='#more'>Voir plus</a>\n";}?>
        <img class="bg" src="ressources/images/bg-cinema.jpg" alt="bg"/>
    </section>
    <?php
    if(isset($_GET["search"]) && !empty($_GET["search"])){
        include_once 'include/results.inc.php';
    }
    ?>
<?php
if(empty($_GET["search"])){
    $stick = true;
}
else{
    $stick = null;
}
include_once 'include/footer.inc.php';
?>