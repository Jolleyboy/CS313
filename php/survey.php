<?php 
  session_start();
  $file = fopen('surveyData', 'r+');
  $content = fread($file,filesize('surveyData'));
  fclose($file);
  
  $array = explode(" ", $content);
  $array[0] += $_POST['q1'];
  $array[1] += $_POST['q2'];
  $array[2] += $_POST['q3'];
  $array[3] += $_POST['q4'];
  $array[4] += 1;
  $newContent = implode(" ", $array);
  
  $file = fopen('surveyData', 'w+');
  fwrite($file, $newContent);
  fclose($file);
  $_SESSION['completedSurvey'] = true;

  print "<script>";
  print "   ";
  print "</script>";
  print "<h1> Results </h1>";
  print "<div class='resultsGraph'></div>";
  print "<hr class='zeroLine'/>";
  print "<div class='y-axis'> 10 8 6 4 2 0 -2 -4 -6 -8 -10</div>";
  print "<div class='qResults'>";
  print " <div id='r1' style='height:". abs($array[0]) * 10 ."px;" . ($array[0] > 0 ? "-webkit-transform-origin: 50% 0%; transform-origin: 50% 0%; -webkit-transform: rotatex(180deg);transform: rotatex(180deg);" : "") . "'></div>";
  print " <div id='r2' style='height:". abs($array[1]) * 10 ."px;" . ($array[1] > 0 ? "-webkit-transform-origin: 50% 0%; transform-origin: 50% 0%; -webkit-transform: rotatex(180deg);transform: rotatex(180deg);" : "") . "'></div>";
  print " <div id='r3' style='height:". abs($array[2]) * 10 ."px;" . ($array[2] > 0 ? "-webkit-transform-origin: 50% 0%; transform-origin: 50% 0%; -webkit-transform: rotatex(180deg);transform: rotatex(180deg);" : "") . "'></div>";
  print " <div id='r4' style='height:". abs($array[3]) * 10 ."px;" . ($array[3] > 0 ? "-webkit-transform-origin: 50% 0%; transform-origin: 50% 0%; -webkit-transform: rotatex(180deg);transform: rotatex(180deg);" : "") . "'></div>";
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

?>