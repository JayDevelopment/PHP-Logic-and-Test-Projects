<?php 
function convert_timestamp_day ($timestamp) {
    $weekday = date('D', $timestamp);
    return $weekday;
}
function convert_timestamp_month ($timestamp) {
    $month = date('F', $timestamp);
    return $month;
}
echo convert_timestamp_day (1572390000);
echo convert_timestamp_month (1572390000);
function next_hundred_days () {
    
    $array = array();
    
    $curent_time = time();
    $hundred_days_later = strtotime('+99 days');
    
    for ($currentDate = $curent_time; $currentDate <= $hundred_days_later;
    $currentDate += (86400)) {
 
        $Store = date('l, F d, Y', $currentDate);
        $array[] = $Store;
    }
    echo "<ol>";
    foreach($array as $date){
        echo "<li>" . $date . "</li>";
    }
    echo "</ol>";
    
}
//next_hundred_days();
function next_ten_thousand_days () {
    
    $array = array();
    
    $curent_time = time();
    $ten_thousand_days_later = strtotime('+9999 days');
    
    for ($currentDate = $curent_time; $currentDate <= $ten_thousand_days_later;
    $currentDate += (86400)) {
        
        $Store = date('l, F d, Y', $currentDate);
        $array[] = $Store;
    }
    echo "<ol>";
    foreach($array as $date){
        if(preg_match("/^Friday, [a-zA-Z]{3,10} 13, [0-9]{4}/i", $date)) {
            echo "<li style='color:red'> $date </li>"; 
        } else {
        echo "<li>" . $date . "</li>";
        
        }
    }
    echo "</ol>";
    
}
//next_ten_thousand_days ()




?>