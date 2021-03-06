<?php 
  require_once $_SERVER['DOCUMENT_ROOT'] . '/php/session.php';
   
  $file = fopen('surveyData', 'r+');
  $content = fread($file,filesize('surveyData'));
  fclose($file);
  $array = explode(" ", $content);
  
  print "<script>";
  print "   ";
  print "</script>";
  print "<h1> Survey Results </h1>";
  print "<div class='resultsGraph'>";
  print "  <hr class='zeroLine'/>";
  print "  <hr class='twoLine'/>";
  print "  <hr class='fourLine'/>";
  print "  <hr class='sixLine'/>";
  print "  <hr class='eightLine'/>";
  print "  <hr class='ntwoLine'/>";
  print "  <hr class='nfourLine'/>";
  print "  <hr class='nsixLine'/>";
  print "  <hr class='neightLine'/>";
  print "  <div class='y-axis'> 10 8 6 4 2 0 -2 -4 -6 -8 -10</div>";
  print "  <div class='qResults'>";
  print "    <div class='r1' style='height:". abs($array[0]) * 10 ."px;" . ($array[0] > 0 ? "-webkit-transform-origin: 50% 0%; transform-origin: 50% 0%; -webkit-transform: rotatex(180deg);transform: rotatex(180deg);" : "") . "'></div>";
  print "    <div class='r2' style='height:". abs($array[1]) * 10 ."px;" . ($array[1] > 0 ? "-webkit-transform-origin: 50% 0%; transform-origin: 50% 0%; -webkit-transform: rotatex(180deg);transform: rotatex(180deg);" : "") . "'></div>";
  print "    <div class='r3' style='height:". abs($array[2]) * 10 ."px;" . ($array[2] > 0 ? "-webkit-transform-origin: 50% 0%; transform-origin: 50% 0%; -webkit-transform: rotatex(180deg);transform: rotatex(180deg);" : "") . "'></div>";
  print "    <div class='r4' style='height:". abs($array[3]) * 10 ."px;" . ($array[3] > 0 ? "-webkit-transform-origin: 50% 0%; transform-origin: 50% 0%; -webkit-transform: rotatex(180deg);transform: rotatex(180deg);" : "") . "'></div>";
  print "  </div>";
  print "</div>";
  print "<div class='keyContainer'>";
  print "  <div class='keyRow'>";
  print "    <div class='key1'></div><span class='keyText'>Preprocessors</span>";
  print "  </div>";
  print "  <div class='keyRow'>";
  print "    <div class='key2'></div><span class='keyText'>Class Work in Class</span>";
  print "  </div>";
  print "  <div class='keyRow'>";
  print "    <div class='key3'></div><span class='keyText'>App Development</span>";
  print "  </div>";
  print "  <div class='keyRow'>";
  print "    <div class='key4'></div><span class='keyText'>Missin' the 'stache</span>";
  print "  </div>";
  print "</div>";
  print "<div class='resultsExplained'>Results are calculated by assigning the values<br/> -2, -1, 0, 1, and 2 to<br/> Strongly Disagree, Disagree, Neutral, Agree, and Strongly Agree respectively.</div>";
  print "<div class='voteTally'>Votes tallied: ". $array[4] ."</div>";
?>