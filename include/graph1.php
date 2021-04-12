<?php
    include_once 'ressources/jpgraph/jpgraph.php';
    include_once 'ressources/jpgraph/jpgraph_bar.php';
    include_once 'include/functions.inc.php';
    jpgraphBar("stats/movie_hits.csv");
    echo $height;
    $graph = new Graph($width, $height, 'auto');
    $graph -> SetScale('textlin');
    $graph->Set90AndMargin(50,20,50,30);
    $graph->SetShadow();
    $graph->title->Set('movie');
    $graph->title->SetFont(FF_VERDANA,FS_BOLD,14);
    $graph->xaxis->SetTickLabels($x);
    $graph->xaxis->SetFont(FF_VERDANA,FS_NORMAL,12);
    $graph->xaxis->SetLabelMargin(10);
    $graph->xaxis->SetLabelAlign('right','center');
    $graph->yaxis->scale->SetGrace(20);
    $graph->yaxis->Hide();
    $bplot = new BarPlot($y);
    $bplot->SetFillColor('orange');
    $bplot->SetShadow();
    $bplot->value->Show();
    $bplot->value->SetFont(FF_ARIAL,FS_BOLD,12);
    $bplot->value->SetAlign('left','center');
    $bplot->value->SetColor('black','darkred');
    $bplot->value->SetFormat('%.1f mkr');
    $graph->Add($bplot);
    $graph->Stroke();
?>