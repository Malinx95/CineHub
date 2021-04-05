<?php
$title = "Rechercher";
$current = 2;
include_once 'include/header.inc.php';
include 'include/functions.inc.php';
?>
    <section id="card">
        <div class="center">
            <h2>Rechercher</h2>
            <form method="get" action="#more">
                <div>
                    <input class="searchbar" type="text" name="search" placeholder="rechercher un film ou une série"/>
                </div>
                <div>
                    <input class="searchbutton" type="submit" value="Rechercher">
                </div>
            </form>
        </div>
        <?php if(isset($_GET["search"]) && !empty($_GET["search"])){echo"<a class='morebutton' href='#more'><button>Voir plus</button></a>\n";}?>
    </section>
    <?php if(isset($_GET["search"]) && !empty($_GET["search"])){include_once 'include/results.inc.php';}?>
<?php
include_once 'include/footer.inc.php';
?>