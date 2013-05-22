<?php
$startDate = date("Y-m-d"); 
$endDate   = "2013-04-25"; 

$o_month = substr($startDate,5,2); 
$o_day = substr($startDate,8,2); 
$o_year = substr($startDate,0,4); 
$n_month = substr($endDate,5,2); 
$n_day = substr($endDate,8,2); 
$n_year = substr($endDate,0,4); 

if ($o_day > $n_day) 
{ 
     $r_days = 30 + ($n_day - $o_day); 
     $o_month++; 
}  
else 
     $r_days = $n_day  - $o_day; 

     if ($o_month > $n_month) 
     { 
        $r_month = 12 + ($n_month - $o_month); 
        $o_year++; 
	} 
	else 
		$r_month = $n_month - $o_month; 
		$r_year = $n_year - $o_year; 
                 
		$numDays  = $r_year . " years "; 
		$numDays .= $r_month . " months "; 
		$numDays .= $r_days . " days";

//echo $numDays;

$day=date('Y-m-d');

// add 7 days to the date above
$NewDate = date('Y-m-d', strtotime($day . " +390 days"));
echo $NewDate;  
?>