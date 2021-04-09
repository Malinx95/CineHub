<?php
$title = "Voir";
$current = 0;
include_once 'include/header.inc.php';
include 'include/functions.inc.php';
hits();
?>
<section id="card">
    <?php
    $results = details($_GET["id"]);
    if($_GET["type"] == "movie"){
        echo "<h2>", $results["original_title"], "</h2>";
        echo "<img src='https://image.tmdb.org/t/p/original", $results["poster_path"], "' width='500' alt='poster ", $results["original_title"], "'/>";
        echo "<p>", $results["overview"], "</p>";
    }
    if($_GET["type"] == "tv") {
        echo "<h2>", $results["original_name"], "</h2>";
        echo "<img src='https://image.tmdb.org/t/p/original", $results["poster_path"], "' width='500' alt='poster ", $results["original_name"], "'/>";
        echo "<p>", $results["overview"], "</p>";
    }
    ?>
    <a class="morebutton" href="#more"><button>Voir plus</button></a>
</section>
<section id="more">
    <h2>Plus d'informations</h2>

</section>
<?php
include_once 'include/footer.inc.php';
?>
