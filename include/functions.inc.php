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
    $json = file_get_contents($url);
    $obj = json_decode($json, true);
    return $obj;
}

function hits(){
    $id = $_GET["id"];
    if($_GET["type"] == "movie"){
        $fichier = "stats/movie_hits.txt";
    }
    else{
        $fichier = "stats/tv_hits.txt";
    }
    if(!file_exists($fichier)){ 
        $compteur=fopen($fichier,"w");
        $hit = array($id, "1", "");
        fputcsv($compteur, $hit, ";");
        setcookie($id,$id,time()+30*60);
    }
    else{
        $compteur=fopen($fichier,"r+");
        if(empty($_COOKIE[$id])){
            setcookie($id,$id,time()+30*60);
            $content = fread($compteur,filesize($fichier));
            $content = explode(";", $content);
            $key = array_search($id, $content);
            if($key !== false){
                $key++;
                $content[$key] = intval($content[$key]) + 1;
            }
            else{
                array_push($content, $id, "1");
            }
            $content = implode(";", $content);
            $compteur=fopen($fichier,"w");
            fwrite($compteur, $content);
        }
    }
    fclose($compteur);
}

?>