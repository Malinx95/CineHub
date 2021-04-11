<?php
$title = "Rechercher";
$current = 2;
include_once 'include/header.inc.php';
include 'include/functions.inc.php';
if(isset($_GET["search"]) && !empty($_GET["search"])) {
    setcookie("last", $_GET["search"], time() + 60*60*24*365);
}
?>
    <section id="card" <?php if(empty($_GET["search"])){echo "style=\"height: 80vh\"";} ?>>
        <div class="center">
            <h2>Rechercher</h2>
            <form method="get" action="#more">
                <div>
                    <input class="searchbar" type="text" name="search" placeholder="rechercher un film ou une série" <?php if(isset($_GET["search"]) && !empty($_GET["search"])){echo "value='", $_GET['search'], "'";} ?>/>
                </div>
                <div>
                    <input class="searchbutton" type="submit" value="Rechercher">
                </div>
            </form>
        </div>
        <?php if(isset($_GET["search"]) && !empty($_GET["search"])){echo"<a class='morebutton button' href='#more'>Voir plus</a>\n";}?>
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