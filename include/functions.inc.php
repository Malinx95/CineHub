<?php
function nasa() { //retourne img
    $url = "https://api.nasa.gov/planetary/apod?api_key=5aX68ZvOKjY5HvFA4IQbZ6QVnkcUOvhQMc8bEfbs&date=";//.date('Y-m-d');
    $json = file_get_contents($url);
    $obj = json_decode($json);
    $url = $obj->{'url'};
    if(strpos($url, "youtube") != false){
        return "<embed class='nasa' type=\"video/webm\" src='$url' autoplay/>";
    }
    else{
        return "<img class=\"nasa\" src=\"$url\" alt=\"image nasa\"/>";
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

function search_results($query, $type){

    $query = str_replace(" ", "+", $query);
    $key = "?api_key=a22fd943c9bbecd346f31c75d2bd3969";
    $url = "https://api.themoviedb.org/3/search/" . $type . $key . "&query=" . $query;
    //echo "<a href=\"", $url, "\">request</a>\n";
    $json = file_get_contents($url);
    $obj = json_decode($json, true);
    $results = $obj["results"];

    $out = "";
    foreach ($results as $key => $value) {
        $result = $value;
        $out .= "<a href='voir.php?id=" . $result["id"] . "&type=$type&from=search&query=" . $query . "'>\n";
        $out .= "\t\t\t\t\t\t<article>\n";
        $out .= "\t\t\t\t\t\t\t<h3>" . getInfo($result["id"], "title", $type) . "</h3>\n";
        $out .= "\t\t\t\t\t\t\t<img class='thumbnail' src='" . getInfo($result["id"], "poster", $type) . "' alt='poster " . getInfo($result["id"], "title", $type) . "'/>\n";
        $out .= "\t\t\t\t\t\t\t<p>" . getInfo($result["id"], "date", $type) . "</p>\n";
        $out .= "\t\t\t\t\t\t</article>\n";
        $out .= "\t\t\t\t\t</a>\n";
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

function getJSON($url){
    $json = file_get_contents($url);
    return json_decode($json, true);
}

function getInfo($id, $info, $type="movie"){
    $api = "a22fd943c9bbecd346f31c75d2bd3969";
    switch ($info){
        case "backdrop":
            $url = "https://api.themoviedb.org/3/$type/$id?api_key=$api&language=fr";
            $json = getJSON($url);
            $backdrop = $json["backdrop_path"];
            if(!empty($backdrop)){
                return "https://image.tmdb.org/t/p/original$backdrop";
            }
            else{
                return "ressources/images/no-image.png";
            }
        case "title":
            $url = "https://api.themoviedb.org/3/$type/$id?api_key=$api&language=fr";
            $json = getJSON($url);
            if($type == "movie"){
                return $json["original_title"];
            }
            else{
                return $json["original_name"];
            }

        case "poster":
            $url = "https://api.themoviedb.org/3/$type/$id?api_key=$api&language=fr";
            $json = getJSON($url);
            $poster = $json["poster_path"];
            if(!empty($poster)){
                return "https://image.tmdb.org/t/p/original$poster";
            }
            else{
                return "ressources/images/no-image.png";
            }

        case "overview":
            $url = "https://api.themoviedb.org/3/$type/$id?api_key=$api&language=fr";
            $json = getJSON($url);
            return $json["overview"];

        case "rating":
            $url = "https://api.themoviedb.org/3/$type/$id?api_key=$api&language=fr";
            $json = getJSON($url);
            return $json["vote_average"] . "/10 (" . $json["vote_count"] . " votes)";

        case "origin":
            $url = "https://api.themoviedb.org/3/$type/$id?api_key=$api&language=fr";
            $json = getJSON($url);
            return $json["original_language"];

        case "directors":
            $url = "https://api.themoviedb.org/3/$type/$id/credits?api_key=$api&language=fr";
            $json = getJSON($url);
            $out = "";
            foreach($json["crew"] as $crew){
                if($crew["job"] == "Director"){
                    $out .= $crew["name"] . ", ";
                }
            }
            return substr($out, 0, strlen($out)-2);

        case "time":
            $url = "https://api.themoviedb.org/3/$type/$id?api_key=$api&language=fr";
            $json = getJSON($url);
            if($type == "movie"){
                $time = $json["runtime"];
                $h = explode(".", $time/60)[0];
                $m = $time - $h*60;
                return $h . "h" . $m . "m";
            }
            else{
                $out = "";
                foreach($json["episode_run_time"] as $time){
                    $out .= $time . "m, ";
                }
                return substr($out, 0, strlen($out)-2);
            }


        case "actors":
            $url = "https://api.themoviedb.org/3/$type/$id/credits?api_key=$api&language=fr";
            $json = getJSON($url);
            $out = "";
            foreach($json["cast"] as $crew){
                if($crew["known_for_department"] == "Acting"){
                    $out .= $crew["name"] . ", ";
                }
            }
            return substr($out, 0, strlen($out)-2);

        case "genres":
            $url = "https://api.themoviedb.org/3/$type/$id?api_key=$api&language=fr";
            $json = getJSON($url);
            $out = "";
            foreach($json["genres"] as $genre){
                $out .= $genre["name"] . ", ";
            }
            return substr($out, 0, strlen($out)-2);

        case "date":
            $url = "https://api.themoviedb.org/3/$type/$id?api_key=$api&language=fr";
            $json = getJSON($url);
            if($type == "movie"){
                $date = $json["release_date"];
            }
            else{
                $date = $json["first_air_date"];
            }
            if(empty($date)){
                return "Date indisponible.";
            }
            return $date;

        case "producers":
            $url = "https://api.themoviedb.org/3/$type/$id?api_key=$api&language=fr";
            $json = getJSON($url);
            $out = "";
            foreach($json["production_companies"] as $producer){
                $out .= $producer["name"] . ", ";
            }
            return substr($out, 0, strlen($out)-2);

        case "site":
            $url = "https://api.themoviedb.org/3/$type/$id?api_key=$api&language=fr";
            $json = getJSON($url);
            $homepage = $json["homepage"];
            if(!empty($homepage)){
                return "<a href=\"$homepage\">$homepage</a>";
            }
            else{
                return "Information indisponible.";
            }
    }
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
    $str = "\t<figure>\n";
    if(stripos($fichier, "movie") != false){
        $str = "<figcaption>Top film</figcaption>\n";
    }
    else{
        $str = "\t\t<figcaption>Top serie</figcaption>\n";
    }
    $str .= "\t\t<svg style=\"height: 200px; width: 500px\">\n";
    $str .= "\t\t\t<rect width=\"500\" height=\"200\" stroke=\"black\" stroke-width=\"5\" style=\"fill:rgb(255,255,255)\" />\n";
    $str .= "\t\t\t<line x1=\"" . $ligne . "%\" y1=\"0%\" x2=\"" . $ligne . "%\" y2=\"100%\" stroke=\"black\" stroke-width=\"2\" />\n";
    $max = $csv[0][1];
    foreach ($csv as $key => $value) {
        $str .= "\t\t\t<text x=\"2%\" y=\"" . ((($key+1)*8)+3.5) . "%\">" . $csv[$key][0] . "</text>\n";
        $str .= "\t\t\t<text x=\"" . ((80/$max*$csv[$key][1])+$ligne) . "%\" y=\"" . ((($key+1)*8)+3.5) . "%\">" . $csv[$key][1] . "</text>\n";
        $str.= "\t\t\t<rect x=\"" . $ligne . "%\" y=\"" . ($key+1)*8 . "%\" width=\"" . 80/$max*$csv[$key][1] . "%\" height=\"2%\" style=\"fill:rgb(255,0,0)\" />\n";
    }
    $str .= "\t\t</svg>\n";
    $str .= "\t</figure>\n";
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


?>