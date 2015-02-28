<html>
  <head>
  </head>
<body style="font-family: monospace;">
<?php
  
  ini_set('display_errors', '1');
  error_reporting(E_ALL);
  date_default_timezone_set("America/Los_Angeles");
  class NextServiceTime {
    public function NextServiceTime()
    {
        $this->seasonEndDate = date("Y-m-d", strtotime("October 31 2015"));
        $this->seasonStartDate = date("Y-m-d", strtotime("March 1 2015"));
        $this->frequency = 15;
        $this->lastCompletedDate = date("Y-m-d", strtotime("February 20 2015"));
    }
    
    public function getServiceDates($numServices) 
    {
      $next = $this->lastCompletedDate;
      $this->yearFromLastRun = date('Y', strtotime($this->lastCompletedDate));

      while ($numServices)
      {
        $next = date("Y-m-d", strtotime($next . "+ $this->frequency days"));
        if ($this->filterDate($next))
        {  
          echo date("M, d, Y", strtotime($next)) . "<br/>";
          $numServices--;
        }
      }
    }

    public function getServiceDatesCustom($numServices, $customStart) 
    {
      $next = $customStart;
      echo date("M, d, Y", strtotime($customStart)) . "<br/>";
      $this->yearFromLastRun = date('Y', strtotime($customStart));

      while ($numServices)
      {
        $next = date("Y-m-d", strtotime($next . "+ $this->frequency days"));
        if ($this->filterDate($next))
        {  
          echo date("M, d, Y", strtotime($next)) . "<br/>";
          $numServices--;
        }
      }
    }

    public function filterDate(&$date)
    {
      $expandRange = $this->frequency / 2;
      $currentYear = date('Y', strtotime($date));
      $start = strtotime("$currentYear-" . date('m-d', strtotime($this->seasonStartDate)));
      $end = strtotime("$currentYear-" . date('m-d', strtotime($this->seasonEndDate . " + $expandRange days")));
      $temp = strtotime($date);
    
      if ($currentYear != $this->yearFromLastRun)
      {
         $date = date("Y-m-d", strtotime(date('Y-m-d', $start)));
         $this->yearFromLastRun = $currentYear;
      }
      
      if ($start <= $temp && $temp <= $end)
      {
        return true;
      }
      else
      {
        return false;
      }
    }
    public $seasonStartDate;
    public $seasonEndDate;
    public $frequency;
    public $lastCompletedDate;
    public $yearFromLastRun;
  }

  $nextServiceTime = new NextServiceTime();
  echo "<h3>Starting from the last completed date:</h3> ";
  $nextServiceTime->getServiceDates(10);
  echo "==================================<br/><h3>With a custom date:</h3> ";
  $nextServiceTime->getServiceDatesCustom(10, date('Y-m-d', strtotime("Jan 1st 2015")));
?>
</body>
</html>