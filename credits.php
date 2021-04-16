<?php
$title = "Crédits";
$current = 3;
include_once 'include/header.inc.php';
include 'include/functions.inc.php';
?>
    <section id="card">
        <h2>Auteurs</h2>
        <div class="center">
            <div>
                <h3>Maxime Grodet</h3>
                <figure>
                    <figcaption>Mini cv Maxime</figcaption>
                    <img src="" alt="photo Maxime"/>
                </figure>
            </div>
            <div>
                <h3>Antoine Qiu</h3>
                <figure>
                    <figcaption>Mini cv Antoine</figcaption>
                    <img src="" alt="photo Antoine"/>
                </figure>
            </div>
        </div>
        <a class="morebutton button" href="#more">Voir plus</a>
    </section>
    <section id="more">
        <h2>Plus</h2>
        <div class="center">
            <div>
                <h3>CV</h3>
                <p>Présentation</p>
            </div>
            <div>
                <h3>Crédits</h3>
                <ul>
                    <li><p>API TMDB</p></li>
                    <li><p>API APOD</p></li>
                    <li><p>API Geoplugin</p></li>
                    <li><p>Prof?</p></li>
                    <div>Icons made by <a href="https://www.flaticon.com/authors/those-icons" title="Those Icons">Those Icons</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>
                </ul>
            </div>
            <div>
                <h3>CV</h3>
                <p>Présentation</p>
            </div>
        </div>
    </section>
<?php
include_once 'include/footer.inc.php';
?>