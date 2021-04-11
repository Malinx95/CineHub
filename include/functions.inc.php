<?php
function nasa() { //retourne img
    $url = "https://api.nasa.gov/planetary/apod?api_key=5aX68ZvOKjY5HvFA4IQbZ6QVnkcUOvhQMc8bEfbs&date=";//.date('Y-m-d');
    $json = file_get_contents($url);
    $obj = json_decode($json);
    return $obj->{'url'};
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

function hits(){
    $id = $_GET["id"];
    if($_GET["type"] == "movie"){
        $fichier = "stats/movie_hits.csv";
    }
    else{
        $fichier = "stats/tv_hits.csv";
    }
    if(!file_exists($fichier)){ 
        $compteur=fopen($fichier,"w");
        $hit = array($id, "1");
        fputcsv($compteur, $hit, ";");
        setcookie($id,$id,time()+30*60);
    }
    else{
        $compteur=fopen($fichier,"r+");
        $c = 0;
        $found = false;
        while($line = fgetcsv($compteur, 0, ";")){
            if($line[0] == $id){
                $line[1]++;
                $found = true;
            }
            $array[$c] = $line[0];
            $c++;
            $array[$c] = $line[1];
            $c++;
        }
        if(!$found){
            $array[$c] = $id;
            $array[$c+1] = 1;
        }
        fclose($compteur);
        $compteur=fopen($fichier,"w");
        for($i=0 ; $i<sizeof($array) ; $i = $i+2){
            fputcsv($compteur, Array($array[$i], $array[$i+1]), ";");
        }
    }
    fclose($compteur);
}

function getInfo($json, $name, $notfoundmsg="Information indisponible."){
    if(isset($json[$name]) && !empty($json[$name])){
        return $json[$name];
    }
    else{
        return $notfoundmsg;
    }
}

function getList($json, $name, $subname, $notfoundmsg="Information indisponible."){
    if(isset($json[$name]) && !empty($json[$name])){
        $out = "";
        foreach($json[$name] as $val) {
            $out .= $val[$subname].", ";
        }
        return substr($out, 0, strlen($out)-2);
    }
    else{
        return $notfoundmsg;
    }
}

function rankingTop($fichier, $type){
    $csv = getTop($fichier);
    
    $str = "\t\t\t\t<div class=\"top\">\n";
    $str .= "\t\t\t\t\t<fieldset>\n";
    $str .= "\t\t\t\t\t\t<legend>Top 1</legend>\n";
    $str .= generateTopText($csv, 0, $type);
    $str .= "\t\t\t\t\t</fieldset>\n";
    $str .= "\t\t\t\t</div>\n";
    $str .= "\t\t\t\t<div class=\"top\">\n";
    $str .= "\t\t\t\t\t<fieldset>\n";
    $str .= "\t\t\t\t\t\t<legend>Top 2</legend>\n";
    $str .= generateTopText($csv, 1, $type);
    $str .= "\t\t\t\t\t</fieldset>\n";
    $str .= "\t\t\t\t\t<fieldset>\n";
    $str .= "\t\t\t\t\t\t<legend>Top 3</legend>\n";
    $str .= generateTopText($csv, 2, $type);
    $str .= "\t\t\t\t\t</fieldset>\n";
    $str .= "\t\t\t\t</div>\n";
    return $str;
}

function getTop($fichier){
    $csv = array_chunk(str_getcsv(substr(str_replace("\n", ";", file_get_contents($fichier)), 0, -1) , ";"), 2); // recupere le contenue du fichier sous forme de tableau
    if(isset($csv[0][1])){
        $keys = array();
    foreach($csv as $key => $value) {
        array_push($keys, $value[1]);
    }
    array_multisort($keys, SORT_DESC, $csv, SORT_DESC);
    return(array_slice($csv, 0, 3));
    }
    else{
        return null;
    }
}

function generateTopText($csv, $i, $type){
    if(isset($csv[$i])){
        $details = detailsTop($csv[$i][0], $type);
        if($type == "tv"){
            $str = "\t\t\t\t\t\t<p>" . $details["original_name"] . "</p>\n";
        }
        else{
            $str = "\t\t\t\t\t\t<p>" . $details["original_title"] . "</p>\n";
        }
        if(isset($details["poster_path"])){
            if($type == "tv"){
                $str .= "\t\t\t\t\t\t<img class='thumbnailtop' src='https://image.tmdb.org/t/p/original" . $details["poster_path"] . "' alt='poster " . $details["original_name"] . "'/>\n";
            }
            else{
                $str .= "\t\t\t\t\t\t<img class='thumbnailtop' src='https://image.tmdb.org/t/p/original" . $details["poster_path"] . "' alt='poster " . $details["original_title"] . "'/>\n";
            }
        }
        else{
            $str .= "\t\t\t\t\t\t<img class='thumbnailtop' src='ressources/images/no-image.png' alt='no-image'/>\n";
        }
        $str .= "\t\t\t\t\t\t<p> Avec " . $csv[$i][1] . "consultations !</p>";
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

?>