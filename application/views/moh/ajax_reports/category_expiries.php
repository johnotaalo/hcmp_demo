<?php
include("Scripts/FusionCharts/FusionCharts.php");


$strXML_e2 ="<chart caption='Expiries per Category' subcaption='$name'  numdivlines='9' bgColor='#FFFFFF' showBorder='0'lineThickness='2' showValues='0' anchorRadius='3' anchorBgAlpha='50' showAlternateVGridColor='1' numVisiblePlot='12' animation='0'>";
$strXML_e2 .="<categories >";

$strXML_e2 .="<category label='Jan'/>";
$strXML_e2 .="<category label='Feb '/>";
$strXML_e2 .="<category label='Mar '/>";
$strXML_e2 .="<category label='Apr '/>";
$strXML_e2 .="<category label='May '/>";
$strXML_e2 .="<category label='Jun'/>";
$strXML_e2 .="<category label='Jul '/>";
$strXML_e2 .="<category label='Aug '/>";
$strXML_e2 .="<category label='Sep'/>";
$strXML_e2 .="<category label='Oct '/>";
$strXML_e2 .="<category label='Nov'/>";
$strXML_e2 .="<category label='Dec'/>";
$strXML_e2 .="</categories>";
$strXML_e2 .="<dataset seriesName='Drug A' color='800080' anchorBorderColor='800080'>";
$strXML_e2 .="<set value='54' />";
$strXML_e2 .="<set value='165' />";
$strXML_e2 .="<set value='175' />";
$strXML_e2 .="<set value='190' />";
$strXML_e2 .="<set value='212' />";
$strXML_e2 .="<set value='241' />";
$strXML_e2 .="<set value='308' />";
$strXML_e2 .="<set value='401' />";
$strXML_e2 .="<set value='481' />";
$strXML_e2 .="<set value='851' />";
$strXML_e2 .="<set value='1250' />";
$strXML_e2 .="<set value='2415' />";
$strXML_e2 .="</dataset>";
$strXML_e2 .="<dataset seriesName='Drug B' color='FF8040' anchorBorderColor='FF8040'>";
$strXML_e2 .="<set value='111' />";
$strXML_e2 .="<set value='120' />";
$strXML_e2 .="<set value='128' />";
$strXML_e2 .="<set value='140' />";
$strXML_e2 .="<set value='146' />";
$strXML_e2 .="<set value='157' />";
$strXML_e2 .="<set value='190' />";
$strXML_e2 .="<set value='250' />";
$strXML_e2 .="<set value='399' />";
$strXML_e2 .="<set value='691' />";
$strXML_e2 .="<set value='952' />";
$strXML_e2 .="<set value='1448' />";

$strXML_e2 .="</dataset>";
$strXML_e2 .="<dataset seriesName='Drug C' color='FFFF00' anchorBorderColor='FFFF00' >";
$strXML_e2 .="<set value='115' />";
$strXML_e2 .="<set value='141' />";
$strXML_e2 .="<set value='175' />";
$strXML_e2 .="<set value='189' />";
$strXML_e2 .="<set value='208' />";
$strXML_e2 .="<set value='229' />";
$strXML_e2 .="<set value='252' />";
$strXML_e2 .="<set value='440' />";
$strXML_e2 .="<set value='608' />";
$strXML_e2 .="<set value='889' />";
$strXML_e2 .="<set value='1334' />";
$strXML_e2 .="<set value='1637' />";

$strXML_e2 .="</dataset>";
$strXML_e2 .="<dataset seriesName='Drug D' color='FF0080' anchorBorderColor='FF0080' >";
$strXML_e2 .="<set value='98' />";
$strXML_e2 .="<set value='1112' />";
$strXML_e2 .="<set value='1192' />";
$strXML_e2 .="<set value='1219' />";
$strXML_e2 .="<set value='1264' />";
$strXML_e2 .="<set value='1282' />";
$strXML_e2 .="<set value='1365' />";
$strXML_e2 .="<set value='1433' />";
$strXML_e2 .="<set value='1559' />";
$strXML_e2 .="<set value='1823' />";
$strXML_e2 .="<set value='1867' />";
$strXML_e2 .="<set value='2198' />";

$strXML_e2 .="</dataset>";
$strXML_e2 .="</chart>";

echo renderChart("".base_url()."Scripts/FusionCharts/Charts/ScrollLine2D.swf", "", $strXML_e2, "e2", "100%", 400, false, true);
?>