<?php
function nasa(){ //retourne img
    $url = "https://api.nasa.gov/planetary/apod?api_key=5aX68ZvOKjY5HvFA4IQbZ6QVnkcUOvhQMc8bEfbs&date=";//.date('Y-m-d');
    $json = file_get_contents($url);
    $obj = json_decode($json);
    return $obj->{'url'};
}
function geo(){ //retourne geolocalisation
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

?>