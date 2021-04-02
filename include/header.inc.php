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
                    echo "<li><a class='active' href='rechercher.php'>Retour</a></li>\n";}
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
