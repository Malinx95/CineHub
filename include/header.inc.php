<?php
    if(empty($_COOKIE["theme"])){
        setcookie("theme", "light", time()+60*30);
        $txt = "dark";
        $img = "moon";
    }
    if(isset($_GET["theme"])){
        setcookie("theme", $_GET["theme"], time()+60*30);
        $page = basename($_SERVER['PHP_SELF']);
        header("Location: $page");
        if($_GET["theme"] == "dark"){
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

    if(!file_exists("stats/hits.txt")){
        $compteur=fopen("stats/hits.txt","w");
        $hit=1;
        setcookie("visit","ok",time()+60*30);
    }
    else{
        $compteur=fopen("stats/hits.txt","r+");
        $hit=fgets($compteur,255);
        if(empty($_COOKIE["visit"])){
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
    <meta name="description" content="Projet DevWeb"/>
    <meta name='author' content='Maxime Grodet &amp; Antoine Qiu'/>
    <meta name='date' content='28/03/2021'/>
    <meta name='keywords' content='CineHub'/>
    <?php
    if(isset($_GET["theme"])){
        echo "<link rel=\"stylesheet\" href=\"" . $_GET["theme"] . ".css\"/>";
    }
    elseif(isset($_COOKIE["theme"])) {
        echo "<link rel=\"stylesheet\" href=\"" . $_COOKIE["theme"] . ".css\"/>";
    }
    else {
        echo "<link rel=\"stylesheet\" href=\"light.css\"/>";
    }
    ?>
    <!-- <link rel="stylesheet" href="dark.css"/> -->
    <link rel="icon" href="ressources/logo/logo.png"/>
</head>
<body>
    <header id="header">
        <h1><?php echo$title?></h1>
        <nav>
            <a class="smalllogo" href="index.php">
                <img src="ressources/logo/logo2.png" alt="logo"/>
                <p>CineHub</p>
            </a>

            <form class="theme" method="get">
                <input type="hidden" name="theme" value="<?php echo $txt ?>" />
                <input type="submit" value=" " style="background-image: url(ressources/images/<?php echo $img ?>.png);" />
            </form>
            <!-- <?php
            echo "<form method=\"get\">\n";
            if($_COOKIE["theme"] == "light"){
                echo "\t\t<input type=\"image\" name=\"theme\" value=\"dark\"/>\n";
            }
            else{
                echo "\t\t<input type=\"image\" name=\"theme\" value=\"light\"/>\n";
            }
            echo "\t</form>\n";
            ?> -->
            <ul>
                <?php
                if($current==0){
                    if(isset($_GET["from"]) && !empty($_GET["from"])){
                        if($_GET["from"] == "stats"){
                            echo "<li><a class='active' href='stats.php'>Retour</a></li>\n";
                        }
                        else if($_GET["from"] == "search"){
                            echo "<li><a class='active' href='rechercher.php?search=", $_GET["query"], "#more'>Retour</a></li>\n";
                        }
                    }
                    /*
                    else if(isset($_COOKIE["last"]) && !empty($_COOKIE["last"])){
                        echo "<li><a class='active' href='rechercher.php?search=", $_COOKIE["last"], "#more'>Retour</a></li>\n";
                    }
                    */
                    else{
                        echo "<li><a class='active' href='rechercher.php'>Retour</a></li>\n";
                    }
                }
                else{
                    echo "<li><a ";
                    if($current == 1){
                        echo "class='active'";
                    }
                    echo " href='index.php'>Accueil</a></li>\n";

                    echo "\t\t\t\t<li><a ";
                    if($current == 2){
                        echo "class='active'";
                    }
                    echo " href='rechercher.php'>Rechercher</a></li>\n";

                    echo "\t\t\t\t<li><a ";
                    if($current == 3){
                        echo "class='active'";
                    }
                    echo " href='credits.php'>Crédits</a></li>\n";

                    echo "\t\t\t\t<li><a ";
                    if($current == 4){
                        echo "class='active'";
                    }
                    echo " href='stats.php'>Statistiques</a></li>\n";
                }
                ?>
            </ul>
        </nav>
    </header>
