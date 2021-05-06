<?php
    session_start();
    // -- code qui gere le changement de theme
    if(empty($_COOKIE["theme"])){ // theme par defaut
        setcookie("theme", "dark", time()+60*60*24*365);
        $txt = "light";
        $img = "sun";
    }
    if(isset($_POST["theme"])){
        setcookie("theme", $_POST["theme"], time()+60*60*24*365);
        $page = basename($_SERVER["REQUEST_URI"]);
        if(strpos($page, "php") == false){
            $page = "index.php";
        }
        header("Location: $page");
        if($_POST["theme"] == "dark"){
            $txt = "light";
            $img = "sun";
        }
        else{
            $txt = "dark";
            $img = "moon";
        }
    }
    if(isset($_COOKIE["theme"])){
        if($_COOKIE["theme"] == "dark"){
            $txt = "light";
            $img = "sun";
        }
        else{
            $txt = "dark";
            $img = "moon";
        }
    }

    // -- code qui gere la construction et l'incrementation du fichier hits --
    if(!file_exists("stats/hits.txt")){ // cree hits si il existe pas
        $compteur=fopen("stats/hits.txt","w");
        $hit=1;
        setcookie("visit","ok",time()+60*30);
    }
    else{
        $compteur=fopen("stats/hits.txt","r+");
        $hit=fgets($compteur,255);
        if(empty($_COOKIE["visit"])){ // si pas de cookie visite, cree et incremente
            setcookie("visit","ok",time()+60*30);
            $hit++;
        }
    }
    fseek($compteur,0);
    fputs($compteur,$hit);
    fclose($compteur);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>CineHub - <?php echo$title?></title>
    <meta charset="utf-8"/>
    <meta name="description" content="<?php echo$desc?>"/>
    <meta name="author" content="Maxime Grodet &amp; Antoine Qiu"/>
    <meta name="date" content="29/04/2021"/>
    <meta name="keywords" content="CineHub"/>
    
    <!-- code qui selectionne le fichier css pour le theme -->
    <?php
    if(isset($_POST["theme"])){
        echo "<link rel=\"stylesheet\" href=\"" . $_POST["theme"] . ".css\"/>";
    }
    elseif(isset($_COOKIE["theme"])) {
        echo "<link rel=\"stylesheet\" href=\"" . $_COOKIE["theme"] . ".css\"/>";
    }
    else {
        echo "<link rel=\"stylesheet\" href=\"dark.css\"/>"; // theme par defaut
    }
    ?>

    <link rel="icon" href="ressources/logo/logo.png"/>
</head>
<body>
    <header id="header">
        <h1><?php echo$title?></h1>
        <nav>
            <a class="smalllogo" href="index.php">
                <img src="ressources/logo/logo.png" alt="logo"/>
                <p>CineHub</p>
            </a>

            <!-- code qui gere le bouton pour le theme -->
            <?php
            echo "<form class=\"theme\" method=\"post\">\n";
            echo "\t\t\t\t<input type=\"hidden\" name=\"theme\" value=\"$txt\" />\n";
            echo "\t\t\t\t<input type=\"submit\" value=\" \" style=\"background-image: url(ressources/images/$img.png);\" />\n";
            echo "\t\t\t</form>\n";
            ?>

            <ul>
                <!-- code qui gere l'affichage de la navbar -->
                <?php
                if($current==0){
                    if(isset($_GET["from"]) && !empty($_GET["from"])){
                        if($_GET["from"] == "stats"){
                            echo "<li><a href=\"stats.php\">Retour</a></li>\n";
                        }
                        else if($_GET["from"] == "search"){
                            if(isset($_GET["query"]) && !empty($_GET["query"])){
                                echo "<li><a href=\"rechercher.php?search=", $_GET["query"], "#more\">Retour</a></li>\n";
                            }
                            else{
                                echo "<li><a href=\"rechercher.php\">Retour</a></li>\n";
                            }
                        }
                    }
                    else{
                        echo "<li><a href=\"rechercher.php\">Retour</a></li>\n";
                    }

                    if(isset($_GET["type"]) && isset($_GET["id"]) && !empty($_GET["id"]) && ($_GET["type"] == "tv" || $_GET["type"] == "movie")){
                        if($_GET["type"] == "movie"){
                            setcookie("last_movie", $_GET["id"].";".date("d/m/Y").";".date("H:i"), time()+60*60*24*365);
                        }
                        else{
                            setcookie("last_tv", $_GET["id"].";".date("d/m/Y").";".date("H:i"), time()+60*60*24*365);
                        }
                    }
                }
                else{
                    echo "<li><a ";
                    if($current == 1){
                        echo "class=\"active\"";
                    }
                    echo " href=\"index.php\">Accueil</a></li>\n";

                    echo "\t\t\t\t<li><a ";
                    if($current == 2){
                        echo "class=\"active\"";
                    }
                    echo " href=\"rechercher.php\">Rechercher</a></li>\n";

                    echo "\t\t\t\t<li><a ";
                    if($current == 3){
                        echo "class=\"active\"";
                    }
                    echo " href=\"credits.php\">Crédits</a></li>\n";

                    echo "\t\t\t\t<li><a ";
                    if($current == 4){
                        echo "class=\"active\"";
                    }
                    echo " href=\"stats.php\">Statistiques</a></li>\n";
                }
                ?>
            </ul>
        </nav>
    </header>
