<?php
define("KEY", "a22fd943c9bbecd346f31c75d2bd3969");

function nasa() { //retourne img
    $url = "https://api.nasa.gov/planetary/apod?api_key=5aX68ZvOKjY5HvFA4IQbZ6QVnkcUOvhQMc8bEfbs&date=";//.date('Y-m-d');
    $json = file_get_contents($url);
    $obj = json_decode($json);
    $url = $obj->{'url'};
    if(strpos($url, "youtube") != false){
        return "<embed class=\"nasa\" type=\"video/webm\" src=\"$url\"/>\n";
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
        if(empty($result["poster_path"])){
            continue;
        }
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
        $title = str_replace("&", "&amp;", $title);
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
    $query = str_replace("%", "%25", $query);
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
        $go = true;
        if ($_GET["type"] == "movie") {
            $fichier = "stats/movie_hits.csv";
            $last = "last_movie";
        } else {
            $fichier = "stats/tv_hits.csv";
            $last = "last_tv";
        }
        if(isset($_COOKIE[$last])){
            $explode = explode(";", $_COOKIE[$last]);
            $last_id = $explode[0];
            if($id == $last_id){
                $go = false;
            }
        }
        if($go == true){
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
}

function getJSON($url){
    $json = file_get_contents($url);
    return json_decode($json, true);
}

function getInfos($id, $infos, $type="movie"){
    $out = array();
    $details = getJSON("https://api.themoviedb.org/3/$type/$id?api_key=" . KEY . "&language=fr");
    if(in_array("directors", $infos) || in_array("actors", $infos)){
        $credits = getJSON("https://api.themoviedb.org/3/$type/$id/credits?api_key=" . KEY . "&language=fr");
    }
    foreach($infos as $info){
        switch ($info) {
            case "backdrop":
                $backdrop = $details["backdrop_path"];
                if (!empty($backdrop)) {
                    array_push($out, "https://image.tmdb.org/t/p/original$backdrop");
                } else {
                    array_push($out, "ressources/images/no-image.png");
                }
                break;
            case "title":
                if ($type == "movie") {
                    $title = $details["title"];
                } else {
                    $title = $details["name"];
                }
                if (empty($title)) {
                    array_push($out, "Titre indisponible");
                    break;
                }
                array_push($out, $title);
                break;
            case "poster":
                $poster = $details["poster_path"];
                if (!empty($poster)) {
                    array_push($out, "https://image.tmdb.org/t/p/original$poster");
                } else {
                    array_push($out, "ressources/images/no-image.png");
                }
                break;
            case "overview":
                $overview = $details["overview"];
                if (empty($overview)) {
                    array_push($out, "Synopsys indisponible");
                    break;
                }
                array_push($out, $overview);
                break;
            case "rating":
                $average = $details["vote_average"];
                $count = $details["vote_count"];
                if (empty($average) || empty($count)) {
                    array_push($out, "Note indisponible");
                    break;
                }
                array_push($out, $average . "/10 (" . $count . " votes)");
                break;
            case "origin":
                $origin = $details["original_language"];
                if (empty($origin)) {
                    array_push($out, "Origine indisponible");
                    break;
                }
                array_push($out, $origin);
                break;
            case "directors":
                if($type == "movie"){
                    if (empty($credits["crew"])) {
                        array_push($out, "\t\t\t\t\t<li>\n\t\t\t\t\t\t<p>Réalisateurs indisponibles</p>\n\t\t\t\t\t</li>\n");
                        break;
                    }
                    $str = "";
                    foreach ($credits["crew"] as $crew) {
                        if ($crew["job"] == "Director") {
                            $str .= "\t\t\t\t\t<li>\n\t\t\t\t\t\t<p>" . $crew["name"] . "</p>\n" . "\t\t\t\t\t\t<div class=\"pop\">\n" . getPerson($crew["id"]) . "\t\t\t\t\t\t</div>\n\t\t\t\t\t</li>\n";
                        }
                    }
                    array_push($out, $str);
                }
                else{
                    if(empty($details["created_by"])){
                        array_push($out, "\t\t\t\t\t<li>\n\t\t\t\t\t\t<p>Créateurs indisponible</p>\n\t\t\t\t\t</li>\n");
                        break;
                    }
                    $str = "";
                    foreach($details["created_by"] as $creator){
                        $str .= "\t\t\t\t\t<li>\n\t\t\t\t\t\t<p>" . $creator["name"] . "</p>\n" . "\t\t\t\t\t\t<div class=\"pop\">\n" . getPerson($creator["id"]) . "\t\t\t\t\t\t</div>\n\t\t\t\t\t</li>\n";
                    }
                    array_push($out, $str);
                }

                break;
            case "time":
                if ($type == "movie") {
                    $time = $details["runtime"];
                    if (empty($time)) {
                        array_push($out, "Durée indisponible");
                        break;
                    }
                    $h = explode(".", $time / 60)[0];
                    $m = $time - $h * 60;
                    array_push($out, $h . "h" . $m . "m");
                }
                else {
                    if (empty($details["episode_run_time"])) {
                        array_push($out, "Durée indisponible");
                        break;
                    }
                    $str = "";
                    foreach ($details["episode_run_time"] as $time) {
                        $str .= $time . "m, ";
                    }
                    array_push($out, substr($str, 0, strlen($str) - 2));
                }
                break;
            case "actors":
                if (empty($credits["cast"])) {
                    array_push($out, "\t\t\t\t\t<li>\n\t\t\t\t\t\t<p>Acteurs indisponibles</p>\n\t\t\t\t\t</li>\n");
                    break;
                }
                $str = "";
                $crew = $credits["cast"];
                for ($i = 0; $i < 5; $i++) {
                    if (!empty($crew[$i]) && $crew[$i]["known_for_department"] == "Acting") {
                        $str .= "\t\t\t\t\t<li>\n\t\t\t\t\t\t<p>" . $crew[$i]["name"] . "</p>\n" . "\t\t\t\t\t\t<div class=\"pop\">\n" . getPerson($crew[$i]["id"]) . "\t\t\t\t\t\t</div>\n\t\t\t\t\t</li>\n";
                    }
                }
                array_push($out, $str);
                break;
            case "genres":
                if (empty($details["genres"])) {
                    array_push($out, "Genres indisponibles");
                    break;
                }
                $str = "";
                foreach ($details["genres"] as $genre) {
                    $str .= $genre["name"] . ", ";
                }
                array_push($out, substr($str, 0, strlen($str) - 2));
                break;
            case "date":
                if ($type == "movie") {
                    $date = $details["release_date"];
                } else {
                    $date = $details["first_air_date"];
                }
                if (empty($date)) {
                    array_push($out, "Date indisponible");
                    break;
                }
                $date = explode("-", $date);
                array_push($out, $date[2] . "/" . $date[1] . "/" . $date[0]);
                break;
            case "producers":
                if (empty($details["production_companies"])) {
                    array_push($out, "Producteurs indisponibles");
                    break;
                }
                $str = "";
                foreach ($details["production_companies"] as $producer) {
                    $str .= $producer["name"] . ", ";
                }
                array_push($out, substr($str, 0, strlen($str) - 2));
                break;
            case "site":
                $homepage = $details["homepage"];
                if (!empty($homepage)) {
                    array_push($out, "<a href=\"$homepage\">$homepage</a>");
                }
                else {
                    array_push($out, "Page officielle indisponible");
                }
                break;
        }
    }
    for($i=0 ; $i<sizeof($out) ; $i++){
        if(strpos($out[$i], "http") == false){
            $out[$i] = str_replace("&", "&amp;", $out[$i]);
        }
    }
    return $out;
}

function getPerson($id){
    $details = getJSON("https://api.themoviedb.org/3/person/$id?api_key=" . KEY . "&language=fr");
    $img = getJSON("https://api.themoviedb.org/3/person/$id/images?api_key=" . KEY)["profiles"];
    if(!empty($img)){
        $img = "https://image.tmdb.org/t/p/original" . $img[0]["file_path"];
    }
    else{
        $img = "ressources/images/no-image.png";
    }
    $place = $details["place_of_birth"];
    $dead = $details["deathday"];
    $date = $details["birthday"];
    if(!empty($date)){
        $date = explode("-", $date);
        $date = $date[2] . "/" . $date[1] . "/" . $date[0];
    }
    else{
        $date = "Date de naissance indisponible";
    }

    $out = "\t\t\t\t\t\t\t<div>\n";
    $out .= "\t\t\t\t\t\t\t\t<h3>" . $details["name"] . "</h3>\n";
    $out .= "\t\t\t\t\t\t\t\t<img src=\"$img\" alt=\"photo " . $details["name"] . "\"/>\n";
    $out .= "\t\t\t\t\t\t\t</div>\n";
    $out .= "\t\t\t\t\t\t\t<div class=\"persondesc\">\n";
    $out .= "\t\t\t\t\t\t\t\t<h4>Date de naissance</h4>\n";
    $out .= "\t\t\t\t\t\t\t\t<p>" . $date . "</p>\n";
    if(!empty($place)){
        $out .= "\t\t\t\t\t\t\t\t<h4>Lieu de naissance</h4>\n";
        $out .= "\t\t\t\t\t\t\t\t<p>$place</p>\n";
    }
    if(!empty($dead)){
        $out .= "\t\t\t\t\t\t\t\t<h4>Date de décès</h4>\n";
        $out .= "\t\t\t\t\t\t\t\t<p>$dead</p>\n";
    }
    $out .= "\t\t\t\t\t\t\t\t<h4>Profession</h4>\n";
    $out .= "\t\t\t\t\t\t\t\t<p>" . $details["known_for_department"] . "</p>\n";
    $out .= "\t\t\t\t\t\t\t\t<h4>Biographie</h4>\n";
    $bio = $details["biography"];
    if(empty($bio)){
        $bio = "Biographie indisponible";
    }
    $out .= "\t\t\t\t\t\t\t\t<p>" . $bio . "</p>\n";
    $out .= "\t\t\t\t\t\t\t</div>\n";
    return $out;
}

function rankingTop($fichier, $type){

    $csv = getTop($fichier, 3);

    $str = "<div class=\"top\">\n";
    if($csv != null){
        $str .= "\t\t\t\t\t<a href =\"voir.php?id=" . $csv[0][0] . "&type=" . $type . "&from=stats\">\n";
    }
    else{
        $str .= "\t\t\t\t\t<a href =\"\">\n";
    }
    $str .= "\t\t\t\t\t\t<fieldset>\n";
    $str .= "\t\t\t\t\t\t\t<legend>Top 1</legend>\n";
    $str .= generateTopText($csv, 0, $type);
    $str .= "\t\t\t\t\t\t</fieldset>\n";
    $str .= "\t\t\t\t\t</a>\n";

    $str .= "\t\t\t\t</div>\n";
    $str .= "\t\t\t\t<div class=\"top\">\n";
    if($csv != null){
        $str .= "\t\t\t\t\t<a href =\"voir.php?id=" . $csv[1][0] . "&type=" . $type . "&from=stats\">\n";
    }
    else{
        $str .= "\t\t\t\t\t<a href =\"\">\n";
    }

    $str .= "\t\t\t\t\t\t<fieldset>\n";
    $str .= "\t\t\t\t\t\t\t<legend>Top 2</legend>\n";
    $str .= generateTopText($csv, 1, $type);
    $str .= "\t\t\t\t\t\t</fieldset>\n";
    $str .= "\t\t\t\t\t</a>\n";

    if($csv != null){
        $str .= "\t\t\t\t\t<a href =\"voir.php?id=" . $csv[2][0] . "&type=" . $type . "&from=stats\">\n";
    }
    else{
        $str .= "\t\t\t\t\t<a href =\"\">\n";
    }

    $str .= "\t\t\t\t\t\t<fieldset>\n";
    $str .= "\t\t\t\t\t\t\t<legend>Top 3</legend>\n";
    $str .= generateTopText($csv, 2, $type);
    $str .= "\t\t\t\t\t\t</fieldset>\n";
    $str .= "\t\t\t\t\t</a>\n";

    $str .= "\t\t\t\t</div>\n";
    return $str;
}

function getTop($fichier, $size){
    if(file_exists($fichier)){
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
    else{
        return null;
    }
}

function generateTopText($csv, $i, $type){
    if($csv != null && isset($csv[$i])){
        $infos = getInfos($csv[$i][0], array("title", "poster"), $type);
        $str = "\t\t\t\t\t\t\t<h3>" . $infos[0] . "</h3>\n";
        $str .= "\t\t\t\t\t\t\t<img class='thumbnailtop' src='" . $infos[1] . "' alt='poster " . $infos[0] . "'/>\n";
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
        $infos = getInfos($id, array("title", "poster"), "movie");
        $out .= "\t\t<div class=\"last_movie\">\n";
        $out .= "\t\t\t<h2>Dernier film visité</h2>\n";
        $out .= "\t\t\t<a href=\"voir.php?id=$id&type=movie&from=search\">\n";
        $out .= "\t\t\t\t<article>\n";
        $out .= "\t\t\t\t\t<h3>" . $infos[0] . "</h3>\n";
        $out .= "\t\t\t\t\t<img class=\"thumbnail\" src=\"" . $infos[1] . "\" alt=\"poster " . $infos[0] . "\"/>\n";
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
        $infos = getInfos($id, array("title", "poster"), "tv");
        $out .= "\t\t<div class=\"last_tv\">\n";
        $out .= "\t\t\t<h2>Dernière série visitée</h2>\n";
        $out .= "\t\t\t<a href=\"voir.php?id=$id&type=tv&from=search\">\n";
        $out .= "\t\t\t\t<article>\n";
        $out .= "\t\t\t\t\t<h3>" . $infos[0] . "</h3>\n";
        $out .= "\t\t\t\t\t<img class=\"thumbnail\" src=\"" . $infos[1] . "\" alt=\"poster " . $infos[0] . "\"/>\n";
        $out .= "\t\t\t\t\t<p>Visité le $date à $time</p>\n";
        $out .= "\t\t\t\t</article>\n";
        $out .= "\t\t\t</a>\n";
        $out .= "\t\t</div>\n";
    }
        return $out;
}
?>