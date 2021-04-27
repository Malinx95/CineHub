<?php
include_once '../ressources/jpgraph/jpgraph.php';
include_once '../ressources/jpgraph/jpgraph_bar.php';
include_once '../include/functions.inc.php';

$csv = getTop('../stats/tv_hits.csv', 10);
$x = array();
$y = array();
foreach ($csv as $key => $value) {
    array_push($x, getInfos($value[0], array("title"), "tv")[0]);
    array_push($y, $value[1]);
}

$width = 900;
$height = 1000;

$graph = new Graph($width, $height, 'auto');
$graph -> SetScale('textlin');
$graph->Set90AndMargin(150,20,50,30);
$graph->SetShadow();
$graph->title->Set('Top 10 séries');
$graph->xaxis->SetTickLabels($x);
$graph->xaxis->SetLabelMargin(5);
$graph->xaxis->SetLabelAlign('right','center');
$graph->yaxis->scale->SetGrace(20);
$bplot = new BarPlot($y);
$bplot->SetShadow();
$bplot->value->SetAlign('left','center');
$bplot->value->SetColor('black','darkred');
$bplot->value->SetFormat('%.1f mkr');
$graph->Add($bplot);
$graph->Stroke();
?>