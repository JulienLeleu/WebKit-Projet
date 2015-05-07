<?php // content="text/plain; charset=utf-8"
require_once ('lib/jpgraph/src/jpgraph.php');
require_once ('lib/jpgraph/src/jpgraph_gantt.php');
 
$graph = new GanttGraph(0,0);
$graph->SetShadow();
 
// Add title and subtitle
$graph->title->Set("Roadmap");
$graph->title->SetFont(FF_ARIAL,FS_BOLD,12);
//$graph->subtitle->Set("(version bêta)");
 
// Show day, week and month scale
$graph->ShowHeaders(GANTT_HYEAR | GANTT_HMONTH);
 
// Instead of week number show the date for the first day in the week
// on the week scale
$graph->scale->week->SetStyle(WEEKSTYLE_FIRSTDAY);
 
// Make the week scale font smaller than the default
$graph->scale->week->SetFont(FF_FONT0);
 
// Use the short name of the month together with a 2 digit year
// on the month scale
$graph->scale->month->SetFontColor("white");
$graph->scale->month->SetBackgroundColor("blue");
 
// Format the bar for the first activity
// ($row,$title,$startdate,$enddate)
$activity = new GanttBar(0,"Project","2015-03-29","2015-06-27");
//$activity2 = new GanttBar(1,"test","2015-12-21","2018-02-20");
 
// Yellow diagonal line pattern on a red background
$activity->SetPattern(GANTT_SOLID,"yellow");
$activity->SetFillColor("red");
$activity->SetHeight(40);
/*$activity2->SetPattern(GANTT_SOLID,"#FF55F");
$activity2->SetFillColor("red");
$activity2->SetHeight(10);*/
//$ms4 = new MileStone(-0.25, 'Code complete', '2016-12-01','test');
$vline = new GanttVLine(date("Y-m-d"),"Today");

// Finally add the bar to the graph
$graph->Add($activity);
//$graph->Add($activity2);
//$graph->Add($ms4);
$graph->Add($vline);
// ... and display it
$graph->Stroke();
?>