<?php
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
    <link rel="stylesheet" href="style.css"/>
    <link rel="icon" href="ressources/logo/logo.png">
</head>
<body>
    <header id="header">
        <h1><?php echo$title?></h1>
        <nav>
            <img class="roundedcorner smalllogo" src="ressources/logo/logo.png" alt="logo"/>
            <ul>
                <?php
                if($current==0){
                    if(isset($_GET["from"]) && !empty($_GET["from"])){
                        echo "<li><a class='active' href='stats.php'>Retour</a></li>\n";
                    }
                    else if(isset($_COOKIE["last"]) && !empty($_COOKIE["last"])){
                        echo "<li><a class='active' href='rechercher.php?search=", $_COOKIE["last"], "#more'>Retour</a></li>\n";
                    }
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
