<?php
include("Scripts/FusionCharts/FusionCharts.php");
$strXML_c2 ="<chart caption='Consumption per Category' subcaption='$name' numdivlines='9' bgColor='#FFFFFF' showBorder='0'lineThickness='2' showValues='0' anchorRadius='3' anchorBgAlpha='50' showAlternateVGridColor='1' numVisiblePlot='12' animation='0'>";
$strXML_c2 .="<categories >";

$strXML_c2 .="<category label='Jan'/>";
$strXML_c2 .="<category label='Feb '/>";
$strXML_c2 .="<category label='Mar '/>";
$strXML_c2 .="<category label='Apr '/>";
$strXML_c2 .="<category label='May '/>";
$strXML_c2 .="<category label='Jun'/>";
$strXML_c2 .="<category label='Jul '/>";
$strXML_c2 .="<category label='Aug '/>";
$strXML_c2 .="<category label='Sep'/>";
$strXML_c2 .="<category label='Oct '/>";
$strXML_c2 .="<category label='Nov'/>";
$strXML_c2 .="<category label='Dec'/>";
$strXML_c2 .="</categories>";
$strXML_c2 .="<dataset seriesName='Drug A' color='800080' anchorBorderColor='800080'>";
$strXML_c2 .="<set value='54' />";
$strXML_c2 .="<set value='165' />";
$strXML_c2 .="<set value='175' />";
$strXML_c2 .="<set value='190' />";
$strXML_c2 .="<set value='212' />";
$strXML_c2 .="<set value='241' />";
$strXML_c2 .="<set value='308' />";
$strXML_c2 .="<set value='401' />";
$strXML_c2 .="<set value='481' />";
$strXML_c2 .="<set value='851' />";
$strXML_c2 .="<set value='1250' />";
$strXML_c2 .="<set value='2415' />";
$strXML_c2 .="</dataset>";
$strXML_c2 .="<dataset seriesName='Drug B' color='FF8040' anchorBorderColor='FF8040'>";
$strXML_c2 .="<set value='111' />";
$strXML_c2 .="<set value='120' />";
$strXML_c2 .="<set value='128' />";
$strXML_c2 .="<set value='140' />";
$strXML_c2 .="<set value='146' />";
$strXML_c2 .="<set value='157' />";
$strXML_c2 .="<set value='190' />";
$strXML_c2 .="<set value='250' />";
$strXML_c2 .="<set value='399' />";
$strXML_c2 .="<set value='691' />";
$strXML_c2 .="<set value='952' />";
$strXML_c2 .="<set value='1448' />";

$strXML_c2 .="</dataset>";
$strXML_c2 .="<dataset seriesName='Drug C' color='FFFF00' anchorBorderColor='FFFF00' >";
$strXML_c2 .="<set value='115' />";
$strXML_c2 .="<set value='141' />";
$strXML_c2 .="<set value='175' />";
$strXML_c2 .="<set value='189' />";
$strXML_c2 .="<set value='208' />";
$strXML_c2 .="<set value='229' />";
$strXML_c2 .="<set value='252' />";
$strXML_c2 .="<set value='440' />";
$strXML_c2 .="<set value='608' />";
$strXML_c2 .="<set value='889' />";
$strXML_c2 .="<set value='1334' />";
$strXML_c2 .="<set value='1637' />";

$strXML_c2 .="</dataset>";
$strXML_c2 .="<dataset seriesName='Drug D' color='FF0080' anchorBorderColor='FF0080' >";
$strXML_c2 .="<set value='98' />";
$strXML_c2 .="<set value='1112' />";
$strXML_c2 .="<set value='1192' />";
$strXML_c2 .="<set value='1219' />";
$strXML_c2 .="<set value='1264' />";
$strXML_c2 .="<set value='1282' />";
$strXML_c2 .="<set value='1365' />";
$strXML_c2 .="<set value='1433' />";
$strXML_c2 .="<set value='1559' />";
$strXML_c2 .="<set value='1823' />";
$strXML_c2 .="<set value='1867' />";
$strXML_c2 .="<set value='2198' />";

$strXML_c2 .="</dataset>";
$strXML_c2 .="</chart>";


echo renderChart("".base_url()."Scripts/FusionCharts/Charts/ScrollLine2D.swf", "", $strXML_c2, "c32", 600, 400, false, true);


?>