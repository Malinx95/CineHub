<?php
$title = "Crédits";
$current = 3;
$desc = "Crédits et remerciements.";
include_once 'include/header.inc.php';
include 'include/functions.inc.php';
?>
    <section id="card">
        <h2>Auteurs</h2>
        <div class="center">
            <div class="minicv maxime">
                <div>
                    <h3>Maxime Grodet</h3>
                    <h4>Présentation</h4>
                    <p>Je suis passionné par les ordinateurs et les nouvelles technologies dès mon plus jeune âge. J’ai toujours été en avance dans les matières technologiques et après le BAC S, j'ai poursuivi mes études en intégrant l'Université de Cergy-Pontoise afin d'y effectuer une licence en informatique.</p>
                </div>
            </div>
            <div class="minicv antoine">
                <div>
                    <h3>Antoine Qiu</h3>
                    <h4>Présentation</h4>
                    <p>Né en 2001 à Pontoise, j'ai toujours été très curieux et interessé par la technologie, l'informatique, le multimédia et les jeux vidéos.</p>
                    <p>Je suis actuellement en 2ème année de Licence Informatique à CY Cergy Paris Université.</p>
                </div>
            </div>
        </div>
        <a class="morebutton button" href="#more">Voir plus</a>
        <img class="bg" src="ressources/images/bg-cinema.jpg" alt="bg"/>
    </section>
    <section id="more">
        <h2>Plus</h2>
        <div class="center cv">
            <div class="left">
                <h3>CV - Maxime Grodet</h3>
                <h4>Parcours scolaire</h4>
                <ul>
                    <li><p>2015-2018 : Baccalauréat Scientifique science de l'ingénieur</p></li>
                    <li><p>2018-2019 : CMI SIC</p></li>
                    <li><p>2019-présent : Licence Informatique</p></li>
                </ul>
                <h4>Expériences</h4>
                <ul>
                    <li><p>fév . 2015 : Stage d'observation</p></li>
                    <li><p>étés 2016, 2017 et 2018 : CDD d'un mois au centre Pompidou en tant qu’agent d’accueil et de surveillance</p></li>
                    <li><p>juin 2019 : stage de cmi au centre de recherche ETIS de l’université de Cergy sur la création d’une interface web pour contrôler une tête robotique</p></li>
                    <li><p> juillet-août 2020 : Intérimaire dans une station d’autoroute Total en tant que Hôte de caisse</p></li>
                </ul>
            </div>
            <div class="middle">
                <h3>Crédits</h3>
                <ul>
                    <li>
                        <img class="tmdb" src="https://www.themoviedb.org/assets/2/v4/logos/v2/blue_square_2-d537fb228cf3ded904ef09b136fe3fec72548ebc1fea3fbbd1ad9e36364db38b.svg" alt="logo tmdb"/>
                        <p>Ce produit utilise l'API TMDb mais n'est pas approuvé ou certifié par TMDb.</p>
                    </li>
                    <li>
                        <p>Ce produit utilise l'<a href="https://apod.nasa.gov/apod/astropix.html">API APOD de la Nasa</a>.</p>
                    </li>
                    <li>
                        <p>Ce produit comprend des données GeoLite créées par MaxMind, disponibles sur <a href="http://www.maxmind.com">http://www.maxmind.com</a>.</p>
                    </li>
                    <li>
                        <p>Icônes réalisés par <a href="https://www.flaticon.com/authors/those-icons">Those Icons</a> sur <a href="https://www.flaticon.com/">https://www.flaticon.com</a></p>
                    </li>
                    <li>
                        <p>Photo de fond prise par Felix Mooneeram sur le site <a href="https://unsplash.com/photos/evlkOfkQ5rE">unsplash</a></p>
                    </li>
                    <li>
                        <p>Remerciements à Monsieur Marc Lemaire pour nous avoir guidé durant tout le long de ce semestre.</p>
                    </li>
                </ul>
            </div>
            <div class="right">
                <h3>CV - Antoine Qiu</h3>
                <h4>Parcours scolaire</h4>
                <ul>
                    <li><p>2016-2019 : Baccalauréat Scientifique</p></li>
                    <li><p>2019-présent : Licence Informatique</p></li>
                </ul>
                <h4>Expériences</h4>
                <ul>
                    <li><p>1-5 fév. 2016 : Stage d'observation</p></li>
                </ul>
            </div>
        </div>
    </section>
<?php
include_once 'include/footer.inc.php';
?>