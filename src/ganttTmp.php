<?php //content="text/plain; charset=utf-8"
require_once ('lib/jpgraph/src/jpgraph.php');
require_once ('lib/jpgraph/src/jpgraph_gantt.php');
require 'modeleRoadMap.php';
 
$graph = new GanttGraph(0,0);
$graph->SetShadow();

$graph->title->Set("Roadmap");
$graph->title->SetFont(FF_ARIAL,FS_BOLD,12);
//$graph->subtitle->Set("(version bêta)");
 
$graph->ShowHeaders(GANTT_HYEAR | GANTT_HMONTH);
$graph->scale->month->SetFontColor("white");
$graph->scale->month->SetBackgroundColor("blue");
$graph->SetZoomFactor(7);
$graph->SetVMarginFactor(0.0);
$datas = getPhases();
$i=0;
foreach($datas as $data){
	$activity = new GanttBar($i++,$data[1],$data[2],$data[3]);
	$activity->SetPattern(GANTT_SOLID,"red");
	$activity->SetFillColor("red");
	$activity->title->SetFont(FF_ARIAL,FS_BOLD);
	$activity->setHeight(12*$data[4]);
	/*$activity->leftMark->SetType( MARK_LEFTTRIANGLE );
	$activity->leftMark->Show();
	$activity->rightMark->SetType( MARK_RIGHTTRIANGLE );
	$activity->rightMark->Show();*/
	$graph->Add($activity);
	for($j=0;$j<$data[4];$j++){
		$position = $data[0] - $j/12;
		$ms4 = new MileStone($position,'','2015-05-01','test');
		$graph->Add($ms4);
	}
}

$vline = new GanttVLine(date("Y-m-d"),"Today");
$graph->Add($vline);

$graph->Stroke();
?>