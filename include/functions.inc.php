<?php
define("KEY", "a22fd943c9bbecd346f31c75d2bd3969");

function nasa() { //retourne img
    $url = "https://api.nasa.gov/planetary/apod?api_key=5aX68ZvOKjY5HvFA4IQbZ6QVnkcUOvhQMc8bEfbs&date=";//.date('Y-m-d');
    $json = file_get_contents($url);
    $obj = json_decode($json);
    $url = $obj->{'url'};
    if(strpos($url, "youtube") != false){
        return "<iframe class=\"nasa\" src=\"$url&autoplay=1&mute=1\"/>";
    }
    else{
        return "<img class=\"nasa\" src=\"$url\" alt=\"image nasa\"/>\n";
    }
}

function geo() { //retourne geolocalisation
    $url = "http://www.geoplugin.net/xml.gp?ip=".$_SERVER['REMOTE_ADDR'];
    $xml = simplexml_load_file($url);
    $out = "";
    if(!empty($xml->geoplugin_city)){
        $out = $out."Ville : ".$xml->geoplugin_city."\t";
    }
    if(!empty($xml->geoplugin_regionName)){
        $out = $out."Région : ".$xml->geoplugin_regionName."\t";
    }
    if(!empty($xml->geoplugin_countryName)){
        $out = $out."Pays : ".$xml->geoplugin_countryName;
    }
    return $out;
}

/*
function tmdb($type, $query) { //requete api the movie database
    $query = str_replace(" ", "+", $query);
    $key = "?api_key=a22fd943c9bbecd346f31c75d2bd3969";
    $url = "https://api.themoviedb.org/3/search/" . $type . $key . "&query=" . $query;
    //echo "<a href=\"", $url, "\">request</a>\n";
    $json = file_get_contents($url);
    $obj = json_decode($json, true);
    $result = $obj["results"];
    return $result;
}
*/

function search($json, $query, $type, $expand=false){
    $out = "\t\t\t<fieldset>\n";
    if($type == "movie"){
        $out .= "\t\t\t\t<legend>Films</legend>\n";
    }
    else{
        $out .= "\t\t\t\t<legend>Séries</legend>\n";
    }
    if($expand){
        $out .= "\t\t\t\t<div class=\"scroll expand\">\n";
    }
    else{
        $out .= "\t\t\t\t<div class=\"scroll\">\n";
    }
    foreach ($json as $result) {
        if($type == "movie"){
            $title = $result["original_title"];
            if(empty($result["release_date"])){
                $date = "Date indisponible";
            }
            else{
                $date = $result["release_date"];
                $date = explode("-", $date);
                $date = $date[2] . "/" . $date[1] . "/" . $date[0];
            }
        }
        else{
            $title = $result["original_name"];
            if(empty($result["first_air_date"])){
                $date = "Date indisponible";
            }
            else{
                $date = $result["first_air_date"];
                $date = explode("-", $date);
                $date = $date[2] . "/" . $date[1] . "/" . $date[0];
            }
        }
        $poster = $result["poster_path"];
        if(empty($poster)){
            $poster = "ressources/images/no-image.png";
        }
        else{
            $poster = "https://image.tmdb.org/t/p/original" . $poster;
        }
        $out .= "\t\t\t\t\t<a href=\"voir.php?id=" . $result["id"] . "&type=$type&from=search&query=" . $query . "\">\n";
        $out .= "\t\t\t\t\t\t<article>\n";
        $out .= "\t\t\t\t\t\t\t<h3>" . $title . "</h3>\n";
        $out .= "\t\t\t\t\t\t\t<img class=\"thumbnail\" src=\"$poster\" alt=\"poster " . $title . "\"/>\n";
        $out .= "\t\t\t\t\t\t\t<p>" . $date . "</p>\n";
        $out .= "\t\t\t\t\t\t</article>\n";
        $out .= "\t\t\t\t\t</a>\n";
    }
    $out .= "\t\t\t\t</div>\n";
    $out .= "\t\t\t</fieldset>\n";
    return $out;
}

function search_results($query){
    $query = str_replace("&", "%26", $query);
    $query = str_replace("+", "%2B", $query);
    $query = str_replace(" ", "+", $query);
    $movie = getJSON("https://api.themoviedb.org/3/search/movie?api_key=" . KEY . "&query=" . $query)["results"];
    $tv = getJSON("https://api.themoviedb.org/3/search/tv?api_key=" . KEY . "&query=" . $query)["results"];
    $out = "";
    if(empty($tv) && empty($movie)){
        $out .= "<p>Aucun résultat</p>";
    }
    else if(empty($tv) || (isset($_POST["type"]) && $_POST["type"] == "movie")){
        $out .= search($movie, $query, "movie", true);
    }
    else if(empty($movie) || (isset($_POST["type"]) && $_POST["type"] == "tv")){
        $out .= search($tv, $query, "tv", true);
    }
    else{
        $out .= search($movie, $query, "movie");
        $out .= search($tv, $query, "tv");
    }
    return $out;
}

/*
function details($id, $movie = true){
    $key = "?api_key=a22fd943c9bbecd346f31c75d2bd3969";
    if($_GET["type"] == "movie"){
        $url = "https://api.themoviedb.org/3/movie/" . $id . $key . "&language=fr";
    }
    if($_GET["type"] == "tv"){
        $url = "https://api.themoviedb.org/3/tv/" . $id . $key . "&language=fr";
    }
    //echo $url;
    $json = file_get_contents($url);
    $obj = json_decode($json, true);
    return $obj;
}

function detailsTop($id, $movie){
    $key = "?api_key=a22fd943c9bbecd346f31c75d2bd3969";
    if($movie == "movie"){
        $url = "https://api.themoviedb.org/3/movie/" . $id . $key . "&language=fr";
    }
    if($movie == "tv"){
        $url = "https://api.themoviedb.org/3/tv/" . $id . $key . "&language=fr";
    }
    //echo $url;
    $json = file_get_contents($url);
    $obj = json_decode($json, true);
    return $obj;
}
*/

function hits(){
    if(isset($_GET["id"])){
        $id = $_GET["id"];
        if ($_GET["type"] == "movie") {
            $fichier = "stats/movie_hits.csv";
        } else {
            $fichier = "stats/tv_hits.csv";
        }
        if (!file_exists($fichier)) {
            $compteur = fopen($fichier, "w");
            $hit = array($id, "1");
            fputcsv($compteur, $hit, ";");
            setcookie($id, $id, time() + 30 * 60);
        } else {
            $compteur = fopen($fichier, "r+");
            $c = 0;
            $found = false;
            while ($line = fgetcsv($compteur, 0, ";")) {
                if ($line[0] == $id) {
                    $line[1]++;
                    $found = true;
                }
                $array[$c] = $line[0];
                $c++;
                $array[$c] = $line[1];
                $c++;
            }
            if (!$found) {
                $array[$c] = $id;
                $array[$c + 1] = 1;
            }
            fclose($compteur);
            $compteur = fopen($fichier, "w");
            for ($i = 0; $i < sizeof($array); $i = $i + 2) {
                fputcsv($compteur, array($array[$i], $array[$i + 1]), ";");
            }
        }
        fclose($compteur);
    }
}

function getJSON($url){
    $json = file_get_contents($url);
    return json_decode($json, true);
}

function getInfo($id, $info, $type="movie"){
    switch ($info){
        case "backdrop":
            $url = "https://api.themoviedb.org/3/$type/$id?api_key=" . KEY . "&language=fr";
            $json = getJSON($url);
            $backdrop = $json["backdrop_path"];
            if(!empty($backdrop)){
                return "https://image.tmdb.org/t/p/original$backdrop";
            }
            else{
                return "ressources/images/no-image.png";
            }
        case "title":
            $url = "https://api.themoviedb.org/3/$type/$id?api_key=" . KEY . "&language=fr";
            $json = getJSON($url);
            if($type == "movie"){
                $title = $json["original_title"];
            }
            else{
                $title = $json["original_name"];
            }
            if(empty($title)){
                return "Titre indisponible";
            }
            return $title;

        case "poster":
            $url = "https://api.themoviedb.org/3/$type/$id?api_key=" . KEY . "&language=fr";
            $json = getJSON($url);
            $poster = $json["poster_path"];
            if(!empty($poster)){
                return "https://image.tmdb.org/t/p/original$poster";
            }
            else{
                return "ressources/images/no-image.png";
            }

        case "overview":
            $url = "https://api.themoviedb.org/3/$type/$id?api_key=" . KEY . "&language=fr";
            $json = getJSON($url);
            $overview = $json["overview"];
            if(empty($overview)){
                return "Synopsys indisponible";
            }
            return $overview;

        case "rating":
            $url = "https://api.themoviedb.org/3/$type/$id?api_key=" . KEY . "&language=fr";
            $json = getJSON($url);
            $average = $json["vote_average"];
            $count = $json["vote_count"];
            if(empty($average) || empty($count)){
                return "Note indisponible";
            }
            return $average . "/10 (" . $count . " votes)";

        case "origin":
            $url = "https://api.themoviedb.org/3/$type/$id?api_key=" . KEY . "&language=fr";
            $json = getJSON($url);
            $origin = $json["original_language"];
            if(empty($origin)){
                return "Origine indisponible";
            }
            return ucfirst(Locale::getDisplayLanguage($origin, "fr"));

        case "directors":
            $url = "https://api.themoviedb.org/3/$type/$id/credits?api_key=" . KEY . "&language=fr";
            $json = getJSON($url);
            if(empty($json["crew"])){
                return "Réalisateurs indisponibles";
            }
            $out = "";
            foreach($json["crew"] as $crew){
                if($crew["job"] == "Director"){
                    $out .= "<li><p>" . $crew["name"] . "<div class=\"pop\">" . getPerson($crew["id"]) . "</div></p></li>";
                }
            }
            return $out;

        case "time":
            $url = "https://api.themoviedb.org/3/$type/$id?api_key=" . KEY . "&language=fr";
            $json = getJSON($url);
            if($type == "movie"){
                $time = $json["runtime"];
                if(empty($time)){
                    return "Durée indisponible";
                }
                $h = explode(".", $time/60)[0];
                $m = $time - $h*60;
                return $h . "h" . $m . "m";
            }
            else{
                if(empty($json["episode_run_time"])){
                    return "Durée indisponible";
                }
                $out = "";
                foreach($json["episode_run_time"] as $time){
                    $out .= $time . "m, ";
                }
                return substr($out, 0, strlen($out)-2);
            }

        case "actors":
            $url = "https://api.themoviedb.org/3/$type/$id/credits?api_key=" . KEY . "&language=fr";
            $json = getJSON($url);
            if(empty($json["cast"])){
                return "Acteurs indisponibles";
            }
            $out = "";
            $crew = $json["cast"];
            for($i=0 ; $i<5 ; $i++){
                if(!empty($crew[$i]) && $crew[$i]["known_for_department"] == "Acting"){
                    $out .= "<li><p>" . $crew[$i]["name"] . "<div class=\"pop\">" . getPerson($crew[$i]["id"]) . "</div></p></li>";
                }
            }
            return $out;

        case "genres":
            $url = "https://api.themoviedb.org/3/$type/$id?api_key=" . KEY . "&language=fr";
            $json = getJSON($url);
            if(empty($json["genres"])){
                return "Genres indisponibles";
            }
            $out = "";
            foreach($json["genres"] as $genre){
                $out .= $genre["name"] . ", ";
            }
            return substr($out, 0, strlen($out)-2);

        case "date":
            $url = "https://api.themoviedb.org/3/$type/$id?api_key=" . KEY . "&language=fr";
            $json = getJSON($url);
            if($type == "movie"){
                $date = $json["release_date"];
            }
            else{
                $date = $json["first_air_date"];
            }
            if(empty($date)){
                return "Date indisponible";
            }
            $date = explode("-", $date);
            return $date[2] . "/" . $date[1] . "/" . $date[0];

        case "producers":
            $url = "https://api.themoviedb.org/3/$type/$id?api_key=" . KEY . "&language=fr";
            $json = getJSON($url);
            if(empty($json["production_companies"])){
                return "Producteurs indisponibles";
            }
            $out = "";
            foreach($json["production_companies"] as $producer){
                $out .= $producer["name"] . ", ";
            }
            return substr($out, 0, strlen($out)-2);

        case "site":
            $url = "https://api.themoviedb.org/3/$type/$id?api_key=" . KEY . "&language=fr";
            $json = getJSON($url);
            $homepage = $json["homepage"];
            if(!empty($homepage)){
                return "<a href=\"$homepage\">$homepage</a>";
            }
            else{
                return "Page officielle indisponible";
            }
    }
}

function getPerson($id){
    $details = getJSON("https://api.themoviedb.org/3/person/$id?api_key=" . KEY . "&language=fr");
    $img = getJSON("https://api.themoviedb.org/3/person/$id/images?api_key=" . KEY)["profiles"][0]["file_path"];
    if(!empty($img)){
        $img = "https://image.tmdb.org/t/p/original" . $img;
    }
    else{
        $img = "ressources/images/no-image.png";
    }
    $out = "<div>";
    $out .= "<h3>" . $details["name"] . "</h3>";
    $out .= "<img src=\"$img\" alt=\"photo " . $details["name"] . "\"/>";
    $out .= "</div>";
    $out .= "<div class=\"persondesc\">";
    $out .= "<h4>Date de naissance</h4>";
    $out .= "<p>" . $details["birthday"] . "</p>";
    $out .= "<h4>Profession</h4>";
    $out .= "<p>" . $details["known_for_department"] . "</p>";
    $out .= "<h4>Biographie</h4>";
    $bio = $details["biography"];
    if(empty($bio)){
        $bio = "Biographie indisponible";
    }
    $out .= "<p>" . $bio . "</p>";
    $out .= "</div>";
    return $out;
}

function rankingTop($fichier, $type){
    $csv = getTop($fichier, 3);

    $str = "\t<div class=\"top\">\n";
    $str .= "\t\t\t\t\t\t<a href =\"voir.php?id=" . $csv[0][0] . "&type=" . $type . "&from=stats\">\n";
    $str .= "\t\t\t\t\t\t\t<fieldset>\n";
    $str .= "\t\t\t\t\t\t\t\t<legend>Top 1</legend>\n";
    $str .= generateTopText($csv, 0, $type);
    $str .= "\t\t\t\t\t\t\t</fieldset>\n";
    $str .= "\t\t\t\t\t\t</a>\n";

    $str .= "\t\t\t\t</div>\n";
    $str .= "\t\t\t\t<div class=\"top\">\n";
    $str .= "\t\t\t\t\t<a href =\"voir.php?id=" . $csv[1][0] . "&type=" . $type . "&from=stats\">\n";

    $str .= "\t\t\t\t\t\t<fieldset>\n";
    $str .= "\t\t\t\t\t\t\t<legend>Top 2</legend>\n";
    $str .= generateTopText($csv, 1, $type);
    $str .= "\t\t\t\t\t\t</fieldset>\n";
    $str .= "\t\t\t\t\t</a>\n";

    $str .= "\t\t\t\t\t<a href =\"voir.php?id=" . $csv[2][0] . "&type=" . $type . "&from=stats\">\n";

    $str .= "\t\t\t\t\t\t<fieldset>\n";
    $str .= "\t\t\t\t\t\t\t<legend>Top 3</legend>\n";
    $str .= generateTopText($csv, 2, $type);
    $str .= "\t\t\t\t\t\t</fieldset>\n";
    $str .= "\t\t\t\t\t</a>\n";

    $str .= "\t\t\t\t</div>\n";
    return $str;
}

function getTop($fichier, $size){
    $csv = array_chunk(str_getcsv(substr(str_replace("\n", ";", file_get_contents($fichier)), 0, -1) , ";"), 2); // recupere le contenue du fichier sous forme de tableau
    if(isset($csv[0][1])){
        $keys = array();
    foreach($csv as $key => $value) {
        array_push($keys, $value[1]);
    }
    array_multisort($keys, SORT_DESC, $csv, SORT_DESC);
    return(array_slice($csv, 0, $size));
    }
    else{
        return null;
    }
}

function generateTopText($csv, $i, $type){
    if(isset($csv[$i])){
        $str = "\t\t\t\t\t\t\t<h3>" . getInfo($csv[$i][0], "title", $type) . "</h3>\n";
        $str .= "\t\t\t\t\t\t\t<img class='thumbnailtop' src='" . getInfo($csv[$i][0], "poster", $type) . "' alt='poster " . getInfo($csv[$i][0], "title", $type) . "'/>\n";
        $str .= "\t\t\t\t\t\t\t<p> Avec " . $csv[$i][1] . " consultations !</p>\n";
        return $str;
    }
    else{
        if($type == "movie"){
            return "Pas de film consulté.";
        }
        else{
            return "Pas de série consulté.";
        }
    }
}

function svgGraph($fichier){
    $csv = getTop($fichier, 10);
    $ligne = 15;
    $str = "\t\t\t<figure>\n";
    if(stripos($fichier, "movie") != false){
        $str .= "\t\t\t\t<figcaption>Top film</figcaption>\n";
    }
    else{
        $str .= "\t\t\t\t<figcaption>Top serie</figcaption>\n";
    }
    $str .= "\t\t\t\t<svg style=\"height: 200px; width: 500px\">\n";
    $str .= "\t\t\t\t\t<rect width=\"500\" height=\"200\" stroke=\"black\" stroke-width=\"5\" style=\"fill:rgb(255,255,255)\" />\n";
    $str .= "\t\t\t\t\t<line x1=\"" . $ligne . "%\" y1=\"0%\" x2=\"" . $ligne . "%\" y2=\"100%\" stroke=\"black\" stroke-width=\"2\" />\n";
    $max = $csv[0][1];
    foreach ($csv as $key => $value) {
        $str .= "\t\t\t\t\t<text x=\"2%\" y=\"" . ((($key+1)*8)+3.5) . "%\">" . $csv[$key][0] . "</text>\n";
        $str .= "\t\t\t\t\t<text x=\"" . ((80/$max*$csv[$key][1])+$ligne) . "%\" y=\"" . ((($key+1)*8)+3.5) . "%\">" . $csv[$key][1] . "</text>\n";
        $str.= "\t\t\t\t\t<rect x=\"" . $ligne . "%\" y=\"" . ($key+1)*8 . "%\" width=\"" . 80/$max*$csv[$key][1] . "%\" height=\"2%\" style=\"fill:rgb(255,0,0)\" />\n";
    }
    $str .= "\t\t\t\t</svg>\n";
    $str .= "\t\t\t</figure>\n";
    return $str;
}
/*
function jpgraphBar($fichier){
    $csv = getTop($fichier, 10);
    $x = array();
    $y = array();
    foreach ($csv as $key => $value) {
        array_push($x, $value[0]);
        array_push($y, $value[1]);
    }
    $width = 500;
    $height = 200;
}
*/

function last(){
    $out = "";

    if(isset($_COOKIE["last_movie"]) && !empty($_COOKIE["last_movie"])){
        $last = explode(";", $_COOKIE["last_movie"]);
        $id = $last[0];
        $date = $last[1];
        $time = $last[2];
        $out .= "\t\t<div class=\"last_movie\">\n";
        $out .= "\t\t\t<h2>Dernier film visité</h2>\n";
        $out .= "\t\t\t<a href=\"voir.php?id=$id&type=movie&from=search\">\n";
        $out .= "\t\t\t\t<article>\n";
        $out .= "\t\t\t\t\t<h3>" . getInfo($id, "title", "movie") . "</h3>";
        $out .= "\t\t\t\t\t<img class=\"thumbnail\" src=\"" . getInfo($id, "poster", "movie") . "\" alt=\"poster " . getInfo($id, "title", "movie") . "\"/>\n";
        $out .= "\t\t\t\t\t<p>Visité le $date à $time</p>\n";
        $out .= "\t\t\t\t</article>\n";
        $out .= "\t\t\t</a>\n";
        $out .= "\t\t</div>\n";
    }
    if(isset($_COOKIE["last_tv"]) && !empty($_COOKIE["last_tv"])){
        $last = explode(";", $_COOKIE["last_tv"]);
        $id = $last[0];
        $date = $last[1];
        $time = $last[2];
        $out .= "\t\t<div class=\"last_tv\">\n";
        $out .= "\t\t\t<h2>Dernière série visitée</h2>\n";
        $out .= "\t\t\t<a href=\"voir.php?id=$id&type=tv&from=search\">\n";
        $out .= "\t\t\t\t<article>\n";
        $out .= "\t\t\t\t\t<h3>" . getInfo($id, "title", "tv") . "</h3>";
        $out .= "\t\t\t\t\t<img class=\"thumbnail\" src=\"" . getInfo($id, "poster", "tv") . "\" alt=\"poster " . getInfo($id, "title", "tv") . "\"/>\n";
        $out .= "\t\t\t\t\t<p>Visité le $date à $time</p>\n";
        $out .= "\t\t\t\t</article>\n";
        $out .= "\t\t\t</a>\n";
        $out .= "\t\t</div>\n";
    }
        return $out;
}
?>