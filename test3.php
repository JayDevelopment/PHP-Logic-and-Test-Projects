<?php
function find_good_friday ($year) {
    $easterDate = DateTime::createFromFormat('U', easter_date($year) );
    $easterDate->modify('- 1 days');
    $return = $easterDate->format('F j');
    return $return;
}
for ($i = 2019; $i <= 2029; $i++) {
  echo "My birthday in {$i}" . ' is on ' . date('D, F j', strtotime("december 16 {$i}")) . '<br>'.
       "Good Friday in {$i}" . ' is on ' . find_good_friday($i) . '<br>'.
       "Easter in {$i}" . ' is on ' . date("F j", easter_date($i)) . '<br>';
}
?>