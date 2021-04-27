<?php
$title = "Crédits";
$current = 3;
include_once 'include/header.inc.php';
include 'include/functions.inc.php';
?>
    <section id="card">
        <h2>Auteurs</h2>
        <div class="center">
            <div class="minicv maxime">
                <figure>
                    <figcaption>Photo Maxime</figcaption>
                    <img src="ressources/images/no-image.png" alt="photo Maxime"/>
                </figure>
                <div>
                    <h3>Maxime Grodet</h3>
                    <h4>Présentation</h4>
                    <p>Petite intro blabla blabla blabla blabla blabla blabla blabla blabla blabla blabla blabla blabla blabla blabla blabla</p>
                </div>
            </div>
            <div class="minicv antoine">
                <figure>
                    <figcaption>Photo Antoine</figcaption>
                    <img src="ressources/images/no-image.png" alt="photo Antoine"/>
                </figure>
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
                    <li><p>diplôme</p></li>
                    <li><p>diplôme</p></li>
                </ul>
                <h4>Expériences</h4>
                <ul>
                    <li><p>expérience</p></li>
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